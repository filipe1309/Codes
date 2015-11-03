<?php

/**
 * AdminCategory.class [ MODEL ADMIN ]
 * Responsável por gerencias as cotegorias no sistema no admin!
 * 
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class AdminCategory {

    private $data;
    private $catId;
    private $error;
    private $result;

    // Nome da tabela no bd
    const entity = 'ws_categories';

    public function exeCreate(array $data) {
        $this->data = $data;

        if (in_array('', $this->data)):
            $this->result = false;
            $this->error = ['<b>Erro ao cadastrar:</b> Para cadastrar uma categoria, preencha todos os campos!', WS_ALERT];
        else:
            //echo "Pode cadastrar";
            $this->setData();
            $this->setName();
            $this->create();
        endif;
    }

    public function exeUpdate($categoryId, array $data) {
        $this->catId = (int) $categoryId;
        $this->data = $data;

        if (in_array('', $this->data)):
            $this->result = false;
            $this->error = ["<b>Erro ao atualizar:</b> Para atualizar a categoria {$this->data['category_title']}, preencha todos os campos!", WS_ALERT];
        else:
            //echo "Pode cadastrar";
            $this->setData();
            $this->setName();
            $this->update();
        endif;
    }

    public function exeDelete($categoryId) {
        $this->catId = (int) $categoryId;

        $read = new Read;
        $read->exeRead(self::entity, 'WHERE category_id = :delid', "delid={$this->catId}");

        if (!$read->getResult()):
            $this->result = FALSE;
            $this->error = ['Opss, você tentou remover uma categoria que não existe no sistema!', WS_INFOR];
        else:
            extract($read->getResult()[0]);
            if (!$category_parent && !$this->checkCats()):
                $this->result = FALSE;
                $this->error = ["A <b>seção {$category_title}</b> possui categorias cadastradas. Para deletar, antes altera ou remova as categorias filhas!", WS_ALERT];
            elseif ($category_parent && !$this->checkPosts()):
                $this->result = FALSE;
                $this->error = ["A <b>categoria {$category_title}</b> possui artigos cadastradas. Para deletar, antes altera ou remova todos os posts desta categoria!", WS_ALERT];

            else:
                $delete = new Delete;
                $delete->exeDelete(self::entity, 'WHERE category_id = :deletaid', "deletaid={$this->catId}");
                
                $tipo = ( empty($category_parent) ? 'seção': 'categoria');
                $this->result = true;
                $this->error = ["A <b>{$tipo} {$category_title}</b> foi removida com sucesso do sistema!", WS_ACCEPT];

            endif;

        endif;
    }

    function getResult() {
        return $this->result;
    }

    function getError() {
        return $this->error;
    }

    // PRIVATES

    private function setData() {
        // Aplica strip_tags para cada indice do array
        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);
        $this->data['category_name'] = Check::name($this->data['category_title']);
        $this->data['category_date'] = Check::data($this->data['category_date']);
        $this->data['category_parent'] = ($this->data['category_parent'] == 'null' ? null : $this->data['category_parent']);
    }

    private function setName() {
        $where = (!empty($this->catId) ? "category_id != {$this->catId} AND" : '');

        $readName = new Read;
        $readName->exeRead(self::entity, "WHERE {$where} category_title = :t", "t={$this->data['category_title']}");
        if ($readName->getResult()):
            $this->data['category_name'] = $this->data['category_name'] . '-' . $readName->getRowCount();
        endif;
    }

    // Verifica categorias da seção
    private function checkCats() {
        $readSes = new Read;
        $readSes->exeRead(self::entity, 'WHERE category_parent = :parent', "parent={$this->catId}");
        if ($readSes->getResult()):
            return false;
        else:
            return true;
        endif;
    }

    // Verfica artigos da categoria
    private function checkPosts() {
        $readPosts = new Read;
        $readPosts->exeRead('ws_posts', 'WHERE post_category = :category', "category={$this->catId}");
        if ($readPosts->getResult()):
            return false;
        else:
            return true;
        endif;
    }

    // Cadastra categoria no banco
    private function create() {
        $create = new Create;
        $create->exeCreate(self::entity, $this->data);
        if ($create->getResult()):
            $this->result = $create->getResult();
            $this->error = ["<b>Sucesso:</b> A categoria {$this->data['category_title']} foi cadastrada no sistema", WS_ACCEPT];
        endif;
    }

    private function update() {
        $update = new Update;
        $update->exeUpdate(self::entity, $this->data, 'WHERE category_id = :catid', "catid={$this->catId}");
        if ($update->getResult()):
            $tipo = ( empty($this->data['category_parent']) ? 'seção' : 'categoria' );
            $this->result = true;
            $this->error = ["<b>Sucesso:</b> A {$tipo} {$this->data['category_title']} foi atualizada no sistema", WS_ACCEPT];
        endif;
    }

}

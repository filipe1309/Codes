<?php

/**
 * AdminPost.class.php [ MODEL ADMIN ]
 * Responsável por gerenciar os posts do admin do sistema!
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class AdminPost {

    private $data;
    private $post;
    private $error;
    private $result;

    // Nome da tabela no banco de dados
    const entity = 'ws_posts';

    public function exeCreate(array $data) {
        $this->data = $data;

        if (in_array('', $this->data)):
            $this->error = ['Erro ao cadastrar: Para criar um post, favor preecha todos os campos!', WS_ALERT];
            $this->result = false;
        else:
            $this->setData();
            $this->setName();

            if ($this->data['post_cover']):
                $upload = new Upload;
                $upload->image($this->data['post_cover'], $this->data['post_name']);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->data['post_cover'] = $upload->getResult();
                $this->create();
            else:
                $this->data['post_cover'] = null;
                $this->create();
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
        $cover = $this->data['post_cover'];
        $content = $this->data['post_content'];
        unset($this->data['post_cover'], $this->data['post_content']);

        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);

        $this->data['post_name'] = Check::name($this->data['post_title']);
        $this->data['post_date'] = Check::data($this->data['post_date']);
        $this->data['post_type'] = 'post';

        $this->data['post_cover'] = $cover;
        $this->data['post_content'] = $content;

        $this->data['post_cat_parent'] = $this->getCatParent();
    }

    private function getCatParent() {
        $rCat = new Read;
        $rCat->exeRead('ws_categories', 'WHERE category_id = :id', "id={$this->data['post_category']}");
        if ($rCat->getResult()):
            return $rCat->getResult()[0]['category_parent'];
        else:
            return null;
        endif;
    }

    private function setName() {
        $where = ( isset($this->post) ? "post_id != {$this->post} AND" : '');
        $readName = new Read;
        $readName->exeRead(self::entity, "WHERE {$where} post_title = :t", "t={$this->data['post_title']}");
        if ($readName->getResult()):
            $this->data['post_name'] = $this->data['post_name'] . '-' . $readName->getRowCount();
        else:
            return null;
        endif;
    }

    private function create() {
        $cadastra = new Create;
        $cadastra->exeCreate(self::entity, $this->data);
        if ($cadastra->getResult()):
            $this->error = ["O post {$this->data['post_title']} foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->result = $cadastra->getResult();
        endif;
    }

}

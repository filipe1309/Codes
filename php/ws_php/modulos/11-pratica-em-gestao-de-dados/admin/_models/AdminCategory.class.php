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

    private function create() {
        $create = new Create;
        $create->exeCreate(self::entity, $this->data);
        if($create->getResult()):
            $this->result = $create->getResult();
            $this->error = ["<b>Sucesso:</b> A categoria {$this->data['category_title']} foi cadastrada no sistema", WS_ACCEPT];
        endif;
    }
    
}

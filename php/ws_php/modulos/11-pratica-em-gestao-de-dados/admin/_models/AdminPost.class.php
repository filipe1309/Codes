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

    public function exeUpdate($postId, array $data) {
        $this->post = (int) $postId;
        $this->data = $data;


        if (in_array('', $this->data)):
            $this->error = ['Para atualizar este post, preecha todos os campos ( Capa não precisa ser enviada! )', WS_ALERT];
            $this->result = false;
        else:
            $this->setData();
            $this->setName();

            if (is_array($this->data['post_cover'] )):
                $readCapa = new Read;
                $readCapa->exeRead(self::entity, 'WHERE post_id = :post', "post={$this->post}");

                $capa = '../uploads/' . $readCapa->getResult()[0]['post_cover'];
                //echo $capa;
                if (file_exists($capa) && !is_dir($capa)):
                    //echo 'capa existe';
                    unlink($capa);
                endif;

                $uploadCapa = new Upload;
                $uploadCapa->image($this->data['post_cover'], $this->data['post_name']);
            endif;


            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->data['post_cover'] = $uploadCapa->getResult();
                $this->update();
            else:
                unset($this->data['post_cover']);
                $this->update();
            endif;
        endif;
    }

    public function gbSend(array $images, $postId) {
        $this->post = (int) $postId;
        $this->data = $images;

        $imageName = new Read;
        $imageName->exeRead(self::entity, 'WHERE post_id = :id', "id={$this->post}");
        if (!$imageName->getResult()):
            $this->error = ["Erro ao enviar galeria. O indice {$this->post} não foi encontrado no banco!", WS_ERROR];
            $this->result = false;
        else:
            $imageName = $imageName->getResult()[0]['post_name'];
            //echo $imageName;

            $gbFiles = array();
            $gbCount = count($this->data['tmp_name']);

            $gbKeys = array_keys($this->data);

            for ($gb = 0; $gb < $gbCount; $gb++):
                foreach ($gbKeys as $keys):
                    $gbFiles[$gb][$keys] = $this->data[$keys][$gb];
                endforeach;
            endfor;
            /* echo '<pre>';
              var_dump($gbFiles);
              echo '</pre>'; */

            $gbSend = new Upload;
            $i = $u = 0;

            foreach ($gbFiles as $gbUpload):
                $i++;
                $imgName = "{$imageName}-gb-{$this->post}-" . (substr(md5(time() + $i), 0, 5));
                //echo $imgName.'<br>';
                $gbSend->image($gbUpload, $imgName);

                if ($gbSend->getResult()):
                    $gbImage = $gbSend->getResult();
                    $gbCreate = ['post_id' => $this->post, 'gallery_image' => $gbImage, 'gallery_date' => date('Y-m-d H:i:s')];
                    $insertGb = new Create;
                    $insertGb->exeCreate('ws_posts_gallery', $gbCreate);
                    $u++;
                endif;
            endforeach;

            if ($u >= 1):
                $this->error = ["Galeria atualizada: Foram enviadas {$u} imagens para galeria deste post!", WS_ACCEPT];
                $this->result = true;

            endif;

        /* echo '<pre>';
          var_dump($this);
          echo '</pre>'; */


        endif;
        /* echo '<pre>';
          var_dump($images);
          echo '</pre>'; */
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

    private function update() {
        $update = new Update;
        $update->exeUpdate(self::entity, $this->data, 'WHERE post_id = :id', "id={$this->post}");
        if ($update->getResult()):
            $this->error = ["O post <b>{$this->data['post_title']}</b> foi atualizado com sucesso no sistema!", WS_ACCEPT];
            $this->result = TRUE;
        endif;
    }

}

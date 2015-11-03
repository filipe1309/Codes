<div class="content form_create">

    <article>

        <header>
            <h1>Atualizar Post:</h1>
        </header>


        <?php
//        EchoMsg("Erro ao cadastrar:", "Existem campos ogrigatórios sem preencher.", ALERT);
//        EchoMsg("Erro ao cadastrar:", "A capa deve ser JPG, PNG ou GIF com até 2MB!.", ALERT);
//        EchoMsg("Sucesso:", "Seu post foi cadastrado com sucesso. <a target=\"_blank\" href=\"../artigo/titulo\">Ver Post</a>", ACCEPT);

        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $postid = filter_input(INPUT_GET, 'post_id', FILTER_VALIDATE_INT);

        if (isset($post) && $post['SendPostForm']):

            $post['post_status'] = ($post['SendPostForm'] == 'Atualizar' ? '0' : '1');
            $post['post_cover'] = ( $_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : 'null');
            unset($post['SendPostForm']);

            require '_models/AdminPost.class.php';
            $cadastra = new AdminPost;
            $cadastra->exeUpdate($postid, $post);
            
            //var_dump($cadastra);

            //if ($cadastra->getResult()):
                wsErro($cadastra->getError()[0], $cadastra->getError()[1]);

                // Enviar a galeria caso exista!
                if (!empty($_FILES['gallery_covers']['tmp_name'])):
                    $sendGallery = new AdminPost;
                    $sendGallery->gbSend($_FILES['gallery_covers'], $postid);
                /* echo '<pre>';
                  var_dump($sendGallery);
                  echo '</pre>'; */
                endif;

                //header('Location: painel.php?exe=posts/update&create=true&postid=' . $cadastra->getResult());

            //echo 'Tudo certo!';
            // Executar Location

            //else:

            //endif;

        /* echo '<pre>';
          var_dump($cadastra);
          echo '</pre>'; */
        else:
            $read = new Read;
            $read->exeRead('ws_posts', 'WHERE post_id = :id', "id={$postid}");
            if (!$read->getResult()):
                header('Location: painel.php?exe=posts/index&empty=true');
            else:
                $post = $read->getResult()[0];
            $post['post_date'] = date('d/m/Y H:i:s', strtotime($post['post_date']));
            endif;
        endif;
        
        $checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
        if($checkCreate && empty($cadastra)):
            wsErro("O post <b>{$post['post_title']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
        endif;
        
        ?>


        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Enviar Capa:</span>
                <input type="file" name="post_cover" />
            </label>

            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="post_title" value="<?php if (isset($post['post_title'])) echo $post['post_title']; ?>" />
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea class="js_editor" name="post_content" rows="10"><?php if (isset($post['post_content'])) echo htmlspecialchars($post['post_content']); ?></textarea>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formDate center" name="post_date" value="<?php
                    if (isset($post['post_date'])): echo $post['post_date'];
                    else: echo date('d/m/Y H:i:s');
                    endif;
                    ?>" />
                </label>

                <label class="label_small">
                    <span class="field">Categoria:</span>
                    <select name="post_category">
                        <option value=""> Selecione a categoria: </option>
                        <?php
                        $readSes = new Read;
                        $readSes->exeRead('ws_categories', 'WHERE category_parent IS NULL ORDER BY category_title ASC');
                        if ($readSes->getRowCount() >= 1):
                            foreach ($readSes->getResult() as $ses):
                                echo "<option disabled=\"disabled\" value=\"\"> {$ses['category_title']}</option>";
                                $readCat = new Read;

                                $readCat->exeRead('ws_categories', 'WHERE category_parent = :parent ORDER BY category_title ASC', "parent={$ses['category_id']}");
                                if ($readCat->getRowCount() >= 1):
                                    foreach ($readCat->getResult() as $cat):
                                        echo "<option ";
                                        if ($post['post_category'] == $cat['category_id']):
                                            echo "selected=\"selected\" ";
                                        endif;
                                        echo "value=\"{$cat['category_id']}\"> &raquo;&raquo; {$cat['category_title']} </option>";
                                    endforeach;
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>

                <label class="label_small">
                    <span class="field">Author:</span>
                    <select name="post_author">
                        <option value="<?= $_SESSION['userlogin']['user_id']; ?>"> <?= "{$_SESSION['userlogin']['user_name']} {$_SESSION['userlogin']['user_lastname']}"; ?> </option>
                        <?php
                        $readAut = new Read;
                        $readAut->exeRead('ws_users', 'WHERE user_id != :id AND user_level >= :level ORDER BY user_name ASC', ":id={$_SESSION['userlogin']['user_id']}&level=2");
                        var_dump($readAut);
                        if ($readAut->getRowCount() >= 1):
                            foreach ($readAut->getResult() as $aut):
                                echo "<option ";
                                if ($post['post_author'] == $aut['user_id']):
                                    echo "selected=\"selected\" ";
                                endif;
                                echo "value=\"{$aut['user_id']}\"> {$aut['user_name']} {$aut['user_lastname']} </option>";
                            endforeach;
                        else:
                            echo "<option value=\"3123\"> zica</option>";
                        endif;
                        ?>
                    </select>
                </label>

            </div><!--/line-->

            <div class="label gbform">

                <label class="label">             
                    <span class="field">Enviar Galeria:</span>
                    <input type="file" multiple name="gallery_covers[]" />
                </label>

                <ul class="gallery" style="display: none">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <li<?php if ($i % 5 == 0) echo ' class="right"'; ?>>
                            <div class="img thumb_small"></div>
                            <a class="del" href="#delete">Deletar</a>                    
                        </li>
                    <?php endfor; ?>
                </ul>                
            </div>


            <input type="submit" class="btn blue" value="Atualizar" name="SendPostForm" />
            <input type="submit" class="btn green" value="Atualizar & Publicar" name="SendPostForm" />

        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->
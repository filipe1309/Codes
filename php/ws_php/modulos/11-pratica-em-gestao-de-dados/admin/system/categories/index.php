<div class="content cat_list">

    <section>

        <h1>Categorias:</h1>
        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            wsErro("Você tentou editar uma categoria que não existe no sistema!", WS_INFOR);
        endif;
        
        $delCat = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
        if($delCat):
            require '_models/AdminCategory.class.php';
            $deletar = new AdminCategory;
            $deletar->exeDelete($delCat);
            
            wsErro($deletar->getError()[0], $deletar->getError()[1]);
            /*echo '<pre>';
            var_dump($deletar);
            echo '</pre>';*/
        endif;

        $readSes = new Read;
        $readSes->exeRead('ws_categories', 'WHERE category_parent IS NULL ORDER BY category_title ASC');
        if (!$readSes->getResult()):
            wsErro('Não existe seção cadastrada!', WS_ALERT);
        else:
            foreach ($readSes->getResult() as $ses):
                extract($ses);

                $readPosts = new Read;
                $readPosts->exeRead('ws_posts', 'WHERE post_cat_parent = :parent', "parent={$category_id}");

                $readCats = new Read;
                $readCats->exeRead('ws_categories', 'WHERE category_parent = :parent', "parent={$category_id}");

                $countSesPosts = $readPosts->getRowCount();
                $countSesCats = $readCats->getRowCount();
                ;
                ?>
                <section>

                    <header>
                        <h1><?= $category_title; ?><span>( <?= $countSesPosts; ?> posts ) ( <?= $countSesCats; ?> Categorias )</span></h1>
                        <p class="tagline"><?= $category_content; ?></p>

                        <ul class="info post_actions">
                            <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($category_date)); ?>Hs</li>
                            <li><a class="act_view" target="_blank" href="../categoria/<?= $category_name; ?>" title="Ver no site">Ver no site</a></li>
                            <li><a class="act_edit" href="painel.php?exe=categories/update&catid=<?= $category_id; ?>" title="Editar">Editar</a></li>
                            <li><a class="act_delete" href="painel.php?exe=categories/index&delete=<?= $category_id; ?>" title="Excluir">Deletar</a></li>
                        </ul>
                    </header>

                    <h2>Sub categorias de vídeo aulas:</h2>

                    <?php
                    $readSub = new Read;
                    $readSub->exeRead('ws_categories', 'WHERE category_parent = :subparent', "subparent={$category_id}");

                    if (!$readSub->getResult()):
                    else:
                        $a = 0;
                        foreach ($readSub->getResult() as $sub):
                            $a++;

                            $readCatPosts = new Read;
                            $readCatPosts->exeRead('ws_posts', 'WHERE post_category = :catogoryid', "catogoryid={$sub['category_id']}");
                            ?>
                            <article<?php if ($a % 3 == 0) echo ' class="right"'; ?>>
                                <h1><a target="_blank" href="../categoria/<?= $sub['category_name']; ?>" title="Ver Categoria"><?= $sub['category_title']; ?></a>  ( <?= $readCatPosts->getRowCount(); ?> posts )</h1>

                                <ul class="info post_actions">
                                    <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($sub['category_date'])); ?>Hs</li>
                                    <li><a class="act_view" target="_blank" href="../categoria/<?= $sub['category_name']; ?>" title="Ver no site">Ver no site</a></li>
                                    <li><a class="act_edit" href="painel.php?exe=categories/update&catid=<?= $sub['category_id']; ?>" title="Editar">Editar</a></li>
                                    <li><a class="act_delete" href="painel.php?exe=categories/index&delete=<?= $sub['category_id']; ?>" title="Excluir">Deletar</a></li>
                                </ul>
                            </article>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </section>
                <?php
            endforeach;
        endif;
        ?>

        <div class="clear"></div>
    </section>

    <div class="clear"></div>
</div> <!-- content home -->
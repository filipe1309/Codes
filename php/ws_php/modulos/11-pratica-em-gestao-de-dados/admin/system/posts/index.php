<div class="content list_content">

    <section>

        <h1>Posts:</h1>

        <?php
        $posti = 0;
        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $pager = new Pager('painel.php?exe=posts/index&page=');
        $pager->exePager($getPage, 2);

        $readPosts = new Read;
        $readPosts->exeRead('ws_posts', 'ORDER BY post_status ASC, post_date DESC LIMIT :limit OFFSET :offset', "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
        if ($readPosts->getResult()):
            foreach ($readPosts->getResult() as $post):
                $posti++;
                extract($post);
                $status = (!$post_status ? 'style="background:#fffed8"' : '');
                ?>
                <article<?php if ($posti % 2 == 0) echo ' class="right"'; ?> <?= $status; ?>>

                    <div class="img thumb_small">
                        <?= Check::image('../uploads/' . $post_cover, $post_title, 120, 70); ?>
                    </div>
                    <h1><a target="_blank" href="../artigo/<?= $post_name; ?>" title="Ver Post"><?= $post_title ?></a></h1>
                    <ul class="info post_actions">
                        <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($post_date)); ?>Hs</li>
                        <li><a class="act_view" target="_blank" href="../artigo/<?= $post_name; ?>" title="Ver no site">Ver no site</a></li>
                        <li><a class="act_edit" href="painel.php?exe=posts/update&postid=<?= $post_id; ?>" title="Editar">Editar</a></li>

                        <?php if ($post_status): ?>
                            <li><a class="act_inative" href="painel.php?exe=posts/post&post=<?= $post_id; ?>&action=active" title="Ativar">Ativar</a></li>
                        <?php else: ?>
                            <li><a class="act_ative" href="painel.php?exe=posts/post&post=<?= $post_id; ?>&action=inative" title="Inativar">Inativar</a></li>
                        <?php endif; ?>
                        <li><a class="act_delete" href="painel.php?exe=posts/index&delete=<?= $post_id; ?>" title="Excluir">Deletar</a></li>
                    </ul>

                </article>
                <?php
            endforeach;
        else:
            $pager->returnPage();
            wsErro("Desculpe, ainda não existem posts cadastrados", WS_INFOR);
        endif;
        ?>

        <div class="clear"></div>
    </section>

    <?php
    $pager->exePager('ws_posts');
    echo $pager->getPaginator();
    ?>
    <!--    <div class="paginator">
            <a href="#">Primeira Página</a>
            <a href="#">1</a>
            <a href="#">2</a>
            <span class="atv">3</span>
            <a href="#">4</a>
            <a href="#">5</a> 
            <a href="#">Última Página</a>
        </div>-->

    <div class="clear"></div>
</div> <!-- content home -->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - MVC :: Trabalhando com Template View</title>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';
        echo '<pre>';

        $read = new Read;
        $read->exeRead('ws_categories');
        
        $tpl = file_get_contents('_mvc/category.tpl.html');
        //var_dump($tpl);
        foreach ($read->getResult() as $cat):
            extract($cat);
            //require ('./_mvc/category.php');
            //echo str_replace(['#category_title#', '#category_content#'], [$category_title, $category_content], $tpl);
            //var_dump($cat);
            $cat['pubdate'] = date('Y-m-d', strtotime($cat['category_date']));
            $cat['category_date'] = date('d/m/Y H:i', strtotime($cat['category_date'])) .  'hs';
            
            $links = explode('&','#' . implode("#&#", array_keys($cat)) . '#');
            //var_dump($links);
            
            echo str_replace($links, array_values($cat), $tpl);
        endforeach;
        ?>


    </body>
</html>

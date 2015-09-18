<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - MVC :: Construindo Auxiliar de Visão</title>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';
        echo '<pre>';
        
        $sessao = new Session;

//        View::load('_mvc/category');
//        
//        $read = new Read;$read;
//        $read->exeRead('ws_categories');
//        
//        foreach ($read->getResult() as $cat):
//            View::show($cat);
//        endforeach;
//        
//        echo '<h1>Request</h1>';
//        foreach ($read->getResult() as $cat):
//            View::request('_mvc/category',$cat);
//        endforeach;
//        
        
        // 
        
        $read = new Read;
        $read->exeRead('ws_siteviews_agent');
        View::load('_mvc/navegador');
        
         foreach ($read->getResult() as $nav):
             $nav['agent_lastview'] = date('d/m/Y', strtotime($nav['agent_lastview']));
            View::show($nav);
        endforeach;
        ?>


    </body>
</html>

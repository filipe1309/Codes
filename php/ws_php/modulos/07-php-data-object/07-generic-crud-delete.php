<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Generic Crud :: Delete</title>
        <link rel="stylesheet" href="css/reset.css"/>
    </head>
    <body>

        <?php
        require './_app/Config.inc.php';
        ini_set('display_errors', 1);

        // Enable error reporting
        error_reporting(E_ALL);
        echo '<pre>';
        // ws_siteviews_agent
        
        $deleta = new Delete;
        $deleta->exeDelete('ws_siteviews_agent', "WHERE agent_id = :id", 'id=3');
        
        if($deleta->getResult()):
            echo "{$deleta->getRowCount()} registro(s) removidos com sucesso!<hr>";
        endif;
        
//        var_dump($deleta);
        ?>

    </body>
</html>

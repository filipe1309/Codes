<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Generic Crud :: Update</title>
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
        $dados = ['agent_name' => 'Chrome', 'agent_views' => '120'];

                        
        $update = new Update;
        $update->exeUpdate('ws_siteviews_agent', $dados, 'WHERE agent_id = :id', 'id=5');
        
        if($update->getResult()):
            echo "{$update->getRowCount()} dado(s) atualizados com sucesso!<hr>";
        endif;
        
        $update->setPlaces('id=6');
        $update->setPlaces('id=7');
        $update->setPlaces('id=8');
        
//        var_dump($update);
        ?>

    </body>
</html>

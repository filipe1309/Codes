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
        
        $read = new Read;
        $read->exeRead('ws_siteviews_agent', 'WHERE agent_name = :name AND agent_views >= :views LIMIT :limit', 'name=firefox&views=10&limit=3');
        $read->setPlaces('name=Chrome&views=10&limit=2');
        $read->setPlaces('name=IE&views=5&limit=2');
        
        if($read->getRowCount() >= 1):
            var_dump($read->getResult());
            echo '<hr>';
        endif;
        
        /* limit = 2,5 == offset 2, limit 5*/
        $read->fullRead("SELECT * FROM ws_siteviews_agent LIMIT :limit OFFSET :offset", 'limit=2&offset=2');
        
        var_dump($read);
        ?>

    </body>
</html>

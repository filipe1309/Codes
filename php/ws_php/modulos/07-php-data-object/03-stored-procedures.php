<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Personalizando Erros</title>
        <link rel="stylesheet" href="css/reset.css"/>
    </head>
    <body>

        <?php
        require './_app/Config.inc.php';
        ini_set('display_errors', 1);

        // Enable error reporting
        error_reporting(E_ALL);
        echo '<pre>';

        $conn = new Conn;

        try {

            $query = "SELECT * FROM ws_siteviews_agent WHERE agent_name = :name";
            $exe = $conn->getConn()->prepare($query);

            $exe->bindValue(':name', 'Chrome');
            $exe->execute();

            //$chrome = $exe->fetchAll(PDO::FETCH_ASSOC);
            $chrome = $exe->fetch(PDO::FETCH_ASSOC);

            $exe->bindValue(':name', 'Safari');
            $exe->execute();

            //$safari = $exe->fetchAll(PDO::FETCH_ASSOC);
            $safari = $exe->fetch(PDO::FETCH_ASSOC);
       
        } catch (PDOException $e) {
            phpErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }

        if ($chrome):
            //var_dump($chrome); // $chrome[0]['agent_name']
            echo "{$chrome['agent_name']} tem {$chrome['agent_views']} visita(s)<hr>";
        endif;
        
        if ($safari):
            //var_dump($safari);
            echo "{$safari['agent_name']} tem {$safari['agent_views']} visita(s)<hr>";

        endif;
        
        ?>

    </body>
</html>

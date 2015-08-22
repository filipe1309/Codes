<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Helpers :: Manipulação e Validação</title>
        <link rel="stylesheet" href="css/reset.css"/>
    </head>
    <body>

        <?php
        require './_app/Config.inc.php';
        ini_set('display_errors', 1);

        // Enable error reporting
        error_reporting(E_ALL);
        echo '<pre>';
        
        $check = new Check;
        var_dump($check);
       
        ?>

    </body>
</html>

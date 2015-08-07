<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Acesso Publico</title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        echo '<pre>';
        
       $filipe = new AcessoPublico('Filipe', "Filipe'sCorp@ex.com");
       $filipe->nome = 'Bob';
       $filipe->email = 'bob@dylan.com';
       
       var_dump($filipe);
        ?>
    </body>
</html>

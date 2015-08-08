<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Objeto Dinamico</title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        echo '<pre>';
       
        $cliente = new ObjetoDinamico;
        
        $filipe = new stdClass();
        $filipe->nome = 'Filipe';
        $filipe->email= 'Filipe@teste.com';
        
        $cliente->novo($filipe);
        
        $bob = clone($filipe);
        $bob->nome = 'Bob';
        $bob->email = 'banana';
        
        var_dump($cliente, $filipe, $bob);
        ?>
    </body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Acesso Privado</title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        echo '<pre>';
        
        $filipe = new AcessoPrivado('Filipe', "Filipe'sCorp@ex.com", 12345678901);
        //$filipe-> somente os métodos

        var_dump($filipe);
      
        ?>
    </body>
</html>

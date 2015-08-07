<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Acesso Protegido</title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        echo '<pre>';
        
        $filipe = new AcessoProtegido('Filipe', "Filipe'sCorp@ex.com");
        $filipe->nome = 'Bob';
        //$filipe->email = 'bob@dylan.com';

        $filipe->setEmail('bob@dylan.com');
        //$filipe->setNome('lu');

        var_dump($filipe);
        
        echo '<hr>';
        
        $lu = new AcessoProtegidoFilha('lu', 'lu@lu.com');
        //$lu->setNome();
        
        $lu->addCPF('lulu', '123456789');
        
        
        var_dump($lu);
        ?>
    </body>
</html>

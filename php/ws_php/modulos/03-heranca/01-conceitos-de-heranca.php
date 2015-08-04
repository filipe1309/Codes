<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Conceitos de Herança</title>
    </head>
    <body>
        <?php
            require './inc/Config.inc.php';
            echo '<pre>';
            $pessoa = new Heranca('Filipe L. Bonfim', 25);    
            $pessoa->formar('Pro PHP');
            $pessoa->formar('ws PHP');
            $pessoa->envelhecer();
            $pessoa->verPessoa();
            
            var_dump($pessoa);
            echo '<hr>';
            
            $pessoaME = new HerancaJuridica('Filipe L. Bonfim', 25, "Filipe's Corporation");
            $pessoaME->formar('Pro PHP');
            $pessoaME->formar('ws PHP');
            $pessoaME->envelhecer();
            $pessoaME->verPessoa();
            
            $pessoaME->contratar('Bob');
            $pessoaME->contratar('Lu');
            $pessoaME->verEmpresa();
            
            var_dump($pessoaME);
            
            
        ?>
    </body>
</html>

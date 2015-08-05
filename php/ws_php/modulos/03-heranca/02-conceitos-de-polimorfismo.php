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
         
            $boleto = new Polimorfismo('Pro PHP', '334.90');
            $boleto->pagar();
            
            
            var_dump($boleto);
            echo '<hr>';
            
            $deposito = new PolimorfismoDeposito('Pro PHP', '334.90');
            $deposito->pagar(); // overriding   
            
            var_dump($deposito);
            echo '<hr>';
            
            $cartao = new PolimorfismoCartao('Pro PHP', '334.90');
            $cartao->pagar();
            $cartao->pagar(10);
            
            var_dump($cartao);
            echo '<hr>';
            
        ?>
    </body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Conceitos de Abstração</title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        echo '<pre>';
        /*http://localhost:8080/modulos/03-heranca/03-abstracao-e-super-classe.php*/
//            $conta = new Abstracao('Filipe L. Bonfim', 500);
//            $conta2 = new Abstracao('Bob Dylan', 300);
//            $conta->depositar(1000);
//            $conta->sacar(500);
//            $conta->transferir(500, $conta);
//            $conta->transferir(500, $conta2);
//            
//            var_dump($conta, $conta2);

        $cc = new AbstracaoCC('Filipe', 0, 1000);
        $cp = new AbstracaoCP('Bob', 0);

        $cc->depositar(1000);
        $cc->sacar(500);
        $cc->transferir(500, $cp);

        $cp->depositar(1000);
        $cp->sacar(500);
        $cp->transferir(500, $cc);

        $cc->verSaldo();
        $cp->verSaldo();

        var_dump($cc, $cp);

        /*
         * Classe asbstract -> pode somente ser herdada
         * Classe final -> é uma classe final, que não pode ser herdada
         */
        ?>
    </body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './class/ComportamentoInicial.class.php';  
//            $filipe = new ComportamentoInicial;
//            $filipe->nome = 'Filipe';
//            $filipe->salario = 'banana';
            
            $filipe = new ComportamentoInicial('Filipe', 25, 'Developer', 1000000);
            $bob = new ComportamentoInicial('Bob', 10, 'Dog', 100);
            $luke = new ComportamentoInicial('Luke', 15, 'Jedi', 123);
            $filipe->ver();

        ?>
    </body>
</html>

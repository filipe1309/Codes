<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Modelagem de Classe</title>
    </head>
    <body>
        <?php
            require './class/ModelagemDeClasse.class.php';
            echo '<pre>';

            $filipe = new ModelagemDeClasse('Filipe', 25, Programador, 1200);
            $filipe->setProfissao('Web Master');
            $filipe->trabalhar('um portal', 12000);


            var_dump($filipe);

        ?>
    </body>
</html>

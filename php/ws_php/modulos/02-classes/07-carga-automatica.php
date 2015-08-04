<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Carga Automática</title>
    </head>
    <body>
        <?php
            require './inc/Config.inc.php';
            echo '<pre>';
            
            $classeA = new ClassesObjetos;
            $classeB = new AtributosMetodos;
            $classeC = new ComportamentoInicial('Filipe', 25, 'Programador', 2200);            
            $classeC = new ComportamentoInicialTeste('Filipe', 25, 'Progamador', 2200);            
            
            var_dump($classeA, $classeB, $classeC);
        ?>
    </body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Modelo de Agregação</title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        echo '<pre>';
        /* Neste modelo  com apenas uma instanciação de objeto,
         * instanciamos outros objetos, obtendo assim, acesso aos 
         * seus métodos e atributos
         * 
         */
        $filipe = new ComposicaoUsuario('Filipe L. Bonfim', 'filipe@flp.com');
        $filipe->cadastrarEnderco('Curitiba', 'Paraná');
        
        echo "O email de {$filipe->nome} é {$filipe->email}<br>";
        echo "{$filipe->nome} mora em {$filipe->getEndereco()->getCidade()}/{$filipe->getEndereco()->getEstado()}<br>";
        var_dump($filipe);
        ?>
    </body>
</html>

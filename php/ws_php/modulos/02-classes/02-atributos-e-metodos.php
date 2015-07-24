<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './class/AtributosMetodos.class.php';  
            $pessoa = new AtributosMetodos();
            $pessoa->setUsuario('Filipe', 25, 'Developer');
            $usuario = $pessoa->getUsuario();
            echo $usuario;
            echo '<hr>';
            
           $pessoa->idade = 'banana';
            
           $pessoa->setUsuario('Bob', 10, 'Dog');
           
           $pessoa->setIdade(12);
           $pessoa->envelhecer();
           $pessoa->envelhecer();

            $pessoa->getClasse();

        ?>
    </body>
</html>

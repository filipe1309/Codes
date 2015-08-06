<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Trabalho com Interfaces</title>
    </head>
    <body>
        <?php
        require './interface/IAluno.php';
        require './inc/Config.inc.php';
        echo '<pre>';
      
        
        $aluno = new TrabalhoComInterfaces('Filipe', 'Pro PHP');
        $aluno->formar();
        $aluno->matricular('WS PHP');
        $aluno->formar();
        
        var_dump($aluno);
        ?>
    </body>
</html>

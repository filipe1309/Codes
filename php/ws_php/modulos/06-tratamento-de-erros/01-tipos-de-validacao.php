<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Tipos de Validação (revisão)</title>
    </head>
    <body>

        <h3>Tratamento por existência</h3>
        <hr>
        <?php
        $string = 'contato';
        $string = 3;
        $string = '';

        if (is_string($string)):
            echo 'String é uma string!';
        elseif (!is_string($string)):
            echo 'String não é uma string!';
        endif;

        echo '<hr>';


        if (!empty($string)):
            echo 'String existe e tem valor';
        elseif (isset($string)):
            echo 'String existe mas está em branco';
        endif;
        ?>

        <hr><hr>
        <h3>Tomada de decisão</h3>
        <hr>
        <?php
        $decicao = 'studio@upinside.com.br';

        if (!filter_var($decicao, FILTER_VALIDATE_EMAIL)):
            echo 'E-mail informado é inválido';
        elseif ($decicao == 'campos@upinside.com.br'):
            die('Esse e-mail é restrito!');
        else:
            echo 'E-mail válido!';
        endif;

        echo ' =)';
        ?>
        
        <hr><hr>
        <h3>Retorno de Flags</h3>
        <hr>
        <?php
        function idade($idade = null) {
            if(!$idade):
                return false;
            elseif (!is_int($idade)):
                return false;
            endif;
            
            return 'Você nasceu em: '. (date('Y') - $idade);
        }
        
        $idade = 'abs';
        $idade = '27';
        $idade = 27;
        
        if(idade($idade)):
            echo idade($idade);
        else:
            echo 'Erro, informe um INT idade';
        endif;
        ?>
        
         <hr><hr>
        <h3>Comparação</h3>
        <hr>
        <?php
        $um = 10;
        $dois = '10';
        
        if($um == $dois):
            echo 'Um tem o mesmo valor que dois!';
        elseif ($um != $dois):
            echo 'Um e dois tem valor diferente!';
        endif;
        
        echo '<hr>';
        $um = 10;
        $dois = 10;
        
        if($um === $dois):
            echo 'Um tem o mesmo valor que dois e são do mesmo tipo!';
        elseif ($um !== $dois):
            echo 'Um e dois tem valor diferente ou tipo diferente!';
        endif;
        
        
        ?>
    </body>
</html>

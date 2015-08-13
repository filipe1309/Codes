<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Disparando Erros</title>
    </head>
    <body>

        <?php
        ini_set('display_errors', 1);

        // Enable error reporting
        error_reporting(E_ALL);

        $uso = '98765432112';
        $cpf = '';
        $cpf = '500';
        $cpf = $uso;
        $cpf = 'abs';
        $cpf = $uso;

        if (!$cpf):
            /* Equivalente ao user_error() */
            trigger_error('Informe seu CPF', E_USER_NOTICE);
        elseif ($cpf == '500'):
            trigger_error('Formato não é mais utilizado', E_USER_DEPRECATED);
        elseif ($cpf == $uso):
            trigger_error('CPF em uso!', E_USER_WARNING);
        elseif (!preg_match('/^[0-9]*$/i', $uso) || strlen($cpf) != 11):
            /* É o unico que trava o código */
            trigger_error('CPF inválido', E_USER_ERROR);
        else:
            echo 'CPF Válido!';
        endif;

        echo '<br>=)';

        echo '<hr>';

        function erro($erro, $mensagem, $arquivo, $linha) {
            $error = ($erro == E_USER_ERROR ? 'red' : ($erro == E_USER_WARNING ? 'darkorange' : 'blue'));
            echo "<p style='color:{$error}'>Erro na linha # {$linha}: {$mensagem}<br>";
            echo "<small>{$arquivo}</small></p>";
        
            if($erro == E_USER_ERROR):
                die;
            endif;
            }

        set_error_handler('erro');

        $uso = '98765432112';
        $cpf = '';
        $cpf = '500';
        $cpf = $uso;
        $cpf = 'abs';

        if (!$cpf):
            /* Equivalente ao user_error() */
            trigger_error('Informe seu CPF', E_USER_NOTICE);
        elseif ($cpf == '500'):
            trigger_error('Formato não é mais utilizado', E_USER_DEPRECATED);
        elseif ($cpf == $uso):
            trigger_error('CPF em uso!', E_USER_WARNING);
        elseif (!preg_match('/^[0-9]*$/i', $uso) || strlen($cpf) != 11):
            /* É o unico que trava o código */
            trigger_error('CPF inválido', E_USER_ERROR);
        else:
            echo 'CPF Válido!';
        endif;

        echo '<br>=)';
        ?>

    </body>
</html>

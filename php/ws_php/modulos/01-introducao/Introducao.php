<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (phpversion() >= 5.4):
            echo phpversion() . ' Olá Mundo, podemos programar!';
        else:
            echo phpversion() . ' Olá Mundo, preciso atualizar o PHP!';
        endif;

        echo "<hr>";

        //echo phpinfo();
        
        //echo "<pre>";
        //print_r(ini_get_all());
        //echo "</pre>";
        
        /* Vizualizando/Alterando php.ini com funções nativas do php */
        echo ini_get('date.timezone') . "<br>"; // timezone do arquivo php.ini
        echo 'America/Sao_Paulo: ' . date('d/m/Y H:i:s') . '<br>';

        echo "<hr>";

        date_default_timezone_set("UTC"); // determina que a aplicação utilize um timezone diferente do que esta no php.ini
        echo date_default_timezone_get() . '<br>'; // timezone do sistema/aplicação
        echo 'UTC: ' . date('d/m/Y H:i:s');
        ?>
    </body>
</html>

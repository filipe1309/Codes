<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Helpers :: Manipulação e Validação</title>
        <link rel="stylesheet" href="css/reset.css"/>
    </head>
    <body>

        <?php
        require './_app/Config.inc.php';
        ini_set('display_errors', 1);

        // Enable error reporting
        error_reporting(E_ALL);
        echo '<pre>';
        
//        $check = new Check;
//        var_dump($check);
       
        $email = 'filipe@teste.com';
        if (Check::email($email)):
            echo 'Válido!<hr>';
        else:
            echo 'Inválido!<hr>';
        endif;
        
        $name = 'Estamos aprendendo PHP. Veja você como é!';
        echo Check::name($name) . '<hr>';
        
        $data = '05/01/2014 13:14:20';
        $data = '05/01/2014';
        echo Check::data($data) . '<hr>';
        
        $string = 'Olá mundo, estamos estudando PHP na UPINSIDE!';
        echo Check::words($string, 4, '<small>continue lendo...</small><hr>');
        
        echo Check::catByname('artigos') . '<hr>';
        echo Check::catByname('esportes') . '<hr>';
//        echo Check::catByname('internet') . '<hr>';
        
        echo Check::userOnline() . '<hr>';
        
//        echo Check::image('google.jpg', 'Google');
        echo Check::image('google.jpg', 'Google', 300, 180);
        
        ?>

    </body>
</html>

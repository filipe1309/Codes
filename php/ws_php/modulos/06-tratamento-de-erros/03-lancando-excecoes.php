<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Lançando Exceções</title>
    </head>
    <body>

        <?php
        ini_set('display_errors', 1);

        // Enable error reporting
        error_reporting(E_ALL);
        echo '<pre>';

        $eu = null;
        
        if(!$eu):
            $a = new Exception('Eu é NULL', E_USER_NOTICE);
        endif;
        
        echo $a->getMessage().'<br>';
        
        var_dump($a);
        
        echo '<hr>';
        
        try {
            if(!$eu):
                throw new Exception('Eu novamente está NULL', E_USER_NOTICE);
            endif;
        } catch (Exception $e) {
            echo "<p>Erro #{$e->getCode()}: {$e->getMessage()} <br>";
            echo "<small>{$e->getFile()} na linha {$e->getLine()}</small></p>";
        
            //echo '<hr>';
            //echo $e->xdebug_message;
            }
    
        ?>

    </body>
</html>

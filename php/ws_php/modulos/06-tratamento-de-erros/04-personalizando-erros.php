<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Personalizando Erros</title>
        <link rel="stylesheet" href="css/reset.css"/>
    </head>
    <body>

        <?php
        ini_set('display_errors', 1);

        // Enable error reporting
        error_reporting(E_ALL);
        echo '<pre>';
        
        require './_app/Config.inc.php';
        
        trigger_error('Essa é uma NOTICE', E_USER_NOTICE);
        trigger_error('Essa é uma WARNIG', E_USER_WARNING);
//        trigger_error('Essa é uma ERROR', E_USER_ERROR);
phpErro(WS_ERROR, 'Esse é um erro personalizado', __FILE__, __LINE__);
        
        wsErro('Esse é um ACCEPT', WS_ACCEPT);
        
        try {
            
            throw new Exception('Essa é uma Exceção', E_USER_WARNING);
            
        } catch (Exception $e) {
            
            phpErro($e->getCode(), $e->getMessage(), $e->getFile(),  $e->getLine());
            wsErro($e->getMessage(), $e->getCode());
            wsErro($e->getMessage(), WS_ACCEPT);
        }
        ?>

    </body>
</html>

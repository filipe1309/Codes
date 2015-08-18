<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Generic Crud :: Create</title>
        <link rel="stylesheet" href="css/reset.css"/>
    </head>
    <body>

        <?php
        require './_app/Config.inc.php';
        ini_set('display_errors', 1);

        // Enable error reporting
        error_reporting(E_ALL);
        echo '<pre>';
        
        $dados = ['agent_name' => 'Firefox', 'agent_views' => '1280'];

        $cadastra = new Create;
        //$cadastra->exeCreate('ws_siteviews_agent', $dados);
        
        $dados = ['agent_name' => 'Safari', 'agent_views' => '680'];
        $cadastra->exeCreate('ws_siteviews_agent', $dados);

        
        if($cadastra->getResult()):
            echo 'Cadastro com sucesso!<hr>';
        endif;
        
        var_dump($cadastra);
        ?>

    </body>
</html>

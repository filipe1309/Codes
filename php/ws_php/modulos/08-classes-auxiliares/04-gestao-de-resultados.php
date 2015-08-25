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
        
        /** Verifica se o GET tem um parametro inteiro chamado "atual" */
        $atual = filter_input(INPUT_GET, "atual", FILTER_VALIDATE_INT);
        $pager = new Pager('04-gestao-de-resultados.php?atual=', 'Primeira', 'Última','1');
        $pager->exePager($atual, 1);
        
        $read = new Read;
        $read->exeRead('ws_categories', 'LIMIT :limit OFFSET :offset', "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
        
        if(!$read->getRowCount()):
            $pager->returnPage();
            /*Não existem resultados*/
        else:
            var_dump($read->getResult());
        endif;
        
        $pager->exePaginator('ws_categories');
        
        echo $pager->getPaginator();
//        var_dump($pager);
        
        ?>

    </body>
</html>

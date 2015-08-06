<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Operador de resolução de escopo</title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        echo '<pre>';
        
        $produto = new ResolucaoDeEscopo('Livro de PHP', 59.90);
        $digital = new ResolucaoDeEscopoDigital('Livro PHP', 39.90);
        
        $produto->vender();
        $produto->vender();
        $produto->vender();
        
        $digital->vender();
        $digital->vender();
        
//        $produto->relatorio();
        
        ResolucaoDeEscopo::relatorio();
        echo "O produto Livro PHP vendeu " . ResolucaoDeEscopo::$vendas . '<hr>';
        echo ResolucaoDeEscopoDigital::$digital . ' Livros digitais <hr>';
        echo ResolucaoDeEscopo::$vendas - ResolucaoDeEscopoDigital::$digital . ' Livros impressos<hr>';
        
        var_dump($produto, $digital);
        ?>
    </body>
</html>

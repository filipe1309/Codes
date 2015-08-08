<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Modelo de Agregação</title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        echo '<pre>';
        /* Neste modelo é possível informar de qual classe o 
         * objeto deve ser informado, ou seja,
         * -> Você coloca de qual classe terá que vir 
         * esse objeto e então tem um controle maior!
         */
        $filipe = new AssociacaoCliente('Filipe', 'Filipe@teste.com');
        
        $prophp = new AgregacaoProduto('20', 'Pro PHP', 334.90);
        $wsphp = new AgregacaoProduto('21', 'WS PHP', 289.90);
        $wshtml = new AgregacaoProduto('22', 'WS HTML5', 289.90);
        
        $outroCurso = new stdClass();
        $outroCurso->produto = '23';
        $outroCurso->nome = 'Curso de JQuery';
        $outroCurso->valor = 400;
        
        $carrinho = new AgregacaoCarrinho($filipe);
        
        $carrinho->add($prophp);
        $carrinho->add($wsphp);
        $carrinho->add($wshtml);
        
        $carrinho->remove($wshtml);
        
        //$carrinho->add($outroCurso);
        
        var_dump($carrinho);
        echo '<hr>';
        var_dump($filipe, $prophp, $outroCurso);
        ?>
    </body>
</html>

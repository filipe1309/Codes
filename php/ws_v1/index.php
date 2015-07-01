<?php

    require_once('Xml.Class.php');
    require_once('config.php');
    
    $xml = new Xml();
    
    $erro = 0;
    
    $idproduto = $_GET['id'];
    
    $xml->openTag("response");
    
    if($idproduto == '') {
        $erro = 1;
        $msgerro = "Codigo invalido!";
    }
    else {
        $rs = mysql_query("SELECT * FROM produto WHERE id_produto = $idproduto");
        if(mysql_num_rows($rs) > 0) {
            $reg = mysql_fetch_object($rs);
            $xml->addTag('nome_produto', $reg->nome_produto);
            $xml->addTag('valor_produto', $reg->valor_produto);
        }
        else {
            $erro = 2;
            $msgerro = "Produto nao encontrado!";
        }
    }
    
    $xml->addTag('erro', $erro);
    $xml->addTag('msgerro', $msgerro);
        
    $xml->closeTag("response");
    
    echo $xml;

?>
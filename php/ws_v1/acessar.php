<?php
//https://www.youtube.com/watch?v=fHPYasJzcw8
    $xml = simplexml_load_file("https://codes-filipe1309.c9.io/php/ws_v1/?id=1");
    //print_r($xml);
    
    echo "Nome do produto: ".$xml->nome_produto."<br />";
    echo "Preço: ".$xml->valor_produto."<br />";
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './class/ReplicaClonagem.class.php';
        echo '<pre>';
        $readA = new ReplicaClonagem("posts", "categoria = 'noticias'", "ORDER BY data DESC");
        $readA->ler();
        $readA->setTermos("categoria = 'internet'");
//        $readA->ler();
        
        $readB = $readA;
        $readB->setTermos("categoria = 'redes sociais'");
//        $readB->ler();

        $readC = clone($readA);
        $readC->setTabela("comentarios");
        $readC->setTermos("post = 25");
        
        $readA->ler();
        $readB->ler();
        $readC->ler();
        
        var_dump($readA, $readB, $readC);
        ?>
    </body>
</html>

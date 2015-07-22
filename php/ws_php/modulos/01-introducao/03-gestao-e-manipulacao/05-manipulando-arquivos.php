<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

$baseDir =  getcwd() . '/05';
echo $baseDir;
echo "<hr>";

// r = ler
// w = escrever
// a = anexar

$file = fopen("{$baseDir}/05.txt",'w');
$txt = "Filipe L. Bonfim\r\nFilipe's Corporation\r\nfilipe1309";
fwrite($file, $txt);
fclose($file);

$add = "\r\nCurso em WebDev";
$fileTrue = fopen("{$baseDir}/05.txt", 'a');
fwrite($fileTrue, $add);
fclose($fileTrue);

$fileRead = fopen("{$baseDir}/05.txt", 'r');
while(!feof($fileRead)):
    $dado = fgets($fileRead);
    echo "{$dado}<br>";
endwhile;
fclose($fileRead);
echo '<hr>';

//file_put_contents("{$baseDir}/05.txt", "Mais um teste");

$file = "{$baseDir}/05.txt";
//$fileContent = file_get_contents($file);
//file_put_contents($file, $fileContent . $add);

//$file = file($file);
//var_dump($file);

copy($file, getcwd() . '/05/teste.txt'); // funciona com links da internet, ex: baixar imagens
unlink($file);

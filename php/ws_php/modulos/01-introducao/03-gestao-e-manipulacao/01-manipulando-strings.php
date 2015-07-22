<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

$nome = "Marcelo Silva <br>";
echo strtolower($nome);
echo strtoupper($nome);
echo ucwords($nome);
echo ucfirst($nome);
echo '<hr>';

// TRATAR UMA IMAGEM
$img = "NOME DA IMAGEM.jpg";

$imagem = strtolower(str_replace(' ', '-', $img));
echo $imagem;
echo '<hr>';

// Coloca zero a esquerda enquanto a string tiver tamanho 2
for($i = 1; $i <= 10; $i++):
    echo str_pad($i, 2, 0, STR_PAD_LEFT). '<br>';
endfor;
echo '<hr>';

$escreva = "DESCULPA, ";
echo str_repeat($escreva, 100);
echo '<hr>';

// O PRIMEIRO
$novoNome = "Filipe L. Bonfim";
echo substr($novoNome, 0, 6);
echo '<br>';

// strpos - primeira ocorrencia da esquerda p direira
echo substr($novoNome, 0, strpos($novoNome, ' '));
echo substr($novoNome, strpos($novoNome, ' '));
echo '<br>';

// strrpos - primeira ocorrencia da direita p esquerda
echo substr($novoNome, 0, strpos($novoNome, ' '));
echo substr($novoNome, strrpos($novoNome, ' '));
echo '<br>';

$ext = substr($img, strrpos($img, '.') + 1);
echo "<hr>{$ext}";

echo str_repeat('<br>', 20);



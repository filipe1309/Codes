<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

$Pessoa = [];
$Pessoa['nome'] = 'Filipe L. Bonfim <script><?=';
$Pessoa = array_pad($Pessoa, 5, null);

$Pessoa = array_filter($Pessoa);
$Pessoa = array_map('strip_tags', $Pessoa);
$Pessoa = array_map('trim', $Pessoa);

array_push($Pessoa, 29);
//array_push($Pessoa, ['idade' => 29]);
array_pop($Pessoa);
array_unshift($Pessoa, 29); // insere no inicio
array_shift($Pessoa); // remove no inicio

$Pessoa['idade'] = 28;
$Pessoa['job'] = "Webmaster";

$Pessoa = array_reverse($Pessoa); // inverte array

$Job['empresa'] = "Filipe's Corporation";
$Empresa['atuacao'] = "Consultoria";
$Casa['cidade'] = "Curita";

$Pessoa = array_merge($Pessoa, $Empresa, $Casa);

var_dump($Pessoa);

var_dump(array_keys($Pessoa));
var_dump(array_values($Pessoa));
var_dump(array_slice($Pessoa, 2, 2)); // tipo offset e limit no bd
var_dump("O array tem ".  count($Pessoa). " indices");

if(in_array("Curita", $Pessoa)):
    echo 'Existe';
endif;


asort($Pessoa); // Ordena pelo valor
arsort($Pessoa); // Ordena invertido pelo valor
ksort($Pessoa); // Ordena pelo indice
krsort($Pessoa); // Ordena invertido pelo indice

//remove associação
sort($Pessoa); // Ordena pelo valor
rsort($Pessoa); // Ordena invertido pelo valor


$nomes =  "Filipe, Bob, Hakuna";
$nomes = explode(', ', $nomes);
$nomes = implode($nomes, ', ');

<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');


// Array relacional - indices definidos automaticamente pelo php
$Arr = array('PHP', 'HTML', 'CSS');
$Arr[] = 'JS';
var_dump($Arr);
echo "<br>";

// Nova sintax de array
$ArrB = ['PHP', 'HTML', 'CSS'];
$ArrB[] = 'JS';
var_dump($ArrB);
echo "<br>";



foreach ($ArrB as $lang):
    echo "{$lang}<br>";
endforeach;
echo "<br>";
echo "<br>";

// Array Associavo - programador define os indices
$ArrC = [
    'cargo' =>'prgramador', 
    'salario' => 2200
];
$ArrC['empresa'] = 'Upinside <?=';
$ArrC['cargo'] = 'Webmaster';
$ArrC['salario'] += 5000;
$ArrC['cargo'] .= '/Programador';

$ArrC = array_map('strip_tags', $ArrC);
$ArrC = array_map('trim', $ArrC);
var_dump($ArrC);
echo "<br>";
echo "<br>";

// Obter dados de um array - modo 1
echo "Eu sou {$ArrC['cargo']} na {$ArrC['empresa']}";
echo "<br>";
echo "<br>";

extract($ArrC);
// Obter dados de um array - modo 2
echo "Eu sou {$cargo} na {$empresa} e ganho ".  number_format($salario, 2, ',','.')." por mês!";

echo "<br>";
echo "<br>";

// Array Multidimensional - muito usado para bd
$colaboradores = [];
$colaboradores[] = ['nome' => 'Filipe L. Bonfim', 'salario' => 7200, 'cargo' => 'Webmaster'];
$colaboradores[] = ['nome' => 'Bob L. Bonfim', 'salario' => 7200, 'cargo' => 'Aprendiz'];
$colaboradores[] = ['nome' => 'Elvis L. Bonfim', 'salario' => 7200, 'cargo' => 'Aprendiz'];

foreach ($colaboradores as $cargo):
    extract($cargo);
echo "{$nome} é {$cargo} na {$empresa} e recebe ".  number_format($salario, 2, ',','.')." por mês!<br>";
endforeach;

echo "<br>";
echo "<br>";

var_dump($colaboradores);


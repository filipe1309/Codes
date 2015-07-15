<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

// STR = string
$str = "Olá Mundo!";
var_dump($str);

// ARR = array
$arr = array();
$arr['nome'] = "Filipe";
$arr['idade'] = "29";
var_dump($arr);

// BOOL = booleano
$bool = true;
$idade = 26;
$velho = ($idade > 27);
var_dump($bool);
//if($bool):
//    echo "TRUE";
//else:
//    echo "FALSE";
//endif;
$opa = null; // == false
$int = 0; // == false
$str = ""; // == false
$arr = array(); // == false


// INT = inteiro
$idade = 29;
var_dump($idade);

// FLOAT = flutuante
$flt = 0.8;
var_dump($flt);

// NUMÉRICAS
$numInt = 1276523;
var_dump($numInt);

$numFlt = 0.8;
var_dump($numFlt);

$numNegativo = -123;
var_dump($numNegativo);

$numCalc = 2*2.86;
var_dump($numCalc);

echo "<hr>";

// OBJ = Objeto
$obj = new stdClass();
$obj->Nome = "Filipe";
$obj->Idade = 29;
var_dump($obj);

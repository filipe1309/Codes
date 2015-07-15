<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

// ATRIBUIÇÃO
$var = 10;
$var += 5; // Soma
$var -= 10; // Subtrai
$var *= 10; // Multiplica
$var /= 10; // Divide

var_dump($var);


// ARITMÉTICOS
$a = 10;
$b = 5;
$c = $a + $b;
$c = $a + $b * $b;
$c = ($a + $b) / $b;

var_dump($c);

// RELACIONAIS

$a = 5;
$b = "5";

if($a == $b): // Não verifica tipo, interpreta string como int
    echo "A igual a B";
endif;


if($a === $b): // Verifica tipo
    echo "A igual a B";
endif;

if ($a != $b): endif; // Se igual

if ($a == $b): endif; // Se igual
if ($a === $b): endif; // Se identico
if ($a != $b): endif; // Se diferente
if ($a !== $b): endif; // Se não identico
if ($a > $b): endif; // Se maior
if ($a >= $b): endif; // Se maior ou igual
if ($a < $b): endif; // Se menor
if ($a <= $b): endif; // Se menor ou igual

// EXISTENCIA
if ($a): endif; // Se existe
if (!$a): endif; // Se não existe
if (isset($a)): endif; // Se existe
if (!isset($a)): endif; // Se não existe
if (empty($a)): endif; // Se não existe ou estiver vazia
if (!empty($a)): endif; // Se existe e tem valor

echo "<hr>";

// LÓGICOS
$l = "";
$s = "Filipe's Corporation";

if(!$l && $s): // ou and
    echo "Existe as duas";
endif;



if(!$l || $s): // ou or
    echo "Existe as duas";
endif;

$ab = null;
echo "<br>e: ".empty($ab);
echo "<br>i: ".isset($ab);

if(empty($l) && $s == "Filipe's Corporation"): 
    echo "true";
else:
    echo "false";
endif;


 
    
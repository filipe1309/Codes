<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

// WHILE: Enquanto acontecer;
$i = 1;
while ($i <= 10):
    echo "{$i} X 8 = ". $i * 8 . "<br>";
    $i ++;
endwhile;
echo '<hr>';

// FOR = Execute X vezes
for($e = 1; $e <= 10; $e++):
    echo "{$e} X 10 = ". $e * 10 . "<br>";
endfor;
echo '<hr>';

// FOREACH: Arrays
$Arr = ['WS PHP', 'WS HTML5', 'WS RWD', 'WS PP'];
foreach ($Arr as $curso):
    echo "Meu treinamento tem o curso {$curso}<br>";
endforeach;

$ArrName = ['nome' => 'Filipe', 'idade' => 28];
foreach ($ArrName as $key => $value):
    echo "{$key} = {$value}<br>";
endforeach;
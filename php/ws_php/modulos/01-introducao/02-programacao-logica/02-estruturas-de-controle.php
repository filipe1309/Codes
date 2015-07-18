<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

$teste = true;

// SE, SENÂO
if($teste):
    echo 'True';
else:
    echo 'False';
endif;

echo '<br>';

if($teste){
    echo 'True';
} else {
    echo 'False';
}

echo '<hr>'; 
 
$teste = false;
$result = 1232321;
if($teste && !empty($result)):
    echo "Teste positivo: {$result}";
elseif($teste && empty($result)):
echo "Teste positivo mas sem resultados!";
else:
    echo 'Teste negativo!';
endif;
echo '<hr>'; 

// BATERIA
$mes = 2;
switch ($mes):
    case 1:
        echo 'Janeiro';
        break;
    case 2:
        echo 'Fevereiro';
        break;
    default :
        echo 'Teste inválido!';
        break;
    
endswitch;
echo '<hr>'; 

$mesMais = 7;

switch ($mesMais):
    /*case 4:
    case 5:
    case 6:*/
    case ($mesMais <= 6):
        echo 'Ainda estamos no primeiro semestre';
        break;
    default :
        echo 'passamos!';
        break;
endswitch;
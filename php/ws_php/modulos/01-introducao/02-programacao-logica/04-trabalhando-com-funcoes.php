<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

function Tabuada() {
    echo '<b>Tabuada do 5:</b><br>';
    for($x = 1; $x <= 10; $x++):
        echo "5 x {$x} = " . 5 * $x . '<br>';
    endfor;
    echo '<hr>';
}

echo Tabuada();

function minhaTabuada($numero) {
    $result = "<b>Tabuada do {$numero}:</b><br>";
    for($x = 1; $x <= 10; $x++):
        $result .= "{$numero} x {$x} = " . $numero * $x . '<br>';
    endfor;
    $result .= '<hr>';
    return $result;
}

echo minhaTabuada(4);
echo minhaTabuada(5);
echo minhaTabuada(6);

<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

$bolsa = "Marrom";

if (!empty($bolsa)):
    if ($bolsa == "Vermelha"):
        echo "Amor, comprei a bolsa que você queria";
    elseif ($bolsa == "Preta"):
        echo 'Amor, comprei a preta pois não tinha a vermelha!';
    else:
        echo "Alô amor, não tem as cores, posso levar outra?<br>";
        $amor = FALSE;
        if($amor):
            echo 'Pode sim amor, Traga qualquer uma!';
        else:
            echo 'O sofa te espera!';
        endif;
    endif;
else:
    echo "Amor. Não tem mais a bolsa :/";
endif;
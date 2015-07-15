<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

// COMPILAÇÂO
// Não colocar dentro de blocos (ifs, whiles...)
        const DEV_NAME = "FILIPE LB";
        const DEV_AGE = 29;

//echo DEV_NAME;
// Inserida em echo por concatenação
echo "Meu nome é " . DEV_NAME . ". Eu tenho " . DEV_AGE;
echo "<hr>";

// EXECUÇÃO
define("DB_NAME", "_wsphp");
$teste = "foi";
define("DB_NAME2", $teste); // com const isto não é possível =P
        
echo DB_NAME;

define("DB_USER", "root");
define("DB_PASS", "");
define("DB_HOST", "localhost");

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($db):
    echo "Conectamos com o db: " . DB_NAME;
else:
    echo "Erro ao  conectar: " . mysqli_connect_error();
endif;
    
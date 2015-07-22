<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');
echo '<pre>';
// include - Caso arquivo não exista, gera erro mas continua execução do código
//include './MinhaClasse.class.php'; 

// require - Caso arquivo não exista, gera erro e não continua execução do código
require'MinhaClasse.class.php'; 
require'MinhaSegundaClasse.class.php'; 

$filipe = new MinhaSegundaClasse;
$filipe->setNome('Filipe');
$filipe->setEmpresa('Filipes Corparation');
$filipe->setRamo('Cursos Web');
$filipe->setIdade(25);

var_dump($filipe);
var_dump(get_class_methods($filipe)); // obj
var_dump(get_class_methods('MinhaSegundaClasse')); // class
var_dump(get_class_vars('MinhaSegundaClasse'));
var_dump(get_class($filipe));
var_dump(get_parent_class($filipe));
var_dump(is_subclass_of($filipe, 'MinhaClasse'));
var_dump(method_exists($filipe, 'getNome'));


var_dump(call_user_func('strtoupper',$filipe->getNome()));
var_dump(call_user_func([$filipe, 'getIdade']));


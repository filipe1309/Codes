<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

$meuNome = "Filipe LB";
$MeuNome;
$Nome;
$nome;

$minha_empresa = "Filipe's Corporation";

$idadeDoCliente = 29;
$idade_do_cliente = 29;

echo "Meu nome é {$meuNome}. Eu trabalho na {$minha_empresa} e tenho {$idadeDoCliente} anos!<hr>";

// VAR de referencia
$var = "empresa";
$$var = "Filipe's Corporation"; // equivalente a $empresa = "..."
echo "Minha {$var} é a {$empresa}<hr>";

// Reescrita
$Nome = "Marcos";
echo "{$Nome}<br>";

// Concatenação
$Nome = "Filipe";
$Nome .= " LB";
echo "{$Nome}<br>";

// 
$Nome = $meuNome;
echo "{$Nome}<br>";
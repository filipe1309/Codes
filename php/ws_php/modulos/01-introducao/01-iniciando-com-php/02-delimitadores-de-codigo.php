<?php
// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

//Comentário de código

/* 
 * Comentário Recursivo (p documentação)
 */

/*
    Comentário de várias linhas
*/

$ola = "Olá Mundo";
$nome = "Filipe";

echo $ola;
echo "<hr>";

echo '$ola'; // Exibe e não interpreta
echo "<br>";
echo "$ola"; // Exibe e interpreta
echo "<br>";
echo $ola;
echo "<br>";
echo "{$ola}s"; 
echo "<br>";
echo "{$ola}, meu nome é {$nome}!"; 
echo "<hr>";

print("{$ola}<br>"); // Existe para retrocompatibilidade com C, o print instancia através de uma função o echo, não encadeia (ex echo $a,$b;), não tem atalho '<?=', não é recomendado a utilização

$Arr = array(
    "ola" => "Olá Mundo!",
    "nome" => "Filipe"
);

print_r($Arr);

$idade = 29;
echo $idade;

var_dump($idade);
var_dump($Arr);
var_dump($ola);

echo "<hr>";

?>

<article>
    <h1><?= $ola; ?></h1>
    <p>Meu nome é <?php echo $nome; ?></p>
</article>

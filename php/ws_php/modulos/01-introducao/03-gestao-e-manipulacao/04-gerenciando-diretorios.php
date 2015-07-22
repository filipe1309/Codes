<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

function checkDir($Dir) {
    if (file_exists($Dir) && is_dir($Dir)):
        return true;
    else:
        return false;
    endif;
}

$getDir = getcwd();
$setDir = "{$getDir}/04";

echo "{$getDir}<hr>";

if(!checkDir($setDir)):
    mkdir($setDir, 0777);
endif;

if(checkDir($setDir)):
//    rmdir($setDir);
endif;

//rename($setDir, "{$getDir}/uploads"); // renomeia pasta

//rename("{$getDir}/05", "{$setDir}/05"); // move pasta

chdir($setDir);
echo getcwd();
echo "<hr>";
//chdir('../');
//echo getcwd();

$newDir = getcwd();

$openDir = opendir($newDir);
while ($file = readdir($openDir)):
    if($file != '.' && $file != '..'):
        echo "<img src='04/{$file}' width='150'/><br>";
        echo "{$file}<br>";
    endif;
endwhile;

echo "<hr>";

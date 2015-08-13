<?php

// CONFIGURAÇÕES DO SITE ####################
// AUTO LOAD DE CLASSES  ####################

function __autoload($class) {
    $dirName = 'class';

    if (file_exists("{$dirName}/{$class}.class.php")):
        echo "Método mágico autoload incluiu:  {$dirName}/{$class}.class.php<br>";
        require_once "{$dirName}/{$class}.class.php";
    else:
        die("Erro ao incluir {$dirName}/{$class}.class.php<hr>");
    endif;
}

// TRATAMENTO DE ERROS ####################
// CSS  constantes :: Mensagens de Erro
define('WS_ACCEPT', 'accept');
define('WS_INFOR', 'infor');
define('WS_ALERT', 'alert');
define('WS_ERROR', 'error');

// wsErro :: Exibe erros lançados :: Front
function wsErro($errMsg, $errNo, $errDie = null) {
    $cssClass = ($errNo == E_USER_NOTICE ? WS_INFOR : ($errNo == E_USER_WARNING ? WS_ALERT : ($errNo == E_USER_ERROR ? WS_ERROR : $errNo)));

    echo "<p class=\"trigger {$cssClass}\">{$errMsg}<span class=\"ajax_close\"></span></p>";

    if ($errDie):
        die;
    endif;
}

// phpErro :: personaliza o gatilho do PHP
function phpErro($errNo, $errMsg, $errFile, $errLine) {
    $cssClass = ($errNo == E_USER_NOTICE ? WS_INFOR : ($errNo == E_USER_WARNING ? WS_ALERT : ($errNo == E_USER_ERROR ? WS_ERROR : $errNo) ));
    echo "<p class=\"trigger {$cssClass}\">";
    echo "<b>Erro na linha: {$errLine} ::</b> {$errMsg}<br>";
    echo "<small>{$errFile}</small>";
    echo '<span class="ajax_close"></span></p>';

    if ($errNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('phpErro');

<?php
define('HOME', 'http://localhost:8080/modulos/08-classes-auxiliares');

// CONFIGURAÇÕES DO SITE ####################
define('HOST', 'localhost'); // runtime, se fosse cont seria compile time
define('USER', 'root');
define('PASS', '123mudar');
define('DBSA', 'wsphp');

// AUTO LOAD DE CLASSES  ####################

function __autoload($class) {
    // Configuração de diretório
    $cDir = ['Conn','Helpers'];
    // Include diretório, para verificar se a inclusão ocorreu
    $iDir = null;

    foreach ($cDir as $dirName) :
        if (!$iDir && file_exists($file = __DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $class . ".class.php") && !is_dir($file)):
            include_once ($file);
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possível incluir {$class}.class.php", E_USER_ERROR);
        die;
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

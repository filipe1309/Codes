<?php

// Alterando documento para HTML
header('Content-type: text/html; charset=utf-8');

// Função valida e-mail
function emailValidade($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)):
        return TRUE;
    else:
        return FALSE;
    endif;
    
    // ou return filter_var($email, FILTER_VALIDATE_EMAIL)
}

$nome = "Filipe";
$email = "filipe@filipe.com";

if(empty($nome) || empty($email)):
    echo "Ops: Informe seu Nome e E-mail!";
elseif(!emailValidade($email)):
    echo "Ops: Informe um e-mail válido!";
else:
    $users = [
        'cursos@upinside.com.br',
        'maria@upinside.com.br'
    ];
    if(in_array($email, $users)):
        echo 'Ops. Você já é cadastrado. Quer Logar <a href="#">Sim</a>';
    else:
        echo 'Cadastro com sucesso!';
    endif;
endif;
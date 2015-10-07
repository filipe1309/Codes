<?php

/**
 * Login.class [ MODEL ]
 * Responsável por autenticar, validar e checar usuários do sistema de login!
 * 
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class Login {

    private $level;
    private $email;
    private $senha;
    private $error;
    private $result;

    function __construct($level) {
        $this->level = (int) $level;
    }

    public function exeLogin(array $userData) {
        $this->email = (string) strip_tags(trim($userData['user']));
        $this->senha = (string) strip_tags(trim($userData['pass']));
        $this->setLogin();
    }

    public function getResult() {
        return $this->result;
    }

    public function getError() {
        return $this->error;
    }

    public function checkLogin() {
        if (empty($_SESSION['userlogin']) || $_SESSION['userlogin']['user_level'] < $this->level):
            unset($_SESSION['userlogin']);
            return FALSE;
        else:
            return TRUE;
        endif;
    }

    // PRIVATES

    private function setLogin() {
        if (!$this->email || !$this->senha || !Check::email($this->email)):
            $this->error = ['Informe seu email e senha para efetuar o login!', WS_INFOR];
            $this->result = FALSE;
        elseif (!$this->getUser()):
            $this->error = ['Os dados informados não são compatíveis!', WS_ALERT];
            $this->result = FALSE;
        elseif ($this->result['user_level'] < $this->level):
            $this->error = ["Desculpe {$this->result['user_name']}, você não tem permissão para acessar esta área", WS_ERROR];
            $this->result = FALSE;
        else:
            /* echo 'Logar aqui';
              die; */
            $this->execute();
        endif;
    }

    private function getUser() {
        $this->senha = md5($this->senha);

        $read = new Read;
        $read->exeRead('ws_users', 'WHERE user_email = :e AND user_password = :p', "e={$this->email}&p={$this->senha}");

        if ($read->getResult()):
            $this->result = $read->getResult()[0];
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    private function execute() {
        if (!session_id()):
            session_start();
        endif;

        $_SESSION['userlogin'] = $this->result;
        $this->error = ["Olá {$this->result['user_name']}, seja bem vindo(a). Aguarde redirecionamento", WS_ACCEPT];
        $this->result = true;
    }

}

<?php
session_start();
require('../_app/Config.inc.php');

//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Site Admin</title>

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/admin.css" />

    </head>
    <body class="login">

        <div id="login">
            <div class="boxin">
                <h1>Administrar Site</h1>

                <?php
                echo '<pre>';
                $login = new Login(3);
                //wsErro("Os dados não conferem. Favor informe seu e-mail e senha!", WS_ERROR);

                if ($login->checkLogin()):
                    header('Location: painel.php');
                endif;

                $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($dataLogin['AdminLogin'])):
                    //echo md5($dataLogin['pass']);
                    $login->exeLogin($dataLogin);
                    //var_dump($login);

                    if (!$login->getResult()):
                        wsErro($login->getError()[0], $login->getError()[1]);
                    else:
                        header('Location: painel.php');
                    endif;

                endif;

                $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                if (!empty($get)):
                    if ($get == 'restrito'):
                        //http://localhost:8080/modulos/11-pratica-em-gestao-de-dados/admin/index.php?exe=restrito
                        //echo 'Restrito!';
                        wsErro('<b>Opss:</b> Acesso negado. Favor efetue login para acessar o painel!', WS_ALERT);
                    elseif ($get == 'logoff'):
                        //echo 'Deslogou';
                        wsErro('<b>Sucesso ao deslogar:</b> Sua sessão foi finalizada volte sempre!', WS_ACCEPT);
                    endif;
                endif;


                echo '</pre>';
                ?>

                <form name="AdminLoginForm" action="" method="post">
                    <label>
                        <span>E-mail:</span>
                        <input type="email" name="user" />
                    </label>

                    <label>
                        <span>Senha:</span>
                        <input type="password" name="pass" />
                    </label>  

                    <input type="submit" name="AdminLogin" value="Logar" class="btn blue" />

                </form>
            </div>
        </div>

    </body>
</html>
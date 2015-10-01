<?php
require('../_app/Config.inc.php');
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
                wsErro("Os dados não conferem. Favor informe seu e-mail e senha!", WS_ERROR);
                
                $teste = new Read;
                ?>

                <form name="login" action="" method="post">
                    <label>
                        <span>E-mail:</span>
                        <input type="email" name="user" />
                    </label>

                    <label>
                        <span>Senha:</span>
                        <input type="password" name="pass" />
                    </label>  

                    <input type="submit" value="Logar" class="btn blue" />

                </form>
            </div>
        </div>

    </body>
</html>
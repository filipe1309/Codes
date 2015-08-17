<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Personalizando Erros</title>
        <link rel="stylesheet" href="css/reset.css"/>
    </head>
    <body>

        <?php
        require './_app/Config.inc.php';
        ini_set('display_errors', 1);

        // Enable error reporting
        error_reporting(E_ALL);
        echo '<pre>';

        $PDO = new Conn;
        $name = 'Firefox';
        $views = '128';

        try {

            /*
             * Query com  prepared statements, para evitar SQLInjection  =) 
             * Os dados não serão executados diretamente,
             * mas sim inseridos (bind).          
             */
            $qrCreate = "INSERT INTO ws_siteviews_agent (agent_name, agent_views) VALUES (?, ?)";
            $create = $PDO->getConn()->prepare($qrCreate);

            /**
             * Atribui valores aos links
             * @param indíce(link), valor, tipo (Se não for informado, o default é string)
             */
//            $create->bindValue(1, 'IE', PDO::PARAM_STR);
//            $create->bindValue(2, '8', PDO::PARAM_INT);

            /**
             * Tem as mesma função que o bindValue, 
             * mas possui mais segurança e opções 
             * @param indíce/nome_do_link, parametros(não aceita valor direto), tipo (Se não for informado, o default é string), tamanho
             */
            $create->bindParam(1, $name, PDO::PARAM_STR, 15);
            $create->bindParam(2, $views, PDO::PARAM_INT, 5);

//            $create->execute();
            /**
             * rowCount -> método da PDO que conta quantas colunas foram alteradas no CREATE/UPDATE/DELETE
             */
            if ($create->rowCount()):
                echo "{$PDO->getConn()->lastInsertId()} - Cadastro com sucesso! <hr>";
            endif;

            /**
             * Exemplo de nomeação do link (ao invés de '?' -> ':visitas')
             */
            $qrSelect = "SELECT * FROM ws_siteviews_agent WHERE agent_views >= :visitas";
            $select = $PDO->getConn()->prepare($qrSelect);

            $select->bindValue(':visitas', '7');

            $select->execute();

            if ($select->rowCount() >= 1):
                echo "Pesquisa retornou {$select->rowCount()} resultado(s)<hr>";
                /*Retrona todos os resultados da consulta na forma de array*/
                $resultado = $select->fetchAll(PDO::FETCH_ASSOC);
                var_dump($resultado);
            else:
                echo 'Nada ainda!<hr>';
            endif;
        } catch (PDOException $e) {
            phpErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
        ?>

    </body>
</html>

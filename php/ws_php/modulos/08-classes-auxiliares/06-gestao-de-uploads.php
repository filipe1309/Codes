<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Helpers :: Manipulação e Validação</title>
        <link rel="stylesheet" href="css/reset.css"/>
    </head>
    <body>

        <?php
        require './_app/Config.inc.php';
        ini_set('display_errors', 1);

        // Enable error reporting
        error_reporting(E_ALL);
        echo '<pre>';

        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($form && $form['sendImage']):

            $upload = new Upload('uploads/');
            $imagem = $_FILES['imagem'];

            $upload->image($imagem);
             var_dump($upload);


        endif;
        ?>

        <form name="fileForm" action="" method="post" enctype="multipart/form-data">
            <label>
                <input type="file" name="imagem" />
            </label>

            <input type="submit" name="sendImage" value="enviar arquivo!" />
        </form>

    </body>
</html>

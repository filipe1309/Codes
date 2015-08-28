<!DOCTYPE html>
<html lang="pt-br">
    <head>

        <meta charset="UTF-8">

        <title>WS PHP - Helpers :: Upload de Arquivos e Midias</title>

        <link rel="stylesheet" href="css/reset.css" />

        <style>

            label{display: block; margin-bottom: 15px;}

            label span{display: block;}

        </style>

    </head>
    <body>

        <?php
        require './_app/Config.inc.php';
        ini_set('display_errors', 1);

        // Enable error reporting
        error_reporting(E_ALL);
        echo '<pre>';
        $maxFile = ini_get("upload_max_filesize");
        $maxPost = ini_get('post_max_size');
        echo "maxFile: $maxFile <br>";
        echo "maxPost: $maxPost <br>";

        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($form && $form['sendFile']):
            $file = $_FILES['arquivo'];
            if ($file['name']):
                $upload = new Upload('uploads/');
                $upload->file($file);
                var_dump($upload);
            endif;
            
            $midia = $_FILES['midia'];
             if ($file['name']):
                $upload = new Upload('uploads/');
                $upload->media($midia);
                var_dump($upload);
            endif;
            
        endif;
        ?>

        <form name="fileForm" action="" method="post" enctype="multipart/form-data">

            <label>

                <span>Arquivo:</span>

                <input type="file" name="arquivo"/>

            </label>



            <label>

                <span>Midia:</span>

                <input type="file" name="midia"/>

            </label>



            <input type="submit" name="sendFile" value="enviar arquivo!"/>

        </form>

    </body>
</html>

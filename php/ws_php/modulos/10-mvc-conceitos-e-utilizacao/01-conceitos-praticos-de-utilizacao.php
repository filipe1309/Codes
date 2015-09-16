<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - MVC :: Conceito Prático de Utilização</title>
    </head>
    <body>
        <?php
            // Controller 
            // - carrega o modelo e indica qual será a view
            // - recebe e trata as interações dos usuários
        
            require './_app/Config.inc.php';
            echo '<pre>';
            
            // Model
            // - recupera a trata os dados
            $read = new Read;
            $read->exeRead('ws_categories');
            
            foreach ($read->getResult() as $cat):
                extract($cat);
                
            // View
                echo "<article>"
                . "<header> <h1>{$category_title}</h1> </header>"
                . "<p>{$category_content}</p>"
                . "</article> <hr>";
                // End View
            endforeach;
            // End Model
            
            // End Controller
        ?>
    </body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Modelagem de Classe</title>
    </head>
    <body>
        <?php
            require './class/InteracaoClasse.class.php';
            require './class/InteracaoDeObjetos.class.php';
            echo '<pre>';

            $filipe = new InteracaoClasse('Filipe L. Bonfim', 25, 'Programador', 1000);
            $bob = new InteracaoClasse('Bob', 10, 'Web Design', 500);
                        
            $upinside = new InteracaoDeObjetos('UPINSIDE TECNOLOGIA');
            $upinside->contratar($filipe, 'WebMaster', 3600);
            $upinside->pagar();
            $upinside->promover('Gerente de Projetos', 12000);
            $upinside->pagar();
            //$upinside->demitir(5600);
            
            $upinside->contratar($bob, 'Design', 2200);
            $upinside->pagar();
            $upinside->pagar();
           
            $upinside->promover('Admin de Projetos');
            
            $upinside->funcionarios($filipe);
            $upinside->pagar();

            var_dump($filipe, $bob, $upinside);
        ?>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once 'systems/Libs/Main.php';
        include_once 'systems/Libs/DController.php';
        include_once 'systems/Libs/DModel.php';
        include_once 'systems/Libs/Load.php';
        include_once 'systems/Libs/DataBase.php';
        include_once 'apps/config/config.php';

        //$main = new Main();
        

        $url = isset($_GET['url']) ? $_GET['url'] : NULL;
        if($url!=NULL){
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
        }else{
            unset($url);
        }
        

        if(isset($url[0])){
            include_once 'apps/Controllers/'.$url[0].'.php';
            $controller = new $url[0]();
            if(isset($url[2])){
                $controller->{$url[1]}($url[2]);
            }elseif(isset($url[1])){
                $controller->{$url[1]}();
            }else{
                $controller->index();
            }

        }
        
        else{
            include_once 'apps/Controllers/index.php';
            $index = new index();
            $index->index();

        }

       

    
    ?>
    
</body>
</html>
<?php
    require_once('systems/Libs/Main.php');
    require_once('systems/Libs/BaseController.php');
    require_once('systems/Libs/BaseModel.php');
    require_once('systems/Libs/DataBase.php');
    require_once('systems/Libs/Load.php');
    
    $url = isset($_GET['url']) ? $_GET['url'] : NULL;
    if($url != NULL){
        $url = rtrim($url,'/');// split url to string
        $url = explode('/',filter_var($url, FILTER_SANITIZE_URL));
        
    }
    else{
        unset($url);
    }
     //"url/class-0-/method/arg"

    if(isset($url[0])){
        require_once('apps/Controllers/'.$url[0].'.php');
        $ctrler = new $url[0]();
        if(isset($url[2])){
            $ctrler->{$url[1]}($url[2]);
        }
        else{
            if(isset($url[1])){
                $ctrler->{$url[1]}();
            }
        }
    }
    else{
        require_once('apps/Controllers/index.php');
        $index = new index();
        $index->homePage();

    }

   

   
    
    

    

?>

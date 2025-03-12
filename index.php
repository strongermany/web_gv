<?php
    spl_autoload_register(function($class){
        require_once('systems/Libs/'.$class.'.php');
    });
    require_once ('apps/config/config.php');
    $main = new Main();

?>

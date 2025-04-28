<?php
    spl_autoload_register(function($class){
        if (file_exists('apps/Controllers/'.$class.'.php')) {
            require_once('apps/Controllers/'.$class.'.php');
        } else {
            require_once('systems/Libs/'.$class.'.php');
        }
    });
    require_once ('apps/config/config.php');
    $main = new Main();

?>

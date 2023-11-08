<?php   
spl_autoload_register(function($class){
    $config = Settings::singleton();
    $folders = array('settings', 'controllers', 'entities', 'libs', 'models', 'views');
    
    foreach($folders as $folder){
        $pathFile = "{$config->get($folder)}/{$class}.php";

        if(is_file($pathFile)){
            require_once $pathFile;
            break;
        }
    }
});
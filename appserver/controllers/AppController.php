<?php
// Archivos de Configuración
require_once "appserver/settings/Settings.php";
require_once "data/configuration.php";

class AppController {
    public static $keySession = 'user';
    private static $login;

    public static function main()
    {
        $config = Settings::singleton();

        // Archivos de principales
        require_once "{$config->get('controllers')}IController.php";
        require_once "{$config->get('controllers')}IndexController.php";
        require_once "{$config->get('models')}IModel.php";
        require_once "{$config->get('models')}SPDO.php";
        require_once "{$config->get('views')}View.php";
        require_once "{$config->get('libs')}autoload.php";
        require_once "{$config->get('libs')}error404.php";
        require_once "{$config->get('libs')}functions.php";

        $controllerName = ((url(0)) && url(0) !== '') ? ucfirst(strtolower(url(0))).'Controller' : 'IndexController';
        $action = (url(1) && url(1) !== '') ? strtolower(str_replace('-', '',url(1))) : 'index';

        $controllerPath = "{$config->get('controllers')}$controllerName.php";

        if (is_file($controllerPath)) {
            $controller = new $controllerName;
            if ($controller instanceof IController) {
                if (is_callable(array($controller, $action))) {
                    $controller->$action();
                } else {
                    $info = "No se puede llamar a la función $controllerName->$action";
                    error404($info);
                }
            } else {
                $info = "El controlador $controllerName no es instancia de 'IController'";
                error404($info);
            }
        } else {
            $info = "El controlador $controllerName no existe";
            error404($info);
        }
    }

    public static function validateSession(){
        if (isset($_SESSION[self::$keySession])) {
            self::$login = json_decode($_SESSION[self::$keySession]);
        }else if(isset($_COOKIE['PHPSESSIONUSER'])){
            self::$login = json_decode(base64_decode($_COOKIE['PHPSESSIONUSER']));
        }else{
            self::$login = false;
        }

        return self::$login;
    }
}
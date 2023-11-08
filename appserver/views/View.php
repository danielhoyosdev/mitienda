<?php

class View {

    public static function load($template = null, $data = array())
    {
        $config = Settings::singleton();

        $templatePath = "{$config->get('views')}{$template}.php";

        if (is_file($templatePath)) {
            extract($data, EXTR_OVERWRITE);
            include_once $templatePath;
        } else {
            $info = "No existe el template {$template}";
            error404($info);
        }
    }
}
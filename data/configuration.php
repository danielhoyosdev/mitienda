<?php
// Zona Horaria
date_default_timezone_set('America/Bogota');

// Instancia de la clase de configuraciones
$config = Settings::singleton();

// Configuraciones globales
$config->set('folderApp', 'mitienda');
$config->set('nameApp', 'Mi Tienda - Online');

$config->set('client', "https://{$_SERVER['HTTP_HOST']}/{$config->get('folderApp')}/");
$config->set('server', "{$_SERVER['DOCUMENT_ROOT']}/{$config->get('folderApp')}/");

// Configuraciones del lado servidor
$config->set('class', "{$config->get('server')}appserver/class/");
$config->set('controllers', "{$config->get('server')}appserver/controllers/");
$config->set('entities', "{$config->get('server')}appserver/entities/");
$config->set('libs', "{$config->get('server')}appserver/libs/");
$config->set('models', "{$config->get('server')}appserver/models/");
$config->set('views', "{$config->get('server')}appserver/views/");

$config->set('imgServer', "{$config->get('server')}/appclient/img/");

// Configuraciones del lado cliente
$config->set('css', "{$config->get('client')}appclient/css/");
$config->set('fonts', "{$config->get('client')}appclient/fonts/");
$config->set('imgClient', "{$config->get('client')}appclient/img/");
$config->set('js', "{$config->get('client')}appclient/js/");

// Configuraciones del envío de correo electronico
$config->set("mailDebug", 0);
$config->set("mailHost", "smtp.gmail.com");
$config->set("mailAuth", true);
$config->set("mailUsername", "softicolombia@gmail.com");
$config->set("mailPassword", "Daniel1061791895");
$config->set("mailSMTPSecure", "ssl");
$config->set("mailPort", 465);
$config->set("mailFrom", "contacto@mitienda.com");
$config->set("mailNameFrom", "Mitienda online");
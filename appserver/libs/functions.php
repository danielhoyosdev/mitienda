<?php
//Se crea la función para crear un token con una emcryptación MD5
//y otros codigos no reconocibles
function generateToken($value) 
{
    $secret = "[s0ft1-c0l0mb1a-s3cur1ty]";
    $session_id = session_id();
    $token = md5($secret.$session_id.$value);

    return $token;
}
// Se crea la función para verificar el token del formulario y ver
// si es el corresponde y no estan atacando el sistema

function verifyToken($value, $token) 
{
    $secret = "[s0ft1-c0l0mb1a-s3cur1ty]";
    $session_id = session_id();
    $correct = md5($secret.$session_id.$value);

    return ($token == $correct);
}

function generateString($limit = 10){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);

    $randomString = '';

    for ($i = 0; $i < $limit; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

// Obtener las urls amigables
function url($position)
{
    $value = false;

    if (isset($_GET['url'])) {
        $url = explode('/', $_GET['url']);
        if (isset($url[$position])) {
            $value = $url[$position];
        }
    }

    return $value;
}

// Mensajes rapidos del sistema
function setFlashInfo($title, $msg, $type){
    $_SESSION['info'] = '{"title": "'.$title.'", "msg":"'.$msg.'", "type":"'.$type.'"}';                    
}

function getFlashInfo(){
    if(isset($_SESSION['info'])){
        $info = json_decode($_SESSION['info']);
        unset($_SESSION['info']);

        return $info;
    }

    return false;
}

// Validaciones por tipo de datos
function validateInt($value = null, $options = array()){
    if(filter_var($value, FILTER_VALIDATE_INT, array("options"=>$options)) === false){
        return false;
    }

    return true;
}

function validateEmail($value){
    if(filter_var($value, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp" => '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/'))) === false){
        return false;
    }

    return true;
}

function validateText($value){
    if(filter_var($value, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp" => '/^[a-zA-ZñáéíóúÑÁÉÍÓÚ ]+$/'))) === false){
        return false;
    }

    return true;
}

function validateTextNumber($value){
    if(filter_var($value, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp" => '/^[a-zA-ZñáéíóúÑÁÉÍÓÚ0-9 ]+$/'))) === false){
        return false;
    }

    return true;
}

// Operaciones del sistema

function cantidadDias($fechaInicial, $fechaFinal)
{
    $dias = (strtotime($fechaFinal) - strtotime($fechaInicial))/86400;
    $dias = floor($dias);

    return $dias;
}

function validarOferta($fechaInicial, $fechaFinal, $fechaValidar)
{
    $flag = false;

    if ($fechaValidar >= $fechaInicial) {
        if ($fechaValidar <= $fechaFinal) {
            $flag = true;
        }
    }

    return $flag;
}

function paginacion($cantidadProductos = null)
{
    $config = Config::singleton();
    $url = $config->get('client').url(0).'/'.url(1).'/'.url(2).'/';
    $nav = '';

    if (($cantidadProductos != null) && $cantidadProductos > 12) {
        $numeroPag = ceil($cantidadProductos / 12);
        $limitePag = 6;
        $pag = (url(3)) ? url(3): 1;
        $prev = ($pag <= 1) ? null : $pag-1;
        $next = ($pag >= $numeroPag) ? null : $pag+1;

        if ($numeroPag > $limitePag) {
            if ($pag <= $limitePag / 2) {
                $minPag = 1;
                $maxPag = $limitePag;
            } elseif ($pag > ($numeroPag - ($limitePag / 2))) {
                $minPag = $numeroPag - $limitePag;
                $maxPag = $numeroPag;
            } else {
                $minPag = $pag - ($limitePag / 2);
                $maxPag = $pag + ($limitePag / 2);
            }
        } else {
            $minPag = 1;
            $maxPag = $numeroPag;
        }


        $itemPrev = ($prev != null) ? "<li class='page-item'><a class='page-link' href='$url$prev'><i class='fa fa-arrow-left'></i></a></li>" : '';
        $itemNext = ($next != null) ? "<li class='page-item'><a class='page-link' href='$url$next'><i class='fa fa-arrow-right'></i></a></li>" : '';

        $nav = "<nav><ul class='pagination pagination-sm d-flex justify-content-center'>".$itemPrev;

        for ($i = $minPag; $i <= $maxPag; $i++) {
            $active = $pag == $i ? 'active' : '';
            
            $nav .= "<li class='page-item $active'><a class='page-link' href='$url$i'>$i</a></li>";
        }

        $nav .= $itemNext."</ul></nav>";
    }

    return $nav;
}

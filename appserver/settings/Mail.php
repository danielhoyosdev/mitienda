<?php
class Mail extends PHPMailer {
    public function __construct($exceptions = null) {
        $config = Config::singleton();
        $this->CharSet = "UTF-8";
        $this->isSMTP();
        $this->SMTPDebug = $config->get("mailDebug");
        $this->SMTPAuth = $config->get("mailAuth");
        $this->SMTPSecure = $config->get("mailSMTPSecure");
        $this->Host = $config->get("mailHost");
        $this->Username = $config->get("mailUsername");
        $this->Password = $config->get("mailPassword");
        $this->Port = $config->get("mailPort");
        $this->From = $config->get("mailFrom");
        $this->FromName = $config->get("mailNameFrom");
        $this->isHTML(true);
    }

    public function sendEmail($subject, $body, $recipients) {
        $this->Subject = $subject;
        $this->Body = $body;
        $this->AddAddress($recipients);
        
        return $this->send();
    }

    public function emailRegistroUsuario($destinatario, $codigo){
        // Configuraciones
        $config = Config::singleton();

        // Asunto
        $subject = "Confirme su dirección de correo electrónico";
        // Mensaje
        $body = '<div style="background-color: #f7f7f7; text-align: center; padding: 25px">
                    <div style="text-align: center;">
                        <a href="'.$config->get('client').'">
                            <img src="http://mitienda.softicol.nph.com.es/appclient/img/template/logo.png" alt="Logo de Mitienda online" style="width: 320px; margin-bottom: 25px">
                        </a>
                        <div style="background-color: #fff; border-radius: 3px; color: #343a40; font-family: sans-serif; margin: 0 auto; padding: 25px; width: 450px; ">
                            <img src="http://mitienda.softicol.nph.com.es/appclient/img/template/icon-email.png" alt="Email" style="width: 100px;">
                            <h1>¡Bienvenido!</h1>
                            <hr style="margin: 20px 0;">
                            <p style="text-align: justify">Haga clic en el botón de abajo para confirmar su direccion de correo electrónico y poder comenzar a usar su cuenta en Mitienda online.</p>
                            <a href="'.$config->get('client').'usuario/verificar/'.$codigo.'" style="color: white; font-weight: bold; text-decoration: none;">
                                <div style="background-color: #fe6518; border-radius: 3px; padding: 15px;">
                                    Confirme su direccion de correo electrónico
                                </div>
                            </a>
                            <hr style="margin: 20px 0;">
                            <p style="text-align: justify">
                                Al confirmar esta dirección de correo electrónico en el enlace anterior usted acepta nuestros terminos y política de privacidad. Si usted no registró esta cuenta por favor omitir este mensaje.
                            </p>
                        </div>
                    </div>
                </div>';
        // Destinatario
        $recipient = $destinatario;

        return self::sendEmail($subject, $body, $recipient);
    }

    public function emailRestorePassword($destinatario, $password){
        // Configuraciones
        $config = Config::singleton();

        // Asunto
        $subject = "Recuperación de la contraseña de usuario";
        // Mensaje
        $body = '<div style="background-color: #f7f7f7; text-align: center; padding: 25px">
                    <div style="text-align: center;">
                        <a href="'.$config->get('client').'">
                            <img src="http://mitienda.softicol.nph.com.es/appclient/img/template/logo.png" alt="Logo de Mitienda online" style="width: 320px; margin-bottom: 25px">
                        </a>
                        <div style="background-color: #fff; border-radius: 3px; color: #343a40; font-family: sans-serif; margin: 0 auto; padding: 25px; width: 450px; ">
                            <img src="http://mitienda.softicol.nph.com.es/appclient/img/template/icon-email.png" alt="Email" style="width: 100px;">
                            <h1>Recuperación de la contraseña</h1>
                            <hr style="margin: 20px 0;">
                            <p style="text-align: justify">Su contraseña fue restaurada, para iniciar sesión en Mitienda Online lo puedes hacer con las siguientes datos: .</p>
                            <p style="text-align: left">
                                <b>Usuario:</b>'.$destinatario.'<br>
                                <b>Contraseña:</b> '.$password.'
                            </p>
                            <a href="'.$config->get('client').'" style="color: white; font-weight: bold; text-decoration: none;">
                                <div style="background-color: #fe6518; border-radius: 3px; padding: 15px;">
                                    Iniciar sessión desde aquí
                                </div>
                            </a>
                            <p style="text-align: left">Se recomienda cambiar la contraseña una vez haya iniciado sesión.</p>
                        </div>
                    </div>
                </div>';
        // Destinatario
        $recipient = $destinatario;

        return self::sendEmail($subject, $body, $recipient);
    }
}
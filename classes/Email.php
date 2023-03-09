<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;


class Email
{
    protected $nombre;
    protected $email;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        $mailer = new PHPMailer();
        $mailer->isSMTP();
        $mailer->Host = 'sandbox.smtp.mailtrap.io';
        $mailer->SMTPAuth = true;
        $mailer->Port = 2525;
        $mailer->Username = 'ba932c5898d303';
        $mailer->Password = 'f1e9b0885034e1';

        $mailer->setFrom("uptask@correo.com");
        $mailer->addAddress($this->email);
        $mailer->isHTML(true);                                  //Set email format to HTML
        $mailer->Subject = 'Cuenta UpTask';
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong> recientemente creaste una cuenta en Uptask</p>";
        $contenido .= "<p>Para validarla has click aqui: <a href='http://localhost:3000/confirmar?token=".$this->token. "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no has solicitado nada, puedes ignorar este mensaje.</p>";
        $contenido .= "</html>";
        $mailer->Body    = $contenido;
        $mailer->send();
    }
    public function enviarInstrucciones()
    {
        $mailer = new PHPMailer();
        $mailer->isSMTP();
        $mailer->Host = 'sandbox.smtp.mailtrap.io';
        $mailer->SMTPAuth = true;
        $mailer->Port = 2525;
        $mailer->Username = 'ba932c5898d303';
        $mailer->Password = 'f1e9b0885034e1';

        $mailer->setFrom("uptask@correo.com");
        $mailer->addAddress($this->email);
        $mailer->isHTML(true);                                  //Set email format to HTML
        $mailer->Subject = 'Reestablece tu contraseña';
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong> Parece que olvidaste tu password</p>";
        $contenido .= "<p>Para reestablecerlo has click aqui: <a href='http://localhost:3000/reestablecer?token=".$this->token. "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no has solicitado nada, puedes ignorar este mensaje.</p>";
        $contenido .= "</html>";
        $mailer->Body    = $contenido;
        $mailer->send();
    }
}

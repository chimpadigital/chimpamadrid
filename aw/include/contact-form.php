<?php

session_cache_limiter('nocache');
//header('Expires: ' . gmdate('r', 0));
//header('Content-type: application/json');
date_default_timezone_set('America/Argentina/Buenos_Aires');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
// Enter your email address. If you need multiple email recipes simply add a comma: email@domain.com, email2@domain.com
$to = "contacto@chimpancedigital.com.ar";

// Form Fields
$name = isset($_POST["widget-contact-form-name"]) ? $_POST["widget-contact-form-name"] : null;
$email = $_POST["widget-contact-form-email"];
$phone = isset($_POST["widget-contact-form-phone"]) ? $_POST["widget-contact-form-phone"] : null;
$company = isset($_POST["widget-contact-form-company"]) ? $_POST["widget-contact-form-company"] : null;
// $service = isset($_POST["widget-contact-form-service"]) ? $_POST["widget-contact-form-service"] : null;
$subject = isset($_POST["widget-contact-form-subject"]) ? $_POST["widget-contact-form-subject"] : 'Consulta landing tupaginaweb';
$subject_user = '¿Por qué es crucial tener una página web hoy?';
$message = isset($_POST["widget-contact-form-message"]) ? $_POST["widget-contact-form-message"] : null;

// $recaptcha = $_POST['g-recaptcha-response'];

//inicio script grabar datos en csv
$fichero = 'tupaginaweb.csv';//nombre archivo ya creado
//crear linea de datos separado por coma
$fecha=date("Y-m-d H:i:s");
$linea = $fecha.";".$name.";".$company.";".$phone.";".$email.";".$message."\n";
// Escribir la linea en el fichero
file_put_contents($fichero, $linea, FILE_APPEND | LOCK_EX);
//fin grabar datos
$name2 = isset($name) ? "Nombre y Apellido: $name<br><br>" : '';
$email = isset($email) ? "Email: $email<br><br>" : '';
$company = isset($company) ? "Empresa: $company<br><br>" : '';
$phone = isset($phone) ? "Teléfono $phone<br><br>" : '';
// $service = isset($service) ? "Service: $service<br><br>" : '';
$message = isset($message) ? "Message: $message<br><br>" : '';

$cuerpo1 = $name2 . $email . $phone . $company . $message . '<br><br><br>Mensaje enviado de: ' . $_SERVER['HTTP_REFERER'];

$cuerpo2='  <div style="background-color:#f9f9f9;padding-top:50px;padding-bottom:50px;width: 100%;">
<table width="600px" align="center" cellpadding="0" cellspacing="0" style="background-color:white">
    <tr style="background-color:#0095c8;">
        <td style="width:500px; height:40px; padding:15px 34px;font-family: Arial, Helvetica, sans-serif">
            <h1 style="color:#ffffff">Hola '.$name.'</h1>
        </td>
        <td align="right">
            <img src="https://chimpancedigital.com.ar/news/iso-blanco.png" style="height:30px;text-align:right;padding-right: 20px;">
        </td>
    </tr>
</table>
<table width="600px" align="center" cellpadding="0" cellspacing="0" style="background-color:white">
    <tr>
        <td width="600px" style="padding:20px 40px 10px;font-family: Arial, Helvetica, sans-serif;text-align: center;">
            <h3 style="margin-bottom:0px; color: #333333;font-size: 22px;">Gracias por ponerte en contacto con nosotros.<br>
            Te estaremos contactando a la brevedad </h3>
        </td>
    </tr>
    <tr>
        <td width="600px" style="padding:0px 40px;font-family: Arial, Helvetica, sans-serif;text-align: center;"><p style="margin-bottom:0px">En los tiempos que estamos viviendo es clave estar presentes en Internet y cerca de tus clientes para no desaparecer. </p></td>
    </tr>
    <tr>
        <td width=6500px" style="padding:50px 40px;font-family: Arial, Helvetica, sans-serif;text-align: center;"><h2 style="color:#0095c8;margin-bottom: 0px;">¿Queres saber cómo vender hoy en Internet?</h2>
            <a href="https://chimpancedigital.com.ar/por-que-tu-empresa-tiene-que-estar-en-internet/" style="color:#0095c8;font-weight:bold;"><p style="margin-top: 5px;">Te invitamos a leer nuestro artículo</p></a>
        </td>
    </tr>
</table>
<table width="600px" align="center" cellpadding="0" cellspacing="0" style="background-color:white">
    <tr style="background-color: #f3f3f3;">
        <td width="70%" style="padding:10px 40px;font-family: Arial, Helvetica, sans-serif;text-align: center;">
            <h2 style="color:#36a9e1">LEE NUESTRA NOTA GRATIS</h2>
        </td>
        <td width="50%">                           
            <a href="https://chimpancedigital.com.ar/por-que-tu-empresa-tiene-que-estar-en-internet/" target="_blank" style="background:#36a9e1;padding:11px 15px; width:150px; height:80px;color:#ffffff;font-size: 18px;font-weight: bold;text-decoration: none;font-family: Arial, Helvetica, sans-serif;">Click Aquí</a>
        </td>
    </tr>
</table>
<table width="600px" align="center" cellpadding="0" cellspacing="0" style="background-color:white">
    <tr style="background-color: #ffffff;">
        <td width="600px" style="padding:10px 40px 0px;text-align:center;font-family: Arial, Helvetica, sans-serif;text-align: center;">
            <a href="tel:+5493516503470" style="text-decoration: none; color: #000000;">
                <p style="margin-bottom:0px;font-size: 16px;">351 650-3470</p>
            </a>
            <a href="mailto:contacto@chimpancedigital.com.ar" style="text-decoration: none; color: #000000;">
                <p style="margin-top: 0px;;font-size: 16px;">contacto@chimpancedigital.com.ar</p>
            </a>
        </td>
    </tr>
</table>
<table width="600px" align="center" cellpadding="0" cellspacing="0" style="background-color:white;padding:0px 0px 29px">
    <tr style="padding:10px 0px 50px;">
        <td width="30%"></td>
        <td width="40%">
            <ul stlye="">
                <li style="float:left;margin-right:0px;list-style: none;margin-left: 0px;">
                    <a href="https://www.facebook.com/chimpancedigital/" target="_blank">
                        <img src="https://chimpancedigital.com.ar/news/face.png" alt="">
                    </a>
                </li>
                <li style="float:left;margin-right:0px;list-style: none;">
                    <a href="https://www.instagram.com/chimpancedigital/?hl=es-la" target="_blank">
                        <img src="https://chimpancedigital.com.ar/news/insta.png" alt="">
                    </a>
                </li>
                <li style="float:left;margin-right:0px;list-style: none;">
                    <a href="https://www.linkedin.com/company/chimpancedigital/" target="_blank">
                        <img src="https://chimpancedigital.com.ar/news/linkedin.png" alt="">
                    </a>
                </li>
            </ul>
        </td>
        <td width="30%"></td>
    </tr>
</table>
</div>
        ';
$to1=$to;
$to2=$_POST["widget-contact-form-email"];
$asunto1=$subject;
$asunto2=$subject_user;

function enviarMail($to,$asunto,$cuerpo){
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
        $mail->isSMTP();      
        
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->CharSet="UTF-8";
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "sprados@chimpancedigital.com.ar";
        $mail->Password = "Chimpance951#$";   
        // Send using SMTP
        
        //Recipients
        $mail->setFrom('contacto@chimpancedigital.com.ar', 'Chimpance Digital');
        $mail->addAddress($to);               // Name is optional
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;
        $mail->AltBody = $cuerpo;
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
if( $_SERVER['REQUEST_METHOD'] == 'POST') {
    //If you don't receive the email, enable and configure these parameters below: 
    $mail_enviado=enviarMail($to1,$asunto1,$cuerpo1);
    //echo 'envio 1 '.$mail_enviado;
    $mail_enviado2=enviarMail($to2,$asunto2,$cuerpo2);
    //echo 'envio 2 '.$mail_enviado2;
    if($mail_enviado2)
                {
                // echo "<script>location.href='../gracias.html';</script>";
                header("Location: ../gracias.html");exit;
                }
                else
                {
                    echo "no se pudo enviar".$mail_enviado2 ;
                }          
    
}
?>

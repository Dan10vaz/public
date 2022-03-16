<?php 

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];
$opciones = $_POST['opciones'];
$presupuesto = $_POST['presupuesto'];
$contactarTel = $_POST['contactarTel'];
$contactarEmail = $_POST['contactarEmail'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

$header = 'From: ' . $email . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$mensaje = "Este mensaje fue enviado por: " . $nombre . "\r\n";
$mensaje .= "Su email es: " . $email . "\r\n";
$mensaje .= "Telefono de contacto: " . $telefono . "\r\n";
$mensaje .= "Su presupuesto es: " . $presupuesto . "\r\n";
$mensaje .= "Sus opciones son: " . $opciones . "\r\n";
$mensaje .= "Mensaje: " . $_POST['mensaje'] . "\r\n";
$mensaje .= "Enviado el: " . date('d/m/Y', time());


$para = 'dcva9565@hotmail.com';
$asunto = 'Cliente nuevo';

mail($para, $asunto, utf8_decode($mensaje), $header);

header("Location: index.php");
   
?>

    
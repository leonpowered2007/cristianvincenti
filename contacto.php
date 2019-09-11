
<?php
header('Content-Type: text/html; charset=utf-8');

$first_name = $_POST["varNombre"];
$email_from = $_POST["varEmail"];
$telefono = $_POST["varTelefono"];
$comments = $_POST["varMensaje"];

 
//Datos de Correo
$email_to = "luisroblesart@gmail.com";

$email_subject = "Contacto Web";
 
     
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

if(!preg_match($email_exp,$email_from)) 
{
	$mensaje_retorno = 'El correo electrónico no es válido. Por favor, intente nuevamente.';
}
else
{
	$string_exp = "/^[A-Za-z .'-]+$/";
 
	if(!preg_match($string_exp,$first_name)) 
	{
		$mensaje_retorno = 'El nombre ingresado no es válido';
	}
	else
	{
		if(strlen($comments) < 2) 
		{
			$mensaje_retorno = 'Su mensaje es demasiado corto.';
		}
		else
		{
			//Envío Mensaje
			$email_message = "Datos de Contacto.\n\n";
			$email_message .= "Nombre: ".clean_string($first_name)."\n";
			$email_message .= "Email: ".clean_string($email_from)."\n";
			$email_message .= "Teléfono: ".clean_string($telefono)."\n";
			$email_message .= "Mensaje: ".clean_string($comments)."\n";
 
			$headers = 'From: '.$email_from."\r\n".
			'Reply-To: '.$email_from."\r\n";
			@mail($email_to, $email_subject, $email_message, $headers);  
			
			$mensaje_retorno = "$first_name, su mensaje ha sido enviado exitosamente";
		}
	}
}
 
echo $mensaje_retorno;
   
function clean_string($string) 
{
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}    

?>

<?php
$server_root = $_SERVER['DOCUMENT_ROOT'].'/webaranda/';
use Dompdf\Dompdf;
require_once $server_root.'Librerias/qr/qrlib.php';
require_once $server_root.'Librerias/dompdf/autoload.inc.php';
require_once $server_root.'Librerias/email/class.phpmailer.php';

function limpiarTexto($texto) {
    return preg_replace('/[\x00-\x1F\x7F]/u', '', $texto);
}

function cortarCadena($texto, $cantidad) {
    // Verifica si la longitud del texto es mayor que la cantidad dada
    if (strlen($texto) > $cantidad) {
        return substr($texto, 0, $cantidad); 
    }
    // Si no excede, devuelve el texto tal cual
    return $texto;
}

function formatoMoneda($numero){
    $numero = number_format($numero, 2, '.', ',');
    return $numero;
}

function convertirHtmlAPdfBase64($resultadosHeader, $resultadosDetalle, $resultadosExtra,$include)
{
    // Pasar los arrays a imprimir.php mediante variables globales
    global $dataHeader, $dataDetalle, $dataExtra;
    $dataHeader = $resultadosHeader;
    $dataDetalle = $resultadosDetalle;
    $dataExtra = $resultadosExtra;

    // Capturar el HTML de 'imprimir.php'
    ob_start();
    include $include; 
    $html = ob_get_clean();

    // Cargar la librería dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Obtener el PDF como un string
    $pdfOutput = $dompdf->output();

    // Convertir el PDF a Base64
    $pdfBase64 = base64_encode($pdfOutput);

    return $pdfBase64;
}


function enviarCorreo($para,$asunto,$Ccopia,$texto,$titulo,$portada) {
    $mail  = new PHPMailer();
    $mail->IsSMTP();
    $mail->isHTML(TRUE);  

    $mail->SMTPAuth = true;
    // $mail->SMTPSecure = 'STARTTLS';

    // $mail->SMTPSecure = "ssl";

    // $mail->Host  = "mail.arandadelaparra.com.mx";
    //$mail->Host  = "mail.arandadelaparra.com.mx";
    $mail->Host  = "mail.s1124.sureserver.com";

    $mail->Port   = 587;
    
    $mail->Username = 'sistemasweb@arandadelaparra.com';
    
    // $mail->Password = '4r@NdA-&A1b2C3#';
    // $mail->Password = 'H0sp1tAl@randa';
    //$mail->Password = '#w9FfeM4z~vr?';
    $mail->Password = '#h4PAr4nd@2023';

    $mail->From   = "sistemasweb@arandadelaparra.com";
    // $mail->From   = $email;
    //$mail->FromName   = "PAGOS ONLINE";
    $mail->FromName   = $titulo;
    // $mail->Subject    = "Comentario Interdepartamental para $departamento";
    $mail->Subject    = $asunto;
    
    $urlHead = "<img src='$portada'>";
    $urlLinea = "<img src='http://arandadelaparra.com.mx/proyweb/linea.png'>";
    $urlLogo =  "<img src='https://arandadelaparra.com.mx/proyweb/LogoHAPR.png' width='250'>";
    $Atentamente = utf8_decode("<b>Atentamente:</b> <br> Administración del Hospital Aranda de la Parra");
    $textoDerechos = "Hospital Aranda de la Parra - Todos los Derechos Reservados.";
    
    $msj  = "<html><body>";
    $msj .= '
    <table cellpadding="0" cellspacing="0" width="600" style="font-family: \'Trebuchet MS\', Helvetica, sans-serif; 
                                                            font-weight: 400; font-style: normal; font-size:14px; 
                                                            color:#333; background:#f4f4f4; line-height:20px; 
                                                            border:1px solid #e3e3e3;">
    <tr> <td style="background:#fff;">'.$urlHead.'</td> </tr>
    <tr> <td style="padding:30px 30px 0px 30px;">'.$texto.' </td> </tr>
    <tr> <td>'.$urlLinea.'</td> </tr>
    <tr> <td align="center" style="padding:30px; background:#fff;"> '.$urlLogo.' <br><br> '.$Atentamente.' </td> </tr>
    <tr> <td align="center" style="padding:10px; font-size:11px; background:#01384c; color:#fff;"> '.$textoDerechos.' </td> </tr>
    </table>';
    $msj .= "</body></html>";


    $mail->Body = "$msj";

    // $mail->AddAddress("$email", "$nombre");
    // $para
    $mail->AddAddress($para);
    if (!empty($Ccopia)) {
        $copias = explode(',', $Ccopia);  // Separar múltiples correos por comas
        foreach ($copias as $copia) {
            $mail->AddCC(trim($copia));  // Agregar cada dirección en copia
        }
    }
    // $mail->AddCC("$emailGerente", "$nombreGerente");
    // $mail->AddCC($Ccopia);
    // $mail->Send();
    if(!@$mail->Send()){}
}


$key = "nqJleI2erWIXgvFuM8gD3mVr6WP1laAX";
$iv = str_repeat("\0", 16); // IV de 16 bytes lleno de ceros.

function  encriptar($palabra)
{
    global $key, $iv;
    // Asegúrate de que la clave tenga 32 caracteres
    $key = substr($key, 0, 32);

    // Encripta los datos
    $encryptedBytes = openssl_encrypt($palabra, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

    // Convierte los datos encriptados a Base64
    $encryptedString = base64_encode($encryptedBytes);

    return $encryptedString;
}


function desencriptar($palabraEncriptada) {
    global $key, $iv;

    // Convierte la clave a un formato adecuado para Mcrypt
    $key = substr($key, 0, 32); // Asegúrate de que la clave tenga 32 caracteres.

    // Decodifica la cadena Base64 en un arreglo de bytes
    $encryptedBytes = base64_decode($palabraEncriptada);

    // Desencripta los datos
    $decryptedBytes = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $encryptedBytes, MCRYPT_MODE_CBC, $iv);

    // Elimina los posibles caracteres de padding
    $decryptedBytes = rtrim($decryptedBytes, "\0");

    return $decryptedBytes;
}

?>

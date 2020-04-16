<?php
$imagenCodificada = file_get_contents("php://input"); //Obtener la imagen
$partes= explode("&", $imagenCodificada);
$id_empleado=$partes[2];
$id_encuesta=$partes[1];
$imagenCodificada=$partes[0];
if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
//La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));

//Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
//todo el contenido lo guardamos en un archivo
$imagenDecodificada = base64_decode($imagenCodificadaLimpia);

//Calcular un nombre único
$nombrearchivo="000000" . $id_empleado ."_"."000000".$id_encuesta. ".png";
$nombreImagenGuardada = "public_html/encuesta_im/". $nombrearchivo;
//Escribir el archivo
file_put_contents($nombreImagenGuardada, $imagenDecodificada);
//Terminar y regresar el nombre de la foto
exit($nombrearchivo);
?>
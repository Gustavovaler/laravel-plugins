<?php
function encuadrarFoto($foto_name,$foto_temp_name,$user_name,$lienzo){

	$user = $user_name;

	$path = rand(1000, 30000)."VT".$user['id_vendedor'];

	$foto_nombre = $foto_name;
	$temp_foto = $foto_temp_name;
    $medidas = getimagesize($temp_foto);
	$ancho = $medidas[0];
	$alto = $medidas[1];
	$relacion = $ancho/$alto;
	//cargamos el fondo
	$lienzo = $lienzo;
    $foto = imagecreatefromjpeg($temp_foto);

	if ($medidas[0] > $medidas[1]) {

		$foto_escalada = imagescale($foto,800,-1);
		$diferencia = (800 -(800/$relacion))/2;
		$alto_nuevo = 800-($diferencia*2);
		
		//pegamos la imagen sobre el fondo
	    imagecopy($lienzo,$foto_escalada,0,$diferencia,0,0,800,$alto_nuevo);

	}elseif ($medidas[0] < $medidas[1]) {
		
		$diferencia = (800-(800*$relacion))/2;
		$ancho_nuevo = 800-($diferencia)*2;
		$foto_escalada = imagescale($foto,$ancho_nuevo,800);
		//pegamos la imagen sobre el fondo
	    imagecopy($lienzo,$foto_escalada,$diferencia,0,0,0,$ancho_nuevo,800);
	}else{
		$diferencia = 0;
		$foto_escalada = imagescale($foto,800,800);
		imagecopy($lienzo,$foto_escalada,0,0,0,0,800,800);

	}


	return $lienzo;


}

$path = rand(1000, 30000)."VT".$user['id_vendedor'];

if ($_FILES['foto']['name'][0] == null) {
  $imagen = null;
}else{
$imagen = "imagenes/".$path.$_FILES['foto']['name'][0];
$lienzo = imagecreatefromjpeg("imagenes/fondo.jpg");
$imagenx = encuadrarFoto($imagen,$_FILES['foto']['tmp_name'][0],$user,$lienzo );    
$f = imagejpeg($imagenx,$imagen);

}  

if($_FILES['foto']['name'][1] == null){
  $imagen2 = null;
}else{

$imagen2 = "imagenes/".$path.$_FILES['foto']['name'][1];
$lienzo2 = imagecreatefromjpeg("imagenes/fondo.jpg");
$imagenx2 = encuadrarFoto($imagen2,$_FILES['foto']['tmp_name'][1],$user,$lienzo2 );    
$f2 = imagejpeg($imagenx2,$imagen2);


}
if($_FILES['foto']['name'][2] == null){
  $imagen3 = null;
}else{
  $imagen3 = "imagenes/".$path.$_FILES['foto']['name'][2];
$lienzo3 = imagecreatefromjpeg("imagenes/fondo.jpg");
$imagenx3 = encuadrarFoto($imagen3,$_FILES['foto']['tmp_name'][2],$user,$lienzo3 );    
$f3 = imagejpeg($imagenx3,$imagen3);


}
if($_FILES['foto']['name'][3] == null){
  $imagen4 = null;
}else{
  $imagen4 = "imagenes/".$path.$_FILES['foto']['name'][3];
$lienzo4 = imagecreatefromjpeg("imagenes/fondo.jpg");
$imagenx4 = encuadrarFoto($imagen4,$_FILES['foto']['tmp_name'][3],$user,$lienzo4 );    
$f4 = imagejpeg($imagenx4,$imagen4);


}
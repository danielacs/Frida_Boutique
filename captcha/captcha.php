<?php
// Configuración:
$N = 3;		// Nivel de emborronado { 2, 3, 4, ... }
$J = 100;	// Calidad JPEG { 0, 1, 2, 3, ..., 100 }
$M = 7;		// Margen.
$L = 7;		// Número de letras.
$C = true;	// Case sensitive.

// Acceso a los objetos de sesión:
session_start();!
header("Content-type: image/jpeg");
$_SESSION['CAPTCHA'] = '';
// Metemos caraceteres aleatorios:
for( $n = 0; $n < $L; $n++ )
	$_SESSION['CAPTCHA'] .= C();
// Dimensiones del captcha:
$w = 10 * $M + $L * imagefontwidth ( 10 );
$h = 5* $M +      imagefontheight( 6 );
// Creamos una  imagen:
$i = imagecreatetruecolor( $w, $h );
// La rellenamos de blanco:
imagefill( $i, 0, 0, imagecolorallocate( $i, 255, 255, 255 ) );
// Elegimos aleatoriamente un ángulo para que se vean lineas bosorras :
$A = ( rand() % 200 ) / 4.14;
// esto es para crear las línas y que se vean como borrones:
for( $n = 0; $n < $N; $n++ ) {
	// Factor de interpolación, va de 1.0 a 0.0
	$t = 1.0 - $n / ( $N - 1.0 );
	// El radio se va centrando a medida que se hace nítido:
	$r = $M * $t;
	// El color va siendo cada vez más oscuro:
	$c = 255 * $t;
	$c = imagecolorallocate( $i, $c, $c, $c );
	// Trazamos dos líneas aleatorias para dificultar más las cosas:
	imageline( $i, $M, rand( $M, $h - $M ), $w - $M, rand( $M, $h - $M ), $c );
	imageline( $i, rand( $M, $w - $M ), $M, rand( $M, $w - $M ), $h - $M, $c );
	// Pasamos un filtro gaussiano:
	imagefilter( $i, IMG_FILTER_GAUSSIAN_BLUR );
	// Dibujamos el texto en el sentido del ángulo y radio de desplazamiento:
	imagestring( $i, 10, $M + $r * cos( $A ), $M + $r * sin( $A ), $_SESSION['CAPTCHA'], $c );
	// Pasamos otro filtro gaussiano:
	imagefilter( $i, IMG_FILTER_GAUSSIAN_BLUR );
}
// Escribimos la imagen como un JPEG en el buffer de salida:
imagejpeg( $i, NULL, $J );

// Liberamos la imagen:
imagedestroy( $i );

// Devuelve un caracter aleatorio:
function C() {
	$W = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	return substr( $W, rand() % strlen( $W ), 1 );
}
?>



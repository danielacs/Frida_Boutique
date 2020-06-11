<?php
	@session_start(); //crea una sesión o reanuda la actual basada en un identificador de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
	@extract($_REQUEST); //Importar variables a la tabla de símbolos actual desde un array, permite acceso a toda las paginas

	$divisa = "$";
?>
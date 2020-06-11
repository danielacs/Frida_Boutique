<?php

include "../configs/configs.php";
include "../configs/funciones.php";

check_admin();

if(isset($enviar)){
	$nom = clear($name);
	$prec = clear($price);
	$talla = clear($talla);
	$oferta = clear($oferta);
	$imagen = "";

	
	if($_FILES['imagen']['tmp_name']){
		$imagen = $nom.rand(0,1000).".png";
		move_uploaded_file($_FILES['imagen']['tmp_name'], "../productos/".$imagen);
	}
//if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
	//	$imagen = $nom.rand(0,1000).".png";
		//move_uploaded_file($_FILES['imagen']['tmp_name'], "productos/".$imagen);
	//}
	

	//$nom=$_FILES['imagen']['name'];
	//$archivo=$_FILES['imagen']['tmp_name'];
	//$ruta="../productos";
	//$ruta=$ruta."/".$nom;
	//move_uploaded_file($archivo, $ruta)


	$conexion->query("INSERT INTO productos (nombre,precio,imagen,talla,oferta,id_categoria) VALUES ('$nom','$prec','$imagen','$talla','$oferta','$categoria')");
	echo '<script language="javascript">alert("Producto agregado correctamente");</script>';
	redir("./registroProductos.php");
}

if(isset($eliminar)){
	$conexion->query("DELETE FROM productos WHERE id = '$eliminar'");
	echo '<script language="javascript">alert("Producto eliminado correctamente");</script>';
	redir("./registroProductos.php");
}
?>
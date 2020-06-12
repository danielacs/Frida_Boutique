<?php

include "../configs/configs.php";
include "../configs/funciones.php";

check_admin();

if(isset($enviar)){
	$nom = clear($name);
	$prec = clear($price);
	$talla = clear($talla);
	$oferta = clear($oferta);

	//$imagen = "";
	if ((isset($_FILES['imagen']['tmp_name'])) && ($_FILES['imagen']['tmp_name'] !='')) {

		$imagen = $nom.rand(0,1000).".png";
		move_uploaded_file($_FILES['imagen']['tmp_name'], "../productos/".$imagen);
	
	}
	//if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
	//	$imagen = $nom.rand(0,1000).".png";
	//	move_uploaded_file($_FILES['imagen']['tmp_name'], "../productos/".$imagen);
	//}

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
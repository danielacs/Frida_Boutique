<?php
	$server = "localhost";
	$user = "root";
	$pass = "";
	$bd = "pasillodefrida";
	$conexion = mysqli_connect($server,$user,$pass,$bd);

function clear($var){
	htmlspecialchars($var);

	return $var;
}

function check_admin(){
	if(!isset($_SESSION['id'])){
		redir("./");
	}
}


function redir($var){
	?>
	<script>
		window.location="<?=$var?>";
	</script>
	<?php
	die();
}

function alert($txt,$type,$url){

	//"error", "success" and "info".

	if($type==0){
		$t = "error";
	}elseif($type==1){
		$t = "success";
	}elseif($type==2){
		$t = "info";
	}else{
		$t = "info";
	}

	echo '<script>swal({ title: "Alerta", text: "'.$txt.'", icon: "'.$t.'"});';
	echo '$(".swal-button").click(function(){ window.location="?p='.$url.'"; });';
	echo '</script>';
}

function check_user($url){

	if(!isset($_SESSION['id_cliente'])){
		redir("?p=login&return=$url");
	}else{

	}

}

function nombre_cliente($id_cliente){
	$conexion = connect();

	$q = $conexion->query("SELECT * FROM clientes WHERE id = '$id_cliente'");
	$r = mysqli_fetch_array($q);
	return $r['name'];
}

function connect(){
	$server = "localhost";
	$user = "root";
	$pass = "";
	$bd = "pasillodefrida";


 	$conexion = mysqli_connect($server,$user,$pass,$bd);

	return $conexion;
}

function fecha($fecha){
	$e = explode("-",$fecha);

	$año = $e[0];
	$mes = $e[1];
	$e2 = explode(" ",$e[2]);
	$dia = $e2[0];
	$tiempo = $e2[1];

	$e3 = explode(":",$tiempo);
	$hora = $e3[0];
	$min = $e3[1];

	return $dia."/".$mes."/".$año." ".$hora.":".$min;

}


function admin_name_connected(){
	include "configs.php";
	$id = $_SESSION['id'];
	$conexion = connect();

	$q = $conexion->query("SELECT * FROM admins WHERE id = '$id'");
	$r = mysqli_fetch_array($q);

	return $r['name'];

}


?>
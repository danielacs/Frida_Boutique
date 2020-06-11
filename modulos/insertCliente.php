<?php
include "../configs/configs.php";
include "../configs/funciones.php";

if(isset($_SESSION['id_cliente'])){
   redir("./indexUser.php");
}

  
   $username = $_POST["username"];
   $password = $_POST["password"];
   //$cpassword = clear($cpassword);
   $nombre = $_POST["nombre"];

   $q = $conexion->query("SELECT * FROM clientes WHERE username = '$username'");

   if(mysqli_num_rows($q)>0){//en caso de que el usuario registrado ya exista
        echo '<script language="javascript">alert("El usuario ya esta en uso");</script>';
        redir("./registro.php");
        die();

   }

   $conexion->query("INSERT INTO clientes (username,password,name) VALUES ('$username','$password','$nombre')");

   if($conexion){
   echo '<script language="javascript">alert(Te has registrado satisfactoriamente");</script>';}
   $q2 = $conexion->query("SELECT * FROM clientes WHERE username = '$username'");
   $r = mysqli_fetch_array($q2);
    $_SESSION['id_cliente'] = $r['id'];

    
   redir("./indexUser.php");
   die();


   ?>
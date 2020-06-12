
<?php
include "../configs/configs.php";
include "../configs/funciones.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>	
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../estilo.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title>Productos</title>
     <script>
    function captcha_admin(){
        if (document.getElementById("admin").value =="") {
          alert("Es un campo obligatorio");
          console.log("entro");
          document.getElementById("admin").focus();
        }
    }
  </script>
</head>

<body>
	<nav class="navbar navbar-dark navbar-expand-sm fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mr-auto" ><img src="../iconos/pasillo.jpg" height="100" width="100"></a>
            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item active"><a class="nav-link" href="./salirAdmin.php"> Salir  </a></li>
                </ul>       
            </div> 
        </div>
    </nav><br><br>

    <?php
   
if(isset($enviar)){
   $username = clear($username);
   $password = clear($password);

   $q = $conexion->query("SELECT * FROM admins WHERE username = '$username' AND password = '$password'");

   if(mysqli_num_rows($q)>0){
      $r = mysqli_fetch_array($q);
      $_SESSION['id'] = $r['id'];
      redir("./adminlogin.php");
   }else{
      echo '<script language="javascript">alert("Los datos no son validos");</script>';
      redir("./adminlogin.php");
   }


}

if(isset($_SESSION['id'])){ // si hay una sesion iniciada
   ?><br><br>
   <h1 class="titulo1">ADMINISTRADOR</h1><br><br>
      <a href="./registroProductos.php" class="btn">Agregar Productos</a>

      <!--<a href="?p=manejar_tracking" class="btn">Manejar Tracking</a>-->

      <a class="btn" href="./pagos.php" >Pagos/Reporte</a>
   <?php
}else{ // si no hay una sesion iniciada
   ?>
   <center>
      <form id="admin" method="post" action="">
         <div class=" row text-center login-page ">
            <div class="col-sm-12 login-form">
               <label><h2 class="titulo2"> Acceso de Administrador</h2></label>

               <div class="row">
                  <div class="col-md-12 login-form-row">
                  <input type="text" class="form-control" placeholder="Usuario" name="username"/>
                  </div>
               </div>
                <div class="row">
                  <div class="col-md-12 login-form-row">
                     <input type="password" class="form-control" placeholder="Contraseña" name="password"/>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-12 login-form-row">
                    <br><img src="../captcha/captcha.php"/>
                     <input type="text" name="captcha" id="captcha" required /><br> 
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-12 login-form-row">
                     <button class="btn2" name="enviar" type="submit" onclick=captcha_admin();> Ingresar</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </center>


   <?php
}
?>
<br><br><br><br><br><br>
    <footer class="footer">
        <div class="container">
           <div class="row justify-content-center">             
                <div class="col-auto">
                    <p>© Copyright 2020 Pasillo de Frida</p>
                </div>
           </div>
       </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
<style type="text/css">
     .centrar_login{
      width: 40%;
      text-align: center;
      padding-top:20px;
      font-family: 'Optima';
   }
   .navbar-dark {
     background-color: #000;
}
.footer{
    background-color: #000;
    margin:0px auto;
    padding: 20px 0px 20px 0px;
    font-family: sans-serif;
}

input[type="text"]{
   border: 1px solid black;

   border-radius: 6px;

   display: block;

   font-size: 1em;

   height: 2.6em;

   text-align: center;

   width: 400px;

   margin-left: auto;

   margin-right: auto;

   margin-top: 15px;
}

input[type="password"] {

   border: 1px solid black;

   border-radius: 6px;

   display: block;

   font-size: 1em;

   height: 2.6em;

   text-align: center;

   width: 400px;

   margin-left: auto;

   margin-right: auto;

   margin-top: 15px;

}

 

/* Botón */

 .btn{
  text-decoration: none;
   background: #6bbf72!important;
   padding: 15px 10px;
   border: none;
   border-radius: 6px;

   color: white;
   display: block;

   margin-bottom: 15px;
   margin-left: auto;

   margin-right: auto;

   margin-top: 20px;

   text-align: center;

   width: 150px;
}

.btn:hover{ 
   cursor: pointer;
   background-color: #d60062!important;
   color:white;
 }
.titulo1{
   margin-top: 30px;
   font-size: 45px;
   font-family: 'Optima';
   margin-left: auto;
   margin-right: auto;
   text-align: center;
}

.titulo2{
   margin-top: 100px;
   font-size: 45px;
   font-family: 'Optima';
   margin-left: auto;
   margin-right: auto;
   text-align: center;
}

.btn2{
   text-decoration: none;
   background: #6bbf72!important;
   padding: 15px 10px;
   border: none;
   border-radius: 6px;

   color: white;
   display: block;

   margin-bottom: 15px;
   margin-left: auto;

   margin-right: auto;

   margin-top: 20px;

   text-align: center;

   width: 150px;
}

.btn2:hover{ 
   cursor: pointer;
   background-color: #d60062!!important;
   color:white;
 }
</style>
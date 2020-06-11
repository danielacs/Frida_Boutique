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

    <title>Login</title>
    <script>
    function captcha_login(){
        if (document.getElementById("login").value =="") {
          alert("Es un campo obligatorio");
          console.log("entro");
          document.getElementById("login").focus();
        }
    }
  </script>
</head>
    <style type="text/css">
        body{background:#8AE691;}
    </style>

<body>
    <nav class="navbar navbar-dark navbar-expand-sm fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mr-auto" href="../index.html"><img src="../iconos/pasillo.jpg" height="100" width="100"></a>
            <div class="collapse navbar-collapse" id="Navbar">       
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a class="nav-link" href="../index.html"> Salir </a></li>
                </ul>       
            </div> 
        </div>
    </nav>
   <br><br><br>

   <?php
if(isset($_SESSION['id_cliente'])){
   redir("./indexUser.php");
}
   
if(isset($enviar)){
   $username = clear($username);
   $password = clear($password);

   $q = $conexion->query("SELECT * FROM clientes WHERE username = '$username' AND password = '$password'");

   if(mysqli_num_rows($q)>0){
      $r = mysqli_fetch_array($q);//obtiene los campos de la matriz
      $_SESSION['id_cliente'] = $r['id'];
      if(isset($return)){
         redir("?p=".$return);
      }else{
         echo '<script language="javascript">alert("Iniciaste Sesion");</script>';
         redir("./indexUser.php");
      }
   }else{
      echo '<script language="javascript">alert("Los datos no son validos");</script>';
      redir("./login.php");
   }


}
   ?>

   <center>
      <form id="login" method="post" action="">
         <div class=" row text-center login-page ">
            <div class="col-md-12 login-form">
               <label><h2 class="titulo">Iniciar Sesion</h2></label>
               <div class="row">
                  <div class="col-md-12 login-form-row">
                     <input type="text" autocomplete="off" class="form-control" placeholder="Usuario" name="username"/>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 login-form-row">
                     <input type="password" class="form-control" placeholder="Contraseña" name="password"/>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 login-form-row">
                    <br> <img src="../captcha/captcha.php"/>

                     <input type="text" name="captcha" id="captcha"required/><br> 
                     
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 login-form-row">
                     <button id="btn_iniciar" class="btn btn-success" name="enviar" type="submit" onclick=captcha_login(); ><i class="fa fa-sign-in"></i> Ingresar</button>
                  </div>
               </div>
              
            </div>
         </div>
      </form>
   </center>   
   

    <footer class="footer">
        <div class="container">
            <div class="row">             
                <div class="col-4 offset-1 col-sm-2">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                         <li><a href="../index.html">Inicio</a></li>
                        <li><a href="./productos.php">Productos</a></li>
                        <li><a href="./carrito.php">Carrito</a></li>
                        <li><a href="#">Mis Compras</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-4 align-center">
                    <div class="text-center">
                        <a href="http://www.facebook.com/profile.php?id="><img src="../iconos/ins.png" width=75 height=75></a>
                        <a href="https://instagram.com/elpasillodefrida_boutique?igshid=1p9dkng0cq5bu"><img src="../iconos/face.png" width=80 height=80></a>
                    </div>
                </div>
           </div>
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

input[type="text"]{
    border: none;

   border-radius: 6px;

   display: block;

   font-size: 1em;

   height: 2em;

   text-align: center;

   width: 400px;

   margin-left: auto;

   margin-right: auto;

   margin-top: 15px;
}

input[type="password"] {

   border: none;

   border-radius: 6px;

   display: block;

   font-size: 1em;

   height: 2.3em;

   text-align: center;

   width: 400px;

   margin-left: auto;

   margin-right: auto;

   margin-top: 15px;

}

 

/* Botón */

 

input[type="submit"] {

   background-color:;

   border: none;

   border-radius: 6px;

   color: black;
   display: block;
   font-size: 1em;
   height: 2.3em;

   margin-left: auto;

   margin-right: auto;

   margin-top: 30px;

   text-align: center;

   width: 150px;
}

input[type="submit"]:hover {
   cursor: pointer;
   background-color: #white;
   opacity: 0.8;
   color:black;
}

 .btn{
   text-decoration: none;
   background: #d60062!important;
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
.titulo{
   margin-top: 110px;
   font-size: 40px;
   font-family: sans-serif;
   margin-left: auto;
   margin-right: auto;
   text-align: center;
}

</style>
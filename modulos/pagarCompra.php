


<!DOCTYPE html>
<html lang="en">
<head>	
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../estilo.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title>Pagar Compra</title>
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
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.html"> Inicio</a></li>
                    <li class="nav-item active"><a class="nav-link" href="./productos.php"> Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="./carrito.php"> Carrito</a></li>
                    <li class="nav-item"><a class="nav-link" href="./miscompras.php"> Mis Compras</a></li>
                    <li class="nav-item"><a class="nav-link" href="./adminlogin.php"> Administrador</a></li>
                </ul>        
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a class="nav-link" href="./salirUser.php"> Cerrar Sesion </a></li>
                </ul>       
            </div> 
        </div>
    </nav>

	<br><br><br>

	<?php
include "../configs/configs.php";
include "../configs/funciones.php";
		check_user('pagarCompra');

		if(isset($subir)){
			$nombre = clear($nombre);

			$comprobante = "";

			if(is_uploaded_file($_FILES['comprobante']['tmp_name'])){
				$comprobante = date("His").rand(0,1000).".png";
				move_uploaded_file($_FILES['comprobante']['tmp_name'], "../comprob/".$comprobante);
			}

			$conexion->query("INSERT INTO pagos (id_cliente,id_compra,comprobante,nombre,fecha) VALUES ('".$_SESSION['id_cliente']."','$id','$comprobante','$nombre',NOW())");

			echo '<script language="javascript">alert("Comprobante enviado correctamente");</script>';
			//redir("?p=miscompras");

	}
?>
	<h1 class="titulo">Metodos de Pago</h1>
	<div class="contenedor1">
      <div class="table-responsive">
         	<table class="table table-bordered table-hover">
            	<tr class="table-secondary">
            		<th>Tipo de pago</th>
					<th>Cuenta</th>
					<th>Beneficiario</th>
            	</tr>

            	<tr>
					<td>Transferencia Bancaria</td>
					<td>5579-0000-1111-2222</td>
					<td>El Pasillo de Frida</td>
				</tr>
        	</table>

        	<h1 class="titulo2">Envia el comprobante de pago de la compra</h1>

			<form method="post" action="" enctype="multipart/form-data">
				<div class="form-group">
					<label class="ima">Adjuntar comprobante</label>
					<input type="file" class="btn1" name="comprobante" title="Adjuntar Comprobante" required/>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="nombre" title="Nombre de la persona que transfiere" placeholder="Nombre de la persona que transfiere" />
				</div>
				<div class="form-group">
					<input type="submit" name="subir" class="btn" value="Enviar"/>
				</div>
			</form>
    	</div>
	</div>


    <footer class="footer">
        <div class="container">
            <div class="row">             
                <div class="col-4 offset-1 col-sm-2">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="../index.html">Inicio</a></li>
                        <li><a href="#">Productos</a></li>
                        <li><a href="./carrito.php">Carrito</a></li>
                        <li><a href="./miscompras.php">Mis Compras</a></li>
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
   background-color: #2854AA;
   color:white;
 }
 .btn1{
   text-decoration: none;
   background: #d60062!important;
   padding: 10px 10px;
   border: none;
   border-radius: 6px;

   color: white;
   display: block;

   margin-bottom: 15px;
   margin-left: 180px;

   margin-right: auto;

   margin-top: -10px;
   float: left;
   text-align: center;

   width: 330px;
}

.btn1:hover{ 
   cursor: pointer;
   background-color: #2854AA;
   color:white;
 }
 .ima{
 	font-family: 'Optima';
 	font-size: 15px;
 	margin-left: -510px;
 	margin-bottom: -10px;
 	margin-top: 20px;

 }
</style>
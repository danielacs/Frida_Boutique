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

	<title>Mis Compras</title>
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
            <a class="navbar-brand mr-auto" href="./indexUser.php"><img src="../iconos/pasillo.jpg" height="100" width="100"></a>
            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="./indexUser.php"> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="./productos.php"> Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="./carrito.php"> Carrito</a></li>
                    <li class="nav-item active"><a class="nav-link" href="#"> Mis Compras</a></li>
                   
                </ul>       
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a class="nav-link" href="./salirUser.php"> Cerrar Sesion </a></li>
                </ul>      
            </div> 
        </div>
    </nav>
   <br><br><br>
    <h1 class="titulo">Mis Compras</h1>
    <?php
        check_user('miscompras');
        $s = $conexion->query("SELECT * FROM compra WHERE id_cliente = '".$_SESSION['id_cliente']."' ORDER BY fecha DESC");
        if(mysqli_num_rows($s)>0){
    ?>
    <div class="contenedor1">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr class="table-secondary">
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>

                <?php
                    while($r=mysqli_fetch_array($s)){
                ?>
                <tr>
                    <td><?=fecha($r['fecha'])?></td>
                    <td><?=$divisa?><?=number_format($r['monto'])?> </td>
                    <td><?=estado($r['estado'])?></td>
                    <td>
                        <a href="./vercompra.php&id=<?php echo $r['id']?>">
                        <img src="../iconos/ver1.png" width="35" height="20" title="Ver compra" ></a>

                    <?php
                        if(estado($r['estado']) == "Iniciando"){
                    ?>
                        &nbsp; &nbsp;<a title="Pagar" href="./pagarCompra.php?id=<?php echo $r['id']?>"><b>Pagar</b></a>
                    <?php
                        }
                    ?>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>
    <?php
        }else{
    ?>
        <center><i>No ha realizado ninguna compra</i></center>
    <?php
        }
    ?>
   

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
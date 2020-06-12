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

   <title>Ver Compra</title>
</head>

<body>
   <nav class="navbar navbar-dark navbar-expand-sm fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mr-auto" href="../index.html"><img src="../iconos/pasillo.jpg" height="100" width="100"></a>
            <div class="collapse navbar-collapse" id="Navbar">       
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a class="nav-link" href="./miscompras.php"> Regresar </a></li>
                </ul>       
            </div> 
        </div>
    </nav>

   <br><br><br>

   <?php
check_user('verCompra');
$id = clear($id);

$s = $conexion->query("SELECT * FROM compra WHERE id = '$id' AND id_cliente = '".$_SESSION['id_cliente']."'");

if(mysqli_num_rows($s)>0){

$s = $conexion->query("SELECT * FROM compra WHERE id = '$id'");
$r = mysqli_fetch_array($s);

$sc = $conexion->query("SELECT * FROM clientes WHERE id = '".$r['id_cliente']."'");
$rc = mysqli_fetch_array($sc);

//$nombre = $rc['nombre'];

?>
<h1 class="titulo">VIENDO COMPRA #<span style="color:#08f"><?=$r['id']?></span></h1><br>

<p class="datos">
Fecha: <?=fecha($r['fecha'])?><br>
Monto: <?=$divisa?><?=number_format($r['monto'])?> <br>

</p>
<br>
   
   <div class="contenedor1">
      <div class="table-responsive">
            <table class="table table-bordered table-hover">
               <tr class="table-secondary">
                  <th>Nombre del producto</th>
                  <th>Cantidad</th>
                  <th>Monto Total</th>
               </tr>

               <?php
              $sp = $conexion->query("SELECT * FROM productos_compra WHERE id_compra = '$id'");
              while($rp=mysqli_fetch_array($sp)){

                $spro = $conexion->query("SELECT * FROM productos WHERE id = '".$rp['id_producto']."'");
                $rpro = mysqli_fetch_array($spro);

                $nombre_producto = $rpro['nombre'];

                $montototal = $rp['monto'] * $rp['cantidad'];
                ?>
                  <tr>
                    <td><?=$nombre_producto?></td>
                    <td><?=$rp['cantidad']?></td>
                    <td><?=$r['monto']?></td>
                  </tr>
                <?php
              }
            ?>
         </table>
      </div>
      <br>
<br>
<!--<?php
//if(estado($r['estado']) == "Iniciando"){
//  ?>
  <a class="btn" href="./pagarCompra.php?id=<?php echo $r['id']?>">
    Pagar
  </a>
  <?php
?>-->

<?php

}else{
  echo '<script language="javascript">alert("El usuario ha cerrado su sesión");</script>';
  redir("./pagos.php");
}
?>
   </div>


    <footer class="footer">
        <div class="container">
            <div class="row">             
                <div class="col-4 offset-1 col-sm-2">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="../indexUser.php">Inicio</a></li>
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
  .navbar-dark {
     background-color: #000;
}
.footer{
    background-color: #000;
    margin:0px auto;
    padding: 20px 0px 20px 0px;
    font-family: sans-serif;
}.table th{
  border: 1px solid #000;
}
.table td{
  border: 1px solid #000 ;
}
</style>
<?php
include "../configs/configs.php";
include "../configs/funciones.php";
?>
<?php
check_user('carrito');

if(isset($eliminar)){
   $eliminar = clear($eliminar);
   $conexion->query("DELETE FROM carro WHERE id = '$eliminar'");
   redir("carrito.php");
}

if(isset($id) && isset($modificar)){

   $id = clear($id);
   $modificar = clear($modificar);

   $conexion->query("UPDATE carro SET cant = '$modificar' WHERE id = '$id'");
   echo '<script language="javascript">alert("Cantidad modificada correctamente");</script>';
}

if(isset($finalizar)){

   $monto = clear($monto_total);

   $id_cliente = clear($_SESSION['id_cliente']);
   $q = $conexion->query("INSERT INTO compra (id_cliente,fecha,monto,estado) VALUES ('$id_cliente',NOW(),'$monto',0)");

   $sc = $conexion->query("SELECT * FROM compra WHERE id_cliente = '$id_cliente' ORDER BY id DESC LIMIT 1");
   $rc = mysqli_fetch_array($sc);

   $ultima_compra = $rc['id'];


   $q2 = $conexion->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente'");
   while($r2=mysqli_fetch_array($q2)){

      $sp = $conexion->query("SELECT * FROM productos WHERE id = '".$r2['id_producto']."'");
      $rp = mysqli_fetch_array($sp);

      $monto = $rp['precio'];

      $conexion->query("INSERT INTO productos_compra (id_compra,id_producto,cantidad,monto) VALUES ('$ultima_compra','".$r2['id_producto']."','".$r2['cant']."','$monto')");

   }

   $conexion->query("DELETE FROM carro WHERE id_cliente = '$id_cliente'");

   $sc = $conexion->query("SELECT * FROM compra WHERE id_cliente = '$id_cliente' ORDER BY id DESC LIMIT 1");
   $rc = mysqli_fetch_array($sc);

   $id_compra = $rc['id'];

   echo '<script language="javascript">alert("Se ha finalizado la compra, ingrese a -Mis compras- para realizar el pago");</script>';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../estilo.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Productos</title>
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
                    <li class="nav-item"><a class="nav-link" href="./productos.php"> Productos</a></li>
                    <li class="nav-item active"><a class="nav-link" href="#"> Carrito</a></li>
                    <li class="nav-item"><a class="nav-link" href="./miscompras.php"> Mis Compras</a></li>
                    <li class="nav-item"><a class="nav-link" href="./adminlogin.php"> Administrador</a></li>
                </ul>        
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a class="nav-link" href="./registro.php"> Registrarse  </a></li>
                    <li class="nav-item"><a class="nav-link" href="./login.php"> Iniciar Sesion </a></li>
                </ul>       
            </div> 
        </div>
    </nav>

    <br><br><br>

    <h1 class="titulo"> CARRITO DE COMPRAS</h1>

   <div class="contenedor1">
      <div class="table-responsive">
         <table class="table table-bordered table-hover">
            <tr class="table-secondary">
               <th><i class="fa fa-image"></i></th>
               <th>Nombre del producto</th>
               <th>Cantidad</th>
               <th>Precio por unidad</th>
               <th>Oferta</th>
               <th>Precio Total</th>
               <th>Precio Neto</th>
               <th>Acciones</th>
            </tr>

<?php
$id_cliente = clear($_SESSION['id_cliente']);
$q = $conexion->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente'");
$monto_total = 0;
while($r = mysqli_fetch_array($q)){
   $q2 = $conexion->query("SELECT * FROM productos WHERE id = '".$r['id_producto']."'");
   $r2 = mysqli_fetch_array($q2);

   $preciototal = 0;
         if($r2['oferta']>0){
            if(strlen($r2['oferta'])==1){
               $desc = "0.0".$r2['oferta'];
            }else{
               $desc = "0.".$r2['oferta'];
            }

            $preciototal = $r2['precio'] -($r2['precio'] * $desc);
         }else{
            $preciototal = $r2['precio'];
         }

   $nombre_producto = $r2['nombre'];

   $cantidad = $r['cant'];

   $precio_unidad = $r2['precio'];
   $precio_total = $cantidad * $preciototal;
   $imagen_producto = $r2['imagen'];

   $monto_total = $monto_total + $precio_total;

   

   ?>
      <tr>
         <td><img src="../productos/<?=$imagen_producto?>" class="imagen_carro"/></td>
         <td><?=$nombre_producto?></td>
         <td><?=$cantidad?></td>
         <td><?=$divisa?><?=$precio_unidad?> </td>
         <td>
            <?php
               if($r2['oferta']>0){
                  echo $r2['oferta']."% de Descuento";
               }else{
                  echo "Sin descuento";
               }
            ?>
         </td>
         <td><?=$divisa?><?=$preciototal?> </td>
         <td><?=$divisa?><?=$precio_total?> </td>
         <td>
            <a onclick="modificar('<?php echo $r['id']?>')" href="#"><img src="../iconos/editar.png" width="35" height="35" title="Modificar cantidad en carrito"></i></a>
            <a href="?eliminar=<?php echo $r['id']?>"><img src="../iconos/eliminar.png" width="35" height="35" title="Eliminar" ></i></a>
         </td>
      </tr>
   <?php
}
?>
</table>
</div>

   </div>
    

<br>
<div class="col-md-12">
<h2 class="monto">Monto Total: <?=$divisa?><?=$monto_total?> </h2>

<br><br><br><br>

<form method="post" action="">
   <input type="hidden" name="monto_total" value="<?=$monto_total?> "/>
   <button href="./miscompras.php" class="btn" type="submit" name="finalizar" >Finalizar Compra</button>
   <a class="btn1" type="submit" name="finalizar" href="./miscompras">Mis Compras</a>
</form>
</div>

<script type="text/javascript">
        
    function modificar(idc){
        var new_cant = prompt("¿Cual es la nueva cantidad?");

        if(new_cant>0){

            window.location="./carrito.php&id="+idc+"&modificar="+new_cant;

        }

    }

</script>
 
    <footer class="footer">
        <div class="container">
            <div class="row">             
                <div class="col-4 offset-1 col-sm-2">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Productos</a></li>
                        <li><a href="#">Carrito</a></li>
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
  .imagen_carro{
  width:50px;
  height:50px;
  border-radius: 1000px;
}
.btn{
   text-decoration: none;
   background:  #d60062!important;
   padding: 15px 10px;
   border: none;
   border-radius: 6px;

   color: white;
   display: block;

   margin-bottom: 15px;
   margin-left: auto;

   margin-right: 200px;

   margin-top: -100px;
   float: right;
   text-align: center;

   width: 150px;
}

.btn:hover{ 
   cursor: pointer;
   background-color:  #d60062!important;
   color:white;
 }

 .btn1{
  font-family: 'Optima';
   text-decoration: none;
   background:  #d60062!important;
   padding: 15px 10px;
   border: none;
   border-radius: 6px;
   font-size: 15px;
   color: white;
   display: block;

   margin-bottom: 15px;
   margin-left: auto;

   margin-right: 20px;

   margin-top: -100px;
   float: right;
   text-align: center;

   width: 150px;
}

.btn1:hover{ 
   cursor: pointer;
   background-color:  #d60062!important;
   color:white;
 }
</style>
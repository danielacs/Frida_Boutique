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

	<title>Pagos</title>
     <script>
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
                    <li class="nav-item active"><a class="nav-link" href="./adminlogin.php"> Regresar  </a></li>
                </ul>       
            </div> 
        </div>
    </nav><br><br><br><br>

  <?php
check_admin();

if(isset($aceptar)){
  $conexion->query("UPDATE pagos SET estado = 1 WHERE id = '$aceptar'");
  $id_compra = clear($id_compra);
  $conexion->query("UPDATE compra SET estado = 1 WHERE id = '$id_compra'");
  echo '<script language="javascript">alert("Pago verificado correctamente");</script>';
  redir("./vercompra.php?id=".$id_compra);
}

//Estados:
//0 Sin verificar
//1 Verificado
//2 Reembolso

?>

          <div class="contenedor1">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <tr class="table-secondary">
                  <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Comprobante</th>
                    <th>Nombre de comprobante</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                    <?php
                      $s = $conexion->query("SELECT * FROM pagos WHERE estado = 0 ORDER BY fecha DESC");
                      while($r=mysqli_fetch_array($s)){
                        ?>

                        <tr>
                          <td><?=nombre_cliente($r['id_cliente'])?></td>
                          <td><?=fecha($r['fecha'])?></td>
                          <td><a style="color:#3f88d4" target="_blank" href="../comprob/<?php echo $r['comprobante']?>">Ver Comprobante</a></td>
                          <td><?=$r['nombre']?></td>
                          <td><?=estado_pago($r['estado'])?></td>
                          <td>
                            <?php
                            if($r['estado']==0){
                              ?>
                                <a style="color:#3f88d4" href="./pagos.php?aceptar=<?php echo $r['id'];?>?id_compra=<?php echo $r['id_compra'];?>"><img src="../iconos/verificar1.png" width="25" height="25" title="Verificar y aceptar pago" ></a>
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

          <h1 class="titulo2">Pagos Realizados</h1>

<div class="contenedor1">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <tr class="table-secondary">
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Comprobante</th>
        <th>Nombre de comprobante</th>
        <th>Estado</th>
      </tr>

  <?php
  $s = $conexion->query("SELECT * FROM pagos WHERE estado > 0 ORDER BY fecha DESC");
  while($r=mysqli_fetch_array($s)){
    ?>
    <tr>
      <td><?=nombre_cliente($r['id_cliente'])?></td>
      <td><?=fecha($r['fecha'])?></td>
      <td><a style="color:#3f88d4" target="_blank" href="../comprob/<?php echo $r['comprobante']?>">Ver Comprobante</a></td>
      <td><?=$r['nombre']?></td>
      <td><?=estado_pago($r['estado'])?></td>
      <td>
        <?php
        if($r['estado']==0){
          ?>
            <a style="color:#333" href="./pagos.php?aceptar=<?php echo $r['id']?>"><img src="../iconos/verificar1.png" width="25" height="25" title="Verificar y aceptar pago" ></a>
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
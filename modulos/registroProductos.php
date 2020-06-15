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

	<title>Registro productos</title>
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
                    <li class="nav-item active"><a class="nav-link" href="./adminlogin.php"> Regresar  </a></li>
                </ul>       
            </div> 
        </div>
    </nav><br><br><br><br>

<center><h1 class="titulo">AGREGAR PRODUCTO</h1></center>

<form id="product" method="post" action="./insertProductos.php" enctype=”multipart/form-data“>
  <div class=" row text-center login-page ">
    <div class="col-md-12 login-form">
      <div class="row">
        <div class="col-md-12 login-form-row">
          <input type="text" autocomplete="off" class="form-control" name="name" placeholder="Nombre del producto"/>
        </div>
      </div><br>
      <div class="row">
        <div class="col-md-12 login-form-row">
          <input type="text" class="form-control" name="price" placeholder="Precio del producto"/>
        </div>
      </div><br>
      <div class="row">
        <div class="col-md-12 login-form-row">
          <input type="text" class="form-control" name="talla" placeholder="Talla del producto XCH/CH/M/G/XG"/>
        </div>
      </div><br>

      <div class="row">
        <div class="col-md-12 login-form-row">          

          <!--<label class="ima">Imagen del producto</label><br>--><br>
          <input type="file" class="btn1" name="imagen" title="Imagen del producto" placeholder="Imagen del producto">

          <select name="categoria" required class="btn">
            <option value="">Categoria</option>
            <?php
              $q = $conexion->query("SELECT * FROM categorias ORDER BY categoria ASC");

              while($r=mysqli_fetch_array($q)){
                ?>
                  <option value="<?php echo $r['id']?>"><?=$r['categoria']?></option>
                <?php
              }
            ?>
          </select>

          <select name="oferta" class="btn">
            <option value="0">0% de Descuento</option>
            <option value="5">5% de Descuento</option>
            <option value="10">10% de Descuento</option>
            <option value="15">15% de Descuento</option>
            <option value="20">20% de Descuento</option>
            <option value="25">25% de Descuento</option>
            <option value="30">30% de Descuento</option>
            <option value="35">35% de Descuento</option>
            <option value="40">40% de Descuento</option>
            <option value="45">45% de Descuento</option>
            <option value="50">50% de Descuento</option>
            <option value="55">55% de Descuento</option>
            <option value="60">60% de Descuento</option>
            <option value="65">65% de Descuento</option>
            <option value="70">70% de Descuento</option>
            <option value="75">75% de Descuento</option>
            <option value="80">80% de Descuento</option>
            <option value="85">85% de Descuento</option>
            <option value="90">90% de Descuento</option>
            <option value="95">95% de Descuento</option>
            <option value="99">99% de Descuento</option>
          </select>

        </div><br>
        </div>

         <div class="row">
                  <div class="col-md-12 login-form-row">
                    <br> <img src="../captcha/captcha.php"/>

                     <input type="text" name="captcha" id="captcha" required /><br> 
                  </div>
               </div>

        <div class="row">
          <div class="col-md-12 login-form-row">
          <button type="submit" class="btn2" name="enviar"><i class="fa fa-check"></i> Agregar Producto</button>
          </div>
        </div>
      
    </div>
    
  </div>
  

</form><br>

<br>

 <div class="contenedor1">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <tr class="table-secondary">
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Talla</th>
                  <th>Descuento</th>
                  <th>Precio Total</th>
                  <th>Imagen</th>
                  <th>Categoria</th>
                  <th>Acciones</th>
                </tr>

  <?php
    $prod = $conexion->query("SELECT * FROM productos ORDER BY id DESC");
    while($rp=mysqli_fetch_array($prod)){
      $preciototal = 0;
      $cat = $conexion->query("SELECT * FROM categorias WHERE id = '".$rp['id_categoria']."'");

      if(mysqli_num_rows($cat)>0){
        $rcat = mysqli_fetch_array($cat);
        $categoria = $rcat['categoria'];
      }else{
        $categoria = "--";
      }

      if($rp['oferta']>0){
        if(strlen($rp['oferta'])==1){
          $desc = "0.0".$rp['oferta'];
        }else{
          $desc = "0.".$rp['oferta'];
        }
        $preciototal = $rp['precio'] -($rp['precio'] * $desc);
      }else{
        $preciototal = $rp['precio'];
      }
      ?>
        <tr>
          <td><?=$rp['nombre']?></td>
          <td><?=$rp['precio']?></td>
          <td><?=$rp['talla']?></td>
          <td>
            <?php
              if($rp['oferta']>0){
                echo $rp['oferta']."% de Descuento";
              }else{
                echo "Sin descuento";
              }
            ?>
          </td>
          <td><?=$preciototal?></td>

          <td><img src="../productos/<?php echo $rp['imagen']?>" class="imagen_carro"/></td>
          <td><?=$categoria?></td>
          <td>
            
            <a href="./modificarProducto.php?id=<?php echo $rp['id']?>"><img src="../iconos/editar.png" width="35" height="35" title="Modificar producto" ></a>
            &nbsp;
      
            <a href="./insertProductos.php?eliminar=<?php echo $rp['id']?>"><img src="../iconos/eliminar.png" width="30" height="35" title="Eliminar" ></a>

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


<style>
  .navbar-dark {
     background-color: #000;
}
.footer{
    background-color: #000;
    margin:0px auto;
    padding: 20px 0px 20px 0px;
    font-family: sans-serif;
}
  .imagen_carro{
  width:50px;
  height:50px;
  border-radius: 1000px;
}
.titulo{
  margin-top: 100px;
  margin-bottom: 40px;
  font-size: 45px;
  font-family: 'Optima';
  margin-left: auto;
  margin-right: auto;
  text-align: center;
}
.table th{
  border: 1px solid #000;
}
.table td{
  border: 1px solid #000 ;
}
.form-group1{
  float:left;
  margin-right: 50px;
  padding: 10px 20px;
}
.btn{
   text-decoration: none;
   background: #6bbf72!important;
   padding: 15px 10px;
   border: none;
   border-radius: 6px;

   color: white;
   display: block;

   margin-bottom: 35px;
   margin-left: auto;

   margin-right: 40px;

   margin-top: 7px;
   float: right;
   text-align: center;

   width: 150px;
}

.btn:hover{ 
   cursor: pointer;
   background-color: #d60062!important;
   color:white;
 }

 .btn1{
   text-decoration: none;
   background: #6bbf72!important;
   padding: 15px 10px;
   border: none;
   border-radius: 6px;

   color: white;
   display: block;

   margin-bottom: 15px;
   margin-left: auto;

   margin-right: 20px;

   margin-top: 0px;
   float: right;
   text-align: center;

   width: 330px;
}

.btn1:hover{ 
   cursor: pointer;
   background-color: #d60062!important;
   color:white;
 }

 .btn2{
   text-decoration: none;
   background:  #6bbf72!important;
   padding: 15px 10px;
   border: none;
   border-radius: 6px;

   color: white;
   display: block;

   margin-bottom: 15px;
   margin-left: auto;

   margin-right: 40px;

   margin-top: 7px;
   float: right;
   text-align: center;

   width: 150px;
}

.btn2:hover{ 
   cursor: pointer;
   background-color:  #d60062!important;
   color:white;
   font-weight: bold;
 }
 .ima{
  font-family: 'Optima';
  font-size: 15px;
  margin-left: 100px;
  margin-bottom: 10px;
  margin-top: 0px;

 }

</style>
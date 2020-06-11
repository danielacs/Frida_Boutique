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

	<title>Modificar Productos</title>
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
                    <li class="nav-item active"><a class="nav-link" href="./salirAdmin.php"> Salir  </a></li>
                </ul>       
            </div> 
        </div>
    </nav><br><br><br><br>

  <?php
check_admin();

  $id = clear($id);

 $q = $conexion->query("SELECT * FROM productos WHERE id = '$id'");
  $rq = mysqli_fetch_array($q);



if(isset($enviar)){
  $idpro = clear($idpro);
  $name = clear($name);
  $price = clear($price);
  $talla = clear($talla);
  $categoria = clear($categoria);
  $oferta = clear($oferta);

  $conexion->query("UPDATE productos SET nombre = '$name',precio = '$price',talla = '$talla',
    oferta = '$oferta', id_categoria = '$categoria' WHERE id = '$idpro'");
  redir("./registroProductos.php");

}

?>
<h1 class="titulo">Modificar Producto</h1>

<form method="post" action="">
  <div class=" row text-center login-page ">
    <div class="col-md-12 login-form">
      <div class="row">
        <div class="col-md-12 login-form-row">
          <input type="text" class="form-control" name="name" value="<?php echo $rq['nombre']?>" placeholder="Nombre del producto"/>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-md-12 login-form-row">
          <input type="text" class="form-control" name="price" value="<?php echo $rq['precio']?>" placeholder="Precio del producto"/>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-md-12 login-form-row">
          <input type="text" class="form-control" name="talla" value="<?php echo $rq['talla']?>" placeholder="Talla del producto XCH/CH/M/G/XG"/>
        </div>
      </div>
      <br>


      <div class="row">
        <div class="col-md-8 login-form-row">

          <select name="categoria" required class="btn">
            <option value="">Seleccione una categoria</option>
            <?php
              $q = $conexion->query("SELECT * FROM categorias ORDER BY categoria ASC");

              while($r=mysqli_fetch_array($q)){
                ?>
                  <option <?php if($rq['id_categoria'] == $r['id']) { echo "selected"; } ?>  value="<?php echo $r['id']?>"><?=$r['categoria']?></option>
                <?php
              }
            ?>
          </select>

          <select name="oferta" class="btn1">
            <option <?php if($rq['oferta'] == 0) { echo "selected"; }?> value="0">0% de Descuento</option>
            <option <?php if($rq['oferta'] == 5) { echo "selected"; }?> value="5">5% de Descuento</option>
            <option <?php if($rq['oferta'] == 10) { echo "selected"; }?> value="10">10% de Descuento</option>
            <option <?php if($rq['oferta'] == 15) { echo "selected"; }?> value="15">15% de Descuento</option>
            <option <?php if($rq['oferta'] == 20) { echo "selected"; }?> value="20">20% de Descuento</option>
            <option <?php if($rq['oferta'] == 25) { echo "selected"; }?> value="25">25% de Descuento</option>
            <option <?php if($rq['oferta'] == 30) { echo "selected"; }?> value="30">30% de Descuento</option>
            <option <?php if($rq['oferta'] == 35) { echo "selected"; }?> value="35">35% de Descuento</option>
            <option <?php if($rq['oferta'] == 40) { echo "selected"; }?> value="40">40% de Descuento</option>
            <option <?php if($rq['oferta'] == 45) { echo "selected"; }?> value="45">45% de Descuento</option>
            <option <?php if($rq['oferta'] == 50) { echo "selected"; }?> value="50">50% de Descuento</option>
            <option <?php if($rq['oferta'] == 55) { echo "selected"; }?> value="55">55% de Descuento</option>
            <option <?php if($rq['oferta'] == 60) { echo "selected"; }?> value="60">60% de Descuento</option>
            <option <?php if($rq['oferta'] == 65) { echo "selected"; }?> value="65">65% de Descuento</option>
            <option <?php if($rq['oferta'] == 70) { echo "selected"; }?> value="70">70% de Descuento</option>
            <option <?php if($rq['oferta'] == 75) { echo "selected"; }?> value="75">75% de Descuento</option>
            <option <?php if($rq['oferta'] == 80) { echo "selected"; }?> value="80">80% de Descuento</option>
            <option <?php if($rq['oferta'] == 85) { echo "selected"; }?> value="85">85% de Descuento</option>
            <option <?php if($rq['oferta'] == 90) { echo "selected"; }?> value="90">90% de Descuento</option>
            <option <?php if($rq['oferta'] == 95) { echo "selected"; }?> value="95">95% de Descuento</option>
            <option <?php if($rq['oferta'] == 99) { echo "selected"; }?> value="99">99% de Descuento</option>
          </select>
        </div>
      </div>

      <div class="row">
                  <div class="col-md-12 login-form-row">
                    <br> <img src="../captcha/captcha.php"/>
            <input type="text" name="captcha" id="captcha" required/><br> 
                  </div>
             </div>


      <div class="row">
        <div class="col-md-8 login-form-row">
          <button type="submit" name="enviar" class="btn2"> Modificar Producto</button>
        </div>
      </div>


        <input type="hidden" name="idpro" value="<?php echo$id?>"/>
    </div>
  </div>
</form>


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
.table-success {
  width: px;
  border: 1px solid black;
  border-collapse: collapse;
  font-family: 'Optima';
  margin-left: 10px;
}
.table th{
  font-size: 17px;
  margin-top: 10px;
  padding: 10px 10px;
  border: 1px solid #E6E6E6;
  margin-left: 10px;
  background: #D5D5D5;
}
.table td{
  font-size: 15px;
  text-align: center;
  padding: 0px 0px;
  border: 1px solid #E6E6E6 ;
  margin-left: 10px;
  background: white;
}
.form-group1{
  float:left;
  margin-right: 50px;
  padding: 10px 20px;
}
.btn{
   text-decoration: none;
   background: #d60062!important;
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
   background-color: #2854AA;
   color:white;
 }

 .btn1{
   text-decoration: none;
   background:  #d60062!important;
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
   background-color: #2854AA;
   color:white;
 }

 .btn2{
   text-decoration: none;
   background:  #d60062!important;
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
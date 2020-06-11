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
                    <!--<li class="nav-item"><a class="nav-link" href="./carrito.php"> Carrito</a></li>
                    <li class="nav-item"><a class="nav-link" href="./miscompras.php"> Mis Compras</a></li>-->
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
	
	
	<?php 
		//CATEGORIAS
		if(isset($cat)){
			$sc = $conexion->query("SELECT * FROM categorias WHERE id = '$cat'");
			$rc = mysqli_fetch_array($sc);
			?>
			<h2 class="cat">Categoria Filtrada por: <?=$rc['categoria']?></h2>
			<?php
		} 
		 //para agregar al carro
		if(isset($agregar) && isset($cant)){
		   $idp = clear($agregar);
		   $cant = clear($cant);
		   check_user('productos');
		   $id_cliente = clear($_SESSION['id_cliente']);

		   $v = $conexion->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");

		   if(mysqli_num_rows($v)>0){
		      $q = $conexion->query("UPDATE carro SET cant = cant + $cant WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
		   }else{
		      $q = $conexion->query("INSERT INTO carro (id_cliente,id_producto,cant) VALUES ($id_cliente,$idp,$cant)");
		   }
		   echo '<script language="javascript">alert("Se ha agregado al carro de compras");</script>';   
		}
		if(isset($busq) && isset($cat)){
			$q = $conexion->query("SELECT * FROM productos WHERE nombre like '%$busq%' AND id_categoria = '$cat'");
		}elseif(isset($cat) && !isset($busq)){
			$q = $conexion->query("SELECT * FROM productos WHERE id_categoria = '$cat' ORDER BY id DESC");
		}elseif(isset($busq) && !isset($cat)){
			$q = $conexion->query("SELECT * FROM productos WHERE nombre like '%$busq%'");
		}elseif(!isset($busq) && !isset($cat)){
			$q = $conexion->query("SELECT * FROM productos ORDER BY id DESC");
		}else{
			$q = $conexion->query("SELECT * FROM productos ORDER BY id DESC");
		}
	?><br><br><br>
<h4>-Inicia Sesion para comprar-</h4>
	<form method="post" action="">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
				<h1 class="titulo" align="center">PRODUCTOS</h1>
					<style> h1{text-align: center;}</style>
					<br>
				<select id="categoria" name="cat" class="btn2">
					<option value="">Seleccionar categoria</option>
					<?php
					$cats = $conexion->query("SELECT * FROM categorias ORDER BY categoria ASC");
					while($rcat = mysqli_fetch_array($cats)){
						?>
						<option value="<?=$rcat['id']?>"><?=$rcat['categoria']?></option>
						<?php
					}
					?>
				</select>

				
			</div><br>
			<div class="col-12">
				<button type="submit" name="buscar" class="btn1"> Buscar</button>
			</div>
		</div>
	</form>
	<br>
<?php
while($r=mysqli_fetch_array($q)){
	$preciototal = 0;
			if($r['oferta']>0){
				if(strlen($r['oferta'])==1){
					$desc = "0.0".$r['oferta'];
				}else{
					$desc = "0.".$r['oferta'];
				}

				$preciototal = $r['precio'] -($r['precio'] * $desc);
			}else{
				$preciototal = $r['precio'];
			}
	?>

<div class="card col-xs-12 col-sm-12 col-md-6 col-lg-3">
			<div class="card-title"><?=$r['nombre']?></div>
			<img class="card-img-top" src="../productos/<?=$r['imagen']?>"/>
			<div class="card-body">
			<div> Talla: <?=$r['talla']?></div>
			<?php
			if($r['oferta']>0){
				?>
				Precio: <del> <?=$divisa?><?=$r['precio']?> </del> <span class="precio"> <?=$divisa?><?=$preciototal?>  </span>
				<?php
			}else{
				?>
				 Precio: <span class="precio"> <?=$divisa?><?=$r['precio']?> </span>
				<?php
			}
			?>
			<!--<button class="btn btn-warning pull-right" onclick="agregar_carro('<?=$r['id']?>');"><img src="../iconos/carrito.png" width="20" height="20" ></button>-->
		</div>
	</div>
	<?php
}
?>


<script type="text/javascript">
	
	function agregar_carro(idp){
		var cant = prompt("¿Que cantidad desea agregar?",1);

		if(cant.length>0){
			window.location="?p=productos&agregar="+idp+"&cant="+cant;
		}
	}

</script>





    <footer class="footer">
        <div class="container">
            <div class="row">             
                <div class="col-4 offset-1 col-sm-2">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="../index.html">Inicio</a></li>
                        <li><a href="#">Productos</a></li>
                        <li><a href="modulos/carrito.php">Carrito</a></li>
                        <li><a href="modulos/miscompras.php">Mis Compras</a></li>
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
	.card{
		display:inline-table;
		width:25%;
		margin-left:65px;
		margin-right: 0px;
		border: 1px solid black;
		font-family: sans-serif;
		margin-bottom: 80px;
		

}

.card-img-top{
		text-align: center;
		width:300px;
		height:300px;
}

.card-tittle{
		padding:10px;
		color:white;
		background: #d60062!important;
		text-align: center;
		font-size:18px;
}

.precio{
		color:#00aa00;
		padding:20px;
}
h4{
   font-size: 20px;
   font-family: 'Optima';
   text-align: center;
}
h1{

   margin-top: 50px;
   font-size: 45px;
   font-family: 'Optima';
   margin-left: auto;
   margin-right: auto;
   text-align: center;
}
.cat{
   margin-top: -15px;
   font-size: 35px;
   font-family: 'Optima';
   margin-left: 0px;
}
.btn1{
   text-decoration: none;
   background:  #d60062!important;
   padding: 15px 10px;
   border: none;
   border-radius: 3px;

   color: white;
   display: block;

   margin-bottom: 15px;
   margin-left: 30px;

   margin-right: 30px;


   margin-top: 6px;
  
   text-align: center;

   width: 100px;
}

.btn1:hover{ 
   cursor: pointer;
   background-color:  #d60062!important;
   color:white;
 }

 .comprar{

	text-decoration: none;
	border: 2px solid black;
	padding: 10px 20px 10px 20px;
	background:  #d60062!important;
	border-top-width: 2px;
 	border-right-width: 5px;
 	border-bottom-width: 5px;
  	border-left-width: 2px;
  	font-family: 'Optima';
  	color: white;
	margin-right: 95px;
	margin-left: 800px;
	margin-top: -80px;
	float:right;
	


}

.comprar:hover{
	background:  #d60062!important;
	color: black;
	transition: background 1s, color 1s;
	font-weight: bold;
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
   margin-left: 50px;

   margin-right: 40px;


   margin-top: 3px;
  
   text-align: center;

   width: 235px;
}

.btn2:hover{ 
   cursor: pointer;
   background-color: #d60062!important;
   color:white;
 }

</style>
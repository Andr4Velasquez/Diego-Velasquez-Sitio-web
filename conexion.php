<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<?php 
//crearemos nuestra conexion a nuestra base de datos
$servidor="localhost";
$usuarios="root";
$contraseña="";
$basedatos="base_sitio";

$conexion=mysqli_connect($servidor,$usuarios,$contraseña,$basedatos);
if(!$conexion){
  die("upss la conexion fallo".mysqli_connect_error());
} 
?>

</body>
</html>
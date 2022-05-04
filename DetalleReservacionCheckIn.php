<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title></title> 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
<form action = "DetalleReservacionCheckIn.php" method = "post">
<div>
<p>Registro de Entrada CheckIn</p>   
<?php
$con=mysqli_connect("127.0.0.1","root","","pia");
$consulta="call spBuscarReservacionDetalleIN();";
$resultado=mysqli_query($con,$consulta);
?>
<p>id reservacion para checkin </p>
<select name ="ddlCheck">
<option value=0> [SELECCIONAR]</option>
<?php
while ($reg=mysqli_fetch_array($resultado)) 
{
echo'<option value='.$reg['IdReservacion'].'>'.$reg['IdReservacion'].'</option>';  
}?>
</select>
<input type="submit" name="btnBuscar" value="Buscar">
<?php
if(isset($_POST["btnBuscar"]))
{ 
   $_Resevacion=($_POST['ddlCheck']);
   $con=mysqli_connect("127.0.0.1","root","","pia");
   $consulta="call spBuscarIdclienteInt('$_Resevacion');";
   $resultado=mysqli_query($con,$consulta);?>
   <p>CLIENTE </p>
   <select name ="ddlCliente">
   <option value=0> [SELECCIONAR]</option>
   <?php  
   while ($reg=mysqli_fetch_array($resultado)) 
   {
   echo'<option value='.$reg['IdCliente'].'>'.$reg['CLIENTE'].'</option>';  
   }?>
   </select>
   <input type="submit" name="btnRegistrarEn" value="Registrar Entrada">
   <?php
}
if(isset($_POST["btnRegistrarEn"]))
{ 
   $_Cliente=$_POST["ddlCliente"];
   $_Resevacion=($_POST['ddlCheck']);
   $con=mysqli_connect("127.0.0.1","root","","pia");
   $consulta="call spCheckInt('$_Resevacion','$_Cliente');";
   $resultado=mysqli_query($con,$consulta);
   echo "<h1>Registro Exitoso</h1>"; 
}
else
{
   $Mensaje="";
   $_Resevacion="";
   $_Cliente="";
}
?>
<br>
<a href="Menu/Menureservacion.php">Regresar Menu reservacion</a>
</form>
</div>
</body>
</html>
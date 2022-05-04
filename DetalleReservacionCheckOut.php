
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
<form action = "DetalleReservacionCheckOut.php" method = "post">
<div>
<p>Registro de salida CheckOut</p>   
<?php

   $con=mysqli_connect("127.0.0.1","root","","pia");
   $consulta="call spBuscarReservacionDetalleOut();";
   $resultado=mysqli_query($con,$consulta);
   echo '<p>Seleccione el id reservacion para checkout</p>';
   echo '<select name ="ddlCheck">';
   echo'<option value=0> [SELECCIONAR]</option>'; 
   while ($reg=mysqli_fetch_array($resultado)) 
   {
   echo'<option value='.$reg['IdReservacion'].'>'.$reg['IdReservacion'].'</option>';  
   }
   echo '</select>';
   echo'<input type="submit" name="btnBuscar" value="Buscar">';
if(isset($_POST["btnBuscar"]))
{
   $_Resevacion=($_POST['ddlCheck']);
   $_Resevacion1=$_Resevacion;
   $con=mysqli_connect("127.0.0.1","root","","pia");
   $consulta="call spBuscarIdclienteOUT($_Resevacion);";
   $resultado=mysqli_query($con,$consulta);
   echo '<p>CLIENTE </p>';
   echo '<select name ="ddlCliente">';
   echo'<option value=0> [SELECCIONAR]</option>';  
   while ($reg=mysqli_fetch_array($resultado)) 
   {
   echo'<option value='.$reg['IdCliente'].'>'.$reg['CLIENTE'].'</option>';  
   }
   echo '</select>';
   echo '<input type="submit" name="btnRegistrarEn" value="Registrar Salida">';

}

if(isset($_POST["btnRegistrarEn"]))
{ 
   //echo $_Resevacion1;
   $_Resevacion1=($_POST['ddlCheck']);
   $_Cliente=($_POST['ddlCliente']);
   $con=mysqli_connect("127.0.0.1","root","","pia");
   $consulta="call spCheckOut($_Resevacion1,$_Cliente);";
   $resultado=mysqli_query($con,$consulta);
   $Mensaje="Registro de salida Exitoso ";
   
}
 else
{

  $Mensaje="";
  $_Resevacion="";
  $_Cliente="";
 
}

?>
<p><td> <?php echo $Mensaje; ?> </td></p>
<br>
<a href="Menu/Menureservacion.php">Regresar Menu reservacion</a>
</div>
</body>
</html>
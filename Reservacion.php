<?php     $conn=mysqli_connect("127.0.0.1","root","","pia");
?>
<?php
function agregar_reservacion($IdReservacion,$IdUsuario,$IdCliente,$IdHabitacion,$FecInc,$FecFin,$IdEstatus){
    $conn=mysqli_connect("127.0.0.1","root","","pia");
    $query=mysqli_prepare($conn,"CALL insertar_reservacion(?,?,?,?,?,?,?);");
    mysqli_stmt_bind_param($query,"iiiissi",$IdReservacion,$IdUsuario,$IdCliente,$IdHabitacion,$FecInc,$FecFin,$IdEstatus);
    $Res=mysqli_stmt_execute($query);
    if($Res!=1){
        echo $Res;
        echo"No se ha logrado  insertar el registro, verifica tu informacion";
     }
    else{
        echo"Registro insertado con exito";
    }
}
if(isset($_POST["btnagregarreservacion"])){
    $IdReservacion=$_POST["txtidreservacion"];
    $IdUsuario=$_POST["ddlUsuario"];
    $IdCliente=$_POST["ddlCliente"];
    $IdHabitacion=$_POST["ddlHabitacion"];
    $FecInc=$_POST["txtfecin"];
    $FecFin=$_POST["txtfecfin"];
    $IdEstatus=$_POST["ddlidestatus"];
    if($IdReservacion==""&&$FecInc==""&&$FecFin==""){
        echo"'<script>alert('Debes llenar todos los campos');</script>'";
    }
    else{
        agregar_reservacion($IdReservacion,$IdUsuario,$IdCliente,$IdHabitacion,$FecFin,$FecInc,$IdEstatus);
    }
}
?>
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
<nav class="navbar navbar-dark bg-dark">
<div class="container">
    <a href="login.php " class="navbar-brand"></a>
    <a href="index.php " class="navbar-brand">Iniciar sesion</a>
</div>
</nav>
<body>
    <form action="Reservacion.php" method="post">
        <h1>Registrar reservacion</h1>
        <label for="">IdReservacion</label>
        <br>
        <input type="number" name="txtidreservacion" id="" required>
        <br>
        <label for="">IdUsuario</label>
        <br>
        <select name="ddlUsuario">
        <?php 
    	$query = "SELECT IdUsuario, usuario FROM Usuario";
	    $resultado = mysqli_query($conn, $query);
	    while ($reg = mysqli_fetch_array($resultado)) 
	    {
		 echo '<option value = ' . $reg['IdUsuario'] . '>'. $reg['usuario'] . '</option>';
	    }?>
     </select>
    <br>
     <label for="">IdCliente</label>
     <br>
     <select name="ddlCliente">
     <?php
     $query="SELECT Idcliente,Nombre FROM Cliente";
     $resultado=mysqli_query($conn,$query);
     while($reg=mysqli_fetch_array($resultado)){
		echo '<option value = ' . $reg['Idcliente'] . '>'. $reg['Nombre'] . '</option>';
     }
     ?>
     </select>
     <br>
     <label for="">IdHabitacion</label>
     <br>
     <select name="ddlHabitacion">
     <?php
     $query="SELECT IdHabitacion,Descrip FROM Habitacion WHERE idestatus=1";
     $resultado=mysqli_query($conn,$query);
     while($reg=mysqli_fetch_array($resultado)){
		echo '<option value = ' . $reg['IdHabitacion'] . '>'. $reg['Descrip'] . '</option>';
     }
     ?>
     </select>
     <br>
     <label for="">Ingresa la fecha de inicio</label>
     <br>
     <input type="date" name="txtfecin" required>
     <br>
     <label for="">Ingresa la fecha fin</label>
     <br>
     <input type="date" name="txtfecfin" required>
     <br>
     <label for="">Selecciona el estatus de la reservacion</label>
     <br>
     <br>
     <select name="ddlidestatus" id="">
     <?php
        $query="SELECT IdEstatusReservacion,Descrip from estatusreservacion where IdEstatusReservacion=1";
        $resultado=mysqli_query($conn,$query);
        while($reg=mysqli_fetch_array($resultado)){
           echo '<option value = ' . $reg['IdEstatusReservacion'] . '>'. $reg['Descrip'] . '</option>';
        }
     ?>
     </select>
     <br>
     <input type="submit" name="btnagregarreservacion" value="Agregar reservacion">
     <br>
     <a href="Menu/Menureservacion.php">Regresar Menu reservacion</a>
    </form>
</body>
</html>
<!----
     <label for="">Ingresa el monto</label>
     <br>
     <input type="number" name="txtmonto">
!---->
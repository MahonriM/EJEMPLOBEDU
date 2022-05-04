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
</div>
</nav>

<?php 
function agregar_tipohabitacion($pIdTipoHabitacion,$pDescrip,$pPrecio,$pCapacidad){
    $conn=mysqli_connect("localhost","root","","pia");
    $query=mysqli_prepare($conn,"CALL spagregartipohabitacion(?,?,?,?)");
    mysqli_stmt_bind_param($query,"isdi",$pIdTipoHabitacion,$pDescrip,$pPrecio,$pCapacidad);   
    $Res=mysqli_stmt_execute($query);
    if($Res!=1){
        echo"Nose ha insertado el registro, verificar informacion";
    }
    else{
        echo"Registro Insertado con exito!";
    }
}
if(isset($_POST["btnregistrartipohabitacion"])){
$IdTipoHabitacion=$_POST["txtidtipohabitacion"];
$Descrip=$_POST["txtdescrip"];
$Precio=$_POST["txtprecio"];
$Capacidad=$_POST["txtcapacidad"];
if($IdTipoHabitacion==""&&$Descrip==""&&$Precio==""&&$Capacidad==""){
    echo"'<script>alert('Debes llenar todos los campos');</script>'";
}
else{
    agregar_tipohabitacion($IdTipoHabitacion,$Descrip,$Precio,$Capacidad);
}
}
?>
<body>
    <form action="Tipohabitacion.php" method="post">
        <label for="">Ingresa el tipo de habitacion</label>
        <input type="number" name="txtidtipohabitacion" id="" required>
        <br>
        <label for="">Ingresa la descripcion</label>
        <input type="text" name="txtdescrip" pattern="{1-15}" required>
        <br>
        <label for="">Ingresa el precio</label>
        <input type="number" name="txtprecio" step="0.0001" min="0" max="10000" required>
        <br>
        <label for="">Ingresa la capacidad</label>
        <input type="number" name="txtcapacidad" pattern="[0-9]" required>
        <br>
        <input type="submit" name="btnregistrartipohabitacion" value="Registrar tipo habitación">
        <br>
        <a href="Menu/Menutipohabitacion.php">Regresar Menu</a>
    </form>
</body>
</html>
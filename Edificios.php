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
<?php $conn=mysqli_connect("127.0.0.1","root","","pia");?>
<?php
function agregar_edificio($pIdEdificio,$pDescripcion,$pNiveles){
    $conn=mysqli_connect("127.0.0.1","root","","pia");
    $query=mysqli_prepare($conn,"CALL spagregaredificio(?,?,?)");
    mysqli_stmt_bind_param($query,"isi",$pIdEdificio,$pDescripcion,$pNiveles);
    $Res=mysqli_stmt_execute($query);
    if($Res!=1){
        echo"Nose ha insertado el registro, verificar informacion";
    }
    else{
        echo"Registro Insertado con exito!";
    }
}
if(isset($_POST["btnedificio"])){
    $IdEdificio=$_POST["txtidedificio"];
    $Descripcion=$_POST["txtdescrip"];
    $Niveles=$_POST["txtniveles"];
    if($IdEdificio==""&&$Descripcion==""&&$Niveles==""){
        echo"'<script>alert('Debes llenar todos los campos');</script>'";
    }
    else{
        agregar_edificio($IdEdificio,$Descripcion,$Niveles);
    }
}
?>
<body>
<form action="Edificios.php" method="post">
<label for="">Ingresa el Id del edificio</label>
<br>
<input type="number" name="txtidedificio" pattern="{1,15}" required>
<br>
<label for="">Ingresa la descripcion</label>
<br>
<input type="text" name="txtdescrip" pattern="[A-Za-z0-9_-]{1,15}" required>
<br>
<label for="">Ingresa los niveles</label>
<br>
<input type="number" name="txtniveles" pattern="{1,15}" min=1 max=20 required>
<br>
<input type="submit" name="btnedificio" value="Registrar edificio">
<br>
<a href="Menu/Menuedificios.php">Regresar menu</a>
</form>
</body>
</html>
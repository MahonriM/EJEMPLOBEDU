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
<?php  $conn=mysqli_connect("localhost","root","","pia");?>
<?php
function agregar_usuario($PIdUsuario,$PNombreUsuario,$PContrasena,$PNombre,$PApellidoPaterno,$PIdRol){
    $conn=mysqli_connect("localhost","root","","pia");
    $query=mysqli_prepare($conn,"CALL spusuario(?,?,?,?,?,?)");
    mysqli_stmt_bind_param($query,"issssi",$PIdUsuario,$PNombreUsuario,$PContrasena,$PNombre,$PApellidoPaterno,$PIdRol);
    $Res=mysqli_stmt_execute($query);
    if($Res!=1){
        echo"Nose ha insertado el registro verificar informacion";
    }
    else{
        echo"Registro Insertado con exito!";
    }
}
if(isset($_POST["btnregistrar"])){
$IdUsuario=$_POST["txtidusario"];
$NombreUsuario=$_POST["txtusuario"];
$Contrasena=$_POST["txtContra"];
$Nombre=$_POST["txtnombre"];
$ApellidoPaterno=$_POST["txtapp"];
$IdRol=$_POST["ddlRol"];
if($IdUsuario==""&&$NombreUsuario==""&&$Contrasena==""&&$Nombre==""&& $ApellidoPaterno==""){
    echo"'<script>alert('Debes llenar todos los campos');</script>'";
}
else
{
    agregar_usuario($IdUsuario,$NombreUsuario,$Contrasena,$Nombre,$ApellidoPaterno,$IdRol);
}

}

?>
<body>
<form action="usuario.php" method="post">
    <h1>Agregar Usuario</h1>
    <label for="">Ingresa el idUsuario</label>
    <input type="number" name="txtidusario" required>
    <br>
    <label for="">Ingresa el nombre de usuario</label>
    <input type="text" name="txtusuario" required="" pattern="[a-zA-Z]+">
    <br>
    <label for="">Ingresa la contraseña</label>
    <input type="text" name="txtContra" pattern="[A-Za-z0-9_-]{1,15}" required>
    <br>
    <label for="">Ingresa el nombre</label>
    <input type="text" name="txtnombre" required="" pattern="[a-zA-Z]+">
    <br>
    <label for="">Ingresa el apellido paterno</label>
    <input type="text" name="txtapp" required="" pattern="[A-Za-z0-9_-]{1,15}" >
    <br>
    <label for="">Ingresa el idrol</label>
    <select name="ddlRol">
    <?php
     $query="SELECT IdRol,Descrip from rol ";
     $resultado=mysqli_query($conn,$query);
     while($reg=mysqli_fetch_array($resultado)){?>
        <?php
        echo '<option value = ' . $reg['IdRol'] . '>'. $reg['Descrip'] . '</option>';
        ?>
     <?php } ?>
     </select> 
     <br>
     <input type="submit" name="btnregistrar" value="Registrar">
     <br>
     <a href="Menu/Menuusuario.php"> Regresar</a>
</form>    
</body>
</html>
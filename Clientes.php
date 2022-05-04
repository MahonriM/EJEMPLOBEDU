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
<?php $conn=mysqli_connect("localhost","root","","pia");?>
<?php
function agregarclientes($IdCliente,$NombreCliente,$ApellidoPaterno,$ApellidoMaterno,$IdUsuario){
$conn=mysqli_connect("localhost","root","","pia");
$query=mysqli_prepare($conn,"CALL insert_Cliente(?,?,?,?,?)");
mysqli_stmt_bind_param($query,"isssi",$IdCliente,$NombreCliente,$ApellidoPaterno,$ApellidoMaterno,$IdUsuario);
$Res=mysqli_stmt_execute($query);
if($Res!=1){
    echo"Nose ha logrado insertar el registro.Verificar informacion";
}
else{
    echo"Registro insertado con exito!";
}
}
if(isset($_POST["btncliente"])){
    $IdCliente=$_POST["txtidcliente"];
    $NombreCliente=$_POST["txtnombrecliente"];
    $ApellidoPaterno=$_POST["txtappcliente"];
    $ApellidoMaterno=$_POST["txtmaternocliente"];
    $IdUsuario=$_POST["ddlidusuario"];
    if($IdCliente=="" && $NombreCliente=="" &&$ApellidoPaterno=="" &&$ApellidoMaterno==""&&$IdUsuario==""){
        echo"'<script>alert('Debes llenar todos los campos');</script>'";
    }
    else{
        agregarclientes($IdCliente,$NombreCliente,$ApellidoPaterno,$ApellidoMaterno,$IdUsuario);
    }
}
?>
<body>
    <form action="Clientes.php" method="post">
        <label for="">Ingresa el id del cliente</label>
        <input type="number" name="txtidcliente" pattern="{1-15}" required>
        <br>
        <label for="">Ingresa el nombre del cliente</label>
        <input type="text" name="txtnombrecliente" required="" pattern="[a-zA-Z]+" >
        <br>
        <label for="">Ingresa el apellido paterno del cliente</label>
        <input type="text" name="txtappcliente" required="" pattern="[a-zA-Z]+">
        <br>
        <label for="">Ingresa el apellido materno</label>
        <input type="text" name="txtmaternocliente" required pattern="[a-zA-Z]+{2,254}">
        <br>
        <label for="">Selecciona el usuario</label>
        <select name="ddlidusuario" id="">
        <?php
         $query="SELECT IdUsuario,usuario FROM usuario";
         $resultado=mysqli_query($conn,$query);
        while($reg=mysqli_fetch_array($resultado)){?>
        <?php
        echo '<option value = ' . $reg['IdUsuario'] . '>'. $reg['usuario'] . '</option>';
        ?>
     <?php } ?>
        </select>
        <br>
        <input type="submit" name="btncliente" value="Agregar cliente"> 
        <br>
        <a href="Menu/Menuclientes.php"> Regresar</a>
    </form>
</body>
</html>
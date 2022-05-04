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
<?php
function agregar_vista($pIdVista,$pDescrip){
$conn=mysqli_connect("localhost","root","","pia");;
$query=mysqli_prepare($conn,"CALL spvista(?,?)");
mysqli_stmt_bind_param($query,"is",$pIdVista,$pDescrip);
$Res=mysqli_stmt_execute($query);
if($Res!=1){
echo "Nose ha logrado inserta el registro. Verificar información";
}
else{
    echo"Registro insertado con exito";
}
}
if(isset($_POST["btnregistrarvista"])){
    $IdVista=$_POST["txtidvista"];
    $Descrip=$_POST["txtdescrip"];
    if($IdVista==""&&$Descrip==""){
        echo"'<script>alert('Debes llenar todos los campos');</script>'";
    }
    else{
    agregar_vista($IdVista,$Descrip);
    }   
}
?>
<body>
<form action="Vistas.php" method="post">
    <h1>Agregar Vistas</h1>
    <label for="">Ingresa el Id de la vista</label>
    <br>
    <input type="number" name="txtidvista" pattern="{1,15}" required>
    <br>
    <label for="">Ingresa la descripcion</label>
    <br>
    <input type="text" name="txtdescrip" pattern="[A-Z a-z 0-9_-]{1,15}" required placeholder="palabra palabra"> 
    <br>
    <input type="submit" name="btnregistrarvista" value="Registrar Vista">
    <br>
    <a href="Menu/Menuvistas.php">Regresar menu</a>
</form>    
</body>
</html>
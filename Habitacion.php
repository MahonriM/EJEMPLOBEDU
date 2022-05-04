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
<?php $conn=mysqli_connect("localhost","root","","pia");?>
<?php
function agregarHabitacion($IdHabitacion,$Descripcion,$Nivel,$IdTipoHabitacion,$IdEdificio,$IdVista,$IdEstatus){
    $conn=mysqli_connect("localhost","root","","pia");
    $query=mysqli_prepare($conn,"CALL insert_habitacion(?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($query,"isiiiii",$IdHabitacion,$Descripcion,$Nivel,$IdTipoHabitacion,$IdEdificio,$IdVista,$IdEstatus);
    $Res=mysqli_stmt_execute($query);
    if($Res!=1){
        echo"No se ha logrado  insertar el registro, verifica tu informacion";
    }
    else{
        echo"Registro insertado con exito";
    }
}
if(isset($_POST["btnhabitacion"])){
    $IdHabitacion=$_POST["txtIdhabitacion"];
    $Descripcion=$_POST["txtdescrip"];
    $Nivel=$_POST["txtnivel"];
    $IdTipoHabitacion=$_POST["ddlidtipohabitacion"];
    $IdEdificio=$_POST["ddlidefificio"];
    $IdVista=$_POST["ddlidvista"];
    $IdEstatus=$_POST["ddlidestatus"];
    if($IdHabitacion==""&&$Descripcion=="" || $Descripcion==" "&&$Nivel==""){
        echo"'<script>alert('Debes llenar todos los campos');</script>'";
    }
    else{
        agregarHabitacion($IdHabitacion,$Descripcion,$Nivel,$IdTipoHabitacion,$IdEdificio,$IdVista,$IdEstatus);
    }
}
?>
<body>
<form action="Habitacion.php" method="post">
    <label for="">Ingresa el Id de la habitacion</label>
    <input type="number" name="txtIdhabitacion" required pattern="{1-15}">
    <br>
    <label for="">Ingresa la descripcion</label>
    <input type="text" name="txtdescrip" pattern="[A-Za-z0-9_-]{1,15}" required>
    <br>
    <label for="">Ingresa el nivel</label>
    <input type="number" name="txtnivel" pattern="{1-15}" required>
    <br>
    <label for="">Selecciona el id del tipo habitacion</label>
    <select name="ddlidtipohabitacion">
        <?php
         $query="SELECT IdTipoHabitacion,Descrip from TipoHabitacion";
         $resultado=mysqli_query($conn,$query);
         while($reg=mysqli_fetch_array($resultado)){
            echo '<option value = ' . $reg['IdTipoHabitacion'] . '>'. $reg['Descrip'] . '</option>';
         }
        ?>
    </select>
    <br>
    <label for="">selecciona el id del edificio</label>
    <select name="ddlidefificio" id="">
    <?php
         $query="SELECT IdEdificio,Descrip from edificio";
         $resultado=mysqli_query($conn,$query);
         while($reg=mysqli_fetch_array($resultado)){
            echo '<option value = ' . $reg['IdEdificio'] . '>'. $reg['Descrip'] . '</option>';
         }
        ?>
    </select>
    <br>
    <label for="">Selecciona el id de la vista</label>
    <select name="ddlidvista" id="">
        <?php
        $query="SELECT IdVista,Descrip FROM Vista";
        $resultado=mysqli_query($conn,$query);
        while($registro=mysqli_fetch_array($resultado)){
            echo '<option value = '. $registro['IdVista'] . '>'. $registro['Descrip'] . '</option>';
        }
        ?>
    </select>
    <br>
    <label for="">selecciona el id del estatus</label>
    <select name="ddlidestatus" id="">
    <?php
        $query="SELECT IdEstatusReservacion,Descrip from estatusreservacion";
        $resultado=mysqli_query($conn,$query);
        while($reg=mysqli_fetch_array($resultado)){
           echo '<option value = ' . $reg['IdEstatusReservacion'] . '>'. $reg['Descrip'] . '</option>';
        }
     ?>
    </select>
    <br>
    <input type="submit" name="btnhabitacion" value="Registrar habitacion">
    <br>
    <a href="Menu/Menuhabitaciones.php">Regresar menu</a>
</form>    
</body>
</html>
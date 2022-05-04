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
<?php
if(isset($_POST["btniniciar"])){
    $conn=mysqli_connect("127.0.0.1","root","","pia");
    $usr=$_POST["txtusuario"];
    $pass=$_POST["txtpass"];
    $query="SELECT * from usuario as u WHERE u.Usuario='$usr' and u.Contra='$pass'";
    $Res=mysqli_query($conn,$query);
    $filas = mysqli_num_rows($Res);
    $row=mysqli_fetch_array($Res); 
    mysqli_free_result($Res);
    $idrol= $row['IdRol'];
  if($filas>0){
        session_start();
        $_SESSION['rol']=$idrol;
        header('Location: login.php');
  }
else{
        echo "<script>alert('Error: usuario y/o clave incorrectos!!');</script>";
}
}
?>
<div class="card card-body">
    <form action="" method="POST">
        <div class="form-group">
            <form action="index.php" method="post">
            <label class="">Usuario</label>
            <input type="text" name="txtusuario" pattern="[A-Za-z0-9_-]{1,15}" placeholder="usuario" required>
            <label for="">Contraseña</label>
            <input type="password" name="txtpass" pattern="[A-Za-z0-9_-]{1,15}" required>
            <input type="submit" class="btn btn-success btn-block" name="btniniciar" value="Iniciar">
                </form>
            </div>
        </div>
</body>
</html>
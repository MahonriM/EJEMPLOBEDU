<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Reporte 3</title>
</head>
<nav class="navbar navbar-dark bg-dark">
<div class="container">
</nav>
</div>
<body>
    <form action="Reporte3.php" method="post">
        <label for="">Ingresa la fecha de inicio</label>
        <input type="date" name="txtfecinc" required>
        <label for="">Ingresa la fecha final</label>
        <input type="date" name="txtfecfin" required>
        <input type="submit" name="btnReporte3" value="ver reporte">
        <?php
            if(isset($_POST["btnReporte3"])){
                $FecInc=$_POST["txtfecinc"];
                $FecFin=$_POST["txtfecfin"];?>
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NOMBRE DEL EDIFICIO</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Fecha de reservacion</th>
                    <th>Monto de reservacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn=mysqli_connect("127.0.0.1","root","","pia");  
                    $query="CALL spClienteReservacion('$FecInc','$FecFin')";
                    $result_task=mysqli_query($conn,$query);
                    while($row=mysqli_fetch_array($result_task)){?>
                        <tr>
                            <td> <?php echo $row['0']; ?></td>
                            <td> <?php echo $row['1']; ?></td>
                            <td> <?php echo $row['2']; ?></td>
                            <td> <?php echo $row['3']; ?></td>
                            <td> <?php echo $row['4']; ?></td>
                            <td> <?php echo $row['5']; ?></td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>   
    </form>
    <?php } ?>
        <br>
        <a href="Menu/Menureservacion.php">Regresar Menu reservacion</a> 
</body>
</html>
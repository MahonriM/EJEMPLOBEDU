<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<nav class="navbar navbar-dark bg-dark">
<div class="container">
</div>
</nav>
<body>
    <form action="Reporte2.php"  method="post">
        <h1>Reporte 2</h1>
        <label for="">Ingresa el Id del edicio</label>
        <input type="number" name="txtidedificio" required >
        <input type="submit" name="btnReporte2" value="Ver reporte">
    <?php
        if(isset($_POST["btnReporte2"])){
            $IdEdificio=$_POST["txtidedificio"];
            ?>
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Edificio</th>
                    <th>Estatus</th>
                    <th>Total de habitaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn=mysqli_connect("localhost","root","","pia");
                    $query="CALL spEstatusHabitacion(".$IdEdificio.")";
                   // mysqli_stmt_bind_param($query,"i",$IdEdificio);
                    $result_task=mysqli_query($conn,$query);
                    while($row=mysqli_fetch_array($result_task)){?>
                        <tr>
                            <td> <?php echo $row['0']; ?></td>
                            <td> <?php echo $row['1']; ?></td>
                            <td> <?php echo $row['2']; ?></td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
</form>
       <?php }?>
       <br>
       <a href="Menu/Menureservacion.php">Regresar Menu reservacion</a>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
    <form action="BuscarCliente.php" method="post">
        <label for="">Ingresa el id del cliente</label>
        <input type="number" name="txtidcliente" required>
        <input type="submit" name="btnbuscarcliente" value="Mostrar Reservacion">
        <br>
        <?php
            if(isset($_POST["btnbuscarcliente"])){
                $IdCliente=$_POST["txtidcliente"];?>
                <table class="table table-bordered">
            <thead>
                <tr>
                    <th>IdCliente</th>
                    <th>Nombre</th>
                    <th>APaterno</th>
                    <th>AMaterno</th>
                    <th>IdUsuario</th>
                    <th>FecRegistro</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn=mysqli_connect("localhost","root","","pia");
                    $query="CALL spBuscarIdCliente  (".$IdCliente.")";
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
    <a href="Menu/Menuclientes.php">Regresar Menu</a>

</body>
</html>
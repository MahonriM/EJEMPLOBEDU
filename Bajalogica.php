<?php
$Mensaje="";
if(isset($_POST["btnBaja"]))
{ 
   $_IdDarBaja=$_POST["txtidParaBaja"]; 
   $_Tabla=$_POST["ddlTabla"]; 
   if($_IdDarBaja>0)
   {  
      if($_Tabla==1 )
      {
         $con=mysqli_connect("127.0.0.1","root","","pia");
         $consulta="call spBuscarIdHabitacion($_IdDarBaja);";
         $resultado=mysqli_query($con,$consulta);
         if (mysqli_num_rows($resultado)>0)
         {
         $con=mysqli_connect("127.0.0.1","root","","pia");
         $consulta="call Bajalogica_HabitacionVeri($_IdDarBaja);";
         $resultado=mysqli_query($con,$consulta);
         if(mysqli_num_rows($resultado)>0)
         {
            echo"<h1>No se puede dar la baja porque tiene reservaciones en la habitacion, reorganice sus reservaciones</h1>";	
            echo"<br>";
            echo"<table class='table table-bordered'>";
            echo"<th><b>IdReservacion</b></th>";
            echo"<th><b>CLIENTE</b></th>";
            echo"<th><b>TELEFONO</b></th>";
            echo"<th><b>CORREO</b></th>";
            echo"<th><b>FECHA INICIO</b></th>";
            echo"<th><b>FECHA FIN</b></th>";
            echo"<th><b>ESTATUS</b></th>";
            echo"</tr>";	   
            while ($reg =mysqli_fetch_array($resultado))
           {
               echo "<tr>";
               echo "<td>" . $reg['IdReservacion'] . "</td>";
               echo "<td>" . $reg['CLIENTE'] . "</td>";
               echo "<td>" . $reg['TELEFONO'] . "</td>";
               echo "<td>" . $reg['CORREO'] . "</td>";
               echo "<td>" . $reg['FECHA INICIO'] . "</td>";
               echo "<td>" . $reg['FECHA FIN'] . "</td>";
               echo "<td>" . $reg['ESTATUS'] . "</td>";
               echo "</tr>";
               echo"<a href='Menu/Menureservacion.php'></a>";
           }				           
         }
         else 
         {
            $con=mysqli_connect("127.0.0.1","root","","pia");
            $consulta="call Bajalogica_Habitacion($_IdDarBaja);";
            $resultado=mysqli_query($con,$consulta);
            $Mensaje="Baja exitosa del id  ".$_IdDarBaja;
         }
      }
      else
      {
         $Mensaje="No existe el id ".$_IdDarBaja." en habitacion";
      } 
      }
      elseif ($_Tabla==2)
      {
         $con=mysqli_connect("127.0.0.1","root","","pia");
         $consulta="call spBuscarIdReservacion($_IdDarBaja);";
         $resultado=mysqli_query($con,$consulta);

         if (mysqli_num_rows($resultado)>0)
         {
 
         $con=mysqli_connect("127.0.0.1","root","","pia");
         $consulta="call Bajalogica_ReservacionVeri($_IdDarBaja);";
         $resultadoR=mysqli_query($con,$consulta);

        if(mysqli_num_rows($resultadoR)>0)
        {?>
            <h1>No se puede dar la baja porque hay clientes que hicieron CHECK IN en la reservacion, reorganice sus reservaciones</h1>		        
            <table class="table table-bordered">
                <thead>
                <th>IdReservacion</th>
                <th>CLIENTE</th> 
                <th>CHECKIN</th>
                <td>CHECKOUT</th>
                </thead>
                <tbody>
                <?php
                while ($reg =mysqli_fetch_array($resultadoR))
                    {
               echo "<tr>";
               echo "<td>" . $reg['IdReservacion'] . "</td>";
               echo "<td>" . $reg['CLIENTE'] . "</td>";
               echo "<td>" . $reg['CHECKIN'] . "</td>";
               echo "<td>" . $reg['CHECKOUT'] . "</td>";
               echo "</tr>";
      
                  }
                ?>		
                </tbody>
            </table>
            <a href="Menu/Menureservacion.php"></a>
            <?php 
        }        
              
        else 
        {
           $con=mysqli_connect("127.0.0.1","root","","pia");
           $consulta="call Bajalogica_Reservacion($_IdDarBaja);";
           $resultado=mysqli_query($con,$consulta);
           $Mensaje="Baja exitosa del id reservacion ".$_IdDarBaja;
         }
      }
      else
      {
         $Mensaje="No existe el id ".$_IdDarBaja." en reservacion";
      }    
     } 
    else 
     {
      $Mensaje="Seleccionar opciones para dar de baja o ingresar ID ";
     }


   }
   else 
   {
   $Mensaje="Ingrese un ID ";

   }
}  
 else
{
$Mensaje=""; 

   
 }
?>
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
<form action = "Bajalogica.php" method = "post">
<div>
<p>Selecione lo que dara de baja </p>
<select name ="ddlTabla" autofocus>
	  <option value=0>[SELECCIONAR]</option>
	  <option value=1>Habitacion</option>
	  <option value=2>Reservacion</option> 
</select>
<p>Ingresa el id de lo que dara de baja <input type="number" name="txtidParaBaja" required><input type="submit" name="btnBaja" value="Baja"></p>
<p><td> <?php echo $Mensaje; ?> </td></p>
<p><td> <br> </td></p>
<br>
<a href="Menu/Menureservacion.php">Regresar</a>
</div>
</body>
</html>
<?php
include("db.php");
if(isset($_POST["save_task"])){
    $title=$_POST['title'];
    $description=$_POST['description'];
    echo($title."   ".$description);
    $query="INSERT INTO task (title,desciption)VALUES('$title','$description')";//
    $Res=mysqli_query($conn,$query);
    if(!$Res){
        die("You are awesome");
    }
    else{
        session_start();
        $_SESSION['message']='Task saved succesfully';
        $_SESSION['message_type']='success';
        header("Location: index.php");    
    }
}
?>
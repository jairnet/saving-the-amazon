<?php
    session_start();
    require 'PHPMailer/PHPMailerAutoload.php';
    require 'database.php';
    $id = $_GET['id'];

    $query = 'SELECT email FROM users WHERE id = :id';
    $records = $conn->prepare($query);
    $records->bindParam(':id',$id);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    if ($results['email']){

        $mensaje = "Señor Usuario su PQR ya venció";
        $asunto = "Vencimiento de PQR";
       
        header('location:listPQR.php');
    }
?>
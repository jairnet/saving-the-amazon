<?php
    session_start();
    require 'database.php';
    $id = $_GET['id'];
    $queryPQR = "DELETE FROM pqrs WHERE (id = :id)";
    $recordsPQR = $conn->prepare($queryPQR);
    $recordsPQR->bindParam(':id',$id);
    if ($recordsPQR->execute()){
        header('location:listPQR.php');
    }
?>
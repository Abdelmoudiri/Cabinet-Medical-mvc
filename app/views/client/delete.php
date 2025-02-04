<?php

    require_once "../../config/db.php";

    $id_reservation = $_GET['id'];

    $requete = "DELETE FROM reservations WHERE id_reservation = ?";

    $stmt= mysqli_prepare($conn,$requete);

    if (!$stmt) {
        die("Échec de la préparation : " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "i", $id_reservation);

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("location: ../client_dashboard.php#booking");
        exit();
    }else{
        die("Failed to Execute Statment". mysqli_stmt_error($stmt));
    }
?>
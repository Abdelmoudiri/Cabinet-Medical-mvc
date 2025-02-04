<?php

    // echo"before connect<br>";

    // require_once '../config/db.php';
    
    // echo"after connect<br>";

    // session_start();

    

    // if(isset($_SESSION['id_user']) && isset($_POST['confirm'])){
    //     echo"client session<br>";
    //     $id_client = $_SESSION['id_user'];
    //     $nom_avocat = explode(" ",$_POST['avocat']);

    //     print_r($nom_avocat);

    //     $get_avocat = "SELECT id_user FROM users WHERE prenom='?' AND nom='?')";
    //     $stmt_avocat = mysqli_prepare($conn, $get_avocat);

    //     if (!$stmt_avocat) {
    //         die("Échec de la préparation : " . mysqli_error($conn));
    //     }

    //     mysqli_stmt_bind_param($stmt_avocat, "ss", $nom_avocat[0], $nom_avocat[1]);

    //     if(mysqli_stmt_execute($stmt_avocat)) {
    //         $result = mysqli_stmt_get_result($stmt_avocat);

    //         if($result && mysqli_num_rows($result) > 0) {
    //             $row = mysqli_fetch_assoc($result);
    //             $id_avocat = $row['id_user'];
    //             echo "$id_avocat<br>";
    //         }
    //     }

    //     // $id_avocat = $_POST['avocat'];
    //     $date = $_POST['booking-date'];

        

    //     $requete = "INSERT INTO reservations(id_client, id_avocat, date_reservation) VALUES (?,?,?)";
    //     $stmt = mysqli_prepare($conn, $requete);

    //     if (!$stmt) {
    //         die("Échec de la préparation : " . mysqli_error($conn));
    //     }

    //     mysqli_stmt_bind_param($stmt, "iis", $id_client, $id_avocat, $date);

    //     if(mysqli_stmt_execute($stmt)) {
    //         echo "<script>alert('Insertion effectuée avec Succées');</script>";
    //         mysqli_stmt_close($stmt);
    //         header('Location : ./Client_dashboard.php#booking');
    //         exit();
    //     }else{
    //         die("Erreur lors de l'insertion : " . mysqli_error($conn));
    //     }

    // }
    // else{
    //     echo "Condition fausse !";
    // }

    // mysqli_close($conn);

?>

<?php
    // echo "before connect<br>";
    // require_once '../../config/db.php';
    // echo "after connect<br>";

    // session_start();

    // if (isset($_SESSION['id_user']) && isset($_POST['confirm'])) {
    //     echo "client session<br>";
        
    //     // Validation des données POST
    //     if (!isset($_POST['avocat']) || !isset($_POST['booking-date'])) {
    //         die("Données POST manquantes.");
    //     }

    //     $id_client = $_SESSION['id_user'];
    //     $id_avocat = $_POST['avocat'];
    //     $date = $_POST['booking-date'];

    //     echo "$id_avocat<br>";
    //     echo "$date<br>";


    //     // Validation du format de la date
    //     if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
    //         die("Format de date invalide.");
    //     }

    //     // Préparation de la requête
    //     $requete = "INSERT INTO reservations(id_client, id_avocat, date_reservation) VALUES (?,?,?)";
    //     $stmt = mysqli_prepare($conn, $requete);

    //     if (!$stmt) {
    //         die("Échec de la préparation : " . mysqli_error($conn));
    //     }

    //     mysqli_stmt_bind_param($stmt, "iis", $id_client, $id_avocat, $date);

    //     // Exécution de la requête
    //     if (mysqli_stmt_execute($stmt)) {
    //         echo "<script>alert('Insertion effectuée avec succès');</script>";
    //         header("Location: ../client_dashboard.php");
    //         exit;
    //     } else {
    //         die("Erreur lors de l'insertion : " . mysqli_error($conn));
    //     }

    //     mysqli_stmt_close($stmt);
    // } else {
    //     die("Session ou données manquantes.");
    // }

    // mysqli_close($conn);
?>























<?php
    session_start();

    require_once "../../config/db.php";

    if(isset($_SESSION["id_user"]) && isset($_POST['confirm'])){

        $id_client = $_SESSION['id_user'];
        $id_avocat = $_POST['avocat'];
        $date_reservation = $_POST['booking-date'];

        $requete = "INSERT INTO reservations(id_client, id_avocat, date_reservation) VALUES (?,?,?)";

        $stmt = mysqli_prepare($conn, $requete);

        if (!$stmt) {
            die("Échec de la préparation : " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "iis", $id_client, $id_avocat, $date_reservation);

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            header("location: ../client_dashboard.php#booking");
            exit();
        }else{
            die("Failed to Execute Statment". mysqli_stmt_error($stmt));
        }
    }else{
        echo "Condition Fausse !";
    }

    mysqli_close($conn);
?>
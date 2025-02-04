<?php

    session_start();

    if(isset($_SESSION['id_user']) && isset($_SESSION['role'])){
        if($_SESSION['role'] == 'Avocat'){
            header('location: ./home.php');
            exit;
        }
    }else{
        header('location: ./index.php');
        exit;
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="../assets/img/logo.png">
    <title>LexAdvisor - Client Dashborad</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <!-- HEADER SECTON -->
    <header class="px-5 md:px-10 lg:px-16 py-5 bg-[#02101f] shadow-lg">
        <nav class="flex justify-between items-center">
            <div class="flex gap-5 items-center">
                <div class="flex items-center gap-2 cursor-pointer order-2">
                    <img class="h-8" src="../assets/img/logo.png" alt="Logo du Site LexAdvisor">
                    <h1 class="text-xl font-semibold">Lex<span class="text-[#01FF70]">Advisor</span></h1>
                </div>
                <div class="text-4xl cursor-pointer mx-2 md:hidden flex items-center order-1">
                    <ion-icon name="menu" onclick="Menu(this)"></ion-icon>
                </div>
            </div>
            <ul id="links" class="md:flex md:items-center z-[1] md:z-auto md:static absolute bg-[#02101f] w-full top-[80px] md:w-auto md:py-0 pb-4 md:pl-0 pl-7 md:opacity-100 opacity-0 left-[-400px] transition-all ease-in duration-500 md:h-auto h-screen">
                <li class="mx-4 my-6 md:my-0 hover:text-[#01FF70] md:text-lg duration-500 font-medium">
                    <a href="./home.php">Home</a>
                </li>
                <li class="mx-4 my-6 md:my-0 md:text-lg hover:text-[#01FF70] duration-500 font-medium">
                    <a href="#statistiques">Statistiques</a>
                </li>
                <li class="mx-4 my-6 md:my-0 md:text-lg hover:text-[#01FF70] duration-500 font-medium">
                    <a href="#avocats">Avocats</a>
                </li>
                <li class="mx-4 my-6 md:my-0 md:text-lg hover:text-[#01FF70] duration-500 font-medium">
                    <a href="#booking">Réservations</a>
                </li>
            </ul>
            <div class="flex items-center gap-2">
                <a href="./logout.php"><button class="text-sm pl-5 pr-2 underline duration-500 hover:text-[#01FF70]">
                    DECONNEXION
                </button></a>
                <a href="./client/profile.php"><img class="rounded-full border-2 border-[#01FF70] w-14" src="../assets/img/client.jpg" alt="Image du Client"></a>
            </div>
        </nav>
    </header>

    <main>
        <!-- STATISTICS -->
        <section id="statistiques" class="py-10 px-5 flex flex-col gap-10">
            <h1 class="font-semibold text-3xl text-center text-gray-300">Statistiques</h1>
            <div class="flex flex-wrap items-center justify-center gap-5">
                <div class="h-[30vh] p-5 bg-[#02101f] flex flex-col gap-5 items-center justify-center rounded-sm flex-1">
                    <h1 class="font-semibold text-md md:text-lg lg:text-xl text-center text-gray-300">Nombre Total des Réservations</h1>
                    <h2 class="font-semibold text-md md:text-lg lg:text-xl text-center text-[#01FF70]">
                        <?php
                            require '../config/db.php';

                            if(isset($_SESSION['id_user']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Client'){
                                $requete = "SELECT COUNT(id_reservation) AS nbr_reservation FROM reservations WHERE id_client = ?";
                                $stmt = mysqli_prepare($conn, $requete);

                                if (!$stmt) {
                                    die("Échec de la préparation : " . mysqli_error($conn));
                                }

                                $id_client = $_SESSION['id_user'];

                                mysqli_stmt_bind_param($stmt, "i", $id_client);

                                
                                if (mysqli_stmt_execute($stmt)) {
                                    $result = mysqli_stmt_get_result($stmt);

                                    
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        $user = mysqli_fetch_assoc($result);

                                        echo "$user[nbr_reservation]";
                                    }
                                    else{
                                        echo "0";
                                    }
                                }else {
                                    die("Erreur d'exécution : " . mysqli_stmt_error($stmt));
                                }

                                mysqli_stmt_close($stmt);
                            }

                            mysqli_close($conn);
                        ?>
                    </h2>
                </div>
                <div class="h-[30vh] p-5 bg-[#02101f] flex flex-col gap-5 items-center justify-center rounded-sm flex-1">
                    <h1 class="font-semibold text-md md:text-lg lg:text-xl text-center text-gray-300">Nombre des Réservations <br><span class="text-orange-300">EN ATTENTE</span></h1>
                    <h2 class="font-semibold text-md md:text-lg lg:text-xl text-center text-[#01FF70]">
                        <?php
                            require '../config/db.php';

                            if(isset($_SESSION['id_user']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Client'){
                                $requete = "SELECT COUNT(id_reservation) AS nbr_reservation FROM reservations WHERE id_client = ? AND statut= ?";
                                $stmt = mysqli_prepare($conn, $requete);

                                if (!$stmt) {
                                    die("Échec de la préparation : " . mysqli_error($conn));
                                }

                                $id_client = $_SESSION['id_user'];
                                $statut = "En Attente" ;

                                mysqli_stmt_bind_param($stmt, "is", $id_client, $statut);

                                
                                if (mysqli_stmt_execute($stmt)) {
                                    $result = mysqli_stmt_get_result($stmt);

                                    
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        $user = mysqli_fetch_assoc($result);

                                        echo "$user[nbr_reservation]";
                                    }
                                    else{
                                        echo "0";
                                    }
                                }else {
                                    die("Erreur d'exécution : " . mysqli_stmt_error($stmt));
                                }

                                mysqli_stmt_close($stmt);
                            }

                            mysqli_close($conn);
                        ?>
                    </h2>
                </div>
                <div class="h-[30vh] p-5 bg-[#02101f] flex flex-col gap-5 items-center justify-center rounded-sm flex-1">
                    <h1 class="font-semibold text-md md:text-lg lg:text-xl text-center text-gray-300">Nombre des Réservations <br><span class="text-red-500">ANNULÉES</span></h1>
                    <h2 class="font-semibold text-md md:text-lg lg:text-xl text-center text-[#01FF70]">
                        <?php
                            require '../config/db.php';

                            if(isset($_SESSION['id_user']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Client'){
                                $requete = "SELECT COUNT(id_reservation) AS nbr_reservation FROM reservations WHERE id_client = ? AND statut= ?";
                                $stmt = mysqli_prepare($conn, $requete);

                                if (!$stmt) {
                                    die("Échec de la préparation : " . mysqli_error($conn));
                                }

                                $id_client = $_SESSION['id_user'];
                                $statut = "Annulé" ;

                                mysqli_stmt_bind_param($stmt, "is", $id_client, $statut);

                                
                                if (mysqli_stmt_execute($stmt)) {
                                    $result = mysqli_stmt_get_result($stmt);

                                    
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        $user = mysqli_fetch_assoc($result);

                                        echo "$user[nbr_reservation]";
                                    }
                                    else{
                                        echo "0";
                                    }
                                }else {
                                    die("Erreur d'exécution : " . mysqli_stmt_error($stmt));
                                }

                                mysqli_stmt_close($stmt);
                            }

                            mysqli_close($conn);
                        ?>
                    </h2>
                </div>
                <div class="h-[30vh] p-5 bg-[#02101f] flex flex-col gap-5 items-center justify-center rounded-sm flex-1">
                    <h1 class="font-semibold text-md md:text-lg lg:text-xl text-center text-gray-300">Nombre des Réservations <br><span class="text-green-400">CONFIRMÉES</span></h1>
                    <h2 class="font-semibold text-md md:text-lg lg:text-xl text-center text-[#01FF70]">
                        <?php
                            require '../config/db.php';

                            if(isset($_SESSION['id_user']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Client'){
                                $requete = "SELECT COUNT(id_reservation) AS nbr_reservation FROM reservations WHERE id_client = ? AND statut= ?";
                                $stmt = mysqli_prepare($conn, $requete);

                                if (!$stmt) {
                                    die("Échec de la préparation : " . mysqli_error($conn));
                                }

                                $id_client = $_SESSION['id_user'];
                                $statut = "Confirmé" ;

                                mysqli_stmt_bind_param($stmt, "is", $id_client, $statut);

                                
                                if (mysqli_stmt_execute($stmt)) {
                                    $result = mysqli_stmt_get_result($stmt);

                                    
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        $user = mysqli_fetch_assoc($result);

                                        echo "$user[nbr_reservation]";
                                    }
                                    else{
                                        echo "0";
                                    }
                                }else {
                                    die("Erreur d'exécution : " . mysqli_stmt_error($stmt));
                                }

                                mysqli_stmt_close($stmt);
                            }

                            mysqli_close($conn);
                        ?>
                    </h2>
                </div>
            </div>
        </section>

        <!-- LAWYERS -->
        <section id="avocats" class="py-10 px-5 flex flex-col gap-10 items-center justify-center">
            <h1 class="font-semibold text-3xl text-gray-300">Avocats</h1>
            <div class="m-5 flex flex-wrap items-center gap-5 md:grid md:grid-cols-2 lg:grid-cols-3 lg:gap-8 lg:mx-16 lg:mb-10">
                <?php require_once './fetch_avocats.php'; ?>
            </div>
        </section>

        <!-- BOOKINGS -->
        <section id="booking" class="bg-[#02101f] py-10 px-5 flex flex-col gap-10 items-center justify-center">
            <h1 class="font-semibold text-3xl text-gray-300">Réservations</h1>
            <button type="button" id="open-booking-popup" class="px-5 py-2 text-black bg-[#01FF70] rounded-sm font-medium duration-500 hover:scale-105">Réserver une Consultation</button>
            <div class="w-[90vw] overflow-x-auto">
                <table class="border-y border-gray-600 min-w-full divide-y divide-gray-600 overflow-auto">
                    <thead>
                        <tr class="bg-[#001F3F]">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom Complet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spécialité</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Réservation</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Réservation</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require '../config/db.php';

                            if(isset($_SESSION['id_user']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Client'){
                                $requete = "SELECT * FROM users JOIN infos_avocat ON users.id_user = infos_avocat.id_avocat JOIN reservations ON reservations.id_avocat = users.id_user WHERE reservations.id_client = ?";
                                $stmt = mysqli_prepare($conn, $requete);

                                if (!$stmt) {
                                    die("Échec de la préparation : " . mysqli_error($conn));
                                }

                                $id_client = $_SESSION['id_user'];

                                mysqli_stmt_bind_param($stmt, "i", $id_client);

                                if(mysqli_stmt_execute($stmt)){
                                    $result = mysqli_stmt_get_result($stmt);

                                    if($result && mysqli_num_rows($result) > 0) {
                                        while($reservation = mysqli_fetch_assoc($result)){
                                            // print_r($reservation);
                                            $id_reservation = $reservation['id_reservation'];
                                            $full_name = $reservation['prenom']. ' ' .$reservation['nom'];
                                            $speciality = $reservation['specialite'];
                                            $date = $reservation['date_reservation'];
                                            $statut = $reservation['statut'];

                                            echo "
                                            <tr class='border-b border-gray-600'>
                                                <td class='px-6 py-4 whitespace-nowrap'>{$full_name}</td>
                                                <td class='px-6 py-4 whitespace-nowrap'>{$speciality}</td>
                                                <td class='px-6 py-4 whitespace-nowrap'>{$date}</td>
                                                <td class='px-6 py-4 whitespace-nowrap'>{$statut}</td>
                                                <td class='px-6 py-4 whitespace-nowrap'>
                                                    <a href='./client/delete.php?id=$id_reservation'><button class='ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out'>Supprimer</button></a>
                                                </td>
                                            </tr>
                                            ";
                                        }
                                    }

                                    mysqli_stmt_close($stmt);
                                }
                            }

                            mysqli_close($conn);

                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- BOOKING FORM -->
        <section id="booking-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-90 hidden">
            <div class="max-w-sm lg:w-[60vw] mx-auto rounded-sm overflow-hidden">
                <div class="px-6 py-4 bg-[#02101f] text-white">
                    <h1 class="text-lg font-medium">Réserver une Consultation</h1>
                </div>
                <form id="booking-form" class="px-6 py-4 bg-[#001F3F]" method="POST" action="./client/booking.php">
                    <div class="mb-4">
                        <label class="block text-gray-300 font-medium mb-2" for="card-number">
                            Avocat
                        </label>
                        <select name="avocat"
                            class="appearance-none border border-black rounded-sm w-full py-2 px-3 text-black leading-tight focus:outline-none font-medium"
                            id="avocat-name" type="text">
                            <?php
                                require "../config/db.php";

                                // session_start();

                                if(isset($_SESSION['id_user']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Client'){
                                    $requete = "SELECT infos_avocat.id_avocat, users.nom, users.prenom FROM users JOIN infos_avocat ON users.id_user = infos_avocat.id_avocat";
                                    $stmt = mysqli_prepare($conn, $requete);

                                    if (!$stmt) {
                                        die("Échec de la préparation : " . mysqli_error($conn));
                                    }

                                    if(mysqli_stmt_execute($stmt)){
                                        $result = mysqli_stmt_get_result($stmt);

                                        if($result && mysqli_num_rows($result) > 0) {
                                            while($avocats = mysqli_fetch_assoc($result)){
                                                // print_r($reservation);
                                                
                                                $avocat_full_name = $avocats['prenom']. ' ' .$avocats['nom'];
                                                $id_avocat = $avocats['id_avocat'];

                                                echo "<option class='text-black bg-blue-200' value='$id_avocat'>{$id_avocat} {$avocat_full_name}</option>";
                                            }
                                        }

                                        mysqli_stmt_close($stmt);
                                    }
                                }

                                mysqli_close($conn);

                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-300 font-medium mb-2" for="expiration-date">
                            Date
                        </label>
                        <input
                            class="appearance-none border border-black rounded-sm w-full py-2 px-3 text-black leading-tight focus:outline-none font-medium"
                            id="booking-date" name="booking-date" type="date">
                    </div>

                    <div class="flex justify-evenly pt-5">
                        <button type="submit" name="confirm" id="confirm-book" class="bg-[#01FF70] text-black font-medium py-2 px-4 rounded-sm hover:px-5 duration-200">
                            Confirmer
                        </button>
                        <button id="cancel-book" type="button" class="border border-white text-white font-medium py-2 px-4 hover:px-5 duration-200 rounded-sm">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>



    <script src="../assets/js/script.js"></script>
</body>
</html>
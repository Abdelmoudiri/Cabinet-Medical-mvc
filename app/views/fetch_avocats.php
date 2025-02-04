<?php

    require '../config/db.php';

    $requete = "SELECT * FROM users JOIN infos_avocat ON users.id_user = infos_avocat.id_avocat";
    $stmt = mysqli_prepare($conn, $requete);

    if (!$stmt) {
        die("Échec de la préparation : " . mysqli_error($conn));
    }
    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);

        if($result && mysqli_num_rows($result) > 0) {
            while($user = mysqli_fetch_assoc($result)){
                // print_r($user);
                $full_name = $user['prenom']. ' ' .$user['nom'];
                $speciality = $user['specialite'];
                $biography = $user['biographie'];
                $email = $user['email'];
                $phone = $user['phone'];

                echo "
                <div class='bg-[#02101f] p-10 rounded-sm h-screen flex flex-col justify-center'>
                    <div class='flex flex-col items-center justify-center gap-2 mb-7'>
                        <img class='rounded-full w-4/12 border-2 border-white' src='../assets/img/lawyer.jpg' alt='Lawyer Jhoe Doe'>
                        <h1 class='font-semibold text-xl'>{$full_name}</h1>
                        <p class='text-gray-300'>Avocat en <span class='text-[#01FF70] font-medium text-lg'>{$speciality}</span></p>
                    </div>
                    <div class='flex flex-col gap-2 mb-5'>
                        <h1 class='font-semibold text-lg'>Biographie</h1>
                        <p class='text-gray-300 text-justify'>{$biography}</p>
                    </div>
                    <div class='flex flex-col gap-2'>
                        <h1 class='font-semibold text-lg'>Informations de Contact</h1>
                        <ul style='list-style-type: disc;' class='ml-10 flex flex-col gap-2'>
                            <li class='text-gray-300'>{$email}</li>
                            <li class='text-gray-300'>{$phone}</li>
                        </ul>
                    </div>
                </div>
                ";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
?>
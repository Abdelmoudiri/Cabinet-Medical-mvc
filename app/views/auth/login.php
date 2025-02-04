<?php
    session_start();

    require '../config/db.php';

    if (isset($_POST['login'])) {
        $email = trim($_POST['email']); 
        $password = $_POST['password'];

        $requete = "SELECT * FROM users JOIN roles ON users.id_role = roles.id_role WHERE email = ?";
        $stmt = mysqli_prepare($conn, $requete);

        if (!$stmt) {
            die("Échec de la préparation : " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "s", $email);

        
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);

                
                if (password_verify($password, $user['mot_de_passe'])) {
                    
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['prenom_user'] = htmlspecialchars($user['prenom']);
                    $_SESSION['nom_user'] = htmlspecialchars($user['nom']);
                    $_SESSION['email'] = htmlspecialchars($user['email']);
                    $_SESSION['phone'] = htmlspecialchars($user['phone']);
                    $_SESSION['role'] = htmlspecialchars($user['nom_role']);


                    $link_role = $user['nom_role'] . "_dashboard.php";
                    
                    header("Location: ./$link_role");
                    exit();
                } else {
                    echo "<script>
                        alert('Password Incorrecte !');
                    </script>";
                }
            } else {
                echo "<script>
                        alert('Aucun Client avec cet Email !');
                    </script>";
            }
        } else {
            die("Erreur d'exécution : " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);


    if(isset($_SESSION['id_user']) && isset($_SESSION['role'])){
        header('location: ./home.php');
        exit;
    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LexAdvisor - LOGIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="icon" type="image/png" href="../assets/img/logo.png">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</head>
<body>
    <!-- BARRE DE NAVIGATION -->
    <nav class="py-5 px-5 md:px-10 bg-[#02101f] shadow md:flex md-items-center md:justify-between">
        <div class="flex items-center justify-between relative z-[10]">
            <div class="flex items-center gap-2">
                <img class="h-10" src="../assets/img/logo.png" alt="Logo du Site LexAdvisor">
                <h1 class="text-2xl font-semibold">Lex<span class="text-[#01FF70]">Advisor</span></h1>
            </div>
            <div class="text-4xl cursor-pointer mx-2 md:hidden flex items-center">
                <ion-icon name="menu" onclick="Menu(this)"></ion-icon>
            </div>
        </div>

        <ul id="links" class="md:flex md:items-center z-[0] md:z-auto md:static absolute bg-[#02101f] w-full top-[80px] md:w-auto md:py-0 pb-4 md:pl-0 pl-7 md:opacity-100 opacity-0 left-[-400px] transition-all ease-in duration-500 md:h-auto h-screen">
            <li class="mx-4 my-6 md:my-0 hover:text-[#01FF70] md:text-lg duration-500 font-medium">
                <a href="./index.php">Home</a>
            </li>
            <li class="mx-4 my-6 md:my-0 md:text-lg hover:text-[#01FF70] duration-500 font-medium">
                <a href="#">Services</a>
            </li>
            <li class="mx-4 my-6 md:my-0 md:text-lg hover:text-[#01FF70] duration-500 font-medium">
                <a href="./lawyers.php">Our Lawyers</a>
            </li>

            <a href="./signup.php"><button class="bg-[#01FF70] text-black font-semibold py-2 px-5 mx-4 rounded-sm duration-500 hover:scale-105 hover:bg-transparent hover:border hover:text-white">
                SIGN UP
            </button></a>
        </ul>
    </nav>

    <!-- FORMULAIRE DE LOGIN -->
    <main>
        <form method="POST" action="" class="max-w-sm mx-auto py-20" id="login-form">
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email <span class="pl-5 text-red-500 font-light hidden" id="login-invalid-email">Inavalid Email !</span></label>
                <input type="email" name="email" id="login-email" class="outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@gmail.com" required />
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password <span class="pl-5 text-red-500 font-light hidden" id="login-invalid-password"></span></label></label>
                <input type="password" name="password" id="login-password" class=" outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm  focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" required />
            </div>
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"/>
                    <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                </div>
                <a href="#" class="text-purple-400 underline hover:text-purple-600">Forget Password ?</a>
            </div>
            <button type="submit" name="login" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-sm text-sm w-full sm:w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">LOGIN</button>
        </form>
    </main>

    <!-- PIED DE LA PAGE -->
    <?php 
        include_once '../includes/footer.php';
    ?>

    <script src="../assets/js/script.js"></script>
</body>
</html>
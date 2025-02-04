<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="../assets/img/logo.png">
    <title>LexAdvisor - Home Page</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <!-- HEADER SECTION -->
    <header class="bg-[#02101f]">
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

            <ul id="links" class="md:flex md:items-center z-[1] md:z-auto md:static absolute bg-[#02101f] w-full top-[80px] md:w-auto md:py-0 pb-4 md:pl-0 pl-7 md:opacity-100 opacity-0 left-[-400px] transition-all ease-in duration-500 md:h-auto h-screen">
                <li class="mx-4 my-6 md:my-0 hover:text-[#01FF70] md:text-lg duration-500 font-medium">
                    <a href="./index.php">Home</a>
                </li>
                <li class="mx-4 my-6 md:my-0 md:text-lg hover:text-[#01FF70] duration-500 font-medium">
                    <a href="#">Services</a>
                </li>
                <li class="text-[#01FF70] mx-4 my-6 md:my-0 md:text-lg hover:text-[#01FF70] duration-500 font-medium">
                    <a href="#">Our Lawyers</a>
                </li>

                <a href="./login.php"><button class="bg-[#01FF70] text-black font-semibold py-2 px-5 mx-4 rounded-sm duration-500 hover:scale-105 hover:bg-transparent hover:border hover:text-white">
                    LOGIN
                </button></a>
            </ul>
        </nav>
        <!-- HERO SECTION -->
        <section class="hero-lawyer h-[calc(100vh-80px)] flex items-center justify-center">
            <div class="flex flex-col items-center gap-5 text-center">
                <div class="flex items-center gap-2">
                    <img src="../assets/img/logo.png" class="h-10 md:h-16 lg:h-20" alt="Logo de LexAdvisor">
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold">Lex<span class="text-[#01FF70]">Advisor</span></h1>
                </div>
                <h1 class="font-medium text-lg md:font-semibold md:text-xl lg:text-2xl">Compétence, Rigueur et Passion <br> Nos Avocats sont là pour Protéger vos Intérêts</h1>
                <p class="font-extralight">Plus de 15 avocats experts à votre service</p>
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-sm text-sm  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">Savoir Plus</button>
            </div>
        </section>
    </header>


    <!-- MAIN SECTION -->
    <main>
        <section>
            <h1 class="text-[#01FF70] text-3xl md:text-4xl text-center font-semibold py-10">Nos Experts Avocats</h1>
            <div class="m-5 flex flex-wrap items-center gap-5 md:grid md:grid-cols-2 lg:grid-cols-3 lg:gap-8 lg:mx-16 lg:mb-10">
                <?php require_once './fetch_avocats.php'; ?>
            </div>
        </section>
    </main>


    <!-- PIED DE LA PAGE -->
    <?php
        include_once '../includes/footer.php';
    ?>

    <script src="../assets/js/script.js"></script>
</body>
</html>
    

    
<?php

    session_start();

    if(!isset($_SESSION['id_user']) && !isset($_SESSION['role'])){
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
                <li class="text-[#01FF70] mx-4 my-6 md:my-0 hover:text-[#01FF70] md:text-lg duration-500 font-medium">
                    <a href="#">Home</a>
                </li>
                <li class="mx-4 my-6 md:my-0 md:text-lg hover:text-[#01FF70] duration-500 font-medium">
                    <a href="
                        <?php
                            if(isset($_SESSION['id_user'])){
                                if($_SESSION['role'] == 'Client'){
                                    echo './client_dashboard.php';
                                }else{
                                    echo './avocat_dashboard.php';
                                }
                            }
                        ?>
                    ">Dashboard</a>
                </li>

                <a href="./logout.php"><button class="bg-[#01FF70] text-black font-semibold py-2 px-5 mx-4 rounded-sm duration-500 hover:scale-105 hover:bg-transparent hover:border hover:text-white">
                    DECONNEXION
                </button></a>
            </ul>
        </nav>
        <!-- HERO SECTION -->
        <section class="container flex flex-col px-14 py-10 mx-auto space-y-6 lg:h-[30rem] lg:py-16 lg:flex-row lg:items-center">
            <div class="w-full lg:w-1/2">
                <div class="lg:max-w-lg">
                    <h1 class="text-3xl font-semibold tracking-wide text-gray-800 dark:text-white lg:text-4xl">
                        Votre Partenaire de Confiance pour Tous vos Litiges
                    </h1>

                    <div class="mt-8 space-y-5">
                        <p class="flex items-center -mx-2 text-gray-700 dark:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <span class="mx-2">Expertise spécialisée</span>
                        </p>

                        <p class="flex items-center -mx-2 text-gray-700 dark:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <span class="mx-2">Service personnalisé</span>
                        </p>

                        <p class="flex items-center -mx-2 text-gray-700 dark:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <span class="mx-2">Innovation</span>
                        </p>
                    </div>
                </div>

                <div class="w-full mt-8 bg-transparent border rounded-sm lg:max-w-sm border-gray-700 focus-within:border-blue-400 outline-none">
                    <form class="flex flex-col lg:flex-row">
                        <input type="email" placeholder="Enter your email address" class="flex-1 h-10 px-4 py-2 m-1 text-gray-700 placeholder-gray-400 bg-transparent border-none appearance-none dark:text-gray-200 focus:outline-none focus:placeholder-transparent focus:ring-0" />

                        <button type="button" class="h-10 px-4 py-2 m-1 text-white transition-colors z-0 duration-300 transform bg-blue-500 rounded-sm hover:bg-blue-400 focus:outline-none focus:bg-blue-400">
                            S'Abonner
                        </button>
                    </form>
                </div>
            </div>

            <div class="flex items-center justify-center w-full h-96 lg:w-1/2">
                <img class="object-cover w-full h-full mx-auto rounded-md lg:max-w-2xl" src="../assets/img/hero.jpg" alt="glasses photo">
            </div>
        </section>
    </header>


    <!-- MAIN SECTION -->
    <main>
        <!-- ABOUT US SECTION -->
        <section class="container flex flex-col lg:gap-10 px-14 py-10 mx-auto space-y-6 lg:h-[30rem] lg:py-16 lg:flex-row lg:items-center">
            <div class="flex items-center justify-center w-full h-80 lg:w-1/2">
                <img class="rounded-md" src="../assets/img/court.jpg" alt="Image de Tribunal">
            </div>
            <div class="w-full lg:w-1/2">
                <h1 class="text-gray-100 text-3xl font-semibold tracking-wide lg:text-4xl">A Propos de Nous</h1>
                <p class="py-5 text-justify leading-6">
                    Notre cabinet d'avocats <span class="font-semibold text-[#01FF70] text-xl">LexAdvisor</span> met à votre service expertise, rigueur et engagement pour défendre vos droits. Composé d'avocats spécialisés, nous intervenons dans divers domaines juridiques.<br>
                    Que vous soyez un particulier ou une entreprise, nous offrons des solutions adaptées à vos besoins, avec transparence, écoute et efficacité.
                </p>
                <a href="#">
                    <button type="button" class="flex justify-center items-center gap-2 h-10 w-full px-4 py-2 m-1 text-white transition-colors z-0 duration-300 transform bg-blue-500 rounded-sm hover:bg-blue-400 focus:outline-none focus:bg-blue-400">
                        <span>Voir Plus</span> 
                        <ion-icon style="--ionicon-stroke-width: 70px;" class="font-bold" name="add"></ion-icon>
                    </button>
                </a>
            </div>
        </section>


        <!-- NOS VALEURS SECTION -->
        <section class="bg-[#02101f] py-10">
            <div class="container px-6 py-10 mx-auto">
                <h1 class="text-2xl font-semibold text-center lg:text-3xl text-white">Nos Valeurs à <span class="text-[#01FF70] text-4xl">LexAdvisor</span></h1>

                <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-16 md:grid-cols-2 xl:grid-cols-3">
                    <div class="flex flex-col items-center p-6 space-y-3 text-center bg-gray-100 rounded-xl dark:bg-gray-800">
                        <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </span>

                        <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white">Excellence</h1>

                        <p class="text-gray-500 dark:text-gray-300">
                            Offrir des solutions juridiques de haute qualité, adaptées à chaque situation.
                        </p>

                        <a href="#" class="flex items-center -mx-1 text-sm text-blue-500 capitalize transition-colors duration-300 transform dark:text-blue-400 hover:underline hover:text-blue-600 dark:hover:text-blue-500">
                            <span class="mx-1">Lire Plus</span>
                            <svg class="w-4 h-4 mx-1 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>

                    <div class="flex flex-col items-center p-6 space-y-3 text-center bg-gray-100 rounded-xl dark:bg-gray-800">
                        <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </span>

                        <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white">Engagement</h1>

                        <p class="text-gray-500 dark:text-gray-300">
                            Défendre vos droits avec passion, dévouement et persévérance.
                        </p>

                        <a href="#" class="flex items-center -mx-1 text-sm text-blue-500 capitalize transition-colors duration-300 transform dark:text-blue-400 hover:underline hover:text-blue-600 dark:hover:text-blue-500">
                            <span class="mx-1">read more</span>
                            <svg class="w-4 h-4 mx-1 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>

                    <div class="flex flex-col items-center p-6 space-y-3 text-center bg-gray-100 rounded-xl dark:bg-gray-800">
                        <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </span>

                        <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white">Ecoute</h1>

                        <p class="text-gray-500 dark:text-gray-300">
                            Comprendre vos besoins pour fournir un accompagnement sur mesure.
                        </p>

                        <a href="#" class="flex items-center -mx-1 text-sm text-blue-500 capitalize transition-colors duration-300 transform dark:text-blue-400 hover:underline hover:text-blue-600 dark:hover:text-blue-500">
                            <span class="mx-1">read more</span>
                            <svg class="w-4 h-4 mx-1 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>


        <!-- FAQ SECTION -->
        <section class="relative w-full bg-[#02101f] px-6 pt-10 pb-8 my-12 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-2xl sm:rounded-lg sm:px-10">
            <div class="mx-auto px-5">
                <div class="flex flex-col items-center">
                    <h2 class="text-[#01FF70] mt-5 text-center text-3xl font-bold tracking-tight md:text-5xl">FAQ</h2>
                    <p class="mt-3 text-lg text-neutral-300 md:text-xl">Frequenty asked questions

                    </p>
                </div>
                <div class="mx-auto mt-8 grid max-w-xl divide-y divide-neutral-200">
                    <div class="py-5">
                        <details class="group">
                            <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                                <span> Quels sont les types de services juridiques que vous proposez ?</span>
                                <span class="transition group-open:rotate-180">
                                        <svg fill="none" height="24" shape-rendering="geometricPrecision"
                                            stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                            <path d="M6 9l6 6 6-6"></path>
                                        </svg>
                                    </span>
                            </summary>
                            <p class="group-open:animate-fadeIn mt-3 text-neutral-400">Nous offrons des services dans divers domaines tels que le droit civil, commercial, pénal, du travail et de la famille, ainsi que des conseils juridiques adaptés à vos besoins.
                            </p>
                        </details>
                    </div>
                    <div class="py-5">
                        <details class="group">
                            <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                                <span> Quels sont vos tarifs pour les consultations ?</span>
                                <span class="transition group-open:rotate-180">
                                        <svg fill="none" height="24" shape-rendering="geometricPrecision"
                                            stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                            <path d="M6 9l6 6 6-6"></path>
                                        </svg>
                                    </span>
                            </summary>
                            <p class="group-open:animate-fadeIn mt-3 text-neutral-400">Nos tarifs varient en fonction de la nature et de la complexité du dossier. Une estimation claire est fournie après une première consultation.
                            </p>
                        </details>
                    </div>
                    <div class="py-5">
                        <details class="group">
                            <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                                <span> Comment prendre rendez-vous avec un avocat ?</span>
                                <span class="transition group-open:rotate-180">
                                        <svg fill="none" height="24" shape-rendering="geometricPrecision"
                                            stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                            <path d="M6 9l6 6 6-6"></path>
                                        </svg>
                                    </span>
                            </summary>
                            <p class="group-open:animate-fadeIn mt-3 text-neutral-400">Les rendez-vous se font via notre site LexAdvisor. Après authentification, vous pourrez choisir l'avocat que vous souhaitez consulter et sélectionner une plage horaire disponible.
                            </p>
                        </details>
                    </div>
                    <div class="py-5">
                        <details class="group">
                            <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                                <span> Comment se déroule la première consultation ?</span>
                                <span class="transition group-open:rotate-180">
                                        <svg fill="none" height="24" shape-rendering="geometricPrecision"
                                            stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                            <path d="M6 9l6 6 6-6"></path>
                                        </svg>
                                    </span>
                            </summary>
                            <p class="group-open:animate-fadeIn mt-3 text-neutral-400">Lors de la première rencontre, nous analysons votre situation, répondons à vos questions et vous proposons des solutions juridiques adaptées.
                            </p>
                        </details>
                    </div>
                </div>
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
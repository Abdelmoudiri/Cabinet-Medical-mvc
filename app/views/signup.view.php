<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= ROOT ?>/assets/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= ROOT ?>/assets/images/favicon-16x16.png">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <title>Sign Up - DentalPro</title>

  <style>
    #menu-toggle:checked+#menu {
      display: block;
    }

    #dropdown-toggle:checked+#dropdown {
      display: block;
    }

    a,
    span {
      position: relative;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    a.arrow,
    span.arrow {
      display: flex;
      align-items: center;
      font-weight: 600;
      line-height: 1.5;
    }

    a.arrow .arrow_icon,
    span.arrow .arrow_icon {
      position: relative;
      margin-left: 0.5em;
    }

    a.arrow .arrow_icon svg,
    span.arrow .arrow_icon svg {
      transition: transform 0.3s 0.02s ease;
      margin-right: 1em;
    }

    a.arrow .arrow_icon::before,
    span.arrow .arrow_icon::before {
      content: "";
      display: block;
      position: absolute;
      top: 50%;
      left: 0;
      width: 0;
      height: 2px;
      background: #38b2ac;
      transform: translateY(-50%);
      transition: width 0.3s ease;
    }

    a.arrow:hover .arrow_icon::before,
    span.arrow:hover .arrow_icon::before {
      width: 1em;
    }

    a.arrow:hover .arrow_icon svg,
    span.arrow:hover .arrow_icon svg {
      transform: translateX(0.75em);
    }

    .bg-blue-teal-gradient {
      background: rgb(49, 130, 206);
      background: linear-gradient(90deg, rgba(49, 130, 206, 1) 0%, rgba(56, 178, 172, 1) 100%);
    }
  </style>
</head>

<body class="antialiased bg-white font-sans text-gray-900">

  <main class="w-full">

    <!-- start header -->
    <header class="absolute top-0 left-0 w-full z-50 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64">
      <div class="flex flex-wrap items-center justify-between py-6">
        <div class="w-1/2 md:w-auto">
          <a href="index.html" class="text-white font-bold text-2xl">
            DentalPro
          </a>
        </div>

        <label for="menu-toggle" class="pointer-cursor md:hidden block"><svg class="fill-current text-white"
            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
            <title>menu</title>
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
          </svg></label>

        <input class="hidden" type="checkbox" id="menu-toggle">

        <div class="hidden md:block w-full md:w-auto" id="menu">
          <nav
            class="w-full bg-white md:bg-transparent rounded shadow-lg px-6 py-4 mt-4 text-center md:p-0 md:mt-0 md:shadow-none">
            <ul class="md:flex items-center">
              <li><a class="py-2 inline-block md:text-white md:hidden lg:block font-semibold" href="#">About Us</a></li>
              <li class="md:ml-4"><a class="py-2 inline-block md:text-white md:px-2 font-semibold"
                  href="#">Treatments</a></li>
              <li class="md:ml-4"><a class="py-2 inline-block md:text-white md:px-2 font-semibold"
                  href="#">Testimonials</a></li>
              <li class="md:ml-4 md:hidden lg:block"><a class="py-2 inline-block md:text-white md:px-2 font-semibold"
                  href="#">Blog</a></li>
              <li class="md:ml-4"><a class="py-2 inline-block md:text-white md:px-2 font-semibold" href="#">Contact
                  Us</a></li>
              <li class="md:ml-6 mt-3 md:mt-0">
                <a class="inline-block font-semibold px-4 py-2 text-white bg-blue-600 md:bg-transparent md:text-white border border-white rounded"
                  href="<?= ROOT ?>/login">Login</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header -->

    <!-- start signup section -->
    <section class="bg-blue-teal-gradient min-h-screen flex items-center justify-center">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Sign Up</h2>
        <form method="post">
          <?php if (!empty($errors)): ?>
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <?=implode("<br>", $errors) ?>
          </div>
          <?php endif; ?>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">
              Nom
            </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="nom" type="text" name="nom" placeholder="Dupont">
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="prenom">
              Prénom
            </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="prenom" type="text" name="prenom" placeholder="Jean">
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
              Email
            </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="email" type="email" name="email" placeholder="jean.dupont@example.com">
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
              Rôle
            </label>
            <select
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="role" name="role">
              <option value="patient">Patient</option>
              <option value="medcin">Médecin</option>
            </select>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
              Mot de passe
            </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="password" type="password" name="password" placeholder="••••••••">
          </div>

          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm-password">
              Confirmer le mot de passe
            </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="confirm-password" type="password" name="confirm-password" placeholder="••••••••">
          </div>

          <button
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit">
            S'inscrire
          </button>
        </form>
        <p class="mt-6 text-center text-sm text-gray-600">
          Already have an account? <a href="<?= ROOT ?>/login" class="text-blue-600 hover:text-blue-800">Login</a>
        </p>
      </div>
    </section>
    <!-- end signup section -->

  </main>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131505823-4"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-131505823-4');
  </script>

</body>

</html>
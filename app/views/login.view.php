<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=ROOT?>/assets/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?=ROOT?>/assets/images/favicon-16x16.png">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <title>Login - DentalPro</title>

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
                  href="<?=ROOT?>/login">Login</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header -->

    <!-- start login section -->
    <section class="bg-blue-teal-gradient min-h-screen flex items-center justify-center">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form method="post">
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
              Email Address
            </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="email" type="email" name="email" placeholder="name@example.com">
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
              Password
            </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="password" type="password" name="password" placeholder="Password">
          </div>
          <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
              <input type="checkbox" id="remember-me" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
              <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                Remember me
              </label>
            </div>
            <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Forgot Password?</a>
          </div>
          <button
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit">
            Sign In
          </button>
        </form>
        <p class="mt-6 text-center text-sm text-gray-600">
          Don't have an account? <a href="<?=ROOT?>/signup" class="text-blue-600 hover:text-blue-800">Sign up</a>
        </p>
      </div>
    </section>
    <!-- end login section -->

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
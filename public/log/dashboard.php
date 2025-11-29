<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
  <title>dashboard</title>
</head>

<body class="">
  <?php
  include "nav.php";
  ?>

  <div class="flex">
    <aside class="w-64 h-screen bg-gray-800 text-white fixed top-0 left-0 pt-16">
      <?php
      include "sidebar.php";
      ?>
    </aside>

    <div class="ml-64 w-full pt-16 p-6 mt-6">


      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <div class="bg-white rounded shadow-lg px-6 py-4">
          <div class="flex items-center">

            <div id="hola" class="ml-4 text-lg font-semibold uppercase">
              BIENVENIDO A LA PLATAFORMA DE VIAJES TURISTICOS
            </div>
          </div>
        </div>

        <div class="bg-white rounded shadow-lg px-6 py-4 flex items-center justify-center">
          <h2 class="text-lg font-semibold uppercase">
            EMPRESA TAURUS
          </h2>
        </div>
      </div>

    </div>
  </div>
</body>


</html>
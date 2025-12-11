<!-- <!DOCTYPE html>
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


</html> -->




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

<body class="bg-slate-100 text-slate-900 antialiased">
  <?php
  include "nav.php";
  ?>

  <div class="flex">
    <aside class="w-64 h-screen bg-slate-900 text-slate-100 fixed top-0 left-0 pt-16 shadow-2xl border-r border-slate-800">
      <?php
      include "sidebar.php";
      ?>
    </aside>

    <div class="ml-64 w-full pt-20 p-6">
      <!-- Contenedor principal del dashboard -->
      <div class="max-w-7xl mx-auto space-y-6">

        <!-- Título general del dashboard -->
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-2xl md:text-3xl font-semibold tracking-tight text-slate-800">
              Panel de Control
            </h1>
            <p class="text-sm md:text-base text-slate-500 mt-1">
              Resumen general de la plataforma de viajes turísticos.
            </p>
          </div>

          <div class="hidden md:flex items-center gap-3">
            <button
              class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm hover:shadow-md hover:border-slate-300 transition">
              <i class="fa-regular fa-calendar"></i>
              <span>Hoy</span>
            </button>
            <a href="http://localhost/TAURUS/public/app/views/inscripcion/new.php"
              class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-md hover:bg-indigo-700 hover:shadow-lg transition">
              <i class="fa-solid fa-plus"></i>
              <span>Nueva reserva</span>
            </a>
          </div>
        </div>

        <!-- Tarjetas principales -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-4">

          <!-- Card Bienvenida -->
          <div
            class="relative overflow-hidden bg-gradient-to-r from-indigo-500 via-sky-500 to-emerald-500 rounded-2xl shadow-xl px-6 py-6 flex items-center">
            <div
              class="absolute -right-10 -bottom-10 w-40 h-40 rounded-full bg-white/10 blur-2xl pointer-events-none">
            </div>
            <div
              class="absolute -left-16 -top-16 w-40 h-40 rounded-full bg-white/10 blur-2xl pointer-events-none">
            </div>

            <div class="relative flex items-center gap-4">
              <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/20 backdrop-blur">
                <i class="fa-solid fa-plane-departure text-2xl text-white"></i>
              </div>

              <div class="space-y-1">
                <div id="hola" class="text-sm font-semibold tracking-[0.17em] text-black/80 uppercase">
                  BIENVENIDO A LA PLATAFORMA DE VIAJES TURISTICOS
                </div>
                <p class="text-xs md:text-sm text-black/80">
                  Gestiona tus rutas, reservas y experiencias turísticas desde un solo lugar con una interfaz moderna y
                  clara.
                </p>
              </div>
            </div>
          </div>

          <!-- Card Empresa -->
          <div
            class="bg-white rounded-2xl shadow-xl px-6 py-6 flex flex-col items-center justify-center border border-slate-100">
            <div class="flex flex-col items-center gap-3">
              <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-900/90">
                <i class="fa-solid fa-building text-xl text-amber-400"></i>
              </div>

              <div class="text-center space-y-1">
                <h2 class="text-base md:text-lg font-semibold tracking-[0.25em] text-slate-800 uppercase">
                  EMPRESA TAURUS
                </h2>
                <p class="text-xs md:text-sm text-slate-500 max-w-xs">
                  Especialistas en experiencias de viaje seguras, personalizadas y memorables para tus clientes.
                </p>
              </div>

              <div class="mt-3 flex flex-wrap items-center justify-center gap-2 text-[11px] uppercase">
                <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 font-medium">
                  Activa
                </span>
                <span class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 font-medium">
                  Turismo
                </span>
                <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 font-medium">
                  Experiencias
                </span>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</body>

</html>

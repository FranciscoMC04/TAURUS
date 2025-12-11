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

<body class="bg-slate-100 text-slate-900 antialiased"
      style="background-image:url('/TAURUS/public/img/TAURUS.png');background-size: 99% ; background-repeat:no-repeat;">
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
            <p class="text-sm md:text-base text-blanck-500 mt-1">
              Resumen general de la plataforma de viajes turísticos.
            </p>
          </div>

          <div class="hidden md:flex items-center gap-3">
            <a target=_blanck href="https://calendar.google.com/calendar"
              class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm hover:shadow-md hover:border-slate-300 transition">
              <i class="fa-regular fa-calendar"></i>
              <span>Hoy</span>
            </a>
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
            class="bg-white rounded-2xl shadow-xl px-6 py-6 w-96 ml-72 flex flex-col items-center justify-center border border-slate-100">
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





<div id="sliderContainer" class="fixed bottom-0 left-0 w-full bg-white shadow-2xl border-t border-slate-200 hidden z-40">
  

  <div class="flex items-center justify-between px-4 py-2 bg-slate-900 text-white">
    <h3 class="text-sm font-semibold">Accesos rápidos del Dashboard</h3>
    <button onclick="toggleSlider()" class="text-lg leading-none">&times;</button>
  </div>

 
  <div class="relative px-10 py-4">

 
    <button id="btnLeft" class="absolute left-2 top-1/2 -translate-y-1/2 bg-slate-800 text-white px-3 py-2 rounded-full shadow hover:bg-slate-700">
      ‹
    </button>


    <div id="sliderItems" class="flex gap-4 overflow-hidden scroll-smooth">

      <!-- HOTEL -->
      <a href="http://localhost/TAURUS/public/app/views/hotel/index.php"
         class="min-w-[180px] bg-slate-100 border border-slate-300 rounded-xl px-4 py-3 shadow text-left hover:border-indigo-500 hover:shadow-md transition">
        <i class="fa-solid fa-hotel text-indigo-600 text-xl"></i>
        <p class="mt-1 font-semibold text-slate-800">Hotel</p>
      </a>

      <!-- RESTAURANTE -->
      <a href="http://localhost/TAURUS/public/app/views/restaurante/index.php"
         class="min-w-[180px] bg-slate-100 border border-slate-300 rounded-xl px-4 py-3 shadow text-left hover:border-indigo-500 hover:shadow-md transition">
        <i class="fa-solid fa-utensils text-emerald-600 text-xl"></i>
        <p class="mt-1 font-semibold text-slate-800">Restaurante</p>
      </a>

      <!-- GUIAS TURISTICOS -->
      <a href="http://localhost/TAURUS/public/app/views/guias/index.php"
         class="min-w-[180px] bg-slate-100 border border-slate-300 rounded-xl px-4 py-3 shadow text-left hover:border-indigo-500 hover:shadow-md transition">
        <i class="fa-solid fa-person-hiking text-amber-600 text-xl"></i>
        <p class="mt-1 font-semibold text-slate-800">Guías Turísticos</p>
      </a>

      <!-- TERRAMOZAS -->
      <a href="http://localhost/TAURUS/public/app/views/terramozas/index.php"
         class="min-w-[180px] bg-slate-100 border border-slate-300 rounded-xl px-4 py-3 shadow text-left hover:border-indigo-500 hover:shadow-md transition">
        <i class="fa-solid fa-people-group text-pink-600 text-xl"></i>
        <p class="mt-1 font-semibold text-slate-800">Terramozas</p>
      </a>

      <!-- PILOTO -->
      <a href="http://localhost/TAURUS/public/app/views/personal/piloto/index.php"
         class="min-w-[180px] bg-slate-100 border border-slate-300 rounded-xl px-4 py-3 shadow text-left hover:border-indigo-500 hover:shadow-md transition">
        <i class="fa-solid fa-id-card text-sky-600 text-xl"></i>
        <p class="mt-1 font-semibold text-slate-800">Piloto</p>
      </a>

      <!-- INSCRIPCIÓN -->
      <a href="http://localhost/TAURUS/public/app/views/inscripcion/index.php"
         class="min-w-[180px] bg-slate-100 border border-slate-300 rounded-xl px-4 py-3 shadow text-left hover:border-indigo-500 hover:shadow-md transition">
        <i class="fa-solid fa-file-pen text-indigo-600 text-xl"></i>
        <p class="mt-1 font-semibold text-slate-800">Inscripción</p>
      </a>

      <!-- ITINERARIO -->
      <a href="http://localhost/TAURUS/public/app/views/itinerario/index.php"
         class="min-w-[180px] bg-slate-100 border border-slate-300 rounded-xl px-4 py-3 shadow text-left hover:border-indigo-500 hover:shadow-md transition">
        <i class="fa-solid fa-list-ul text-green-600 text-xl"></i>
        <p class="mt-1 font-semibold text-slate-800">Itinerario</p>
      </a>

      <!-- CONSOLIDADO DE VIAJE -->
      <a href="http://localhost/TAURUS/public/app/views/consolidado/index.php"
         class="min-w-[200px] bg-slate-100 border border-slate-300 rounded-xl px-4 py-3 shadow text-left hover:border-indigo-500 hover:shadow-md transition">
        <i class="fa-solid fa-file-contract text-rose-600 text-xl"></i>
        <p class="mt-1 font-semibold text-slate-800">Consolidado de Viaje</p>
      </a>

      <!-- BUS -->
      <a href="http://localhost/TAURUS/public/app/views/bus/index.php"
         class="min-w-[180px] bg-slate-100 border border-slate-300 rounded-xl px-4 py-3 shadow text-left hover:border-indigo-500 hover:shadow-md transition">
        <i class="fa-solid fa-bus text-orange-500 text-xl"></i>
        <p class="mt-1 font-semibold text-slate-800">Bus</p>
      </a>

      <!-- DETALLES BUS -->
      <a href="http://localhost/TAURUS/public/app/views/detalle_bus/index.php"
         class="min-w-[200px] bg-slate-100 border border-slate-300 rounded-xl px-4 py-3 shadow text-left hover:border-indigo-500 hover:shadow-md transition">
        <i class="fa-solid fa-clipboard-list text-blue-600 text-xl"></i>
        <p class="mt-1 font-semibold text-slate-800">Detalles Bus</p>
      </a>

      <!-- FICHA -->
      <a href="http://localhost/TAURUS/public/app/views/ficha/index.php"
         class="min-w-[180px] bg-slate-100 border border-slate-300 rounded-xl px-4 py-3 shadow text-left hover:border-indigo-500 hover:shadow-md transition">
        <i class="fa-solid fa-file-lines text-purple-600 text-xl"></i>
        <p class="mt-1 font-semibold text-slate-800">Ficha</p>
      </a>

      <!-- USUARIO -->
      <a href="http://localhost/TAURUS/public/app/views/usuarios/index.php"
         class="min-w-[180px] bg-slate-100 border border-slate-300 rounded-xl px-4 py-3 shadow text-left hover:border-indigo-500 hover:shadow-md transition">
        <i class="fa-solid fa-user-gear text-slate-700 text-xl"></i>
        <p class="mt-1 font-semibold text-slate-800">Usuario</p>
      </a>

    </div>

    
    <button id="btnRight" class="absolute right-2 top-1/2 -translate-y-1/2 bg-slate-800 text-white px-3 py-2 rounded-full shadow hover:bg-slate-700">
      ›
    </button>

  </div>
</div>


<button onclick="toggleSlider()" 
        class="fixed bottom-4 right-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-3 rounded-full shadow-lg z-50">
  Menú rápido
</button>


<script>
function toggleSlider() {
  const slider = document.getElementById("sliderContainer");
  slider.classList.toggle("hidden");
}

const slider = document.getElementById("sliderItems");
const btnLeft = document.getElementById("btnLeft");
const btnRight = document.getElementById("btnRight");

btnLeft.addEventListener("click", () => {
  slider.scrollBy({ left: -220, behavior: "smooth" });
});

btnRight.addEventListener("click", () => {
  slider.scrollBy({ left: 220, behavior: "smooth" });
});
</script>


  
</body>

</html>

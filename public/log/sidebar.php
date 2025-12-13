<?php
$base_url = '/public';
?>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
    <ul class="space-y-2 font-medium">
      <li>
        <a href="<?php echo $base_url; ?>/log/dashboard.php" class="mt-3 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <i class="fa-solid fa-gauge"></i>
          <span class="ms-3">Dashboard</span>
        </a>

      </li>
      <hr>
      <li>
        <a href="<?php echo $base_url; ?>/app/views/hotel/index.php" class="mt-3 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

          <!-- <i class="fas fa-user-tie"></i> -->
           <i class="fa-solid fa-hotel"></i>

          <span class="ms-3">Hotel</span>
        </a>
      </li>
      <li>
        <a href="<?php echo $base_url; ?>/app/views/restaurante/index.php" class="mt-3 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

          <!-- <i class="fa-solid fa-book"></i> -->
           <i class="fa-solid fa-utensils"></i>

          <span class="ms-3">Restaurante</span>
        </a>
      </li>
      <li>
        <a href="<?php echo $base_url; ?>/app/views/guia/index.php" class="mt-3 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

          <!-- <i class="fa-solid fa-book"></i> -->
           <i class="fa-solid fa-person-hiking"></i>

          <span class="ms-3">Guias Turisticos</span>
        </a>
      </li>

      <li>
        <a href="<?php echo $base_url; ?>/app/views/terramoza/index.php" class="mt-3 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

          <!-- <i class="fa-solid fa-book"></i> -->
           <i class="fa-solid fa-user-nurse"></i>

          <span class="ms-3">Terramozas</span>
        </a>
      </li>
      <li> 
        <a href="<?php echo $base_url; ?>/app/views/personal/piloto/index.php" class="mt-3 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

          <!-- <i class="fa-solid fa-book"></i> -->
           <i class="fa-solid fa-user-tie"></i>

          <span class="ms-3">Piloto</span>
        </a>
      </li>
      <li>
        <a href="<?php echo $base_url; ?>/app/views/inscripcion/index.php" class="mt-3 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

          <!-- <i class="fa-solid fa-book"></i> -->
           <i class="fa-solid fa-file-signature"></i>

          <span class="ms-3">Inscripción</span>
        </a>
      </li>
      <li>
        <a href="<?php echo $base_url; ?>/app/views/itinerario/index.php" class="mt-3 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

          <!-- <i class="fa-solid fa-book"></i> -->
           <i class="fa-solid fa-route"></i>

          <span class="ms-3">Itinerario</span>
        </a>
      </li>
      <li>
        <!-- <a href="/TAURUS/public/app/views/consolidado/index.php" class="mt-3 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
</a> -->
          <!-- <i class="fa-solid fa-book"></i> -->
           <!-- <i class="fa-solid fa-file-lines"></i>

          <span class="ms-3">Consolidado de Viaje</span> -->
        
      </li>



      <li>
        <button
          type="button"
          class="mt-3 flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
          aria-controls="dropdown-bus"
          data-collapse-toggle="dropdown-bus"
        >
          <i class="fa-solid fa-bus"></i>
          <span class="flex-1 ms-3 text-left">Bus</span>
          <i class="fa-solid fa-chevron-down"></i>
        </button>

        <!-- SUBMENÚ -->
        <ul id="dropdown-bus" class="hidden py-2 space-y-2">
          <li>
            <a href="<?php echo $base_url; ?>/app/views/bus/index.php"
              class="flex items-center w-full p-2 pl-11 text-gray-700 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
              <i class="fa-solid fa-list"></i>
              <span class="ms-3">Listado Bus</span>
            </a>
          </li>

          <li>
            <a href="<?php echo $base_url; ?>/app/views/detalle_bus/index.php"
              class="flex items-center w-full p-2 pl-11 text-gray-700 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
              <i class="fa-solid fa-screwdriver-wrench"></i>
              <span class="ms-3">Asignación Bus</span>
            </a>
          </li>
        </ul>
      </li>





      <li>
        <a href="<?php echo $base_url; ?>/app/views/ficha/index.php" class="mt-3 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

          <!-- <i class="fa-solid fa-book"></i> -->
           <i class="fa-solid fa-address-card"></i>

          <span class="ms-3">Ficha</span>
        </a>
      </li>
      <li>
        <a href="<?php echo $base_url; ?>/app/views/usuarios/index.php" class="mt-3 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

          <!-- <i class="fa-solid fa-book"></i> -->
           <i class="fa-solid fa-user"></i>

          <span class="ms-3">Usuario</span>
        </a>
      </li>

    </ul>
  </div>
</aside>

<!-- rivas gey -->
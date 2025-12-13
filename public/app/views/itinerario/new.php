<?php
require '../../controllers/conexion.php';
require '../../controllers/database/hotel.php';
require '../../controllers/database/restaurante.php';
require '../../controllers/database/ficha.php';

$fichaObj = new Ficha($conexion);
$fichas = $fichaObj->index();

$hotelObj = new hotel($conexion);
$restauranteObj = new Restaurante($conexion);

$hoteles = $hotelObj->index();
$restaurantes = $restauranteObj->index();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
  <title>Nueva Itinerario</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">

  <?php
  include "../../../log/nav.php";
  ?>

  <div class="flex">
    <aside class="w-64 h-screen bg-gray-800 text-white fixed top-0 left-0 pt-16">
      <?php
      include "../../../log/sidebar.php";
      ?>
    </aside>

    <div class="ml-64 w-full pt-16 p-6 min-h-[calc(100vh-4rem)] flex flex-col">

      <div class="mt-10">
        <a href="index.php"
          class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800 ">
          <i class="fa-solid fa-left-long text-2xl "></i>
        </a>
      </div>

      <div class="flex-grow flex items-center justify-center">
        <form method="post" action="../../models/itinerario.php" class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 w-full max-w-md">
          <input type="hidden" name="action" value="create">

          <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Registrar nuevo itinerario</h2>
          <div class="mb-4">
            <label for="ficha_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Seleccione Ficha
            </label>

            <select id="ficha_id" name="ficha_id"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              required>

              <option value="" disabled selected>Seleccione una ficha</option>

              <?php foreach ($fichas as $f): ?>
                <option 
                  value="<?= $f['id'] ?>"
                  data-fecha="<?= $f['fecha_inicio'] ?>"
                >
                  <?= $f['codigo'] ?> - <?= $f['titulo'] ?>
                </option>
              <?php endforeach; ?>

            </select>
          </div>

          <div class="mb-4">
            <input type="hidden" id="dia" name="dia">
          </div>
          <div class="mb-4">
            <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Fecha
            </label>
            <input type="date" id="fecha" name="fecha"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              required />
          </div>

          <div class="mb-4">
            <label for="hora_inicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora inicio</label>
            <input type="time" id="hora_inicio" name="hora_inicio" placeholder=""
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" required />
          </div>
          <div class="mb-4">
            <label for="hora_fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora fin</label>
            <input type="time" id="hora_fin" name="hora_fin" placeholder=""
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" required />
          </div>
          <div class="mb-4">
            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
            <input type="text" id="descripcion" name="descripcion" placeholder=""
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" required />
          </div>
          <div class="mb-4">
            <label for="nombre_hotel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Seleccione Hotel
            </label>
            <select id="nombre_hotel" name="nombre_hotel"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              required>
              <option value="" disabled selected>Seleccione un hotel</option>

              <?php foreach ($hoteles as $h): ?>
                <option value="<?= $h['nombre'] ?>">
                  <?= $h['nombre'] ?>
                </option>
              <?php endforeach; ?>

            </select>
          </div>
          <div class="mb-4">
            <label for="nombre_restaurante" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Seleccione Restaurante
            </label>
            <select id="nombre_restaurante" name="nombre_restaurante"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              required>

              <option value="" disabled selected>Seleccione un restaurante</option>

              <?php foreach ($restaurantes as $r): ?>
                  <option value="<?= $r['nombre'] ?>">
                      <?= $r['nombre'] ?>
                  </option>
              <?php endforeach; ?>

            </select>
          </div>
          <div class="mb-4">
            <input type="hidden" id="orden" name="orden">
          </div>

          <button type="submit"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
            Registrar
          </button>

        </form>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('ficha_id').addEventListener('change', function () {
      const selected = this.options[this.selectedIndex];
      const fecha = selected.getAttribute('data-fecha');

      if (fecha) {
        document.getElementById('fecha').value = fecha;
      }
    });
  </script>
</body>

</html>
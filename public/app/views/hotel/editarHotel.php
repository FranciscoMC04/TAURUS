<?php
require '../../controllers/conexion.php';
require '../../controllers/database/hotel.php';

if (!isset($_GET['id'])) {
  echo "ID no proporcionado";
  exit;
}

$hotelObj = new hotel($conexion);
$hotel = $hotelObj->show($_GET['id']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
  <title>Editar Hotel</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">

  <?php include "../../../log/nav.php"; ?>

  <div class="flex">
    <aside class="w-64 h-screen bg-gray-800 text-white fixed top-0 left-0 pt-16">
      <?php include "../../../log/sidebar.php"; ?>
    </aside>

    <div class="ml-64 w-full pt-16 p-6 flex flex-col">

      <div class="mt-10">
        <a href="index.php"
          class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5">
          <i class="fa-solid fa-left-long text-2xl"></i>
        </a>
      </div>

      <div class="flex-grow flex items-center justify-center">

        <form method="POST" action="../../models/hotel.php"
          class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 w-full max-w-md">

          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?= $hotel['id'] ?>">

          <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">
            Editar hotel
          </h2>

          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text" name="nombre" value="<?= $hotel['nombre'] ?>"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" required />
          </div>

          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
            <input type="text" name="direccion" value="<?= $hotel['direccion'] ?>"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" required />
          </div>

          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
            <input type="number" name="telefono" value="<?= $hotel['telefono'] ?>"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" required />
          </div>

          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
            <input type="number" name="categoria" value="<?= $hotel['categoria'] ?>"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" required />
          </div>

          <button type="submit"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5">
            Actualizar
          </button>

        </form>
      </div>

    </div>
  </div>

</body>
</html>

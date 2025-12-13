<?php
require '../../controllers/conexion.php';
require '../../controllers/database/itinerario.php';
require '../../controllers/database/hotel.php';
require '../../controllers/database/restaurante.php';

/* 🔹 Validar ID */
$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header("Location: index.php");
    exit();
}

/* 🔹 Objetos */
$itinerarioObj = new itinerario($conexion);
$hotelObj = new hotel($conexion);
$restauranteObj = new Restaurante($conexion);

/* 🔹 Datos */
$itinerario = $itinerarioObj->show($id);
$hoteles = $hotelObj->index();
$restaurantes = $restauranteObj->index();

if (!$itinerario) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
  <title>Editar Itinerario</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">

<?php include "../../../log/nav.php"; ?>

<div class="flex">
  <aside class="w-64 h-screen bg-gray-800 text-white fixed top-0 left-0 pt-16">
    <?php include "../../../log/sidebar.php"; ?>
  </aside>

  <div class="ml-64 w-full pt-16 p-6 min-h-[calc(100vh-4rem)] flex flex-col">

    <div class="mt-6">
      <a href="index.php"
        class="text-white bg-blue-600 hover:bg-blue-700 rounded-lg px-5 py-2.5">
        <i class="fa-solid fa-left-long"></i>
      </a>
    </div>

    <div class="flex-grow flex items-center justify-center">
      <form method="POST" action="../../models/itinerario.php"
        class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 w-full max-w-md">

        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="dia" value="<?= $itinerario['dia'] ?>">
        <input type="hidden" name="orden" value="<?= $itinerario['orden'] ?>">

        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">
          Editar Itinerario
        </h2>

        <!-- Fecha -->
        <div class="mb-4">
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha</label>
          <input type="date" name="fecha" value="<?= $itinerario['fecha'] ?>"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <!-- Hora inicio -->
        <div class="mb-4">
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora inicio</label>
          <input type="time" name="hora_inicio" value="<?= $itinerario['hora_inicio'] ?>"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <!-- Hora fin -->
        <div class="mb-4">
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora fin</label>
          <input type="time" name="hora_fin" value="<?= $itinerario['hora_fin'] ?>"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <!-- Descripción -->
        <div class="mb-4">
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
          <input type="text" name="descripcion" value="<?= $itinerario['descripcion'] ?>"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <!-- Hotel -->
        <div class="mb-4">
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hotel</label>
          <select name="nombre_hotel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            <?php foreach ($hoteles as $h): ?>
              <option value="<?= $h['nombre'] ?>"
                <?= $h['nombre'] == $itinerario['hotel'] ? 'selected' : '' ?>>
                <?= $h['nombre'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Restaurante -->
        <div class="mb-6">
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Restaurante</label>
          <select name="nombre_restaurante" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            <?php foreach ($restaurantes as $r): ?>
              <option value="<?= $r['nombre'] ?>"
                <?= $r['nombre'] == $itinerario['restaurante'] ? 'selected' : '' ?>>
                <?= $r['nombre'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Botón -->
        <button type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg py-2.5">
          Guardar cambios
        </button>

      </form>
    </div>
  </div>
</div>

</body>
</html>

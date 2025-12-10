<?php
require '../../controllers/database/inscripcion.php';
$id = $_GET['id'] ?? null;

$inscripcionObj = new inscripcion($conexion);
$inscripciones = $inscripcionObj->show($id);

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
  <title>Modificar Inscripcion</title>
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
        <form method="post" action="../../models/inscripcion.php" class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 w-full max-w-md">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="ficha_id" value="1">
          <input type="hidden" name="id" value="<?php echo $inscripciones['id']; ?>">

          <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Modificar inscripcion</h2>

          <div class="mb-4">
            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
            <input type="text" id="descripcion" name="descripcion" placeholder="" value="<?php echo $inscripciones['descripcion']; ?>"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" required />
          </div>
          <div class="mb-4">
            <label for="nombre_turista" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre turista</label>
            <input type="text" id="nombre_turista" name="nombre_turista" placeholder="" value="<?php echo $inscripciones['turista']; ?>"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" required />
          </div>

          <div class="mb-4">
            <label for="fecha_inscripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha</label>
            <input type="date" id="fecha_inscripcion" name="fecha_inscripcion" placeholder=""
              value="<?php echo date('Y-m-d', strtotime($inscripciones['fecha_inscripcion'])); ?>"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" required />
          </div>
          <div class="mb-4 flex items-center">
            <input
              type="checkbox"
              id="confirmacion"
              name="confirmacion"
              <?php if ($inscripciones['estado']) echo 'checked'; ?>
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label
              for="confirmacion"
              class="ms-2 text-sm font-medium text-gray-900 dark:text-white cursor-pointer">
              Confirmado
            </label>
          </div>

          <button type="submit"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
            Registrar
          </button>

        </form>
      </div>
    </div>
  </div>

</body>

</html>
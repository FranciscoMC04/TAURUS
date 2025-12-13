<?php
require_once '../../controllers/conexion.php';

/* FICHAS */
$fichas = [];
$result = $conexion->query("SELECT id, titulo FROM ficha ORDER BY titulo");
while ($row = $result->fetch_assoc()) {
    $fichas[] = $row;
}

/* BUSES */
$buses = [];
$result = $conexion->query("SELECT id, placa FROM bus ORDER BY placa");
while ($row = $result->fetch_assoc()) {
    $buses[] = $row;
}

/* PILOTOS */
$pilotos = [];
$result = $conexion->query("SELECT id, nombre, licencia FROM piloto ORDER BY nombre");
while ($row = $result->fetch_assoc()) {
    $pilotos[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
  <title>Nuevo Detalle de Bus</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <?php include "../../../log/nav.php"; ?>

  <div class="flex">
    <aside class="w-64 h-screen bg-gray-800 text-white fixed top-0 left-0 pt-16">
      <?php include "../../../log/sidebar.php"; ?>
    </aside>

    <div class="ml-64 w-full pt-16 p-6 min-h-[calc(100vh-4rem)] flex flex-col">
      <div class="mt-10">
        <a href="index.php" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none
                                  focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
          <i class="fa-solid fa-left-long text-2xl "></i>
        </a>
      </div>

      <div class="flex-grow flex items-center justify-center">
        <form method="post" action="../../models/detalle_bus.php"
              class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 w-full max-w-md">
          <input type="hidden" name="action" value="create">

          <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">
            Registrar nuevo detalle de bus
          </h2>

          <div class="mb-4">
            <label for="ficha_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Viaje asignado
            </label>
            <select id="ficha_id" name="ficha_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
              <option value="">Seleccione un viaje</option>
              <?php foreach ($fichas as $f): ?>
                <option value="<?= $f['id'] ?>">
                  <?= htmlspecialchars($f['titulo']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-4">
            <label for="bus_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Placa de Bus
            </label>
            <select id="bus_id" name="bus_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
              <option value="">Seleccione un bus</option>
              <?php foreach ($buses as $b): ?>
                <option value="<?= $b['id'] ?>">
                  <?= htmlspecialchars($b['placa']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-4">
            <label for="piloto_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Piloto
            </label>
            <select id="piloto_id" name="piloto_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
              <option value="">Seleccione un piloto</option>
              <?php foreach ($pilotos as $p): ?>
                <option value="<?= $p['id'] ?>">
                  <?= htmlspecialchars($p['nombre'] . ' - Lic. ' . $p['licencia']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-4">
            <label for="fecha_asignacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Fecha de asignación
            </label>
            <input type="date" id="fecha_asignacion" name="fecha_asignacion" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" />
          </div>

          <div class="mb-4">
            <label for="rol_onboard" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Rol onboard
            </label>
            <select id="rol_onboard" name="rol_onboard" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
              <option value="">Seleccione un rol</option>
              <option value="Conductor principal">Conductor principal</option>
              <option value="Conductor secundario">Conductor secundario</option>
            </select>
          </div>

          <div class="mb-4">
            <label for="observacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Observación
            </label>
            <textarea id="observacion" name="observacion" rows="3"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                             focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700"></textarea>
          </div>

          <button type="submit"
                  class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none
                         focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Registrar
          </button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

<?php
require '../../controllers/conexion.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header("Location: index.php");
    exit();
}

$stmt = $conexion->prepare("SELECT * FROM detalle_bus WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$detalle = $result->fetch_assoc();
$stmt->close();

if (!$detalle) {
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
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
  <title>Editar Detalle de Bus</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <?php include "../../../log/nav.php"; ?>

  <div class="flex">
    <aside class="w-64 h-screen bg-gray-800 text-white fixed top-0 left-0 pt-16">
      <?php include "../../../log/sidebar.php"; ?>
    </aside>

    <div class="ml-64 w-full pt-16 p-6 min-h-[calc(100vh-4rem)] flex flex-col">
      <div class="mt-10">
        <a href="index.php"
           class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300
                  font-medium rounded-lg text-sm px-5 py-2.5">
          <i class="fa-solid fa-left-long text-2xl"></i>
        </a>
      </div>

      <div class="flex-grow flex items-center justify-center">
        <form method="post" action="../../models/detalle_bus.php"
              class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 w-full max-w-md">
          
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?= htmlspecialchars($detalle['id']) ?>">

          <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">
            Editar detalle de bus
          </h2>

          <div class="mb-4">
            <label for="ficha_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ficha ID</label>
            <input type="number" id="ficha_id" name="ficha_id"
                   value="<?= htmlspecialchars($detalle['ficha_id']) ?>"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" required />
          </div>

          <div class="mb-4">
            <label for="bus_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bus ID</label>
            <input type="number" id="bus_id" name="bus_id"
                   value="<?= htmlspecialchars($detalle['bus_id']) ?>"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" required />
          </div>

          <div class="mb-4">
            <label for="piloto_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Piloto ID</label>
            <input type="number" id="piloto_id" name="piloto_id"
                   value="<?= htmlspecialchars($detalle['piloto_id']) ?>"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" required />
          </div>

          <div class="mb-4">
            <label for="fecha_asignacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Fecha de asignación
            </label>
            <input type="date" id="fecha_asignacion" name="fecha_asignacion"
                   value="<?= htmlspecialchars($detalle['fecha_asignacion']) ?>"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" required />
          </div>

          <div class="mb-4">
            <label for="rol_onboard" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Rol onboard
            </label>
            <input type="text" id="rol_onboard" name="rol_onboard"
                   value="<?= htmlspecialchars($detalle['rol_onboard']) ?>"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" required />
          </div>

          <div class="mb-4">
            <label for="observacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Observación
            </label>
            <textarea id="observacion" name="observacion" rows="3"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                             focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700"><?= htmlspecialchars($detalle['observacion'] ?? '') ?></textarea>
          </div>

          <button type="submit"
                  class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none
                         focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Actualizar
          </button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

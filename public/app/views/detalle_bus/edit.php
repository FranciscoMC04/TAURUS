<?php

use LDAP\Result;

require '../../controllers/conexion.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
  header("Location: index.php");
  exit();
}

/* 🔹 OBTENER DETALLE */
$stmt = $conexion->prepare("
    SELECT 
        db.id,
        db.ficha_id,
        db.bus_id,
        db.piloto_id,
        db.fecha_asignacion,
        db.rol_onboard,
        db.observacion
    FROM detalle_bus db
    WHERE db.id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$detalle = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$detalle) {
  header("Location: index.php");
  exit();
}

/* 🔹 CARGAR LISTAS */

/* Fichas */
$fichas = [];
$res = $conexion->query("SELECT id, titulo FROM ficha ORDER BY titulo");
while ($r = $res->fetch_assoc()) {
  $fichas[] = $r;
}

/* Buses */
$buses = [];
$res = $conexion->query("SELECT id, placa FROM bus ORDER BY placa");
while ($r = $res->fetch_assoc()) {
  $buses[] = $r;
}

/* Pilotos */
$pilotos = [];
$res = $conexion->query("SELECT id, nombre, licencia FROM piloto ORDER BY nombre");
while ($r = $res->fetch_assoc()) {
  $pilotos[] = $r;
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
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Viaje asignado</label>
            <select name="ficha_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
              <?php foreach ($fichas as $f): ?>
                <option value="<?= $f['id'] ?>"
                  <?= $f['id'] == $detalle['ficha_id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($f['titulo']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bus</label>
            <select name="bus_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
              <?php foreach ($buses as $b): ?>
                <option value="<?= $b['id'] ?>"
                  <?= $b['id'] == $detalle['bus_id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($b['placa']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Piloto</label>
            <select name="piloto_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
              <?php foreach ($pilotos as $p): ?>
                <option value="<?= $p['id'] ?>"
                  <?= $p['id'] == $detalle['piloto_id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($p['nombre'] . ' - Lic. ' . $p['licencia']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-4">
            <label for="fecha_asignacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Fecha de asignación
            </label>
            <input type="date" name="fecha_asignacion"
              value="<?= $detalle['fecha_asignacion'] ?>"
              required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
          </div>
          
          <div class="mb-4">
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Rol
          </label>
          <select name="rol_onboard" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
            <option value="Conductor principal"
              <?= $detalle['rol_onboard'] == 'Conductor principal' ? 'selected' : '' ?>>
              Conductor principal
            </option>
            <option value="Conductor secundario"
              <?= $detalle['rol_onboard'] == 'Conductor secundario' ? 'selected' : '' ?>>
              Conductor secundario
            </option>
          </select>
          </div>

          <div class="mb-4">
            <label for="observacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Observación
            </label>
            <textarea name="observacion" rows="3"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700"><?= htmlspecialchars($detalle['observacion']) ?></textarea>
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
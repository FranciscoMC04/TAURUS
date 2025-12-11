<?php


require '../../controllers/conexion.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header("Location: index.php");
    exit();
}

$stmt = $conexion->prepare("SELECT * FROM bus WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$bus = $result->fetch_assoc();
$stmt->close();

if (!$bus) {
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
  <title>Editar Bus</title>
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
        <form method="post" action="../../models/bus.php"
              class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 w-full max-w-md">
          
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?= htmlspecialchars($bus['id']) ?>">

          <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">
            Editar bus
          </h2>

          <div class="mb-4">
            <label for="placa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Placa</label>
            <input type="text" id="placa" name="placa"
                   value="<?= htmlspecialchars($bus['placa']) ?>"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   required />
          </div>

          <div class="mb-4">
            <label for="marca" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Marca</label>
            <input type="text" id="marca" name="marca"
                   value="<?= htmlspecialchars($bus['marca']) ?>"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   required />
          </div>

          <div class="mb-4">
            <label for="modelo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modelo</label>
            <input type="text" id="modelo" name="modelo"
                   value="<?= htmlspecialchars($bus['modelo']) ?>"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   required />
          </div>

          <div class="mb-4">
            <label for="capacidad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Capacidad</label>
            <input type="number" id="capacidad" name="capacidad" min="1"
                   value="<?= htmlspecialchars($bus['capacidad']) ?>"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   required />
          </div>

          <div class="mb-4">
            <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
            <select id="estado" name="estado"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              <option value="activo" <?= $bus['estado'] === 'activo' ? 'selected' : '' ?>>Activo</option>
              <option value="inactivo" <?= $bus['estado'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
              <option value="mantenimiento" <?= $bus['estado'] === 'mantenimiento' ? 'selected' : '' ?>>Mantenimiento</option>
            </select>
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

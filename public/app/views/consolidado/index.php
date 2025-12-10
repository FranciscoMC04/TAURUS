<?php
require '../../controllers/database/consolidado.php';

$consolidadoObj = new consolidado($conexion);
$consolidados = $consolidadoObj->index();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
  <title>Consolidado</title>
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

    <div class="ml-64 w-full pt-16 p-6 mt-6">

      <div class="mt-6 text-white">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">Descripcion</th>
                <th scope="col" class="px-6 py-3">Total turistas</th>
                <th scope="col" class="px-6 py-3">Total gastos</th>
                <th scope="col" class="px-6 py-3">Total ingresos</th>
                <th scope="col" class="px-6 py-3">Utilidad</th>
                <th scope="col" class="px-6 py-3">Observaciones</th>
                <th scope="col" class="px-6 py-3">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (count($consolidados) > 0) {
                foreach ($consolidados as $consolidado) {

              ?>
                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4"><?php
                                          echo htmlspecialchars($consolidado['descripcion'] ?? 'N/A');
                                          ?></td>
                    <td class="px-6 py-4"><?php
                                          echo htmlspecialchars($consolidado['total_turistas'] ?? 'N/A');
                                          ?></td>
                    <td class="px-6 py-4"><?php
                                          echo htmlspecialchars($consolidado['total_gastos'] ?? 'N/A');
                                          ?></td>
                    <td class="px-6 py-4"><?php
                                          echo htmlspecialchars($consolidado['total_ingresos'] ?? 'N/A');
                                          ?></td>
                    <td class="px-6 py-4"><?php
                                          echo htmlspecialchars($consolidado['utilidad'] ?? 'N/A');
                                          ?></td>
                    <td class="px-6 py-4"><?php
                                          echo htmlspecialchars($consolidado['observaciones'] ?? 'Sin observacions');
                                          ?></td>

                    <td class="px-6 py-4">
                      <a href="update.php?codigo=<?php
                                                  echo $consolidado['id'];
                                                  ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-3">
                        <i class="fas fa-edit"></i> Editar
                      </a>
                      <form action="../../models/consolidado.php" method="POST" class="inline">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($consolidado['id']); ?>">

                        <button
                          onclick="return confirm('¿Estás seguro de eliminar el consolidado <?php echo htmlspecialchars($consolidado['id']); ?>?')"
                          class="font-medium text-red-600 dark:text-red-500 hover:underline">
                          <i class="fas fa-trash"></i> Eliminar
                        </button>
                      </form>

                    </td>
                  </tr>
              <?php
                }
              } else {
                echo '<tr><td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No hay hoteles registrados</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>

    <div>
      <a href="new.php" type="button"
        class="fixed bottom-5 right-5 p-3 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        <i class="fas fa-plus"></i>
      </a>
    </div>
  </div>

</body>

</html>
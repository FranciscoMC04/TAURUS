<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
  <title>Nuevo Bus</title>
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
                  font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-500 dark:hover:bg-blue-600
                  dark:focus:ring-blue-800 ">
          <i class="fa-solid fa-left-long text-2xl "></i>
        </a>
      </div>

      <div class="flex-grow flex items-center justify-center">
        <form method="post" action="../../models/bus.php"
              class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 w-full max-w-md">

          <input type="hidden" name="action" value="create">

          <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">
            Registrar nuevo bus
          </h2>

          <div class="mb-4">
            <label for="placa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Placa</label>
            <input type="text" id="placa" name="placa"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   required />
          </div>

          <div class="mb-4">
            <label for="marca" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Marca</label>
            <input type="text" id="marca" name="marca"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   required />
          </div>

          <div class="mb-4">
            <label for="modelo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modelo</label>
            <input type="text" id="modelo" name="modelo"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   required />
          </div>

    

          <div class="mb-4">
            <label for="capacidad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Capacidad
            </label>
            <input type="number" id="capacidad" name="capacidad" min="1"
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
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required>
              <option value="activo">Activo</option>
              <option value="inactivo">Inactivo</option>
              <option value="mantenimiento">Mantenimiento</option>
            </select>
          </div>

          <button type="submit"
                  class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none
                         focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5
                         dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
            Registrar
          </button>

        </form>
      </div>
    </div>
  </div>
</body>
</html>

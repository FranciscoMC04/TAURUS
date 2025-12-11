<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
  <title>Nueva Ficha</title>
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
        <form method="post" action="../../models/ficha.php"
              class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 w-full max-w-md">
          <input type="hidden" name="action" value="create">

          <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">
            Registrar nueva ficha
          </h2>

          <div class="mb-4">
            <label for="codigo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código</label>
            <input type="text" id="codigo" name="codigo" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" />
          </div>

          <div class="mb-4">
            <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
            <input type="text" id="titulo" name="titulo" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" />
          </div>

          <div class="mb-4">
            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Descripción
            </label>
            <textarea id="descripcion" name="descripcion" rows="3" required
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                             focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700"></textarea>
          </div>

          <div class="mb-4">
            <label for="fecha_inicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Fecha inicio
            </label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" />
          </div>

          <div class="mb-4">
            <label for="fecha_fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Fecha fin
            </label>
            <input type="date" id="fecha_fin" name="fecha_fin" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" />
          </div>

          <div class="mb-4">
            <label for="planificador_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Planificador ID
            </label>
            <input type="number" id="planificador_id" name="planificador_id" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" />
          </div>

          <div class="mb-4">
            <label for="guia_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Guía ID
            </label>
            <input type="number" id="guia_id" name="guia_id" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" />
          </div>

          <div class="mb-4">
            <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Estado
            </label>
            <select id="estado" name="estado"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
              <option value="publicado">Publicado</option>
              <option value="borrador">Borrador</option>
            </select>
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

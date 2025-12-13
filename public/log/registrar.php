<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
  <title>Nuevo Usuario</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">

  <div class="w-full min-h-[calc(100vh-4rem)] flex flex-col">

    <div class="flex-grow flex items-center justify-center">
      <form method="post" action="../app/models/usuarios.php"
        class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 w-full max-w-md">
        <input type="hidden" name="action" value="registrar">


        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">
          Registrar nuevo usuario
        </h2>

        <div class="mb-4">
          <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
          <input type="text" id="nombre" name="nombre" required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" />
        </div>

        <div class="mb-4">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
          <input type="email" id="email" name="email" required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" />
        </div>

        <div class="mb-4">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
          <input type="password" id="password" name="password" required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" />
        </div>

        <div class="mb-4">
          <label for="rol" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol</label>
          <select id="rol" name="rol"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700">
            <option value="admin">Admin</option>
            <option value="planificador">Planificador</option>
            <option value="piloto">Piloto</option>
            <option value="guia">Guía</option>
            <option value="turista">Turista</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Teléfono
          </label>
          <input type="text" id="telefono" name="telefono"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700" />
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
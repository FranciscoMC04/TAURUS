<?php

require '../../controllers/database/terramoza.php';

$terramozaObj = new Terramoza($conexion);
$terramozas = $terramozaObj->index();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
    <script src=""></script>
    <title>Terramoza</title>
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
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Teléfono</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($terramozas as $terramoza) { ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?= htmlspecialchars($terramoza['id']); ?>
                                    </th>
                                    <td class="px-6 py-4"><?= htmlspecialchars($terramoza['nombre']); ?></td>
                                    <td class="px-6 py-4"><?= htmlspecialchars($terramoza['telefono'] ?? 'N/A'); ?></td>

                                    <td class="px-6 py-4">
                                        <a href="editterra.php?id=<?= $terramoza['id']; ?>"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-3">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>

                                        <a href="../../models/terramoza.php?action=delete&id=<?= $terramoza['id']; ?>"
                                            onclick="return confirm('¿Estás seguro de eliminar el terramoza <?= htmlspecialchars($terramoza['nombre']); ?>?')"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div>
            <a href="newterra.php" type="button"
                class="fixed bottom-5 right-5 p-3 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

</body>

</html>
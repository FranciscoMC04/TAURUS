<?php

require_once '../../controllers/database/bus_controller.php'; 

$busObj = new Bus($conexion);
$buses = $busObj->index();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
    <title>Gestión de Buses</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">

    <?php include "../../../log/nav.php"; ?> 
    <div class="flex">
        <aside class="w-64 h-screen bg-gray-800 text-white fixed top-0 left-0 pt-16">
            <?php include "../../../log/sidebar.php"; ?> 
        </aside>

        <div class="ml-64 w-full pt-16 p-6 mt-6">
            <div class="mt-6 text-white">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Placa</th>
                                <th scope="col" class="px-6 py-3">Marca</th>
                                <th scope="col" class="px-6 py-3">Modelo</th>
                                <th scope="col" class="px-6 py-3">Capacidad</th>
                                <th scope="col" class="px-6 py-3">Estado</th>
                                <th scope="col" class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($buses) > 0) {
                                foreach ($buses as $bus) {
                            ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4"><?php echo htmlspecialchars($bus['placa']); ?></td>
                                        <td class="px-6 py-4"><?php echo htmlspecialchars($bus['marca']); ?></td>
                                        <td class="px-6 py-4"><?php echo htmlspecialchars($bus['modelo']); ?></td>
                                        
                                        <td class="px-6 py-4"><?php echo htmlspecialchars($bus['capacidad']); ?></td>
                                        <td class="px-6 py-4"><?php echo htmlspecialchars($bus['estado']); ?></td>
                                        <td class="px-6 py-4">
                                            <a href="edit.php?id=<?php echo $bus['id']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-3">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <a href="delete.php?id=<?php echo $bus['id']; ?>"
                                               onclick="return confirm('¿Estás seguro de eliminar el bus <?php echo htmlspecialchars($bus['placa']); ?>?')"
                                               class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No hay buses registrados</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

 
        <div>
            <a href="new.php" type="button" class="fixed bottom-5 right-5 p-3 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

</body>

</html>

<?php
require '../controllers/database/restaurante.php';

// Crear
if (isset($_POST['action']) && $_POST['action'] === 'create') {

    $restauranteObj = new Restaurante($conexion);
    $restauranteObj->store($_POST);
    header("Location: ../views/restaurante/index.php");
    exit();

}

// Actualizar
elseif (isset($_POST['action']) && $_POST['action'] === 'update') {

    $restauranteObj = new Restaurante($conexion);

    if (!isset($_POST['id'])) {
        die("ID no recibido para actualización");
    }

    $restauranteObj->update($_POST['id'], $_POST);

    header("Location: ../views/restaurante/index.php");
    exit();

}

// Eliminar
elseif (
    (isset($_POST['action']) && $_POST['action'] === 'delete') ||
    (isset($_GET['action']) && $_GET['action'] === 'delete')
) {

    $restauranteObj = new Restaurante($conexion);

    // Obtener ID
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } elseif (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        die("ID no recibido para eliminación");
    }

    $restauranteObj->destroy($id);

    header("Location: ../views/restaurante/index.php");
    exit();

}

// Si nada coincide
else {
    var_dump($_POST);
    exit;
}


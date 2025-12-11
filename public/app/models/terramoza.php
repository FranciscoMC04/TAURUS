<?php
require '../controllers/database/terramoza.php';

$terramozaObj = new Terramoza($conexion);

// Crear
if (isset($_POST['action']) && $_POST['action'] === 'create') {

    $terramozaObj->store($_POST);
    header("Location: ../views/terramoza/index.php");
    exit();
}

// Actualizar
elseif (isset($_POST['action']) && $_POST['action'] === 'update') {

    if (!isset($_POST['id'])) {
        die("ID no recibido para actualización");
    }

    $terramozaObj->update($_POST['id'], $_POST);
    header("Location: ../views/terramoza/index.php");
    exit();
}

// Eliminar (POST o GET)
elseif (
    (isset($_POST['action']) && $_POST['action'] === 'delete') ||
    (isset($_GET['action']) && $_GET['action'] === 'delete')
) {

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } elseif (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        die("ID no recibido para eliminación");
    }

    $terramozaObj->destroy($id);
    header("Location: ../views/terramoza/index.php");
    exit();
}

else {
    var_dump($_POST);
    exit;
}

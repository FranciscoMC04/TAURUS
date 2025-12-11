<?php
require '../controllers/database/guia.php';

if (isset($_POST['action']) && $_POST['action'] === 'create') {

    $guiaObj = new Guia($conexion);
    $guiaObj->store($_POST);
    header("Location: ../views/guia/index.php");
    exit();

} elseif (isset($_POST['action']) && $_POST['action'] === 'update') {

    $guiaObj = new Guia($conexion);

    if (!isset($_POST['id'])) {
        die("ID no recibido para actualización");
    }

    $guiaObj->update($_POST['id'], $_POST);
    header("Location: ../views/guia/index.php");
    exit();

} elseif (
    (isset($_POST['action']) && $_POST['action'] === 'delete') ||
    (isset($_GET['action']) && $_GET['action'] === 'delete')
) {

    $guiaObj = new Guia($conexion);

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } elseif (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        die("ID no recibido para eliminación");
    }

    $guiaObj->destroy($id);
    header("Location: ../views/guia/index.php");
    exit();

} else {
    var_dump($_POST);
    exit;
}

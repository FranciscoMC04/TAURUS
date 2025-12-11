<?php
require '../controllers/database/hotel.php';

if (isset($_POST['action']) && $_POST['action'] === 'create') {

    $hotelObj = new hotel($conexion);
    $hotelObj->create();
    header("Location: ../views/hotel/index.php");
    exit();

} elseif (isset($_POST['action']) && $_POST['action'] === 'update') {

    $hotelObj = new hotel($conexion);
    $hotelObj->update();
    header("Location: ../views/hotel/index.php");
    exit();

} elseif (
    (isset($_POST['action']) && $_POST['action'] === 'delete') ||
    (isset($_GET['action']) && $_GET['action'] === 'delete')
) {

    $hotelObj = new hotel($conexion);

    if (isset($_POST['id'])) {
        $_POST['id'] = $_POST['id'];
    } elseif (isset($_GET['id'])) {
        $_POST['id'] = $_GET['id'];
    }

    $hotelObj->delete();
    header("Location: ../views/hotel/index.php");
    exit();
} else {
    var_dump($_POST);
    exit;
}



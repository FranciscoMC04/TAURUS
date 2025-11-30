<?php


require_once '../../controllers/conexion.php';

$id = intval($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = $conexion->prepare("DELETE FROM bus WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}


header('Location: index.php');
exit();

<?php


require_once __DIR__ . '/../controllers/conexion.php';

$action = $_POST['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($action === 'create') {
        $placa      = trim($_POST['placa'] ?? '');
        $marca      = trim($_POST['marca'] ?? '');
        $modelo     = trim($_POST['modelo'] ?? '');
        $capacidad  = intval($_POST['capacidad'] ?? 0);
        $estado     = trim($_POST['estado'] ?? 'activo');

        $stmt = $conexion->prepare(
            "INSERT INTO bus (placa, marca, modelo, capacidad, estado)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssis", $placa, $marca, $modelo, $capacidad, $estado);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../views/bus/index.php");
            exit();
        } else {
            die("Error al guardar bus: " . $stmt->error);
        }
    }

    if ($action === 'update') {
        $id         = intval($_POST['id'] ?? 0);
        $placa      = trim($_POST['placa'] ?? '');
        $marca      = trim($_POST['marca'] ?? '');
        $modelo     = trim($_POST['modelo'] ?? '');
        $capacidad  = intval($_POST['capacidad'] ?? 0);
        $estado     = trim($_POST['estado'] ?? 'activo');

        if ($id <= 0) {
            header("Location: ../views/bus/index.php");
            exit();
        }

        $stmt = $conexion->prepare(
            "UPDATE bus
             SET placa = ?, marca = ?, modelo = ?, capacidad = ?, estado = ?
             WHERE id = ?"
        );
       
        $stmt->bind_param("sssisi", $placa, $marca, $modelo, $capacidad, $estado, $id);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../views/bus/index.php");
            exit();
        } else {
            die("Error al actualizar bus: " . $stmt->error);
        }
    }
}

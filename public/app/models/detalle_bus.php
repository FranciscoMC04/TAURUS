<?php

require_once __DIR__ . '/../controllers/conexion.php';

$action = $_POST['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($action === 'create') {

        $ficha_id         = intval($_POST['ficha_id'] ?? 0);
        $bus_id           = intval($_POST['bus_id'] ?? 0);
        $piloto_id        = intval($_POST['piloto_id'] ?? 0);
        $fecha_asignacion = $_POST['fecha_asignacion'] ?? null;
        $rol_onboard      = trim($_POST['rol_onboard'] ?? '');
        $observacion      = trim($_POST['observacion'] ?? '');

        $stmt = $conexion->prepare(
            "INSERT INTO detalle_bus (ficha_id, bus_id, piloto_id, fecha_asignacion, rol_onboard, observacion)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("iiisss",
            $ficha_id, $bus_id, $piloto_id, $fecha_asignacion, $rol_onboard, $observacion
        );

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../views/detalle_bus/index.php");
            exit();
        } else {
            die("Error al guardar detalle_bus: " . $stmt->error);
        }
    }

    if ($action === 'update') {

        $id              = intval($_POST['id'] ?? 0);
        $ficha_id        = intval($_POST['ficha_id'] ?? 0);
        $bus_id          = intval($_POST['bus_id'] ?? 0);
        $piloto_id       = intval($_POST['piloto_id'] ?? 0);
        $fecha_asignacion= $_POST['fecha_asignacion'] ?? null;
        $rol_onboard     = trim($_POST['rol_onboard'] ?? '');
        $observacion     = trim($_POST['observacion'] ?? '');

        if ($id <= 0) {
            header("Location: ../views/detalle_bus/index.php");
            exit();
        }

        $stmt = $conexion->prepare(
            "UPDATE detalle_bus
             SET ficha_id = ?, bus_id = ?, piloto_id = ?, fecha_asignacion = ?, rol_onboard = ?, observacion = ?
             WHERE id = ?"
        );
      
        $stmt->bind_param("iiisssi",
            $ficha_id, $bus_id, $piloto_id, $fecha_asignacion, $rol_onboard, $observacion, $id
        );

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../views/detalle_bus/index.php");
            exit();
        } else {
            die("Error al actualizar detalle_bus: " . $stmt->error);
        }
    }
}

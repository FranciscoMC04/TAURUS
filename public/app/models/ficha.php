<?php

require_once __DIR__ . '/../controllers/conexion.php';

$action = $_POST['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($action === 'create') {

        $codigo          = trim($_POST['codigo'] ?? '');
        $titulo          = trim($_POST['titulo'] ?? '');
        $descripcion     = trim($_POST['descripcion'] ?? '');
        $fecha_inicio    = $_POST['fecha_inicio'] ?? null;
        $fecha_fin       = $_POST['fecha_fin'] ?? null;
        $planificador_id = intval($_POST['planificador_id'] ?? 0);
        $guia_id         = intval($_POST['guia_id'] ?? 0);
        $estado          = trim($_POST['estado'] ?? 'publicado');

        $stmt = $conexion->prepare(
            "INSERT INTO ficha
             (codigo, titulo, descripcion, fecha_inicio, fecha_fin, planificador_id, guia_id, estado)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            "sssssiis",
            $codigo, $titulo, $descripcion, $fecha_inicio, $fecha_fin,
            $planificador_id, $guia_id, $estado
        );

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../views/ficha/index.php");
            exit();
        } else {
            die("Error al guardar ficha: " . $stmt->error);
        }
    }

    if ($action === 'update') {

        $id              = intval($_POST['id'] ?? 0);
        $codigo          = trim($_POST['codigo'] ?? '');
        $titulo          = trim($_POST['titulo'] ?? '');
        $descripcion     = trim($_POST['descripcion'] ?? '');
        $fecha_inicio    = $_POST['fecha_inicio'] ?? null;
        $fecha_fin       = $_POST['fecha_fin'] ?? null;
        $planificador_id = intval($_POST['planificador_id'] ?? 0);
        $guia_id         = intval($_POST['guia_id'] ?? 0);
        $estado          = trim($_POST['estado'] ?? 'publicado');

        if ($id <= 0) {
            header("Location: ../views/ficha/index.php");
            exit();
        }

        $stmt = $conexion->prepare(
            "UPDATE ficha
             SET codigo = ?, titulo = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ?,
                 planificador_id = ?, guia_id = ?, estado = ?
             WHERE id = ?"
        );
       
        $stmt->bind_param(
            "sssssiisi",
            $codigo, $titulo, $descripcion, $fecha_inicio, $fecha_fin,
            $planificador_id, $guia_id, $estado, $id
        );

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../views/ficha/index.php");
            exit();
        } else {
            die("Error al actualizar ficha: " . $stmt->error);
        }
    }
}

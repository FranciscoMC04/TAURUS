<?php

require_once __DIR__ . '/../controllers/conexion.php';

$action = $_POST['action'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($action === 'create') {

        $nombre   = trim($_POST['nombre'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $rol      = trim($_POST['rol'] ?? 'turista');
        $telefono = trim($_POST['telefono'] ?? '');


        $stmt = $conexion->prepare(
            "INSERT INTO usuarios (nombre, email, password, rol, telefono)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $nombre, $email, $password, $rol, $telefono);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../views/usuarios/index.php");
            exit();
        } else {
            die("Error al guardar usuario: " . $stmt->error);
        }
    }
    if ($action === 'registrar') {

        $nombre   = trim($_POST['nombre'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $rol      = trim($_POST['rol'] ?? 'turista');
        $telefono = trim($_POST['telefono'] ?? '');


        $stmt = $conexion->prepare(
            "INSERT INTO usuarios (nombre, email, password, rol, telefono)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $nombre, $email, $password, $rol, $telefono);

        if ($stmt->execute()) {
            $stmt->close();
            $_SESSION['usuario']    = $nombre;

            header("Location: ../../index.php");
            exit();
        } else {
            die("Error al guardar usuario: " . $stmt->error);
        }
    }
    if ($action === 'update') {

        $id       = intval($_POST['id'] ?? 0);
        $nombre   = trim($_POST['nombre'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $rol      = trim($_POST['rol'] ?? 'turista');
        $telefono = trim($_POST['telefono'] ?? '');

        if ($id <= 0) {
            header("Location: ../views/usuarios/index.php");
            exit();
        }

        $stmt = $conexion->prepare(
            "UPDATE usuarios
             SET nombre = ?, email = ?, password = ?, rol = ?, telefono = ?
             WHERE id = ?"
        );

        $stmt->bind_param("sssssi", $nombre, $email, $password, $rol, $telefono, $id);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../views/usuarios/index.php");
            exit();
        } else {
            die("Error al actualizar usuario: " . $stmt->error);
        }
    }
}

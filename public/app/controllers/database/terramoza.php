<?php
require_once __DIR__ . "/../conexion.php";

class Terramoza
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    // Mostrar todos
    public function index()
    {
        $sql = "SELECT * FROM terramoza";
        $result = $this->conexion->query($sql);

        if (!$result) {
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Mostrar uno por ID
    public function show($id)
    {
        $sql = "SELECT * FROM terramoza WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Crear terramoza
    public function store($data)
    {
        $sql = "INSERT INTO terramoza (nombre, telefono) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ss",
            $data['nombre'],
            $data['telefono']
        );

        return $stmt->execute();
    }

    // Actualizar terramoza
    public function update($id, $data)
    {
        $sql = "UPDATE terramoza SET nombre = ?, telefono = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "ssi",
            $data['nombre'],
            $data['telefono'],
            $id
        );

        return $stmt->execute();
    }

    // Eliminar terramoza
    public function destroy($id)
    {
        $sql = "DELETE FROM terramoza WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}


// =========================
// ACCIONES DIRECTAS (DELETE)
// =========================

$terramoza = new Terramoza($conexion);

if (isset($_GET['action'])) {

    if ($_GET['action'] === 'delete' && isset($_GET['id'])) {

        $terramoza->destroy($_GET['id']);

        header("Location: ../views/terramoza/index.php");
        exit();
    }
}

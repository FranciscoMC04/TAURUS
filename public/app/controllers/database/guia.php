<?php
require_once __DIR__ . "/../conexion.php";

class Guia
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function index() {
        $sql = "SELECT * FROM guia";
        $result = $this->conexion->query($sql);

        if (!$result) {
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function show($id)
    {
        $sql = "SELECT * FROM guia WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function store($data)
    {
        $sql = "INSERT INTO guia (nombre, certificacion, telefono) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sss",
            $data['nombre'],
            $data['certificacion'],
            $data['telefono']
        );
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE guia SET nombre = ?, certificacion = ?, telefono = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "sssi",
            $data['nombre'],
            $data['certificacion'],
            $data['telefono'],
            $id
        );

        return $stmt->execute();
    }

    public function destroy($id)
    {
        $sql = "DELETE FROM guia WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}


$guia = new Guia($conexion);

if (isset($_GET['action'])) {

    if ($_GET['action'] === 'delete' && isset($_GET['id'])) {

        $guia->destroy($_GET['id']);

        header("Location: ../views/guia/index.php");
        exit();
    }
}

<?php
require_once __DIR__ . "/../conexion.php";

class Restaurante
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    // Listar todos los restaurantes
    public function index()
    {
        $sql = "SELECT * FROM restaurante";
        $result = $this->conexion->query($sql);

        if (!$result) {
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Mostrar un restaurante por ID
    public function show($id)
    {
        $sql = "SELECT * FROM restaurante WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Crear restaurante
    public function store($data)
    {
        $sql = "INSERT INTO restaurante (nombre, direccion, tipo_comida, capacidad)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "sssi",
            $data['nombre'],
            $data['direccion'],
            $data['tipo_comida'],
            $data['capacidad']
        );

        return $stmt->execute();
    }

    // Actualizar restaurante
    public function update($id, $data)
    {
        $sql = "UPDATE restaurante 
                SET nombre = ?, direccion = ?, tipo_comida = ?, capacidad = ? 
                WHERE id = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "sssii",
            $data['nombre'],
            $data['direccion'],
            $data['tipo_comida'],
            $data['capacidad'],
            $id
        );

        return $stmt->execute();
    }

    // Eliminar restaurante
    public function destroy($id)
    {
        $sql = "DELETE FROM restaurante WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}


// ================================
//   MANEJO DIRECTO DE ELIMINAR
// ================================
$restaurante = new Restaurante($conexion);

if (isset($_GET['action'])) {

    if ($_GET['action'] === 'delete' && isset($_GET['id'])) {

        $restaurante->destroy($_GET['id']);

        header("Location: ../views/restaurante/index.php");
        exit();
    }
}


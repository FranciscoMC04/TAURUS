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


     // Traer restaurantes paginados
    public function getRestaurantesPaginados($limit = 4, $offset = 0)
    {
        $sql = "SELECT * FROM restaurante LIMIT ? OFFSET ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $restaurantes = [];
        while ($row = $result->fetch_assoc()) {
            $restaurantes[] = $row;
        }
        return $restaurantes;
    }

    // Contar total de restaurantes
    public function getTotalRestaurantes()
    {
        $sql = "SELECT COUNT(*) as total FROM restaurante";
        $result = $this->conexion->query($sql);
        $row = $result->fetch_assoc();
        return intval($row['total']);
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
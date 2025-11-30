<?php



require_once __DIR__ . '/../conexion.php';

class Usuario
{
    private $conn;

    public function __construct($conexion)
    {
        $this->conn = $conexion;
    }


    public function index()
    {
        $sql = "SELECT * FROM usuarios ORDER BY id ASC";
        $result = $this->conn->query($sql);

        $usuarios = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }

        return $usuarios;
    }

   
}

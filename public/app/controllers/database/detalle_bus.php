<?php

require_once __DIR__ . '/../conexion.php';

class DetalleBus
{
    private $conn;

    public function __construct($conexion)
    {
        $this->conn = $conexion;
    }

    
    public function index()
    {
        $sql = "SELECT * FROM detalle_bus ORDER BY fecha_asignacion DESC";
        $result = $this->conn->query($sql);

        $detalles = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $detalles[] = $row;
            }
        }

        return $detalles;
    }

 
}

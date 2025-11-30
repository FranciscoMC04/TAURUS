<?php


require_once dirname(__DIR__, 2) . '../controllers/conexion.php'; 


class Bus {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    
    public function index() {
        $sql = "SELECT * FROM bus"; 
        $result = $this->conexion->query($sql);

        $buses = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $buses[] = $row;
            }
        }
        return $buses;
    }
}

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
        $sql = "SELECT f.descripcion as descripcion, b.placa as bus, p.nombre as piloto, db.fecha_asignacion, db.rol_onboard, db.id, db.observacion FROM detalle_bus as db
        inner join ficha as f on db.ficha_id=f.id 
        inner join bus as b on db.bus_id=b.id
        inner join piloto as p on db.piloto_id=p.id
        ORDER BY fecha_asignacion DESC";
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

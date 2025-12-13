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
        $sql = "
            SELECT 
                f.titulo AS ficha_titulo,
                b.placa AS bus,
                p.nombre AS piloto,
                db.fecha_asignacion,
                db.rol_onboard,
                db.id,
                db.observacion
            FROM detalle_bus AS db
            INNER JOIN ficha AS f ON db.ficha_id = f.id
            INNER JOIN bus AS b ON db.bus_id = b.id
            INNER JOIN piloto AS p ON db.piloto_id = p.id
            ORDER BY db.fecha_asignacion DESC
        ";

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

<?php

require_once __DIR__ . '/../conexion.php';

class Ficha
{
    private $conn;

    public function __construct($conexion)
    {
        $this->conn = $conexion;
    }


    public function index()
    {
        $sql = "SELECT * FROM ficha ORDER BY fecha_inicio DESC";
        $result = $this->conn->query($sql);

        $fichas = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fichas[] = $row;
            }
        }

        return $fichas;
    }

    public function index2($orderBy = 'fecha_inicio DESC')
    {
        $sql = "SELECT id, titulo, descripcion, imagen FROM ficha ORDER BY $orderBy";
        $result = $this->conn->query($sql);

        $fichas = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fichas[] = $row;
            }
        }

        return $fichas;
    }
}

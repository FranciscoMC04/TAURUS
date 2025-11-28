<?php
require '../../controllers/conexion.php';

class Hotel
{
    private $conn;

    public function __construct($conexion)
    {
        $this->conn = $conexion;
    }


    public function create($nombre, $direccion, $telefono, $categoria)
    {
        $stmt = $this->conn->prepare("INSERT INTO hotel (nombre, direccion, telefono, categoria) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $nombre, $direccion, $telefono, $categoria);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }


    public function index()
    {
        $sql = "SELECT * FROM hotel ORDER BY id DESC";
        $result = $this->conn->query($sql);

        $hoteles = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $hoteles[] = $row;
            }
        }
        return $hoteles;
    }


    public function show($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM hotel WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $hotel = $result->fetch_assoc();
        $stmt->close();
        return $hotel;
    }


    public function update($id, $nombre, $direccion, $telefono, $categoria)
    {
        $stmt = $this->conn->prepare("UPDATE hotel SET nombre = ?, direccion = ?, telefono = ?, categoria = ? WHERE id = ?");
        $stmt->bind_param("sssii", $nombre, $direccion, $telefono, $categoria, $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }


    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM hotel WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }


    public function search($termino)
    {
        $termino = "%" . $termino . "%";
        $stmt = $this->conn->prepare("SELECT * FROM hotel WHERE nombre LIKE ? OR direccion LIKE ?");
        $stmt->bind_param("ss", $termino, $termino);
        $stmt->execute();
        $result = $stmt->get_result();

        $hoteles = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $hoteles[] = $row;
            }
        }
        $stmt->close();
        return $hoteles;
    }
}

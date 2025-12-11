<?php
$archivoActual = basename($_SERVER['SCRIPT_FILENAME']);

if ($archivoActual == 'index.php')
    require '../../controllers/conexion.php';
elseif ($archivoActual == 'update.php')
    require '../../controllers/conexion.php';
elseif ($archivoActual == 'hotel.php')
    require '../controllers/conexion.php';


class hotel
{
    private $conn;

    public function __construct($conexion)
    {
        $this->conn = $conexion;
    }

    public function create()
    {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $categoria = $_POST['categoria'];

        $stmt = $this->conn->prepare("INSERT INTO hotel (nombre, direccion, telefono, categoria) VALUES (?,?,?,?)");
        $stmt->bind_param("ssii", $nombre, $direccion, $telefono, $categoria);
        $stmt->execute();
        $stmt->close();
    }

    public function index()
    {
        $sql = "SELECT id, nombre, direccion, telefono, categoria FROM hotel";
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
        $stmt = $this->conn->prepare("SELECT id, nombre, direccion, telefono, categoria FROM hotel WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $hotel = $result->fetch_assoc();
        $stmt->close();

        return $hotel;
    }

    public function update()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $categoria = $_POST['categoria'];

        $stmt = $this->conn->prepare("UPDATE hotel 
            SET nombre = ?, direccion = ?, telefono = ?, categoria = ? 
            WHERE id = ?");
        $stmt->bind_param("ssiii", $nombre, $direccion, $telefono, $categoria, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function delete()
    {
        $id = $_POST['id'];

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

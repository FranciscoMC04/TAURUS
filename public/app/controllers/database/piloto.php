<?php
$archivoActual = basename($_SERVER['SCRIPT_FILENAME']);

if ($archivoActual == 'index.php')
  require '../../../controllers/conexion.php';
elseif ($archivoActual == 'update.php') {
  require '../../../controllers/conexion.php';
} elseif ($archivoActual == 'piloto.php') {
  require '../controllers/conexion.php';
}
class Piloto
{
  private $conn;

  public function __construct($conexion)
  {
    $this->conn = $conexion;
  }


  public function create()
  {
    $nombre = $_POST['nombre'];
    $licencia = $_POST['licencia'];
    $telefono = $_POST['telefono'];

    $stmt = $this->conn->prepare("INSERT INTO piloto (nombre, licencia, telefono) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $licencia, $telefono);

    if ($stmt->execute()) {
      $stmt->close();
      return true;
    }
    $stmt->close();
    return false;
  }


  public function index()
  {
    $sql = "SELECT * FROM piloto ORDER BY licencia DESC";
    $result = $this->conn->query($sql);

    $hoteles = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $hoteles[] = $row;
      }
    }
    return $hoteles;
  }


  public function show($licencia)
  {
    $stmt = $this->conn->prepare("SELECT * FROM  piloto WHERE licencia = ?");
    $stmt->bind_param("s", $licencia);
    $stmt->execute();
    $result = $stmt->get_result();
    $hotel = $result->fetch_assoc();
    $stmt->close();
    return $hotel;
  }

  public function update()
  {
    $nombre = $_POST['nombre'];
    $licencia = $_POST['licencia'];
    $telefono = $_POST['telefono'];
    $stmt = $this->conn->prepare("UPDATE piloto SET nombre = ?, telefono = ? WHERE licencia = ?");
    $stmt->bind_param("sss", $nombre, $telefono, $licencia);

    if ($stmt->execute()) {
      $stmt->close();
      return true;
    }
    $stmt->close();
    return false;
  }

  public function delete($licencia)
  {
    $stmt = $this->conn->prepare("DELETE FROM piloto WHERE licencia = ?");
    $stmt->bind_param("i", $licencia);

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
    $stmt = $this->conn->prepare("SELECT * FROM piloto WHERE nombre LIKE ? OR licencia LIKE ?");
    $stmt->bind_param("ss", $termino, $termino);
    $stmt->execute();
    $result = $stmt->get_result();

    $pilotos = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $pilotos[] = $row;
      }
    }
    $stmt->close();
    return $pilotos;
  }
}

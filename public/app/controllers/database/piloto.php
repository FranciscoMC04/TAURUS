<?php
// var_dump(__DIR__);
// exit;
require '../../../controllers/conexion.php';

class Piloto
{
  private $conn;

  public function __construct($conexion)
  {
    $this->conn = $conexion;
  }


  public function create($nombre, $licencia, $telefono)
  {
    $stmt = $this->conn->prepare("INSERT INTO piloto (nombre, licencia, telefono) VALUES (?, ?, ?)");
    $stmt->bind_param("sssi", $nombre, $licencia, $telefono);

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
    $stmt->bind_param("i", $licencia);
    $stmt->execute();
    $result = $stmt->get_result();
    $hotel = $result->fetch_assoc();
    $stmt->close();
    return $hotel;
  }


  public function update($nombre, $licencia, $telefono)
  {
    $stmt = $this->conn->prepare("UPDATE hotel SET nombre = ?, licencia = ?, telefono = ? WHERE licencia = ?");
    $stmt->bind_param("sssii", $nombre, $licencia, $telefono);

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

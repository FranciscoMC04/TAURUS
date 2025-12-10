<?php
$archivoActual = basename($_SERVER['SCRIPT_FILENAME']);
// 
if ($archivoActual == 'index.php')
  require '../../controllers/conexion.php';
elseif ($archivoActual == 'update.php') {
  require '../../controllers/conexion.php';
} elseif ($archivoActual == 'inscripcion.php') {
  require '../controllers/conexion.php';
}
class inscripcion
{
  private $conn;

  public function __construct($conexion)
  {
    $this->conn = $conexion;
  }


  public function create()
  {
    $descripcion = $_POST['descripcion'];
    $ficha_id = $_POST['ficha_id'];
    $nombre_turista = $_POST['nombre_turista'];
    $fecha_inscripcion = $_POST['fecha_inscripcion'];
    $confirmacion = $_POST['confirmacion'] ?? 0;


    $stmt = $this->conn->prepare("SELECT id FROM ficha WHERE descripcion = ?");
    $stmt->bind_param("s", $descripcion);
    $stmt->execute();
    $result = $stmt->get_result();
    $fichaData = $result->fetch_assoc();
    $ficha = $fichaData ? $fichaData['id'] : null;
    $stmt->close();


    $stmt = $this->conn->prepare("SELECT id FROM turista WHERE nombres = ?");
    $stmt->bind_param("s", $nombre_turista);
    $stmt->execute();
    $result = $stmt->get_result();
    $turistaData = $result->fetch_assoc();
    $turista = $turistaData ? $turistaData['id'] : null;
    $stmt->close();


    if ($turista === null) {
      return false;
    }

    $estado = ($confirmacion == 1) ? 'confirmado' : 'pendiente';


    $ficha_final = ($ficha !== null) ? $ficha : $ficha_id;

    $stmt = $this->conn->prepare("INSERT INTO inscripcion (ficha_id, turista_id, fecha_inscripcion, estado) VALUES (?,?,?,?)");
    $stmt->bind_param("iiss", $ficha_final, $turista, $fecha_inscripcion, $estado);

    if ($stmt->execute()) {
      $stmt->close();
      return true;
    }
    $stmt->close();
    return false;
  }


  public function index()
  {


    $sql = "SELECT inscripcion.id as id, f.descripcion as ficha,t.nombres as turista, fecha_inscripcion,inscripcion.estado FROM inscripcion 
    JOIN ficha AS f ON inscripcion.ficha_id = f.id 
    JOIN turista AS t ON inscripcion.turista_id = t.id 
    ORDER BY inscripcion.id DESC;";
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
    $stmt = $this->conn->prepare("SELECT inscripcion.id as id,f.descripcion as descripcion, t.nombres as turista,fecha_inscripcion,inscripcion.estado FROM inscripcion 
    JOIN ficha AS f ON inscripcion.ficha_id = f.id
    JOIN turista AS t ON inscripcion.turista_id = t.id 
    where inscripcion.id = ?
    ORDER BY inscripcion.id DESC");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $hotel = $result->fetch_assoc();
    $stmt->close();
    return $hotel;
  }

  public function update()
  {


    $descripcion = $_POST['descripcion'];
    $ficha_id = $_POST['ficha_id'];
    $nombre_turista = $_POST['nombre_turista'];
    $fecha_inscripcion = $_POST['fecha_inscripcion'];
    $confirmacion = $_POST['confirmacion'] ?? 0;
    $id = $_POST['id'];


    $stmt = $this->conn->prepare("SELECT id FROM ficha WHERE descripcion = ?");
    $stmt->bind_param("s", $descripcion);
    $stmt->execute();
    $result = $stmt->get_result();
    $fichaData = $result->fetch_assoc();
    $ficha = $fichaData ? $fichaData['id'] : null;
    $stmt->close();


    $stmt = $this->conn->prepare("SELECT id FROM turista WHERE nombres = ?");
    $stmt->bind_param("s", $nombre_turista);
    $stmt->execute();
    $result = $stmt->get_result();
    $turistaData = $result->fetch_assoc();
    $turista = $turistaData ? $turistaData['id'] : null;
    $stmt->close();


    if ($turista === null) {
      return false;
    }

    $estado = ($confirmacion == 'on') ? 'confirmado' : 'pendiente';


    $ficha_final = ($ficha !== null) ? $ficha : $ficha_id;

    $stmt = $this->conn->prepare("UPDATE inscripcion SET ficha_id = ?, turista_id = ?, fecha_inscripcion = ?, estado = ? WHERE id = ?");
    $stmt->bind_param("iissi", $ficha_final, $turista, $fecha_inscripcion, $estado, $id);

    $result = $stmt->execute();
    $affected = $stmt->affected_rows;

    var_dump("UPDATE resultado: " . ($result ? 'SUCCESS' : 'FAIL') . ", filas afectadas: $affected");

    if ($stmt->error) {
      var_dump("ERROR SQL: " . $stmt->error);
    }

    $stmt->close();
    return $result;
  }

  public function delete()
  {
    $id = $_POST['id'];

    $stmt = $this->conn->prepare("DELETE FROM inscripcion WHERE id = ?");
    $stmt->bind_param("s", $id);

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

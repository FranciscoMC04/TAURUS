<?php
$archivoActual = basename($_SERVER['SCRIPT_FILENAME']);
// 
if ($archivoActual == 'index.php')
  require '../../controllers/conexion.php';
elseif ($archivoActual == 'update.php') {
  require '../../controllers/conexion.php';
} elseif ($archivoActual == 'itinerario.php') {
  require '../controllers/conexion.php';
}
class itinerario
{
  private $conn;

  public function __construct($conexion)
  {
    $this->conn = $conexion;
  }


  public function create()
  {
      // Obtener último día y orden
      $sql = "SELECT dia, orden FROM itinerario ORDER BY id DESC LIMIT 1";
      $result = $this->conn->query($sql);

      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $dia = $row['dia'] + 1;
          $orden = $row['orden'] + 1;
      } else {
          $dia = 1;
          $orden = 1;
      }

      // Datos del formulario
      $fecha = $_POST['fecha'];
      $horaInicio = $_POST['hora_inicio'];
      $horaFin = $_POST['hora_fin'];
      $descripcion = $_POST['descripcion'];
      $fichaID = $_POST['ficha_id']; // 👈 DIRECTO DEL SELECT
      $hotel_nombre = $_POST['nombre_hotel'];
      $restaurante_nombre = $_POST['nombre_restaurante'];

      // Obtener ID del hotel
      $stmt = $this->conn->prepare("SELECT id FROM hotel WHERE nombre = ?");
      $stmt->bind_param("s", $hotel_nombre);
      $stmt->execute();
      $result = $stmt->get_result();
      $hotelData = $result->fetch_assoc();
      $hotelID = $hotelData ? $hotelData['id'] : null;
      $stmt->close();

      // Obtener ID del restaurante
      $stmt = $this->conn->prepare("SELECT id FROM restaurante WHERE nombre = ?");
      $stmt->bind_param("s", $restaurante_nombre);
      $stmt->execute();
      $result = $stmt->get_result();
      $restauranteData = $result->fetch_assoc();
      $restauranteID = $restauranteData ? $restauranteData['id'] : null;
      $stmt->close();

      // Insertar itinerario
      $stmt = $this->conn->prepare("
          INSERT INTO itinerario
          (dia, fecha, hora_inicio, hora_fin, descripcion, ficha_id, hotel_id, restaurante_id, orden)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
      ");

      $stmt->bind_param(
          "isssssiii",
          $dia,
          $fecha,
          $horaInicio,
          $horaFin,
          $descripcion,
          $fichaID,
          $hotelID,
          $restauranteID,
          $orden
      );

      $stmt->execute();
      $stmt->close();
  }


  public function index()
  {
      $sql = "
          SELECT 
              itinerario.id,
              itinerario.dia,
              itinerario.fecha,
              itinerario.hora_inicio,
              itinerario.hora_fin,
              itinerario.descripcion,
              itinerario.orden,
              h.nombre AS hotel,
              r.nombre AS restaurante,
              f.titulo AS ficha_titulo,
              f.codigo AS ficha_codigo
          FROM itinerario
          JOIN hotel h ON itinerario.hotel_id = h.id
          JOIN restaurante r ON itinerario.restaurante_id = r.id
          JOIN ficha f ON itinerario.ficha_id = f.id
          ORDER BY itinerario.orden ASC
      ";

      $result = $this->conn->query($sql);

      $data = [];
      if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $data[] = $row;
          }
      }
      return $data;
  }



  public function show($id)
  {
    $stmt = $this->conn->prepare("SELECT dia,fecha, hora_inicio, hora_fin,descripcion,  h.nombre as hotel,r.nombre as restaurante,orden FROM itinerario JOIN hotel AS h ON itinerario.hotel_id = h.id 
    JOIN restaurante AS r ON itinerario.restaurante_id = r.id 
    where itinerario.id = ?
    ORDER BY itinerario.id DESC");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $hotel = $result->fetch_assoc();
    $stmt->close();
    return $hotel;
  }

  public function update()
  {
      $dia = $_POST['dia'];
      $fecha = $_POST['fecha'];
      $horaInicio = $_POST['hora_inicio'];
      $horaFin = $_POST['hora_fin'];
      $descripcion = $_POST['descripcion'];
      $hotel_nombre = $_POST['nombre_hotel'];
      $restaurante_nombre = $_POST['nombre_restaurante'];
      $orden = $_POST['orden'];
      $id = $_POST['id'];

      // Hotel
      $stmt = $this->conn->prepare("SELECT id FROM hotel WHERE nombre = ?");
      $stmt->bind_param("s", $hotel_nombre);
      $stmt->execute();
      $result = $stmt->get_result();
      $hotelData = $result->fetch_assoc();
      $hotelID = $hotelData ? $hotelData['id'] : null;
      $stmt->close();

      // Restaurante
      $stmt = $this->conn->prepare("SELECT id FROM restaurante WHERE nombre = ?");
      $stmt->bind_param("s", $restaurante_nombre);
      $stmt->execute();
      $result = $stmt->get_result();
      $restauranteData = $result->fetch_assoc();
      $restauranteID = $restauranteData ? $restauranteData['id'] : null;
      $stmt->close();

      // Update
      $stmt = $this->conn->prepare("
          UPDATE itinerario 
          SET dia = ?, fecha = ?, hora_inicio = ?, hora_fin = ?, descripcion = ?, 
              hotel_id = ?, restaurante_id = ?, orden = ?
          WHERE id = ?
      ");

      $stmt->bind_param(
          "ssssssssi",
          $dia,
          $fecha,
          $horaInicio,
          $horaFin,
          $descripcion,
          $hotelID,
          $restauranteID,
          $orden,
          $id
      );

      $stmt->execute();
      $stmt->close();
  }

  public function delete()
  {
    $id = $_POST['id'];

    $stmt = $this->conn->prepare("DELETE FROM itinerario WHERE id = ?");
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

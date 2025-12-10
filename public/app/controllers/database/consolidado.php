<?php
$archivoActual = basename($_SERVER['SCRIPT_FILENAME']);
// 
if ($archivoActual == 'index.php')
  require '../../controllers/conexion.php';
elseif ($archivoActual == 'update.php') {
  require '../../controllers/conexion.php';
} elseif ($archivoActual == 'consolidado.php') {
  require '../controllers/conexion.php';
}
class consolidado
{
  private $conn;

  public function __construct($conexion)
  {
    $this->conn = $conexion;
  }


  public function create()
  {
    $codigo = $_POST['codigo'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $planificador = $_POST['planificador_id'];
    $nombre_guia = $_POST['nombre_guia'];
    $estado_num =  $_POST['estado'] ?? 0;

    $stmt = $this->conn->prepare("SELECT id FROM guia WHERE nombre = ?");
    $stmt->bind_param("s", $nombre_guia);
    $stmt->execute();
    $result = $stmt->get_result();
    $guiaData = $result->fetch_assoc();
    $guia = $guiaData['id'];
    $stmt->close();

    if ($estado_num == 1) {
      $estado = 'publicado';
    } else {
      $estado = 'borrador';
    }

    $stmt = $this->conn->prepare("INSERT INTO ficha (codigo, titulo, descripcion,fecha_inicio,fecha_fin,planificador_id,guia_id,estado) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssss", $codigo, $titulo, $descripcion, $fechaInicio, $fechaFin, $planificador, $guia, $estado);

    if ($stmt->execute()) {
      $stmt->close();
      return true;
    }
    $stmt->close();
    return false;
  }


  public function index()
  {
    $sql = "SELECT cv.id as id,f.descripcion as descripcion,total_turistas,total_gastos, total_ingresos,utilidad,observaciones FROM consolidado_viaje as cv
     JOIN ficha AS f ON cv.ficha_id = f.id ORDER BY cv.id DESC;";
    $result = $this->conn->query($sql);

    $hoteles = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $hoteles[] = $row;
      }
    }
    return $hoteles;
  }


  public function show($codigo)
  {
    $stmt = $this->conn->prepare("SELECT codigo, titulo, descripcion, fecha_inicio, fecha_fin, g.nombre as Guia,estado FROM ficha JOIN guia AS g ON ficha.guia_id = g.id 
    where codigo = ?
    ORDER BY codigo DESC");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();
    $hotel = $result->fetch_assoc();
    $stmt->close();
    return $hotel;
  }

  public function update()
  {

    $codigo = $_POST['codigo'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    // $planificador = $_POST['planificador_id'];
    $nombre_guia = $_POST['nombre_guia'];

    $estado_num = isset($_POST['estado']) ? 1 : 0;

    $stmt = $this->conn->prepare("SELECT id FROM guia WHERE nombre = ?");
    $stmt->bind_param("s", $nombre_guia);
    $stmt->execute();
    $result = $stmt->get_result();
    $guiaData = $result->fetch_assoc();
    $guia = $guiaData['id'];
    $stmt->close();
    if (!$guia) {
      echo " 
          <script>
            alert('Guia no encontrada. Por favor, verifica el nombre del guia.');
            window.location.href = '../views/ficha/update.php';
          </script>
        ";
      return false;
    }

    if ($estado_num == 1) {
      $estado = 'publicado';
    } else {
      $estado = 'borrador';
    }
    $codigo_original = $_POST['codigo_original'];

    $stmt = $this->conn->prepare("UPDATE ficha SET codigo = ?, titulo = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ?, guia_id = ?, estado = ? WHERE codigo = ?");
    $stmt->bind_param("ssssssss", $codigo, $titulo, $descripcion, $fechaInicio, $fechaFin, $guia, $estado, $codigo_original);

    if ($stmt->execute()) {
      $stmt->close();
      return true;
    }
    $stmt->close();
    return false;
  }

  public function delete()
  {
    $codigo = $_POST['codigo'];

    $stmt = $this->conn->prepare("DELETE FROM ficha WHERE codigo = ?");
    $stmt->bind_param("s", $codigo);

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

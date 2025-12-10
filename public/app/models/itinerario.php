
<?php
require '../controllers/database/itinerario.php';
if (isset($_POST['action']) && $_POST['action'] === 'create') {
  $itinerarioObj = new itinerario($conexion);
  $itinerarioObj->create();
  header("Location: ../views/itinerario/index.php");
  exit();
} elseif (isset($_POST['action']) && $_POST['action'] === 'update') {
  $itinerarioObj = new itinerario($conexion);
  $itinerarioObj->update();
  header("Location: ../views/itinerario/index.php");
  exit();
} elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
  $itinerarioObj = new itinerario($conexion);
  $itinerarioObj->delete();
  header("Location: ../views/itinerario/index.php");
  exit();
} else {

  var_dump($_POST);
  exit;
}

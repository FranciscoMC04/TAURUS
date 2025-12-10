
<?php
require '../controllers/database/inscripcion.php';

if (isset($_POST['action']) && $_POST['action'] === 'create') {
  $inscripcionObj = new inscripcion($conexion);
  $inscripcionObj->create();
  header("Location: ../views/inscripcion/index.php");
  exit();
} elseif (isset($_POST['action']) && $_POST['action'] === 'update') {
  $inscripcionObj = new inscripcion($conexion);
  $inscripcionObj->update();
  header("Location: ../views/inscripcion/index.php");
  exit();
} elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
  $inscripcionObj = new inscripcion($conexion);
  $inscripcionObj->delete();
  header("Location: ../views/inscripcion/index.php");
  exit();
} else {

  var_dump($_POST);
  exit;
}

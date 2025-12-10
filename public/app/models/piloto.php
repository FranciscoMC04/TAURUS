
<?php
require '../controllers/database/piloto.php';
if (isset($_POST['action']) && $_POST['action'] === 'create') {
  $pilotoObj = new Piloto($conexion);
  $pilotoObj->create();
  header("Location: ../views/personal/piloto/index.php");
  exit();
} elseif (isset($_POST['action']) && $_POST['action'] === 'update') {
  $pilotoObj = new Piloto($conexion);
  $pilotoObj->update();
  header("Location: ../views/personal/piloto/index.php");
  exit();
}elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
  $pilotoObj = new Piloto($conexion);
  $pilotoObj->delete();
  header("Location: ../views/personal/piloto/index.php");
  exit();
} else {

  var_dump($_POST);
  exit;
}

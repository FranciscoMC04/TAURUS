<?php
session_start();
require "../conexion.php";

$usuario  = $_POST['usuario'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE nombre = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {

  $user = $result->fetch_assoc();

  if ($password === $user['password']) {

    $_SESSION['id'] = $user['id'];
    $_SESSION['usuario']    = $user['nombre'];
    header("Location: ../../../index.php");

    exit;
  }
}
echo "<script>
    alert('Usuario o contraseña incorrectos');
    window.location.href = '../../../index.php';
</script>";
exit;


exit;

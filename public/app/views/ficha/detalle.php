<?php
session_start();

if (!isset($_SESSION['id'])) {
  header("Location: /TAURUS/public/log/login.php");
  exit;
}

require_once __DIR__ . "/../../controllers/conexion.php";









$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
  die("ID inválido");
}


$sql = "SELECT * FROM ficha WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
  die("Ficha no encontrada");
}

$ficha = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($ficha['titulo'] ?? 'Detalle') ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen p-8">

  <div class="max-w-4xl mx-auto bg-gray-800 rounded-xl p-6 shadow">
    <h1 class="text-3xl font-bold mb-4">
      <?= htmlspecialchars($ficha['titulo'] ?? '') ?>
    </h1>

    <p class="text-gray-300 mb-6">
      <?= htmlspecialchars($ficha['descripcion'] ?? '') ?>
    </p>

    <?php if (!empty($ficha['imagen']) && filter_var($ficha['imagen'], FILTER_VALIDATE_URL)): ?>

      <img class="rounded-lg mb-6 w-full max-h-[400px] object-cover"
           src="<?= htmlspecialchars($ficha['imagen']) ?>" alt="Imagen">
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-200">
    <p><b>Código:</b> <?= htmlspecialchars($ficha['codigo']) ?></p>
    <p><b>Fecha inicio:</b> <?= htmlspecialchars($ficha['fecha_inicio']) ?></p>
    <p><b>Fecha fin:</b> <?= htmlspecialchars($ficha['fecha_fin']) ?></p>
    <p><b>Estado:</b> <?= htmlspecialchars($ficha['estado']) ?></p>

    </div>

    <a href="/TAURUS/public/"
       class="inline-block mt-6 bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
       ⬅ Volver
    </a>
  </div>

</body>
</html>

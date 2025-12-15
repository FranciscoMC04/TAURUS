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

$preciosPorFicha = [
  1 => 1299.90,   
  2 => 899.50,    
  3 => 799.00,
  4 => 699.00,
  5 => 999.00,
  6 => 1200.00,
  7 => 305.00,
  8 => 499.00,
  9 => 299.00,
  10 => 599.00,
  11 => 459.00,
  12 => 639.00,
  13 => 789.00,
  14 => 799.00,
  15 => 419.00,
  16 => 199.00,
  17 => 209.00,
  18 => 899.00,    
  19 => 1499.99,   
  20 => 999.00     
];
$precio = $preciosPorFicha[$ficha['id']] ?? 850.00;

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($ficha['titulo']) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-900 to-gray-800 text-white min-h-screen">

  <div class="max-w-6xl mx-auto px-6 py-10">

    <!-- BOTÓN VOLVER -->
    <a href="/TAURUS/public/"
       class="inline-flex items-center mb-6 text-sm text-gray-300 hover:text-white transition">
       ← Volver a la lista
    </a>

    <!-- CARD PRINCIPAL -->
    <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">

      <!-- IMAGEN -->
      <?php if (!empty($ficha['imagen'])): ?>
        <div class="h-[420px] w-full">
          <img src="<?= htmlspecialchars($ficha['imagen']) ?>"
               class="w-full h-full object-cover"
               alt="Imagen del viaje">
        </div>
      <?php endif; ?>

      <!-- CONTENIDO -->
      <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- INFO PRINCIPAL -->
        <div class="lg:col-span-2">

          <h1 class="text-4xl font-bold mb-4">
            <?= htmlspecialchars($ficha['titulo']) ?>
          </h1>

          <p class="text-gray-300 leading-relaxed mb-6 text-lg">
            <?= nl2br(htmlspecialchars($ficha['descripcion'])) ?>
          </p>

          <!-- DETALLES -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-200">

            <div class="bg-gray-700/40 rounded-lg p-4">
              <p class="text-sm text-gray-400">📅 Fecha de inicio</p>
              <p class="font-semibold"><?= htmlspecialchars($ficha['fecha_inicio']) ?></p>
            </div>

            <div class="bg-gray-700/40 rounded-lg p-4">
              <p class="text-sm text-gray-400">🏁 Fecha de fin</p>
              <p class="font-semibold"><?= htmlspecialchars($ficha['fecha_fin']) ?></p>
            </div>

            <div class="bg-gray-700/40 rounded-lg p-4">
              <p class="text-sm text-gray-400">📌 Estado</p>
              <p class="font-semibold capitalize"><?= htmlspecialchars($ficha['estado']) ?></p>
            </div>

            <div class="bg-gray-700/40 rounded-lg p-4">
              <p class="text-sm text-gray-400">👤 Guía asignado</p>
              <p class="font-semibold">Disponible</p>
            </div>

          </div>
        </div>

        <!-- PANEL LATERAL -->
        <div class="bg-gray-900 rounded-xl p-6 flex flex-col justify-between">

          <!-- PRECIO -->
          <div>
            <p class="text-sm text-gray-400 mb-1">Precio por persona</p>
            <p class="text-4xl font-bold text-green-400 mb-4">
              S/. <?= number_format($precio, 2) ?>
            </p>

            <p class="text-sm text-gray-400 mb-6">
              Incluye transporte, guía turístico y visitas programadas.
            </p>
          </div>

          <!-- ACCIONES -->
          <div class="flex flex-col gap-3">

            <a href="/TAURUS/public/log/Dashboard.php"
               class="w-full bg-blue-600 hover:bg-blue-700 text-center py-3 rounded-lg font-semibold transition">
               Ir al Dashboard
            </a>

            <a href="/TAURUS/public/app/views/inscripcion/new.php"
               class="w-full bg-green-600 hover:bg-green-700 text-center py-3 rounded-lg font-semibold transition">
               Reservar ahora
            </a>

          </div>
        </div>

      </div>
    </div>
  </div>

</body>
</html>
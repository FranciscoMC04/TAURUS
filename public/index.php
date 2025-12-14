<?php

session_start();
require '../public/app/controllers/database/ficha.php';


/* ========= TRUCO HOTEL ========= */
$cwd = getcwd();
chdir(__DIR__ . '/app/controllers/database');
require 'hotel.php';
require 'restaurante.php';
chdir($cwd);
/* =============================== */


// ===== ORDEN =====
$orden = $_GET['orden'] ?? 'nuevos';
$tipo  = $_GET['tipo'] ?? 'viajes';


switch ($orden) {
  case 'titulo':
    $orderBy = 'titulo ASC';
    break;
  default:
    $orderBy = 'fecha_inicio DESC';
    break;
}
$fichaController = new Ficha($conexion);
$fichas = $fichaController->index2($orderBy);
// $usuarioLogueado = isset($_SESSION['usuario']);

$hotelController = new hotel($conexion);
$hoteles = $hotelController->index();

$restauranteController = new Restaurante($conexion);
$restaurantes = $restauranteController->index();
?>

<?php include "./log/nav.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Home</title>


<!-- Botón Flotante del Chatbot -->
<style>
.chat-float-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(37, 99, 235, 0.4);
    z-index: 1000;
    transition: all 0.3s ease;
    border: none;
    animation: bounce 2s infinite;
}

.chat-float-button:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 30px rgba(37, 99, 235, 0.6);
}

.chat-float-button span {
    font-size: 28px;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.chat-modal {
    display: none;
    position: fixed;
    bottom: 90px;
    right: 20px;
    z-index: 999;
    animation: slideUp 0.3s ease-out;
}

.chat-modal.active {
    display: block;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>


<button class="chat-float-button" onclick="toggleChat()" id="chatButton">
    <span>💬</span>
</button>


<div class="chat-modal" id="chatModal">
    <iframe src="chatbot.html" style="width: 450px; height: 650px; border: none; border-radius: 20px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);"></iframe>
</div>

<script>
function toggleChat() {
    const modal = document.getElementById('chatModal');
    const button = document.getElementById('chatButton');
    
    if (modal.classList.contains('active')) {
        modal.classList.remove('active');
        button.querySelector('span').textContent = '💬';
    } else {
        modal.classList.add('active');
        button.querySelector('span').textContent = '✖️';
    }
}
</script>


  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-900">

  <!-- PORTADA -->
  <figure class="mt-12">
    <img src="../public/img/buslogin.jpg" alt="Portada del Home"
      style="width: 100%; aspect-ratio: 3 / 1; object-fit: cover; object-position: center;">
  </figure>
  <!-- <div class="flex justify-end gap-3 p-4 bg-gray-900">

    <?php if (!$usuarioLogueado): ?>
      <a href="../public/log/login.php"
        class="text-white bg-blue-600 hover:bg-blue-700
              px-4 py-2 rounded-lg text-sm font-medium">
        Iniciar sesión
      </a>

      <a href="../public/log/registrar.php"
        class="text-white bg-green-600 hover:bg-green-700
              px-4 py-2 rounded-lg text-sm font-medium">
        Registrarse
      </a>
    <?php else: ?>
      <span class="text-gray-300 text-sm self-center">
        Sesión iniciada
      </span>

      <a href="../public/log/logout.php"
        class="text-white bg-red-600 hover:bg-red-700
              px-4 py-2 rounded-lg text-sm font-medium">
        Cerrar sesión
      </a>
    <?php endif; ?>

  </div> -->



  <!-- CONTENIDO -->
  <section class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 100rem; padding-bottom: 45px;">

    <h1 class="text-3xl text-gray-300 text-center font-semibold mt-6 mb-6">
      <!-- Lista de Viajes -->
        Viajes · Hoteles · Restaurantes

    </h1>

    <div class="flex gap-4">

      <div class="w-1/4 p-4 rounded-lg">
        <p class="text-lg text-gray-300 mb-2 font-semibold">Ordenar:</p>

        <form method="GET">
            <input type="hidden" name="tipo" value="<?= htmlspecialchars($tipo) ?>">

          <select name="orden"
            onchange="this.form.submit()"
            class="w-full border-gray-300 bg-gray-900 text-gray-300 rounded-md shadow-sm">

            <option value="nuevos" <?= ($orden === 'nuevos') ? 'selected' : '' ?>>
              Nuevos
            </option>

            <option value="titulo" <?= ($orden === 'titulo') ? 'selected' : '' ?>>
              Título (A - Z)
            </option>

          </select>
        </form><br><br>

        <!-- BOTONES -->
        <div class="mt-6">
          <p class="text-lg text-gray-300 mb-2 font-semibold">Mostrar:</p>

          <div class="flex flex-col gap-2">
            <a href="?tipo=viajes&orden=<?= $orden ?>"
              class="px-4 py-2 rounded-lg text-sm font-medium
              <?= ($tipo === 'viajes') ? 'bg-blue-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' ?>">
              Viajes
            </a>

            <a href="?tipo=hoteles&orden=<?= $orden ?>"
              class="px-4 py-2 rounded-lg text-sm font-medium
              <?= ($tipo === 'hoteles') ? 'bg-green-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' ?>">
              Hoteles
            </a>

            <a href="?tipo=restaurantes&orden=<?= $orden ?>"
              class="px-4 py-2 rounded-lg text-sm font-medium
              <?= ($tipo === 'restaurantes') ? 'bg-yellow-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' ?>">
              Restaurantes
            </a>
          </div>
        </div>

      </div>



      <div class="w-3/4  p-4 rounded-lg">

        <div class="flex flex-wrap gap-4">
 <!-- VIAJES -->
          <?php if ($tipo === 'viajes'): ?>

          <?php foreach ($fichas as $ficha): ?>
            <!-- <pre class="text-white"><?php var_dump($ficha); ?></pre> -->

            
            <article class="bg-gray-800 p-4 rounded-lg shadow-md flex w-full md:w-[48%]">

              <!-- IMAGEN -->
              <figure class="w-1/3 h-40">
                <img src="<?= htmlspecialchars($ficha['imagen']) ?>"
                 
                  class="w-full h-40 object-cover rounded-lg">
              </figure>

              <!-- CONTENIDO -->
              <div class="w-2/3 p-3 flex flex-col justify-between">


              <!-- TEXTO -->

                <div>
                  <h2 class="text-xl text-gray-300 font-semibold">
                    <?= htmlspecialchars($ficha['titulo']) ?>
                  </h2>

                  <hr class="my-2">

                  <p class="text-sm text-gray-300">
                    <?= substr($ficha['descripcion'], 0, 120) ?>...
                  </p>
                </div>

                <!-- <a href=""
                  class="mt-3 text-white bg-gray-700 hover:bg-gray-600 rounded-lg
                        text-sm px-4 py-2 text-center">
                  Ver ficha
                </a> -->


                  <!-- BOTONES (ABAJO DEL TEXTO) -->
                  <div class="mt-4 flex flex-col gap-2">

     <?php if (isset($_SESSION['usuario'])): ?>
     <a href="/TAURUS/public/app/views/ficha/detalle.php?id=<?= (int)$ficha['id'] ?>"
        class="w-full text-white bg-gray-700 hover:bg-gray-600 rounded-lg text-sm px-4 py-2 text-center">
        Ver ficha
     </a>
     <a href="/TAURUS/public/log/Dashboard.php"
        class="mt-3 text-white bg-gray-500 rounded-lg text-sm px-4 py-2 text-center">
        Ir al Dashboard
     </a>
     <?php else: ?>
     <a href="/TAURUS/public/log/login.php"
        class="mt-3 text-white bg-gray-500 rounded-lg text-sm px-4 py-2 text-center">
        <!-- Inicia sesión -->
         Mostrar más
     </a>
     
     <?php endif; ?>



              </div>
            </article>
          <?php endforeach; ?>

          <!-- HOTELES -->
          <?php elseif ($tipo === 'hoteles'): ?>

            <?php foreach ($hoteles as $hotel): ?>
              <article class="bg-gray-800 p-4 rounded-lg shadow-md flex w-full md:w-[48%]">
                <div class="w-full p-3">
                  <h2 class="text-xl text-gray-300 font-semibold"><?= htmlspecialchars($hotel['nombre']) ?></h2>
                  <hr class="my-2">
                  <p class="text-sm text-gray-300">📍 <?= htmlspecialchars($hotel['direccion']) ?></p>
                  <p class="text-sm text-gray-400">☎ <?= htmlspecialchars($hotel['telefono']) ?></p>
                  <p class="text-sm text-gray-400">⭐ Categoría: <?= htmlspecialchars($hotel['categoria']) ?></p>
                </div>
              </article>
            <?php endforeach; ?>

            <!-- RESTAURANTES -->
          <?php elseif ($tipo === 'restaurantes'): ?>

            <?php foreach ($restaurantes as $rest): ?>
              <article class="bg-gray-800 p-4 rounded-lg shadow-md flex w-full md:w-[48%]">
                <div class="w-full p-3">
                  <h2 class="text-xl text-gray-300 font-semibold"><?= htmlspecialchars($rest['nombre']) ?></h2>
                  <hr class="my-2">
                  <p class="text-sm text-gray-300">📍 <?= htmlspecialchars($rest['direccion']) ?></p>
                  <p class="text-sm text-gray-400">🍽 Tipo: <?= htmlspecialchars($rest['tipo_comida']) ?></p>
                  <p class="text-sm text-gray-400">👥 Capacidad: <?= htmlspecialchars($rest['capacidad']) ?></p>
                </div>
              </article>
            <?php endforeach; ?>

          <?php endif; ?>

        </div>
      </div>

    </div>
  </section>

</body>

</html>
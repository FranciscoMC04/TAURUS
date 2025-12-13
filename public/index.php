<?php

session_start();
require '../public/app/controllers/database/ficha.php';

// ===== ORDEN =====
$orden = $_GET['orden'] ?? 'nuevos';

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
$usuarioLogueado = isset($_SESSION['usuario']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Home</title>

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
  <div class="flex justify-end gap-3 p-4 bg-gray-900">

    <?php if (!$usuarioLogueado): ?>
      <a href="../public/log/login.php"
        class="text-white bg-blue-600 hover:bg-blue-700
              px-4 py-2 rounded-lg text-sm font-medium">
        Iniciar sesión
      </a>

      <a href="../public/log/registar.php"
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

  </div>

  <!-- CONTENIDO -->
  <section class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 100rem; padding-bottom: 45px;">

    <h1 class="text-3xl text-gray-300 text-center font-semibold mt-6 mb-6">
      Lista de Viajes
    </h1>

    <div class="flex gap-4">

      <div class="w-1/4 p-4 rounded-lg">
        <p class="text-lg text-gray-300 mb-2 font-semibold">Ordenar:</p>

        <form method="GET">
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
        </form>
      </div>


      <div class="w-3/4  p-4 rounded-lg">

        <div class="flex flex-wrap gap-4">

          <?php foreach ($fichas as $ficha): ?>
            <!-- <pre class="text-white"><?php var_dump($ficha); ?></pre> -->

            
            <article class="bg-gray-800 p-4 rounded-lg shadow-md flex w-full md:w-[48%]">

              <!-- IMAGEN -->
              <figure class="w-1/3 h-40">
                <img src="<?= htmlspecialchars($ficha['imagen']) ?>"
                  alt="<?= htmlspecialchars($ficha['titulo']) ?>"
                  class="w-full h-40 object-cover rounded-lg">
              </figure>

              <!-- CONTENIDO -->
              <div class="w-2/3 p-3 flex flex-col justify-between">

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

     <?php if (isset($_SESSION['id'])): ?>
     <a href="/TAURUS/public/app/views/ficha/detalle.php?id=<?= (int)$ficha['id'] ?>"
        class="mt-3 text-white bg-gray-700 hover:bg-gray-600 rounded-lg text-sm px-4 py-2 text-center">
        Ver ficha
     </a>
     <?php else: ?>
     <a href="/TAURUS/public/log/login.php"
        class="mt-3 text-white bg-gray-500 rounded-lg text-sm px-4 py-2 text-center">
        Inicia sesión
     </a>
     <?php endif; ?>



              </div>
            </article>
          <?php endforeach; ?>

          <?php if (empty($fichas)): ?>
            <p class="text-gray-300">No hay fichas registradas.</p>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </section>

</body>

</html>
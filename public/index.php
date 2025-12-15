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

// Controllers
$fichaController = new Ficha($conexion);
$fichas = $fichaController->index2($orderBy);

$hotelController = new hotel($conexion);
$hoteles = $hotelController->index();

$restauranteController = new Restaurante($conexion);
$restaurantes = $restauranteController->index();

// Traer fichas paginadas
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 4;
$offset = ($page - 1) * $limit;

$fichas = $fichaController->getFichasPaginadas($orderBy, $limit, $offset);
$totalFichas = $fichaController->getTotalFichas();
$totalPages = ceil($totalFichas / $limit);

// Traer hoteles paginados
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 4;
$offset = ($page - 1) * $limit;

$hoteles = $hotelController->getHotelesPaginados($limit, $offset);
$totalHoteles = $hotelController->getTotalHoteles();
$totalPages = ceil($totalHoteles / $limit);

// Traer restaurantes paginados
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 4;
$offset = ($page - 1) * $limit;

$restaurantes = $restauranteController->getRestaurantesPaginados($limit, $offset);
$totalRestaurantes = $restauranteController->getTotalRestaurantes();
$totalPages = ceil($totalRestaurantes / $limit);

?>

<?php include "./log/nav.php"; ?>

<?php if (isset($_SESSION['usuario'])): ?>
  <div class="fixed top-[11px] left-[1250px] z-[60] flex items-center">
    <i class="fa-solid fa-circle-info text-white shadow-md text-[15px]"></i>
    <a href="/TAURUS/public/log/Dashboard.php"
      class="px-3 py-1.5 text-[15px] font-semibold
              text-white hover:text-blue-100
              transition">
      Mas información
    </a>
    <div class="w-[2px] h-4 bg-white ml-[19px]"></div>
  </div>
<?php endif; ?> 

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

      0%,
      20%,
      50%,
      80%,
      100% {
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
  </style> <button class="chat-float-button" onclick="toggleChat()" id="chatButton"> <span>💬</span> </button>
  <div class="chat-modal" id="chatModal"> <iframe src="chatbot.html" style="width: 450px; height: 650px; border: none; border-radius: 20px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);"></iframe> </div>
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

  <!-- PORTADA / CARRUSEL -->
  <div class="relative mt-12">

    <!-- Carrusel -->
    <div id="home-carousel"
      class="relative w-full z-0"
      data-carousel="slide">

      <div class="relative h-[420px] overflow-hidden">

        <!-- Imagen 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="../public/img/buslogin.jpg"
            class="absolute w-full h-full object-cover">
        </div>

        <!-- Imagen 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="https://trexperienceperu.com/sites/default/files/2023-10/rainbow-mountain-trexperience.jpg"
            class="absolute w-full h-full object-cover">
        </div>

        <!-- Imagen 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="https://www.peru.travel/Contenido/General/Imagen/es/92/1.1/nor-yauyos-cochas.jpg"
            class="absolute w-full h-full object-cover">
        </div>

        <!-- Imagen 4 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="https://fullday.org/wp-content/uploads/2021/02/Top-de-paisajes-naturales-mas-bellos-del-Peru-1.jpg"
            class="absolute w-full h-full object-cover">
        </div>

      </div>
    </div>

    <!-- OVERLAY OSCURO -->
    <div class="absolute inset-0 bg-black/50 z-10 pointer-events-none"></div>

    <!-- TEXTO CENTRADO -->
    <div class="absolute inset-0 flex items-center justify-center z-20">
      <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white text-center drop-shadow-2xl">
        BUSCA TU PRÓXIMA AVENTURA
      </h1>
    </div>

  </div>
  <br>

  <!-- CONTENIDO -->
  <section class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 100rem; padding-bottom: 45px;">

    <div class="flex gap-4">

      <!-- FILTROS -->
      <div class="w-1/4 p-4 rounded-lg">

        <!-- ORDEN -->
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

      <!-- LISTADO -->
      <div class="w-3/4 p-4 rounded-lg">
        <div class="flex flex-wrap gap-4">

          <!-- VIAJES -->
          <?php if ($tipo === 'viajes'): ?>

            <?php foreach ($fichas as $ficha): ?>
              <article class="bg-gray-800 p-4 rounded-lg shadow-md flex items-center w-full md:w-[48%]">

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

                  <!-- BOTONES (ABAJO DEL TEXTO) -->
                  <div class="mt-4 flex flex-col gap-2">

                    <?php if (isset($_SESSION['usuario'])): ?>

                      <a href="/TAURUS/public/app/views/ficha/detalle.php?id=<?= (int)$ficha['id'] ?>"
                        class="w-full text-white bg-gray-700 hover:bg-gray-600 rounded-lg text-sm px-4 py-2 text-center">
                        Detalles del viaje
                      </a>

                    <?php else: ?>

                      <a href="/TAURUS/public/log/login.php"
                        class="w-full text-white bg-gray-500 hover:bg-gray-600 rounded-lg text-sm px-4 py-2 text-center">
                        Mostrar Más
                      </a>

                    <?php endif; ?>

                  </div>

                </div>
              </article>

            <?php endforeach; ?>


            <div class="mt-6 flex justify-between">
              <?php if ($page > 1): ?>
                <a href="?tipo=viajes&orden=<?= $orden ?>&page=<?= $page - 1 ?>"
                  class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">Anterior</a>
              <?php else: ?>
                <span></span>
              <?php endif; ?>

              <?php if ($page < $totalPages): ?>
                <a href="?tipo=viajes&orden=<?= $orden ?>&page=<?= $page + 1 ?>"
                  class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">Siguiente</a>
              <?php endif; ?>
            </div>


            <!-- HOTELES -->
          <?php elseif ($tipo === 'hoteles'): ?>
            <?php
            // Array con imágenes de hoteles (puedes agregar la que desees)
            $hotelImages = [
                1 => "https://x.cdrst.com/foto/hotel-sf/d6a4593/granderesp/foto-hotel-d6a3ae9.jpg",
                2 => "https://cf.bstatic.com/xdata/images/hotel/max500/506885383.jpg?k=17dfded1c59e68ec340e3fb4fe9581a76d14b9c6d72e245e0843bb92dbee2456&o=&hp=1",
                5 => "https://cdn.prod.website-files.com/67c809b5f63deab8a71cf757/67c809b5f63deab8a71d020d_LUX_MOBILE.jpg",
                6 => "https://r.profitroom.com/bthhotelboutiqueconcept/images/gallery/thumbs/500x500/cd9cf707-ea41-45cd-b007-f3999a6bd658.jpg?updated=2025-07-15_22-31",
                7 => "https://media.smartbox.com/pim/1000001966539464863775.jpg",
                8 => "https://www.hoteltrias.com/wp-content/uploads/2021/12/galeria-02-1-500x500.jpg",
                9 => "https://www.termotexsa.com/wp-content/uploads/2020/06/eurobuilding-hotel-and-suites-guyana-21-1-500x500.jpg",
                10 => "https://r.profitroom.com/bthhotellimagolf/images/gallery/thumbs/500x500/fba8edde-46b3-4fae-846c-f1fc485b7bf8.png?updated=2025-07-15_16-15",
                11 => "https://y.cdrst.com/foto/hotel-sf/d6a4595/granderesp/foto-hotel-d6a3aeb.jpg",
                12 => "https://mhtravelagencyweb.com/wp-content/uploads/2025/08/17Loews-Royal-Pacific-Resort-500x500.jpg.webp",
                13 => "https://mhtravelagencyweb.com/wp-content/uploads/2025/08/13Loews-Portofino-Bay-Hotel-500x500.webp",
                14 => "https://cf.bstatic.com/xdata/images/hotel/max500/286431104.jpg?k=a9cc24739cdb03d050844512c1cd23a36db44b33f259cb9575e7761619dc7226&o=&hp=1",
                15 => "https://images.trvl-media.com/lodging/1000000/880000/871800/871798/1b3078d4_y.jpg",
                16 => "https://romainfinita.com/wp-content/uploads/2024/10/5.jpg",
                17 => "https://r.profitroom.com/bthhotellimagolf/images/gallery/thumbs/500x500/e24a79c9-ef42-4839-b3be-7c2aa287879f.jpg?updated=2025-07-15_16-15",
                18 => "https://mhtravelagencyweb.com/wp-content/uploads/2025/08/11Disneys-Grand-Floridian-Resort-Spa-500x500.jpg.webp",
                19 => "https://images.trvl-media.com/lodging/118000000/117050000/117040500/117040469/9dc8c7ab_y.jpg",
                19 => "https://mhtravelagencyweb.com/wp-content/uploads/2025/08/8-Disneys-Art-of-Animation-Resort-500x500.jpg.webp",
                20 => "https://q-xx.bstatic.com/xdata/images/hotel/max500/437017025.jpg?k=1f9881d4c540991d05760529137bd7d98cc0bf554a359cb5e9f6a367bd3dbb86&o=",
                21 => "https://r.profitroom.com/bthhotellimagolf/images/gallery/thumbs/500x500/54687c22-e59b-470f-a897-bef64b9fbb37.png?updated=2025-07-15_16-15",
                22 => "https://q-xx.bstatic.com/xdata/images/hotel/max500/491316310.jpg?k=0233ab38eb9ecc4b8b7ee00e8eae8ac4f890b6b973be7141aedadb88603c0536&o=",
                23 => "https://z.cdrst.com/foto/hotel-sf/1105d3a4/granderesp/foto-hotel-1105c8fa.jpg",
                24 => "https://cf.bstatic.com/xdata/images/hotel/max1024x768/333375080.jpg?k=12ae0a32e53620732417786b9224657347aadea74b9250dcf4ded751fa1a9376&o=",   
                "default" => "https://cf.bstatic.com/xdata/images/hotel/max500/506885383.jpg?k=17dfded1c59e68ec340e3fb4fe9581a76d14b9c6d72e245e0843bb92dbee2456&o=&hp=1"
            ];
            ?>
            <?php foreach ($hoteles as $hotel): ?>
              <article class="bg-gray-800 p-4 rounded-lg shadow-md flex w-full md:w-[48%]">
                
                <!-- Imagen del hotel -->
                <figure class="w-[160px] h-[160px] md:h-[160px]">
                  <img 
                    src="<?= htmlspecialchars($hotelImages[$hotel['id']] ?? $hotelImages['default']) ?>" 
                    alt="<?= htmlspecialchars($hotel['nombre']) ?>" 
                    class="w-full h-full object-cover rounded-lg"
                  >
                </figure>

                <!-- Contenido del hotel -->
                <div class="w-2/3 p-3 flex flex-col justify-between">
                  <h2 class="text-xl text-gray-300 font-semibold"><?= htmlspecialchars($hotel['nombre']) ?></h2>
                  <hr class="my-2">
                  <p class="text-sm text-gray-300">📍 <?= htmlspecialchars($hotel['direccion']) ?></p>
                  <p class="text-sm text-gray-400">☎ <?= htmlspecialchars($hotel['telefono']) ?></p>
                  <p class="text-sm text-gray-400">⭐ Categoría: <?= htmlspecialchars($hotel['categoria']) ?></p>
                </div>

              </article>
            <?php endforeach; ?>

            <div class="mt-6 flex justify-between">
              <?php if ($page > 1): ?>
                <a href="?tipo=hoteles&page=<?= $page - 1 ?>"
                  class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">Anterior</a>
              <?php else: ?>
                <span></span>
              <?php endif; ?>

              <?php if ($page < $totalPages): ?>
                <a href="?tipo=hoteles&page=<?= $page + 1 ?>"
                  class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">Siguiente</a>
              <?php endif; ?>
            </div>

            <!-- RESTAURANTES -->
          <?php elseif ($tipo === 'restaurantes'): ?>

            <?php
            // Array con imágenes de restaurantes (puedes cambiar las URLs a las que quieras)
            $restImages = [
                1 => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/93/c0/92/nuestro-local-de-miraflores.jpg?w=500&h=-1&s=1",
                4 => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/ca/d5/d0/photo0jpg.jpg?w=500&h=-1&s=1",
                5 => "https://www.salvadordabahia.com/wp-content/uploads/2018/01/soho-marina-1-500x500.jpg",
                6 => "https://www.restaurantes-bcn.com/wp-content/uploads/2022/09/cachitos-diagonal-1-500x500.jpg",
                7 => "https://www.wien.info/resource/image/438648/1x1/500/500/4699cc4b358d0c271bba9090a032bbc7/9EBB440DEB1850DA5E6E8F761F1CB40B/pi-122022-restaurant-glasswing-im-hotel-amauris.webp",
                8 => "https://www.salvadordabahia.com/wp-content/uploads/2017/12/paladar-poro-2-500x500.jpg",
                9 => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/ca/d5/d0/photo0jpg.jpg?w=500&h=-1&s=1",
                10 => "https://www.restaurantes-bcn.com/wp-content/uploads/2025/05/oliva1-500x500.webp",
                11 => "https://amordmadre.com/wp-content/uploads/2025/08/WhatsApp-Image-2025-08-21-at-12.26.38-500x500.jpeg",
                12 => "https://newyorkdelibagel.com/ny/wp-content/uploads/2023/05/color-rojo.webp",
                13 => "https://amordmadre.com/wp-content/uploads/2020/04/28-scaled-500x500.jpg",
                14 => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/ca/d5/d0/photo0jpg.jpg?w=500&h=-1&s=1",
                15 => "https://www.salvadordabahia.com/wp-content/uploads/2018/01/soho-marina-1-500x500.jpg",
                16 => "https://www.restaurantes-bcn.com/wp-content/uploads/2022/09/cachitos-diagonal-1-500x500.jpg",
                17 => "https://www.salvadordabahia.com/wp-content/uploads/2017/12/paladar-poro-6-500x500.jpg",
                18 => "https://www.diegocoquillat.com/wp-content/uploads/2023/04/diegocoquillat_diseo_real_del_interior_de_un_restaurante_sofist_a05f4cae-19ad-4735-a3e1-2057ee8fc3ef-1.png",
                20 => "https://axwwgrkdco.cloudimg.io/v7/__gmpics3__/1c0de45d43c64927b183217f22aeb56b.jpeg",
                23 => "https://cdn.thefork.com/tf-lab/image/upload/w_500,h_500,c_fill,q_auto,f_auto,g_auto:subject/restaurant/ca55e335-686d-43cc-807a-d32cf3f1931b/985cc14e-d635-4ad7-8900-c012f475b79c.jpg",
                24 => "https://www.vivirbonito.com.mx/wp-content/uploads/mostradores-restaurantes-02-500x500.jpeg",
                "default" => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/91/1b/81/photo0jpg.jpg?w=500&h=-1&s=1"
            ];
            ?>

            <?php foreach ($restaurantes as $rest): ?>
              <article class="bg-gray-800 p-4 rounded-lg shadow-md flex w-full md:w-[48%]">
                
                <!-- Imagen del restaurante -->
                <figure class="w-[160px] h-[160px] md:h-[160px]">
                  <img 
                    src="<?= htmlspecialchars($restImages[$rest['id']] ?? $restImages['default']) ?>" 
                    alt="<?= htmlspecialchars($rest['nombre']) ?>" 
                    class="w-full h-full object-cover rounded-lg"
                  >
                </figure>

                <!-- Contenido del restaurante -->
                <div class="w-2/3 p-3 flex flex-col justify-between">
                  <h2 class="text-xl text-gray-300 font-semibold"><?= htmlspecialchars($rest['nombre']) ?></h2>
                  <hr class="my-2">
                  <p class="text-sm text-gray-300">📍 <?= htmlspecialchars($rest['direccion']) ?></p>
                  <p class="text-sm text-gray-400">🍽 Tipo: <?= htmlspecialchars($rest['tipo_comida']) ?></p>
                  <p class="text-sm text-gray-400">👥 Capacidad: <?= htmlspecialchars($rest['capacidad']) ?></p>
                </div>

              </article>
            <?php endforeach; ?>

            <div class="mt-6 flex justify-between">
              <?php if ($page > 1): ?>
                <a href="?tipo=restaurantes&page=<?= $page - 1 ?>"
                  class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">Anterior</a>
              <?php else: ?>
                <span></span>
              <?php endif; ?>

              <?php if ($page < $totalPages): ?>
                <a href="?tipo=restaurantes&page=<?= $page + 1 ?>"
                  class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">Siguiente</a>
              <?php endif; ?>
            </div>
          <?php endif; ?>

        </div>
      </div>

    </div>
  </section>

</body>

<article class="h-[400px] w-full overflow-hidden rounded-lg shadow-md relative bg-gray-800">
  <div class="h-full w-full">
    <img src="https://www.peru.travel/Contenido/General/Imagen/es/92/1.1/nor-yauyos-cochas.jpg"
         class="h-full w-full object-cover">
  </div>

  <!-- Overlay oscuro para resaltar texto -->
  <div class="absolute inset-0 bg-black/50 flex items-center justify-center px-6">
    <div class="flex flex-col md:flex-row items-center justify-between w-full max-w-6xl text-white">
      
      <!-- Texto -->
      <div class="mb-4 md:mb-0 md:w-2/3">
        <h2 class="text-3xl md:text-4xl font-bold mb-2">Ayúdanos a crecer</h2>
        <p class="text-lg md:text-xl text-gray-200">
          Tu apoyo nos permite seguir ofreciendo experiencias únicas con TAURUS.
          ¡Escanea el QR de Yape y colabora para que sigamos adelante!
        </p>
      </div>

      <!-- QR -->
      <div class="md:w-1/3 flex justify-center md:justify-end">
        <img src="../public/img/qr.jpg" alt="QR de Yape" class="h-40 w-40 object-contain rounded-lg shadow-lg">
      </div>

    </div>
  </div>
</article>


<!-- FOOTER -->
<footer class="bg-gray-900 text-gray-300 border-t border-gray-800">
  <div class="max-w-8xl mx-auto px-6 py-12 lg:py-16 grid grid-cols-1 md:grid-cols-3 gap-16 justify-items-center">

    <!-- Sección 1: Sobre la empresa -->
    <div class="text-center md:text-left">
      <h3 class="text-xl font-semibold text-white mb-4">Experiencia de viaje</h3>
      <p class="text-gray-400 mb-4">
        Descubre los mejores viajes, hoteles y restaurantes en Perú.
        Vive aventuras únicas y experiencias inolvidables con nosotros.
      </p>
      <p class="text-gray-400 text-sm">© 2025 TAURUS. Todos los derechos reservados.</p>
    </div>

    <!-- Sección 2: Enlaces rápidos -->
    <div class="text-center md:text-left">
      <h3 class="text-xl font-semibold text-white mb-4">Enlaces Rápidos</h3>
      <ul class="space-y-2">
        <li><a href="?tipo=viajes" class="hover:text-blue-500 transition">Viajes</a></li>
        <li><a href="?tipo=hoteles" class="hover:text-green-500 transition">Hoteles</a></li>
        <li><a href="?tipo=restaurantes" class="hover:text-yellow-500 transition">Restaurantes</a></li>
        <li><a href="/TAURUS/public/log/Dashboard.php" class="hover:text-blue-500 transition">Dashboard</a></li>
      </ul>
    </div>

    <!-- Sección 3: Contacto y redes sociales -->
    <div class="text-center md:text-left">
      <h3 class="text-xl font-semibold text-white mb-4">Contacto</h3>
      <p class="text-gray-400 mb-2">📍 Trujillo, Perú</p>
      <p class="text-gray-400 mb-2">📧 info@taurus.com</p>
      <p class="text-gray-400 mb-4">☎ +51 947 875 220</p>

      <div class="flex justify-center md:justify-start space-x-4">
        <a href="#" class="text-gray-400 hover:text-blue-500 transition"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="text-gray-400 hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-gray-400 hover:text-pink-500 transition"><i class="fab fa-instagram"></i></a>
        <a href="#" class="text-gray-400 hover:text-red-600 transition"><i class="fab fa-youtube"></i></a>
      </div>
    </div>

  </div>
</footer>

</html>
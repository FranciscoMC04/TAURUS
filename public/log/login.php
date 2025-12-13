

<!DOCTYPE html>
<html lang="es" class="h-full">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full relative overflow-hidden">

    <!-- FONDO PICSUM -->
    <img src="https://picsum.photos/1920/1080?transport,bus,road"
        class="fixed inset-0 w-screen h-screen object-cover z-0"
        alt="Fondo">

    <!-- OVERLAY OSCURO -->
    <div class="fixed inset-0 bg-black/50 z-10"></div>

    <!-- CONTENIDO -->
    <div class="relative z-20 flex items-center justify-center h-full">

        <div class="backdrop-blur-md bg-white/20 p-8 rounded-xl shadow-2xl w-80">

            <h2 class="text-2xl font-bold text-white text-center mb-6">
                Iniciar Sesión
            </h2>

            <form action="../app/controllers/database/login.php" method="POST">

                <label class="text-white font-semibold">Usuario</label>
                <input name="usuario" required
                    class="w-full p-2 mb-4 rounded bg-white/30 text-white">

                <label class="text-white font-semibold">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full p-2 mb-4 rounded bg-white/30 text-white">

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700
                   text-white py-2 rounded">
                    Ingresar
                </button>

            </form>


        </div>
    </div>

</body>

</html>
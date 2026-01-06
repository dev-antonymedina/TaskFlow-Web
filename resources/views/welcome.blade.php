<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow | Organiza tu vida</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="antialiased h-screen flex flex-col overflow-hidden bg-taskflow">
  
    <!-- NAVBAR -->
    <nav class="flex justify-between items-center px-4 py-2 shadow-sm" style="background-color: #630000;">
        <div class="flex items-center"> <img src="{{ asset('drawables/icono.png') }}" alt="logo"
                class="h-7 w-auto object-contain">
            <h2 class="title-navbar ml-2">TASKFLOW</h2>
        </div>
        <div class="space-x-3 text-sm"> <a href="/login"
                class="inline-block px-4 py-2 border border-white text-white rounded-lg hover:bg-white/10 transition">Iniciar
                sesión</a> <a href="/register"
                class="inline-block px-4 py-2 border border-white text-white rounded-lg hover:bg-white/10 transition">Crear
                cuenta</a> </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex items-center justify-center px-4">
        <!-- CARD GLASS CENTRADA -->
        <section class="card-glass w-medium max-w-md md:max-w-lg text-center">
            <div class="card-content">
                <h1 class="card-title">Bienvenido a TaskFlow 😁</h1>
                <p class="card-subtitle">Gestiona tus tareas de manera simple, organizada y eficiente.</p>

                <div class="mt-4">
                    <button class="btn" onclick="location.href='/login'">Iniciar sesión</button>
                </div>
            </div>
        </section>
    </main>


    <!-- SIMPLE FOOTER -->
    <footer class="card-glass text-center text-sm text-black" style="margin-top: auto;">
        <p>© <?php echo date('Y'); ?> TaskFlow</p>
    </footer>

</body>

</html>
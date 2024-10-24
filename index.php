<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Header y Sección</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/principal.css">
</head>
<body>
    <header class="bg-primary text-white text-center p-3">
        <h1>ChatBox</h1>
    </header>
    <section class="d-flex" style="height: 90vh;">
        <div class="w-50 d-flex align-items-center justify-content-center p-4 border">
            <img src="./img/unnamed.png" alt="Imagen de ejemplo" class="img-fluid">
        </div>
        <div class="w-50 d-flex flex-column justify-content-center align-items-center p-4 border">
            <h2>Bienvenido a ChatBox!</h2>
            <p><strong>Web de mensajería</strong></p>
            <p>¡Acepta y comunícate con tus conocidos! Unidos en un mundo más conectado.</p>
            <div class="mt-3">
                <a href="./actions/login.php" class="btn btn-primary me-2">Login up</a>
                <a href="./actions/resgistro.php" class="btn btn-info">Registrarse</a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

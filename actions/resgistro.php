<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Header y Sección</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/principal.css">
</head>
<body>
    <section class="d-flex" style="height: 100vh;">
        <div class="w-50 d-flex align-items-center justify-content-center p-4 border">
            <img src="../img/unnamed.png" alt="Imagen de ejemplo" class="img-fluid">
        </div>
        <div class="w-50 d-flex flex-column justify-content-center align-items-center p-4 border">
            <h2>REGISTRARSE</h2>
            <p><strong>Conectados siempre!</strong></p>
            <p>Crea un nuevo perfil de usuario</p>
            <form action="../validations/verificarRegistro.php" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu correo electrónico">
                </div>
                <br>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Introduce tu email">
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Introduce tu contraseña">
                    <span id="errorPwd"></span>
                </div>
                <br>
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Introduce tu usuario">
                    <span id="errorPwd"></span>
                </div>
                <br>
                <div id="teo">
                    <input type="submit" name="userRegistro" value="Iniciar Sesión" class="btn btn-primary">
                </div>
            </form>
            <div class="mt-3">
                <a href="login.php" class="btn btn-primary me-2">Login up</a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

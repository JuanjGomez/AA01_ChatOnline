<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Header y Sección</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.min.css" integrity="sha256-qWVM38RAVYHA4W8TAlDdszO1hRaAq0ME7y2e9aab354=" crossorigin="anonymous">
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
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre real">
                    <span id="errorNombre" class="errorRed"></span>
                    <?php if(isset($_GET['nombreVacio'])){ echo "<p class='errorRed'>El campo no puede estar vacio.</p>"; } ?>
                    <?php if(isset($_GET['nombreMal'])){ echo "<p class='errorRed'>El campo solo debe tener letras.</p>"; } ?>
                    <?php if(isset($_GET['nombreLongitud'])){ echo "<p class='errorRed'>El campo debe tener mas de 2 caracteres.</p>"; } ?>
                </div>
                <br>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Introduce tu email">
                    <span id="errorEmail" class="errorRed"></span>
                    <?php if(isset($_GET['emailVacio'])){ echo "<p class='errorRed'>El campo no puede estar vacio.</p>"; } ?>
                    <?php if(isset($_GET['emailMal'])){ echo "<p class='errorRed'>El campo debe ser un email valido.</p>"; } ?>
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Introduce tu contraseña">
                    <span id="errorPwd" class="errorRed"></span>
                    <?php if(isset($_GET['passwordVacio'])){ echo "<p class='errorRed'>El campo no puede estar vacio.</p>"; } ?>
                    <?php if(isset($_GET['passwordCorto'])){ echo "<p class='errorRed'>El campo debe tener mas de 6 caracteres.</p>"; } ?>
                </div>
                <br>
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Introduce tu nombre de usuario">
                    <span id="errorUser" class="errorRed"></span>
                    <?php if(isset($_GET['usuarioVacio'])){ echo "<p class='errorRed'>El campo no puede estar vacio.</p>"; } ?>
                    <?php if(isset($_GET['userMal'])){ echo "<p class='errorRed'>El campo solo debe tener letras.</p>"; } ?>
                    <?php if(isset($_GET['userLongitud'])){ echo "<p class='errorRed'>El campo debe tener mas de 2 caracteres.</p>"; } ?>
                </div>
                <br>
                <div id="teo">
                    <input type="submit" name="userRegistro" value="Iniciar Sesión" class="btn btn-primary">
                </div>
            </form>
            <div class="mt-3">
                <a href="login.php" class="btn btn-primary me-2">Login up</a>
                <a href="../index.php" class="btn btn-info">Inicio</a>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../validations/js/registro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js" integrity="sha256-WLPV1xrJUZx5TVzM44uDSNXrc7bXOMxSsbrQ/FC9x7M=" crossorigin="anonymous"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.get('error') == '2'){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Los campos deben introducirse de manera correcta.'
            });
        }
    </script>
</body>
</html>

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
            <h2>INICIO SESION</h2>
            <p><strong>Conectados siempre!</strong></p>
            <p>Inicia para conectarte al mundo</p>
            <form action="../validations/verificarUser.php" method="POST">
                <div class="form-group">
                    <label for="user">Nombre de usuario o real:</label>
                    <input type="text" class="form-control" id="user" name="user" aria-describedby="emailHelp" placeholder="Ingresa tu correo electrónico">
                    <span id="errorUser"></span>
                    <?php if(isset($_GET['userVacio'])){ echo "El campo de usuario no puede estar vacío."; } ?>
                    <?php if(isset($_GET['userMal'])){ echo "El campo solo debe tener letras."; } ?>
                </div>
                <br>
                <div class="form-group">
                    <label for="pwd">Contraseña</label>
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Ingresa tu contraseña">
                    <span id="errorPwd"></span>
                    <?php if(isset($_GET['pwdVacio'])){ echo "El campo de contraseña no puede estar vacío."; }?>
                    <?php if(isset($_GET['pwdMal'])){ echo "El campo debe tener mas de 6  caracteres."; }?>
                </div>
                <br>
                <div id="teo">
                    <input type="submit" value="Iniciar Sesión" class="btn btn-primary">
                </div>
            </form>
            <div class="mt-3">
                <a href="../index.php" class="btn btn-primary me-2">Inicio</a>
                <a href="./resgistro.php" class="btn btn-info">REGISTRARSE</a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
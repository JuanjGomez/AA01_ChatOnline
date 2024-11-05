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
            <h2>INICIO SESION</h2>
            <p><strong>Conectados siempre!</strong></p>
            <p>Inicia para conectarte al mundo</p>
            <form action="../validations/verificarUser.php" method="POST">
                <div class="form-group">
                    <label for="user">Nombre de usuario o real:</label>
                    <input type="text" class="form-control" id="user" name="user" placeholder="Ingresa tu nombre o usuario">
                    <span id="errorUser" class="errorRed"></span>
                    <?php if(isset($_GET['userVacio'])){ echo "<p class='errorRed'>El campo de usuario no puede estar vacío.</p>"; } ?>
                    <?php if(isset($_GET['userMal'])){ echo "<p class='errorRed'>El campo solo debe tener letras.</p>"; } ?>
                    <?php if(isset($_GET['userLargo'])){ echo "<p class='errorRed'>El campo debe tener 2 letras a mas.</p>"; } ?>
                </div>
                <br>
                <div class="form-group">
                    <label for="pwd">Contraseña</label>
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Ingresa tu contraseña">
                    <span id="errorPwd" class="errorRed"></span>
                    <?php if(isset($_GET['pwdVacio'])){ echo "<p class='errorRed'>El campo de contraseña no puede estar vacío.</p>"; }?>
                    <?php if(isset($_GET['pwdMal'])){ echo "<p class='errorRed'>El campo debe tener mas de 6  caracteres.</p>"; }?>
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
    <script src="../validations/js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js" integrity="sha256-WLPV1xrJUZx5TVzM44uDSNXrc7bXOMxSsbrQ/FC9x7M=" crossorigin="anonymous"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.get('error') == '2'){
            swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Los campos deben llenarse de manera correcta.'
            })
        }
        if(urlParams.get('error') == '5'){
            swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Datos incorrectos.'
            })
        }
        if(urlParams.get('error') == '4'){
            swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Datos incorrectos.'
            })
        }
    </script>
</body>
</html>
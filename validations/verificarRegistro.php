<?php
// Verifica si el formulario ha sido enviado
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location:../actions/resgistro.php?error=1');
} else {
    // Escapar los valores enviados para evitar inyecciones de código
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $usuario = htmlspecialchars($_POST['usuario']);

    $errores = ''; // Inicializamos la variable de errores
    require_once '../functions/campofunction.php';
    // Validación del nombre
    if(validaCampo($nombre)){
        $errores .= ($errores === '') ? '?nombreVacio=true' : '&nombreVacio=true';
    } elseif(!ctype_alpha($nombre)){
        $errores .= ($errores === '') ? '?nombreMal=true' : '&nombreMal=true';
    } elseif(strlen($nombre) < 2){
        $errores .= ($errores === '') ? '?nombreLongitud=true' : '&nombreLongitud=true';
    }

    // Validación del email
    if(validaCampo($email)){
        $errores .= ($errores === '') ? '?emailVacio=true' : '&emailVacio=true';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores .= ($errores === '') ? '?emailInvalido=true' : '&emailInvalido=true';
    }

    // Validación de la contraseña
    if(validaCampo($password)){
        $errores .= ($errores === '') ? '?passwordVacio=true' : '&passwordVacio=true';
    } elseif(strlen($password) < 6){
        $errores .= ($errores === '') ? '?passwordCorto=true' : '&passwordCorto=true';
    }
    // Validación del usuario
    if(validaCampo($usuario)){
        $errores .= ($errores === '') ? '?usuarioVacio=true' : '&usuarioVacio=true';
    } elseif(!ctype_alpha($usuario)){
        $errores .= ($errores === '') ? '?userMal=true' : '&userMal=true';
    } elseif(strlen($usuario) < 2){
        $errores .= ($errores === '') ? '?userLongitud=true' : '&userLongitud=true';
    }
    // Si hay errores, redirigir con los errores
    if($errores !== ''){
        // Ajustar los datos a devolver
        $datosRecibidos = array(
            'nombre' => $nombre,
            'email' => $email,
            'password' => $password,
            'usuario' => $usuario
        );
        $datosDevolver = http_build_query($datosRecibidos); // Genera la cadena de consulta con los datos
        header('Location:../actions/resgistro.php' . $errores . '&error=2&' . $datosDevolver);
        exit();
    } else {
        // No hay errores, proceder con el flujo normal (guardar en la sesión o base de datos)
        echo "<form id='comprobacionCheck' action='../queries/insertarUser.php' method='POST'>";
            echo "<input type='hidden' name='usuario' value='$usuario'>";
            echo "<input type='hidden' name='password' value='$password'>";
            echo "<input type='hidden' name='email' value='$email'>";
            echo "<input type='hidden' name='nombre' value='$nombre'>";
            echo "</form>";
            echo "<script>document.getElementById('comprobacionCheck').submit();</script>";
    }
}
<?php
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../actions/registro.php?error=2');
        exit();
    } else {
        require_once '../database/conexion.php';
        session_start();
        try {
            // Captura de datos del formulario
            $_SESSION['username'] = htmlspecialchars($_POST['usuario']);
            $user = mysqli_real_escape_string($conector, $_POST['usuario']);
            $name_real = mysqli_real_escape_string($conector, $_POST['nombre']);
            $email = mysqli_real_escape_string($conector, $_POST['email']);
            $pwd = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptación de la contraseña
            $sqlInsert = "INSERT INTO tbl_usuarios (u_username, u_name_real, u_email, u_contrasena) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conector);
            mysqli_stmt_prepare($stmt, $sqlInsert);
            mysqli_stmt_bind_param($stmt, "ssss", $user, $name_real, $email, $pwd);
            mysqli_stmt_execute($stmt);
            $lastid = mysqli_insert_id($conector);
            // Redirigir a la página de bienvenida o confirmar el registro
            mysqli_stmt_close($stmt);
            mysqli_close($conector);
            session_start();
            $_SESSION['id'] = $lastid;
            $_SESSION['success'] = true;
            header('Location: ../actions/principal.php');
            exit();
        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
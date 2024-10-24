<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: ../actions/login.php?error=2');
    exit();
}else{
    require_once '../database/conexion.php';
    try{
        $user = mysqli_real_escape_string($conector, trim($_POST['user']));
        $pwd = mysqli_real_escape_string($conector,trim($_POST['pwd']));
        $sqlVerificar = "SELECT * FROM tbl_usuarios WHERE u_username = ? OR u_name_real = ?;";
        $stmt = mysqli_stmt_init($conector);
        mysqli_stmt_prepare($stmt, $sqlVerificar);
        mysqli_stmt_bind_param($stmt, "ss", $user, $user);
        mysqli_stmt_execute($stmt);
        $resultUser = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($resultUser) > 0){
            $datos = mysqli_fetch_assoc($resultUser);
            if(password_verify($pwd, $datos['u_contrasena'])){
                session_start();
                $_SESSION['id'] = $datos['u_id'];
                mysqli_stmt_close($stmt);
                mysqli_close($conector);
                header('Location: ../actions/principal.php');
                exit();
            }else{
                header('Location: ../actions/login.php?error=4');
                exit();
            }
        }else{
            header(header: 'Location: ../actions/login.php?error=5');
            exit();
        }
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}
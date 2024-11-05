<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location:../index.php');
        exit();
    } else {
        if($_SERVER['REQUEST_METHOD']!== 'POST'){
            header('Location:../actions/principal.php');
            exit();
        } else {
            require_once '../database/conexion.php';
            try{
                $id_envia = $_SESSION['id'];
                $id_recibe = mysqli_real_escape_string($conector, trim($_POST['usuario_recibe']));
                // Verifica si ya existe una solicitud de amistad entre los dos usuarios
                $sqlVerificar = "SELECT * FROM tbl_solicitud_amistad 
                WHERE (u_usuario_envia = ? AND u_usuario_recibe = ?) 
                OR (u_usuario_envia = ? AND u_usuario_recibe = ?);";
                $stmtVerificar = mysqli_stmt_init($conector);
                mysqli_stmt_prepare($stmtVerificar, $sqlVerificar);
                mysqli_stmt_bind_param($stmtVerificar, "ssss", $id_envia, $id_recibe, $id_recibe, $id_envia);
                mysqli_stmt_execute($stmtVerificar);
                $resultVerificar = mysqli_stmt_get_result($stmtVerificar);
                if(mysqli_num_rows($resultVerificar) > 0){
                    header('Location:../actions/principal.php?error=11');
                    exit();
                }
                // Si no hay solicitud de amistad, se crea una nueva
                $sqlInsertAmistad = "INSERT INTO tbl_solicitud_amistad (u_usuario_envia, u_usuario_recibe, sa_estado) VALUES 
                (?,?,'Pendiente');";
                $stmtInsertAmistad = mysqli_stmt_init($conector);
                mysqli_stmt_prepare($stmtInsertAmistad, $sqlInsertAmistad);
                mysqli_stmt_bind_param($stmtInsertAmistad, "ss", $id_envia, $id_recibe);
                mysqli_stmt_execute($stmtInsertAmistad);
                mysqli_stmt_close($stmtInsertAmistad);
                mysqli_stmt_close($stmtVerificar);
                mysqli_close($conector);
                header('Location:../actions/principal.php?success=5');
            } catch(Exception $e){
                echo "Error: ". $e->getMessage();
                die();
            }
        }
    }
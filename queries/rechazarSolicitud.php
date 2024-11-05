<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location:../index.php');
        exit();
    } else {
        require_once '../database/conexion.php';
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_solicitud'])){
            try{
                $id_solicitud = mysqli_real_escape_string($conector, $_POST['id_solicitud']);
                $sqlDelete = 'DELETE FROM tbl_solicitud_amistad WHERE sa_id = ?;';
                $stmt = mysqli_stmt_init($conector);
                mysqli_stmt_prepare($stmt, $sqlDelete);
                mysqli_stmt_bind_param($stmt, "i", $id_solicitud);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                mysqli_close($conector);
                echo "Solicitud rechazada.";
            }catch(Exception $e){
                echo "Error: ". $e->getMessage();
                die();
            }
            header('Location: ../actions/principal.php');
            exit();
        }
    }
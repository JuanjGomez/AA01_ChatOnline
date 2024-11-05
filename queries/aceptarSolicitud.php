<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location:../index.php');
    exit();
} else {
    require_once '../database/conexion.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_solicitud'])){
        try{
            $id_solicitud = mysqli_real_escape_string($conector, $_POST['id_solicitud']);
            // Obtener los id de los usuarios de la solicitud
            $sqlIDEnvio = 'SELECT u_usuario_envia, u_usuario_recibe FROM tbl_solicitud_amistad WHERE sa_id = ?;';
            $stmtID = mysqli_stmt_init($conector);
            mysqli_stmt_prepare($stmtID, $sqlIDEnvio);
            mysqli_stmt_bind_param($stmtID, "i", $id_solicitud);
            mysqli_stmt_execute($stmtID);
            $resultID = mysqli_stmt_get_result($stmtID);
            if (mysqli_num_rows($resultID) > 0) {
                $filaID = mysqli_fetch_assoc($resultID);
                $idUserEnvia = $filaID['u_usuario_envia'];
                $idUserRecibe = $filaID['u_usuario_recibe'];
                // Actualizar estado de la solicitud
                $sqlAceptar = 'UPDATE tbl_solicitud_amistad SET sa_estado = "Aceptada" WHERE sa_id = ?;';
                $stmtAceptar = mysqli_stmt_init($conector);
                mysqli_stmt_prepare($stmtAceptar, $sqlAceptar);
                mysqli_stmt_bind_param($stmtAceptar, "i", $id_solicitud);
                mysqli_stmt_execute($stmtAceptar);
                // Inicializamos una transaccion
                mysqli_begin_transaction($conector, MYSQLI_TRANS_START_READ_WRITE);
                // Insertar en la tabla de amigos
                $sqlInsertarAmistad = 'INSERT INTO tbl_amistad (u_usuario_uno, u_usuario_dos) VALUES (?, ?);';
                $stmtAmistad = mysqli_stmt_init($conector);
                mysqli_stmt_prepare($stmtAmistad, $sqlInsertarAmistad);
                mysqli_stmt_bind_param($stmtAmistad, "ii", $idUserEnvia, $idUserRecibe);
                mysqli_stmt_execute($stmtAmistad);
                // Recuperamos el ID generadoen la query anterior
                $lastiD = mysqli_insert_id($conector);
                // Insertar en la tabla de chats
                $sqlInsertChats = 'INSERT INTO tbl_chats (a_amistad) VALUES (?);';
                $stmtChat = mysqli_stmt_init($conector);
                mysqli_stmt_prepare($stmtChat, $sqlInsertChats);
                mysqli_stmt_bind_param($stmtChat, "i", $lastiD);
                mysqli_stmt_execute($stmtChat);
                mysqli_commit($conector);
                // Cerrar las sentencias
                mysqli_stmt_close($stmtChat);
                mysqli_stmt_close($stmtID);
                mysqli_stmt_close($stmtAmistad);
                mysqli_stmt_close($stmtAceptar);
                mysqli_close($conector);
            } else {
                echo "No se encontró la solicitud";
            }
        } catch (Exception $e) {
            // En caso de error
            mysqli_rollback($conector);
            echo "Error: " . $e->getMessage();
            die();
        }
        header('Location: ../actions/principal.php');
        exit();
    }
}
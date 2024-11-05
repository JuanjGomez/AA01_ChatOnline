<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location: ../index.php');
    }
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header('Location:../actions/chats.php?c_id="'.$_SESSION['c_id'].'"');
        exit();
    } else {
        require_once '../database/conexion.php';
        try{
            $chat_id = mysqli_real_escape_string($conector, trim($_SESSION['c_id']));
            $id = mysqli_real_escape_string($conector,$_SESSION['id']);
            $msj = mysqli_real_escape_string($conector,trim($_POST['mensaje']));
            $sqlMensaje = "INSERT INTO tbl_mensajes (c_chat, u_envio, m_contenido) VALUES (?,?,?);";
            $stmtMsj = mysqli_stmt_init($conector);
            mysqli_stmt_prepare($stmtMsj, $sqlMensaje);
            mysqli_stmt_bind_param($stmtMsj, "iis", $chat_id, $id, $msj);
            mysqli_stmt_execute($stmtMsj);
            mysqli_stmt_close($stmtMsj);
            mysqli_close($conector);
            echo "<form method='GET' action='../actions/chats.php' id='EnvioCheck'>
            <input type='hidden' name='c_id' value='$chat_id'>
                </form>";
            echo "<script>document.getElementById('EnvioCheck').submit();</script>";
            exit();
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }
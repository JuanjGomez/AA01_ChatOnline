<?php
session_start();
    if (!isset($_SESSION['id'])){
        exit("Acceso denegado: sesión no válida o falta de c_id.");
    }
    require_once '../database/conexion.php';
$c_id = mysqli_real_escape_string($conector, $_SESSION['c_id']);
$id_user = $_SESSION['id'];

$sqlMensajes = 'SELECT m.m_contenido, m.m_fecha, u.u_username, m.u_envio 
                FROM tbl_chats c 
                INNER JOIN tbl_mensajes m ON c.c_id = m.c_chat 
                INNER JOIN tbl_usuarios u ON m.u_envio = u.u_id
                WHERE c.c_id = ? 
                ORDER BY m.m_fecha DESC;';

$stmtMensajes = mysqli_stmt_init($conector);
mysqli_stmt_prepare($stmtMensajes, $sqlMensajes);
mysqli_stmt_bind_param($stmtMensajes, "i", $c_id);
mysqli_stmt_execute($stmtMensajes);
$resultMensajes = mysqli_stmt_get_result($stmtMensajes);
if(mysqli_num_rows($resultMensajes)>0){
$mensajes = [];
while ($fila = mysqli_fetch_assoc($resultMensajes)) {
        $mensajes[] = "<p><strong>" . htmlspecialchars($fila['u_username']) . "</strong> - " . htmlspecialchars($fila['m_fecha']) . ": " . htmlspecialchars($fila['m_contenido']) . "</p>";
}

mysqli_stmt_close($stmtMensajes);
mysqli_close($conector);

echo implode("", $mensajes);
} else{
    echo "<p>No hay mensajes en este chat.</p>";
}
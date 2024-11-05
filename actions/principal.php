<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location:../index.php');
        exit();
    }
    if(isset($_SESSION['success']) && $_SESSION['success']){
        unset($_SESSION['success']);
        $user = htmlspecialchars($_SESSION['username']);
        echo "<script>let loginSucces = true; let user ='$user';</script>";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.min.css" integrity="sha256-qWVM38RAVYHA4W8TAlDdszO1hRaAq0ME7y2e9aab354=" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../styles/inicioWeb.css">
    <title>Funciones de Usuario</title>
</head>
<body>
    <!-- Columna 1: Formulario de búsqueda -->
    <div class="column">
        <h2>Buscar Usuarios</h2>
        <form id="searchForm" action="../queries/busquedaUser.php" method="POST">
            <input type="text" id="searchInput" name="busqueda" placeholder="Buscar por username o nombre real">
            <button type="submit">Buscar</button>
        </form>
        <ul id="searchResults">
            <!-- Aquí se mostrarán los resultados de la búsqueda -->
        </ul>
    </div>
    <!-- Columna 2: Solicitudes de Amistad -->
    <div class="column">
        <h2>Solicitudes de Amistad</h2>
        <ul id="friendRequests">
            <?php
                require_once '../database/conexion.php';
                try {
                    $id_usuario = $_SESSION['id'];
                    // Mostrar las solicitudes de amistad pendientes
                    $sqlSolicitudes = "SELECT tbl_solicitud_amistad.sa_id, tbl_usuarios.u_username, tbl_usuarios.u_id
                            FROM tbl_solicitud_amistad 
                            INNER JOIN tbl_usuarios ON tbl_solicitud_amistad.u_usuario_envia = tbl_usuarios.u_id
                            WHERE tbl_solicitud_amistad.u_usuario_recibe = ? 
                            AND tbl_solicitud_amistad.sa_estado = 'Pendiente';";
                    $stmtSoli = mysqli_stmt_init($conector);
                    mysqli_stmt_prepare($stmtSoli, $sqlSolicitudes);
                    mysqli_stmt_bind_param($stmtSoli, "i", $id_usuario);
                    mysqli_stmt_execute($stmtSoli);
                    $resultSoli = mysqli_stmt_get_result($stmtSoli);
                    if (mysqli_num_rows($resultSoli) > 0) {
                        while ($fila = mysqli_fetch_assoc($resultSoli)) {
                            $sa_id = htmlspecialchars($fila['sa_id']);
                            $username = htmlspecialchars($fila['u_username']);
                            // Envolvemos los botones en un formulario para enviarlos
                            echo "<li>{$username} 
                                <form method='POST' action='../queries/aceptarSolicitud.php' style='display:inline;'>
                                    <input type='hidden' name='id_solicitud' value='{$sa_id}'>
                                    <button type='submit'>Aceptar</button>
                                </form>
                                <form method='POST' action='../queries/rechazarSolicitud.php' style='display:inline;'>
                                    <input type='hidden' name='id_solicitud' value='{$sa_id}'>
                                    <button type='submit' id='warning'>Rechazar</button>
                                </form>
                            </li>";
                        }
                    } else {
                        echo "<li>No hay solicitudes pendientes</li>";
                    }
                    mysqli_stmt_close($stmtSoli);
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                    die();
                }
            ?>
        </ul>
    </div>
    <!-- Columna 3: Amigos -->
    <div class="column">
        <h2>Amigos</h2>
        <a href="../validations/cerrarSesion.php">Cerrar Sesion</a>
        <ul id="friendsList">
            <?php
                require_once '../database/conexion.php';
                try{
                    $idUser = $_SESSION['id'];
                    $sqlAmigos = "SELECT DISTINCT c.c_id, u.u_username
                        FROM tbl_chats c
                        INNER JOIN tbl_amistad a ON (c.a_amistad = a.a_id)
                        INNER JOIN tbl_usuarios u ON (u.u_id = (CASE
                                                                WHEN a.u_usuario_uno = ? THEN a.u_usuario_dos
                                                                ELSE a.u_usuario_uno
                                                                END))
                        WHERE (a.u_usuario_uno = ? OR a.u_usuario_dos =?)
                        AND u.u_id != ?;";
                    $stmtAmigos = mysqli_stmt_init($conector);
                    mysqli_stmt_prepare($stmtAmigos, $sqlAmigos);
                    mysqli_stmt_bind_param($stmtAmigos, "iiii", $idUser, $idUser, $idUser, $idUser);// Vincular los tres parámetros en la consulta
                    mysqli_stmt_execute($stmtAmigos);
                    $resultAmigos = mysqli_stmt_get_result($stmtAmigos);
                    if (mysqli_num_rows($resultAmigos) > 0){// Verificar si hay resultados y mostrarlos
                        while ($fila = mysqli_fetch_assoc($resultAmigos)) {
                            $username = htmlspecialchars($fila['u_username']);// Asigna y escapa los valores dentro del bucle
                            $chatId = $fila['c_id'];
                            echo "<li><a href='chats.php?c_id={$chatId}'>{$username}</a></li>";
                        }
                    } else {
                        echo "<li>No tienes amigos.</li>";
                    }
                    mysqli_stmt_close($stmtAmigos);
                    mysqli_close($conector);
                } catch (Exception $e) {
                    echo "Error: ". $e->getMessage();
                    die();
                }
            ?>
        </ul>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js" integrity="sha256-WLPV1xrJUZx5TVzM44uDSNXrc7bXOMxSsbrQ/FC9x7M=" crossorigin="anonymous"></script>
<script>
    if(typeof loginSucces !== 'undefined' && loginSucces){
    swal.fire({
            title: 'Sesion iniciada',
            text: 'Bienvenido ' + user + '!',
            icon:'success',
        })
    }
// Función para manejar el envío del formulario de búsqueda
document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir que el formulario recargue la página
    // Obtener el valor de búsqueda
    let searchQuery = document.getElementById('searchInput').value;
    // Realizar la búsqueda con AJAX
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../queries/busquedaUser.php', true); // Apunta a tu archivo PHP para procesar la búsqueda
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Manejar la respuesta del servidor
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(xhr.responseText); // Mostrar la respuesta en la consola
            // Actualizar la lista de resultados con la respuesta
            document.getElementById('searchResults').innerHTML = xhr.responseText;
        } else {
            console.error('Error en la búsqueda de usuarios');
        }
    };
    // Enviar los datos de búsqueda al servidor
    xhr.send('busqueda=' + encodeURIComponent(searchQuery));
});
</script>
</html>
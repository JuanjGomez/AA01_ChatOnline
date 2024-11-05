<?php
    session_start();
    $_SESSION['c_id'] = $_GET['c_id'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../styles/styles.css">
    <title>Document</title>
</head>
<body>
    <div class="chat-container">
        <a href="principal.php">Volver</a>
        <h2>Chat con tu amigo</h2>
        <div class="messages-container" id="messages-container">
            
        </div>
        <form method="POST" action="../queries/enviarMensaje.php">
            <textarea id="mensaje" name="mensaje" placeholder="Escribe tu mensaje..." maxlength="250"></textarea>
            <button type="submit" id="enviarBtn">Enviar</button>
        </form>
    </div>
    <script src="../validations/js/limitchat.js"></script>
    <script>
        // Función para cargar mensajes
        function cargarMensajes() {
            const xhr = new XMLHttpRequest();
            // Cambiar la ruta para apuntar al archivo en la carpeta "queries"
            xhr.open("GET", "../queries/cargarMensajes.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById("messages-container").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
        // Llama a la función de carga cada 3 segundos
        setInterval(cargarMensajes, 3000);
        // Cargar mensajes inmediatamente al cargar la página
        cargarMensajes();
    </script>
</body>
</html>
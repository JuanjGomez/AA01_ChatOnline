<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <li>Usuario 1 <button>Aceptar</button> <button>Rechazar</button></li>
            <li>Usuario 2 <button>Aceptar</button> <button>Rechazar</button></li>
            <!-- Más solicitudes -->
        </ul>
    </div>

    <!-- Columna 3: Amigos -->
    <div class="column">
        <h2>Amigos</h2>
        <ul id="friendsList">
            <li>Amigo 1</li>
            <li>Amigo 2</li>
            <li>Amigo 3</li>
            <!-- Más amigos -->
        </ul>
    </div>

</body>
<script>
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

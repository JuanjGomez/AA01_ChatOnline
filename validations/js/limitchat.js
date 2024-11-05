let mensajeInput = document.getElementById('mensaje');
let enviarBtn = document.getElementById('enviarBtn');

function validarMensaje() {
    if (mensajeInput.value.trim() === '') {
        enviarBtn.disabled = true; // Deshabilita el botón si el campo está vacío o tiene más de 250 caracteres
    } else {
        enviarBtn.disabled = false; // Habilita el botón si cumple las condiciones
    }
}

// Escuchar cambios en el campo de texto
mensajeInput.addEventListener("input", validarMensaje);

// Validar el campo al cargar la página
validarMensaje();

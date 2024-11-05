document.getElementById("nombre").onblur = function validaNombre(){
    let nombre = this.value
    let errorNombre = ""
    if(nombre.length == 0 || nombre == null || /^\s+$/.test(nombre)){
        errorNombre = "El campo no puede estar vacío."
    } else if(nombre.length < 2){
        errorNombre = "El campo debe tener al mas de 2 caracteres."
    } else if(!letras(nombre)){
        errorNombre = "El campo solo puede tener letras."
    }
    function letras(nombre){
        let letra = /^[a-zA-Z]+$/
        return letra.test(nombre)
    }
    document.getElementById("errorNombre").innerHTML = errorNombre
}
document.getElementById("email").onblur = function validaEmail(){
    let email = this.value
    let errorEmail = ""
    if(email.length == 0 || email == null || /^\s+$/.test(email)){
        errorEmail = "El campo no puede estar vacío."
    } else if(!verifMail(email)){
        errorEmail = "El campo no es válido."
    }
    function verifMail(email){
        var validar = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return validar.test(email);
    }
    document.getElementById("errorEmail").innerHTML = errorEmail
}
document.getElementById("password").onblur = function validaPassword(){
    let password = this.value
    let errorPassword = ""
    if(password.length == 0 || password == null || /^\s+$/.test(password)){
        errorPassword = "El campo no puede estar vacío."
    } else if(password.length < 6){
        errorPassword = "El campo debe tener mas de 6 caracteres."
    }
    document.getElementById("errorPwd").innerHTML = errorPassword
}
document.getElementById("usuario").onblur = function validaUsuario(){
    let usuario = this.value
    let errorUsuario = ""
    if(usuario.length == 0 || usuario == null || /^\s+$/.test(usuario)){
        errorUsuario = "El campo no puede estar vacío."
    } else if(usuario.length < 2){
        errorUsuario = "El campo debe tener mas de 2 caracteres."
    } else if(!letra(usuario)){
        errorUsuario = "El campo solo puede tener letras."
    }
    function letra(usuario){
        let letr = /^[a-zA-Z]+$/
        return letr.test(usuario)
    }
    document.getElementById("errorUser").innerHTML = errorUsuario
}
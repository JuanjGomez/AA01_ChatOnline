document.getElementById("user").onblur = function validaUser(){
    let user = this.value
    let error_user = ""
    if (user.length == 0 || user == null || /^\s+$/.test(user)) {
        error_user = "El campo no puede estar vacio."
    } else if(user.length < 2){
        error_user = "El campo debe tener al menos 2 caracteres."
    } else if(!letras(user)){
        error_user = "El campo solo puede contener letras."
    }
    document.getElementById("errorUser").innerHTML = error_user
}
document.getElementById("pwd").onblur = function validaPwd(){
    let pwd = this.value
    let errorPwd = ""
    if (pwd.length == 0 || pwd == null || /^\s+$/.test(pwd)) {
        errorPwd = "El campo no puede estar vacio."
    } else if(pwd.length < 6){
        errorPwd = "El campo debe tener al mas 6 caracteres."
    }
    document.getElementById("errorPwd").innerHTML = errorPwd
}
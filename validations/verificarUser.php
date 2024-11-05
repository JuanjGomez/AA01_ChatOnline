<?php
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header('Location:../actions/login.php?error=1');
    } else {
        $user = htmlspecialchars(trim($_POST['user']));
        $pwd = htmlspecialchars(trim($_POST['pwd']));
        $errores = "";
        require_once '../functions/campofunction.php';
        if(validaCampo($user)){
            $errores .= ($errores === '') ? '?userVacio=true' : '&userVacio=true';
        } elseif(!ctype_alpha( $user)){
            $errores .= ($errores === '') ? '?userMal=true' : '&userMal=true';
        } elseif(strlen($user) < 2){
            $errores .= ($errores === '') ? '?userLargo=true' : '&userLargo=true';
        }
        if(validaCampo($pwd)){
            $errores .= ($errores === '') ? '?pwdVacio=true' : '&pwdVacio=true';
        } elseif(strlen($pwd) < 6){
            $errores .= ($errores === '') ? '?pwdMal=true' : '&pwdMal=true';
        }
        if($errores!== ''){
            $datosRecibidos = array(
                'user' => $user,
                'pwd' => $pwd
            );
            $datosDevolver = http_build_query($datosRecibidos);
            header('Location:../actions/login.php'. $errores. '&error=2&'. $datosDevolver);
            exit();
        } else {
            echo "<form id='comprobacionCheck2' action='../queries/comprobarUser.php' method='POST'>";
            echo "<input type='hidden' id='user' name='user' value='$user'>";
            echo "<input type='hidden' id='pwd' name='pwd' value='$pwd'>";
            echo "</form>";
            echo "<script>document.getElementById('comprobacionCheck2').submit();</script>";
        }
    }
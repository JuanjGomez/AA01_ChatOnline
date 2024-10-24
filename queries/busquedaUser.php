<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location:../index.php');
        exit();
    } else {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location:../actions/principal.php');
            exit();
        } else {
            require_once '../database/conexion.php';
            try{
            $busqueda = mysqli_real_escape_string($conector, trim($_POST['busqueda']));
            $id_inicio = $_SESSION['id'];
            $sqlBuscar = "SELECT u_id, u_username, u_name_real 
            FROM tbl_usuarios 
            WHERE (u_username LIKE CONCAT('%', ?, '%') 
            OR u_name_real LIKE CONCAT('%', ?, '%')) 
            AND u_id != ?";
            $stmt = mysqli_stmt_init($conector);
            mysqli_stmt_prepare($stmt, $sqlBuscar);
            mysqli_stmt_bind_param($stmt, "ssi", $busqueda, $busqueda, $id_inicio);
            mysqli_stmt_execute($stmt);
            $resultBuscar = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($resultBuscar) > 0){
                $datos = mysqli_fetch_all($resultBuscar,MYSQLI_ASSOC);
                foreach($datos as $fila){
                    echo "<div class='card text-center'>";
                    echo "<h4 class='card-header'>Usuario: " . htmlspecialchars($fila['u_username']) . "</h4>";
                    echo "<p>Nombre Real: " . htmlspecialchars($fila['u_name_real']) . "</p>";
                    echo "<form action='../queries/solicitudAmistad.php' method='POST'>";
                    echo "<input type='hidden' name='usuario_recibe' value='". htmlspecialchars($fila['u_id'])."'>";
                    echo "<button type='submit' class='btn btn-primary'>Enviar Solicitud de Amistad</button>";
                    echo "</form>";
                    echo "</div><br>";
                }
            } else {
                echo "<p>No se encontraron resultados.</p>";
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conector);
            } catch(Exception $e){
                echo "Error: ". $e->getMessage();
                die();
            }
        }
    }
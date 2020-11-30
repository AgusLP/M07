<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome admin!</title>
</head>
<body> 
<?php
    include "funcions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["salir"])) {
            cerrar_session();
        }

        if (isset($_REQUEST["modificar"])) {
            modificar_usuario_admin($_REQUEST['Id'], $_REQUEST['newuser'], md5($_REQUEST['newpassword']), $_REQUEST['newrol']);
        } else if (isset($_REQUEST["borrar"])) {
            borrar_usuario($_REQUEST["newuser"]);
        } else if (isset($_REQUEST["crear"])) {
            registrar_usuario($_REQUEST["reguser"], md5($_REQUEST["regpassword"]), $_REQUEST["regrol"]);
        }
        
    }
    
    if (isset($_SESSION["User"]) && isset($_SESSION["Password"])) {
        echo "<h2>Hola ".$_SESSION["User"]."!</h2><br>";
?>
<h3>Tabla de administración:</h3>
<?php
    generar_tabla_admin();
?>
<form method="post">
    <br><h3>Cerrar sesion: <button type="submit" name="salir" value="si">Salir</button></h3>
</form>
<?php
    } else {
        header("Location: UF1-A6-ExerciciPublic.php");
    }
?>
</body>
</html>
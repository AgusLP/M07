<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome user!</title>
</head>
<body>
<?php 
    include "funcions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["salir"])) {
            cerrar_session();
        }
        
        if (isset($_REQUEST["password"]) && isset($_REQUEST["newuser"]) && isset($_REQUEST["newpassword"])) {
            modificar_usuario($_SESSION["User"], md5($_REQUEST["Password"]), $_REQUEST["newuser"], md5($_REQUEST["newpassword"]));
        }
    }
    
    if (isset($_SESSION["User"]) && isset($_SESSION["Password"])) {
        echo "<h2>Hola ".$_SESSION["User"]."!</h2><br>";
?>
<table border="1">
        <tr><th colspan="2">Modificar tus datos</th></tr>
        <tr><td colspan="2" style="text-align: center;">Es necesario poner la contraseña.</td></tr>
        <form method="post">
            <tr><td style="text-align: right;"><label>Tu contraseña: </label></td><td><input type="password" name="password"></td></tr>
            <tr><td style="text-align: right;"><label>Nuevo correo: </label></td><td><input type="text" name="newuser"></td></tr>
            <tr><td style="text-align: right;"><label>Nueva contraseña: </label></td><td><input type="password" name="newpassword"></td></tr>
            <tr><td colspan="2" style="text-align: center;"><label><button type="submit">Modificar</button></label></td></tr>
        </form>
</table><br>
<form method="post">
    <h3>Cerrar sesion: <button type="submit" name="salir" value="si">Salir</button></h3>
</form>
<?php
    } else {
        header("Location: UF1-A6-ExerciciPublic.php");
    }
?>
</body>
</html>
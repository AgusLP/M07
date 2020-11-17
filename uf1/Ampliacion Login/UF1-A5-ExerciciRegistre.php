<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body> 
<?php
    include "funcions.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["salir"])) {
            header("Location: UF1-A5-ExerciciPublic.php");
        }
        
        registrar_usuario($_REQUEST["registroEmail"], md5($_REQUEST["registroPassword"]), 2);
    }
?>
<table border="1">
    <tr><th colspan="2">Registrar usuario</th></tr>
    <form method="post">
        <tr><td style="text-align: right;"><label>Tu mail: </label></td><td><input type="text" name="registroEmail"></td></tr>
        <tr><td style="text-align: right;"><label>Tu contraseña: </label></td><td><input type="password" name="registroPassword"></td></tr>
        <tr><td colspan="2" style="text-align: center;"><button type="submit">Registrarse</button></td></tr>
    </form>
</table><br>
<form method="post">
    <h3>Volver al menu: <button type="submit" name="salir" value="si">Menu</button></h3>
</form>
</body>
</html>
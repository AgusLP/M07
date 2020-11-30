<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>
<body>
<?php
    include "funcions.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["registrarse"])) {
            header("Location: UF1-A6-ExerciciRegistre.php");
        }
        if (isset($_REQUEST["aceptar"])) {
            crear_cookie($_REQUEST["aceptar"]);
        }
        if (isset($_REQUEST["iniciar"])) {
            iniciar_sesion($_REQUEST["User"], md5($_REQUEST["Password"]));
        } 
    }

    if (isset($_COOKIE["aceptado"])) {
?>
<table border="1">
    <tr><th colspan="2">Iniciar sesion</th></tr>
    <form method="post">
        <tr><td style="text-align: right;"><label>Email: </label></td><td><input type="text" name="user"/></td></tr>
        <tr><td style="text-align: right;"><label>Contraseña: </label></td><td><input type="password" name="password"/></td></tr>
        <tr><td colspan="2" style="text-align: center;"><button type="submit" name="iniciar">Iniciar sesión</button></td></tr>
    </form>
</table><br>
<form method="post">
    <h3>Registrarse: <button type="submit" name="registrarse" value="Si">Registrarse</button></h3>
</form><br>
<h1>Productos: </h1>
<table border="1">
    <tr>
        <form method="post">
            <td><label>Buscar producto: </label></td>
            <td><input type="text" name="buscar" placeholder="Buscar..."></td>
            <td><button type="submit" name="buscador" value="Si">Buscar</button></td>
        </form>
        <form method="post">
            <td><label>Buscar por categoria: </label></td>
            <td><select name="categorias">
<?php
            todas_categorias();
?>
            </select></td>
            <td><button type="submit" name="buscarcat" value="Si">Buscar</button></td>
        </form>
    </tr>
</table><br>
<?php
        if (isset($_REQUEST["buscador"])) {
            Tbuscador(strtolower($_REQUEST["buscar"]));
        } else if(isset($_REQUEST["buscarcat"]) && $_REQUEST["categorias"] != "") {
            Tbuscador_categoria($_REQUEST["categorias"]);
        } else {
            tabla_productes();
        }
    } else {

?>

<form method="post">
    <label>Esta pagina usa cookies, quieres continuar?</label><br>
    <button type="submit" name="aceptar" value="Si">Si. </button>
    <button type="submit" name="aceptar" value="No">No.</button>
</form>
<?php
    }
?>
</body>
</html>
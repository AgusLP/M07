<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include "funciones.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (isset($_REQUEST["aceptar"])) {
                if ($_REQUEST["aceptar"] == "si") {
                    setcookie("aceptado", 1, time() + 365 * 24 * 60 * 60);
                    header("Location: https://dawjavi.insjoaquimmir.cat/alarrosa/m07/uf1/login/pub.php");
                }
                else {
                    header("Location: https://www.google.com/");
                }
            }
            else {
                if (comprovar_email($_REQUEST["email"]) && compro_contra($_REQUEST["contra"])){
                    if ($_REQUEST["recordar"] == 1) {
                        echo"<p>h</p>";
                    } 
                    else {
                        $_SESSION["email"] = comp_campo($_REQUEST["email"]);
                        $_SESSION["contra"] = comp_campo($_REQUEST["contra"]);
                        header("Location: https://dawjavi.insjoaquimmir.cat/alarrosa/m07/uf1/login/privi.php");
                    }
                } 
                else {
                    echo ("datos erroneos");
                }
            }
        }
        if (isset($_COOKIE["aceptado"])){

    ?>
<form enctype="multipart/form-data" method="post">
    <label>email: </label> <input type="text" name="email"/><br>
    <label>contra: </label> <input type="password" name="contra"/><br><br>
    <input type="submit" value="iniciar sesion"> 
</form>
<?php
    } else {
?>
<form method="post">
    <label>Esta pagina utiliza cookies, deseas aceptarlas?</label><br>
    <button type="submit" name="aceptar" value="si".>Si</button>
    <button type="submit" name="aceptar" value="No".>No</button>
</form>
<?php
    }
?>
</body>
</html>




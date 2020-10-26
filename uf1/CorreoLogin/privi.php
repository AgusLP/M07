<?php

session_start();
if($_SERVER($_SESSION["email"])) {
    session_destroy();
    header("Location: pub.php");

}else {
    if(isset($_SESSION["email"]) && isset($_SESSION["contra"])) {
        echo "<p>buenas" .$_SESSION["email"]. "!</p>";
    }else {
        header("Localtion: pub.php");
    }
}
?>
<a href="salir.php">Cerrar sesión</a>
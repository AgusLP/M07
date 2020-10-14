<?php
echo "Has ecrito esto: $_REQUEST[mytext].<br>";
echo "Has escogido la:  $_REQUEST[myradio].<br>";


if(isset ($_REQUEST["mycheckbox"])){
    foreach ($_REQUEST["mycheckbox"] as $respuesta){
    echo "Has hecho click en la checkbox: $respuesta <br>";
    }
}


echo "Has escogido en el grupo $_REQUEST[myselect].<br>";
echo "Has escrito en el recuadro: $_REQUEST[mytextarea].<br>";
?>
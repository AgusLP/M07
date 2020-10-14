<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
   //Procesar datos
    echo "Has ecrito esto en text: $_REQUEST[mytext].<br>";
    echo "Has escogido la:  $_REQUEST[myradio].<br>";

    if(isset ($_REQUEST["mycheckbox"])){
        foreach ($_REQUEST["mycheckbox"] as $respuesta){
        echo "Has escogido la checkbox: $respuesta <br>";
        }
    }

    echo "Has escogido el grupo $_REQUEST[myselect].<br>";
    echo "Has escrito en el recuadro: $_REQUEST[mytextarea].<br>";  
    }   else {

    //Print del formulario



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Formulario</title>

</head>

<body>


<div style="margin: 30px 10%;">
<h3>Mi formulario</h3>
<form action="procesa_datos.php" method="post" id="myform" name="myform">

    <label>Text</label> <input type="text" value="" size="30" maxlength="100" name="mytext" id="" /><br /><br />

    <input type="radio" name="myradio" value="1" /> First radio
    <input type="radio" checked="checked" name="myradio" value="2" /> Second radio<br /><br />

    <input type="checkbox" name="mycheckbox[]" value="1" /> First checkbox
    <input type="checkbox" checked="checked" name="mycheckbox[]" value="2" /> Second checkbox<br /><br />

    <label>Select ... </label>
    <select name="myselect" id="">
        <optgroup label="group 1">
            <option value="1" selected="selected">item one</option>
        </optgroup>
        <optgroup label="group 2" >
            <option value="2">item two</option>
        </optgroup>
    </select><br /><br />

    <textarea name="mytextarea" id="" rows="3" cols="30">
Text area
    </textarea> <br /><br />

    <button id="mysubmit" type="submit">Submit</button><br /><br />

</form>

</div>

</body>

</html>


<?php
}
?>

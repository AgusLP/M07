<p>Octubre</p>
<table>
<tr>
<td>lunes</td>
<td>martes</td>
<td>miercoles</td>
<td>jueves</td>
<td>viernes</td>
<td>sabado</td>
<td>domingo</td>
</tr>

<?php
echo "<tr>";

for ($n=1;$n!=31; $n++){
    echo "<td>$n</td>";
    if (($n%7)==0){
        echo "</tr><tr>";
    }

}
?>
</tr>
</table>

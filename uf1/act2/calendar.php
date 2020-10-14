<p> Octubre </p>
<tabla>
<tr>
<td> lunes </td>
<td> martes </td>
<td> miércoles </td>
<td> jueves </td>
<td> viernes </td>
<td> sábado </td>
<td> domingo </td>
</tr>

<? php
echo  "<tr>" ;

para ( $ n = 1 ; $ n ! = 31 ; $ n ++) {
    echo  "<td> $ n </td>" ;
    si (( $ n % 7 ) == 0 ) {
        echo  "</tr> <tr>" ;
    }

}
?>
</tr>
</tabla>

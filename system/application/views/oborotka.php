<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}?>
<font size=4><center>Оборотка по организации</center></font><br><br>
<font size=3>
<table border=1px width=100% style="border: black;" cellspacing=0px cellpadding=0px>
<tr>
<td>
Сальдо на начало</td><td align=right> <?php echo f_d($oborotka->saldo);?>
</td>
</tr>
<tr>
<td>
Начисленно:</td><td align=right> <?php echo f_d($oborotka->nachisleno);?>
</td>
</tr>
<tr>
<td>
Оплочено:</td><td align=right> <?php echo f_d($oborotka->oplata_value);?></td></tr>
<tr>
<td>
Сальдо на конец:</td><td align=right> <?php echo f_d($oborotka->saldo+$oborotka->nachisleno-$oborotka->oplata_value);?>
</td>
</tr>
<tr>
<td>
С учетом предоплаты:</td><td align=right> 
<?php echo f_d($oborotka->saldo+
$oborotka->nachisleno-$oborotka->oplata_value+$oborotka->last_nachisleno);?>
</td>
</tr>
</table>
</font>
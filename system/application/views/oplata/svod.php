<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}
function datetostring($date)
{
	$d=explode("-",$date); 
	return $d['2'].'.'.$d['1'].'.'.$d['0'];
}
?>
<html>
<head>
<title>Отчет по оплате за электроэнергию</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<center><h2>Отчет по оплате за электроэнергию</H2></center>
<br>
<table width=100% border=1px cellspacing=0px style="border: gray;font-family: Verdana; font-size: x-small;">
<tr>
<td>
Номер счета
</td>
<td>
Дата
</td>
<td>
Сумма
</td>
</tr>
<?php $last_schet=-1;$sum=0;$itogo=0; foreach($oplata->result() as $o):
$itogo+=$o->sum;
if (($last_schet!=-1)&&($last_schet!=$o->number)) 
{
	echo "<tr><th>итого по счету $last_schet</th><td></td><th align=right>".f_d($sum)."</th></tr>";
	$sum=0;$last_schet=$o->number;
}
if (($last_schet==-1)) 
{
	$last_schet=$o->number;
}
$sum+=$o->sum;
?>
<tr>
<td>
<?php echo $o->number;?>
</td>
<td>
<?php echo datetostring($o->data);?>
</td>
<td align=right>
<?php echo f_d($o->sum);?>
</td>
</tr>
<?php endforeach;
echo "<tr><th>итого по счету $last_schet</th><td></td><th align=right>".f_d($sum)."</th></tr>";
echo "<tr><th>ВСЕГО</th><td></td><th align=right>".f_d($itogo)."</th></tr>";
?>
</table>
</html>
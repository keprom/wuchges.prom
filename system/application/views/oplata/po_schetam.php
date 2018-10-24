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
<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>
<th>
Дог.
</th>
<th>
Наименование
</th>
<th>
№ Док.
</th>
<th>
Бух/сч.
</th>
<th width=100px>
Дата операц.
</th>
<th>
Сумма
</th>
</tr>
<?php $last_schet=-1;$last_data=-1;$sum_data=0;$itogo=0;$sum_schet=0; 
foreach($oplata->result() as $o):
 
$itogo+=$o->sum;
if (($last_data!=-1)&&($last_data!=$o->data)) 
{
	echo "<tr><th>итого</th><td> за $last_data</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><th align=right>".f_d($sum_data)."</th></tr>";
	$sum_data=0;$last_data=$o->data;
}
if (($last_schet!=-1)&&($last_schet!=$o->number)) 
{
	echo "<tr><th>итого</th><td> по счету $last_schet</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><th align=right>".f_d($sum_schet)."</th></tr>";
	$sum_schet=0;$last_schet=$o->number;
}

if (($last_schet==-1)) 
{
	$last_schet=$o->number;
}
if (($last_data==-1)) 
{
	$last_data=$o->data;
}
$sum_schet+=$o->sum;
$sum_data+=$o->sum;
?>
<tr>
<td>
<?php echo $o->dogovor;?>
</td>
<td>
<?php echo $o->firm_name;?>
</td>
<td>
<?php echo $o->document_number;?>
</td>
<td>
<?php echo $o->number;?>
</td>
<td>
<?php echo $o->data;?>
</td>
<td align=right>
<?php echo f_d($o->sum);?>
</td>
</tr>
<?php endforeach;
echo "<tr><th>итого</th><td> за $last_data</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><th align=right>".f_d($sum_data)."</th></tr>";
echo "<tr><th>итого</th><td> по счету $last_schet</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><th align=right>".f_d($sum_schet)."</th></tr>";
echo "<tr><th>ВСЕГО</th><td>&nbsp; </td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><th align=right>".f_d($itogo)."</th></tr>";
?>
</table>
</html>
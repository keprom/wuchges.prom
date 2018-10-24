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
<?php $last_group=-1;$itogo=0;$sum_schet=0; 
foreach($oplata->result() as $o):
 
$itogo+=$o->sum;


if (($last_group!=-1)&&($last_group!=$o->firm_subgroup_name)) 
{
	echo "<tr><td colspan=2><b>ИТОГО: $last_group</b></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><th align=right><b>".f_d($sum_schet)."</b></th></tr>";
	echo "<tr><td colspan= 6><b>{$o->firm_subgroup_name}</b></td></tr>";
	$sum_schet=0;$last_group=$o->firm_subgroup_name;
}

if (($last_group==-1)) 
{
	echo "<tr><td colspan= 6><b>{$o->firm_subgroup_name}</b></td></tr>";
	$last_group=$o->firm_subgroup_name;
}

$sum_schet+=$o->sum;
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

echo "<tr><td colspan=2><b>ИТОГО:  $last_group</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><th align=right>".f_d($sum_schet)."</th></tr>";
echo "<tr><td colspan=2> ВСЕГО:  </td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><th align=right>".f_d($itogo)."</th></tr>";
?>
</table>
</html>
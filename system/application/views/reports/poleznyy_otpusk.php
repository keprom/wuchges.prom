<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}?>
<html>
<head>
<title>Полезный отпуск</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<div align=right>Форма 46-ЭС</div>
<center><b>Полезный отпуск<br/><?php echo $org_info->org_name." за ".$period_name->current_period;
if ($type==2) echo ' по юридическим лицам ';
if ($type==3) echo ' по физическим лицам ';

?></b></center>
<table border = 1px width=100%>

<tr>
<td rowspan=2 align=left>
<b>Наименование</b>
</td>
<td colspan=2 align=center>
<b>Полезный отпуск</b>
</td>
<td rowspan=2 align=right>
<b>Ср. Тариф</b>
</td>
</tr>

<tr>
<td align=right>
<b>кВт/ч</b>
</td>
<td align=right>
<b>тенге</b>
</td>
</tr>

<?php
$last_group=-1;$last_group_name="";
$sum_kvt=0;
$sum_tariff_kvt=0;
$sum_tariff_tenge=0;
$sum_tenge=0;$_sum_kvt=0;$_sum_tenge=0;
$last_tariff=-1;
 foreach($otpusk->result() as $o):?>
<?php 
if ($last_tariff==-1) $last_tariff=f_d($o->sum_tenge/$o->sum_kvt);

if (f_d($o->sum_tenge/$o->sum_kvt)!=$last_tariff)
{
	echo "<tr><td align=right><b>Всего по тарифу ".
	f_d($last_tariff)."</b>
	</td><td align=right>".f_d($sum_tariff_kvt)."</td><td align=right>".f_d($sum_tariff_tenge)."</td>
	<td align=right>&nbsp;</td>
	</td></tr>";
	$sum_tariff_kvt=0;
	$sum_tariff_tenge=0;
	$last_tariff=f_d($o->sum_tenge/$o->sum_kvt);
}
if (($o->firm_subgroup_id!=$last_group)&&($last_group==-1))
{
	echo "<tr><td colspan=4 ><b>{$o->firm_subgroup_name}</b></td></tr>";
	$last_group=$o->firm_subgroup_id;
	$last_group_name=$o->firm_subgroup_name;
}
if (($o->firm_subgroup_id!=$last_group)&&($last_group!=-1))
{
	echo "<tr ><td align=left><b>Итого {$last_group_name}</b></td><td align=right><b>{$sum_kvt}</b></td><td align=right><b>{$sum_tenge}</b></td><td align=right><b>".
	f_d($sum_tenge/$sum_kvt)."</b></td></tr>";
	$sum_kvt=0;$sum_tenge=0;
	echo "<tr ><td colspan=4><b>{$o->firm_subgroup_name}</b></td>  </tr>";

	$last_group=$o->firm_subgroup_id;
	$last_group_name=$o->firm_subgroup_name;
}
$last_group=$o->firm_subgroup_id;
$sum_tenge+=$o->sum_tenge;
$sum_kvt+=$o->sum_kvt;
$_sum_tenge+=$o->sum_tenge;
$_sum_kvt+=$o->sum_kvt;
$sum_tariff_kvt+=$o->sum_kvt;
$sum_tariff_tenge+=$o->sum_tenge;
?>
<tr>
<td align=left>
<?php echo $o->firm_power_group_name; ?>
</td>
<td align=right>
<?php echo $o->sum_kvt; ?>
</td>
<td align=right>
<?php echo f_d($o->sum_tenge); ?>
</td>
<td align=right>
<?php echo f_d(($o->sum_kvt==0?"0":$o->sum_tenge/$o->sum_kvt)); ?>
</td>
<td>
</td>
</tr>
<?php endforeach;
echo "<tr><td align=right><b>Всего по тарифу ".
	f_d($last_tariff)."</b>
	</td><td align=right>".f_d($sum_tariff_kvt)."</td><td align=right>".f_d($sum_tariff_tenge)."</td>
	<td align=right>&nbsp;</td>
	</td></tr>";
	
echo "<tr ><td align=left><b>Итого {$last_group_name}</b></td><td align=right><b>{$sum_kvt}</b>
</td><td align=right><b>{$sum_tenge}</b></td><td align=right><b>".
	f_d($sum_tenge/$sum_kvt)."</b></td></tr>";
?>
<tr>
<td><b>Всего</b></td><td align=right><b><?php echo f_d($_sum_kvt);?></b></td><td align=right>
<b><?php echo f_d($_sum_tenge);?></b></td><td align=right><b><?php echo f_d($_sum_tenge/$_sum_kvt);?></b></td>
</tr>
</table>
<br><br>

<table align=center width=70%>
<tr align=center>
<td>Начальник</td>
<td><?php echo $org_info->nachalnik;?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr align=center>
<td>Нач. управления сбыта</td>
<td><?php echo $org_info->nachalnik_otdela_sbyta;?></td>
</tr>
</table>
</body>
</html>

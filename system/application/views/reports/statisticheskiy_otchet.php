<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}
function datetostring($date)
{
	$d=explode("-",$date); 
	return $d['1'].'.'.$d['0'].'.'.$d['2'];
}
?>
<html>
<head>
<title>Статистический отчет</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>


<center>
Статистический отчет<br><?php echo $period_name->current_period;?>
</center>

<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>
<td rowspan=4 align=center>Наименование</td>
<td colspan=3 align=center >Предприятий</td>
<td colspan=11 align=center >Счетчиков</td>
</tr>
<tr>
<td rowspan=3 align=center>Всего</td>
<td rowspan=3 align=center>Действ</td>
<td rowspan=3 align=center>Откл</td>
<td rowspan=3 align=center>Всего</td>
<td colspan=5 align=center>Действующих</td>
<td colspan=5 align=center>Отключенных</td>
</tr>
<tr>
<td rowspan=2 align=center>Всего</td>
<td colspan=4 align=center>Актив</td>
<td rowspan=2 align=center>Всего</td>
<td colspan=3 align=center>Актив</td>
<td rowspan=2 align=center>Реакт</td>
</tr>
<tr>
<td >Всего</td>
<td >одноф</td>
<td >трехф</td>
<td >Многотариф.</td>
<td >Всего</td>
<td >одноф</td>
<td >трехф</td>

</tr>


<?php 
$sum_firm=0;
$sum_1_phase=0;
$sum_3_phase=0;
$sum_2_tariff=0;
;foreach($otchet->result() as $o):
$sum_firm+=$o->count_firm_id;
$sum_1_phase+=$o->count_1_phase;
$sum_3_phase+=$o->count_3_phase;
$sum_2_tariff+=$o->count_2_tariff;
?>
<tr>
<td>&nbsp;<?php echo $o->firm_subgroup_name;?></td>
<td>&nbsp;<?php echo $o->count_firm_id;?></td>
<td>&nbsp;<?php echo $o->count_firm_id;?></td>
<td>&nbsp;</td>
<td>&nbsp;<?php echo $o->count_1_phase+$o->count_3_phase;?></td>
<td>&nbsp;<?php echo $o->count_1_phase+$o->count_3_phase;?></td>
<td>&nbsp;<?php echo $o->count_1_phase+$o->count_3_phase;?></td>
<td>&nbsp;<?php echo $o->count_1_phase;?></td>
<td>&nbsp;<?php echo $o->count_3_phase-$o->count_2_tariff;?></td>
<td>&nbsp;<?php echo $o->count_2_tariff;?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<?php endforeach; ?>
<tr>
<td align=right >&nbsp;ВСЕГО</td>
<td>&nbsp;<?php echo $sum_firm;?></td>
<td>&nbsp;<?php echo $sum_firm;?></td>
<td>&nbsp;</td>
<td>&nbsp;<?php echo $sum_1_phase+$sum_3_phase; ?></td>
<td>&nbsp;<?php echo $sum_1_phase+$sum_3_phase;?></td>
<td>&nbsp;<?php echo $sum_1_phase+$sum_3_phase;?></td>
<td>&nbsp;<?php echo $sum_1_phase;?></td>
<td>&nbsp;<?php echo $sum_3_phase-$sum_2_tariff;?></td>
<td>&nbsp;<?php echo $sum_2_tariff;?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>

</html>
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
<td rowspan=5 align=center>Наименование</td>
<td colspan=3 align=center >Предприятий</td>
<td colspan=13 align=center >Счетчиков</td>
</tr>
<tr>
<td rowspan=4 align=center>Всего</td>
<td rowspan=4 align=center>Действ</td>
<td rowspan=4 align=center>Откл</td>
<td rowspan=4 align=center>Всего</td>
<td colspan=6 align=center>Действующих</td>
<td colspan=6 align=center>Отключенных</td>
</tr>
<tr>
<td rowspan=3 align=center>Всего</td>
<td colspan=5 align=center>Актив</td>
<td rowspan=3 align=center>Всего</td>
<td colspan=5 align=center>Актив</td>
</tr>
<tr>
<td rowspan=2 align=center>Всего</td>
<td colspan=2 align=center>Однотариф.</td>
<td colspan=2 align=center>Многотариф.</td>
<td rowspan=2 align=center>Всего</td>
<td colspan=2 align=center>Однотариф.</td>
<td colspan=2 align=center>Многотариф.</td>
</tr>
<tr>
<td >одноф</td>
<td >трехф</td>
<td >одноф</td>
<td >трехф</td>
<td >одноф</td>
<td >трехф</td>
<td >одноф</td>
<td >трехф</td>
</tr>

<?php 
$sum_firm=0;
$sum_odnotarif_1_phase=0;
$sum_odnotarif_3_phase=0;
$sum_mnogotarif_1_phase=0;
$sum_mnogotarif_3_phase=0;
$sum_firm_closed=0;
$sum_odnotarif_1_phase_closed=0;
$sum_odnotarif_3_phase_closed=0;
$sum_mn1=0;
$sum_mn3=0;

;foreach($otchet->result() as $o):
$sum_firm+=$o->count_firm_id;
$sum_odnotarif_1_phase+=$o->count_odnotarif_1_phase;
$sum_odnotarif_3_phase+=$o->count_odnotarif_3_phase;
$sum_mnogotarif_1_phase+=$o->count_mnogotarif_1_phase;
$sum_mnogotarif_3_phase+=$o->count_mnogotarif_3_phase;


$sum_firm_closed+=$o->count_firm_id_closed;
$sum_odnotarif_1_phase_closed+=$o->count_odnotarif_1_phase_closed;
$sum_odnotarif_3_phase_closed+=$o->count_odnotarif_3_phase_closed;
$sum_mn1+=$o->count_mn1;
$sum_mn3+=$o->count_mn3;
?>
<tr>
<td>&nbsp;<?php echo $o->firm_subgroup_name;?></td>
<td>&nbsp;<?php echo $o->count_firm_id+$o->count_firm_id_closed;?></td>
<td>&nbsp;<?php echo $o->count_firm_id;?></td>
<td>&nbsp;<?php echo $o->count_firm_id_closed;?></td>
<td>&nbsp;<?php echo $o->count_odnotarif_1_phase+$o->count_odnotarif_3_phase;?></td>
<td>&nbsp;<?php echo $o->count_odnotarif_1_phase+$o->count_odnotarif_3_phase;?></td>
<td>&nbsp;<?php echo $o->count_odnotarif_1_phase+$o->count_odnotarif_3_phase;?></td>
<td>&nbsp;<?php echo $o->count_odnotarif_1_phase;?></td>
<td>&nbsp;<?php echo $o->count_odnotarif_3_phase-$o->count_mnogotarif_1_phase-$o->count_mnogotarif_3_phase;?></td>
<td>&nbsp;<?php echo $o->count_mnogotarif_1_phase;?></td>
<td>&nbsp;<?php echo $o->count_mnogotarif_3_phase;?></td>


<td>&nbsp;<?php echo $o->count_odnotarif_1_phase_closed+$o->count_odnotarif_3_phase_closed;?></td>
<td>&nbsp;<?php echo $o->count_odnotarif_1_phase_closed+$o->count_odnotarif_3_phase_closed;?></td>
<td>&nbsp;<?php echo $o->count_odnotarif_1_phase_closed;?></td>
<td>&nbsp;<?php echo $o->count_odnotarif_3_phase_closed-$o->count_mn1-$o->count_mn3;?></td>
<td>&nbsp;<?php echo $o->count_mn1;?></td>
<td>&nbsp;<?php echo $o->count_mn3;?></td>


</tr>
<?php endforeach; ?>
<tr>
<td align=right >&nbsp;ВСЕГО</td>
<td>&nbsp;<?php echo $sum_firm+$sum_firm_closed;?></td>
<td>&nbsp;<?php echo $sum_firm;?></td>
<td>&nbsp;<?php echo $sum_firm_closed;?></td>
<td>&nbsp;<?php echo $sum_odnotarif_1_phase+$sum_odnotarif_3_phase; ?></td>
<td>&nbsp;<?php echo $sum_odnotarif_1_phase+$sum_odnotarif_3_phase;?></td>
<td>&nbsp;<?php echo $sum_odnotarif_1_phase+$sum_odnotarif_3_phase;?></td>
<td>&nbsp;<?php echo $sum_odnotarif_1_phase;?></td>
<td>&nbsp;<?php echo $sum_odnotarif_3_phase-$sum_mnogotarif_1_phase-$sum_mnogotarif_3_phase;?></td>
<td>&nbsp;<?php echo $sum_mnogotarif_1_phase;?></td>
<td>&nbsp;<?php echo $sum_mnogotarif_3_phase;?></td>

<td>&nbsp;<?php echo $sum_odnotarif_1_phase_closed+$sum_odnotarif_3_phase_closed;?></td>
<td>&nbsp;<?php echo $sum_odnotarif_1_phase_closed+$sum_odnotarif_3_phase_closed;?></td>
<td>&nbsp;<?php echo $sum_odnotarif_1_phase_closed;?></td>
<td>&nbsp;<?php echo $sum_odnotarif_3_phase_closed-$sum_mn1-$sum_mn3;?></td>
<td>&nbsp;<?php echo $sum_mn1;?></td>
<td>&nbsp;<?php echo $sum_mn3;?></td>
</tr>
</table>

</html>
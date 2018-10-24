<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}
function datetostring($date)
{
	$d=explode("-",$date); 
	return $d['0'].'.'.$d['1'].'.'.$d['2'];
}
?>
<html>
<head>
<title>Снятые показаний по ТП за <?php echo $period_name->current_period; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>


<center><b>Снятые показаний по ТП за <?php echo $period_name->current_period; ?></b></center>
<br>

<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>
<td>№</td>
<td>ТП</td>
<td>Договор</td>
<td>Предприятие</td>
<td>№ счетчика</td>
<td>Тип учета</td>
<td>показания</td>
<td>примечание</td>
</tr>

<?php $i=1;foreach($values->result() as $v):?>
<tr>
<td><?php echo $i++;?></td>
<td><?php echo $v->tp_name;?></td>
<td><?php echo $v->dogovor;?></td>
<td><?php echo $v->firm_name;?></td>
<td align=center><?php echo $v->gos_nomer;?></td>
<td><?php echo $v->tariff_name;?></td>
<td align=right><?php echo f_d($v->value);?></td>
<td></td>
</tr>
<?php endforeach; ?>
</table>

</html>
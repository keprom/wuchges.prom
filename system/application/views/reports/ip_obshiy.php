<?php
function f_d($var)
{
	if ($var == null) return " ";
	if ($var == 0) return " "; else
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
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<table width=100%>
	<tr><td align=center><b>Частники, расчитывающиеся по общему тарифу за </b></td></tr>
	<tr><td align=center><b><?php echo $period->name;?></b></td></tr></table>
<br>

<table width=100% border = 1>
<tr>
<td>П/П</td>
<td>Договор</td>
<td>Наименование</td>
<td>Точка учета</td>
<td>Гос номер счетчика</td>
</tr>
<?php $i=1; foreach ($ip->result() as $firm){?>
<tr>
<td><?php echo $i;$i++;?></td>
<td><?php echo $firm->dogovor;?></td>
<td><?php echo $firm->firm_name;?></td>
<td><?php echo $firm->bill_name;?></td>
<td><?php echo $firm->gos_nomer;?></td>
</tr>
<?php }?>
</table>
</body>
</html>
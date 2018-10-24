<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}
 
?>
<html>
<head>
<title>Учет электроэнергии. Промышленный отдел</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<center>Оплата по фирмам за период</center>
<center><?php $period->name; ?></center>

<br>
<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>
<td>№ П.П.</td>
<td># Дог.</td>
<td>Наименование предприятия</td>
<td>Сумма оплат</td>
</tr>
<?php 
$i=1;foreach($svod->result() as $firm):?>
<tr>
<td><?php echo $i++;?></td>
<td align=center><?php echo $firm->dogovor; ?></td>
<td><?php echo $firm->firm_name; ?></td>
<td align=right><?php echo f_d($firm->sum); ?></td>
</tr>
<?php endforeach;?>
</table>
<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}
function f_d2($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.0f",$var);
}
?>
<html>
<head>
<title>Оборотная ведомость с учетом предоплаты</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<center>ОБОРОТНАЯ ВЕДОМОСТЬ С УЧЕТОМ ПРЕДОПЛАТЫ</center>
<center> за <?php echo $period->name;?> </center>
<?php 
$last_group=-1;

?>

<table  width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: xx-small;">
<tr align=center>
<td  rowspan=2>
№ Дог.
</td>
<td rowspan=2 width=200px>
Наименование потребителя
</td>
<td colspan=2>
На начало отчетного периода
</td>
<td rowspan=2>
Начислено
</td>
<td rowspan=2>
Оплачено, всего
</td>
<td colspan=2>
На конец периода
</td>
<td rowspan=2>
Последнее начисление
</td>
</tr>
<tr align=center>
<td>
Дебет
</td>
<td>
Кредит
</td>
<td>
Дебет
</td>
<td>
Кредит
</td>
</tr>
<!-- Конец шапки -->
<?php $u_sum_debet=0;$u_sum_kredit=0;$u_sum_nachisleno=0;$u_sum_oplata=0;$u_sum_kredit_end=0;$u_sum_debet_end=0;$u_sum_itogo_kvt=0?>

<?php $sum_debet=0;$sum_kredit=0;$sum_nachisleno=0;$sum_oplata=0;$sum_kredit_end=0;$sum_debet_end=0;$sum_itogo_kvt=0?>
<?php foreach($oborotka->result() as $data):?>
<?php if ($last_group!=$data->subgroup_id):?>
	<?php if ($last_group!=-1): ?> 
		<tr align=right><td colspan=2 align=right><b>Итого по группе</b></td>
			<td><b><?php echo f_d($sum_debet); ?></b></td>
			<td><b><?php echo f_d($sum_kredit); ?></b></td>
			<td><b><?php echo f_d($sum_nachisleno); ?></b></td>
			<td><b><?php echo f_d($sum_oplata); ?></b></td>
			<td><b><?php echo f_d($sum_debet_end); ?></b></td>
			<td><b><?php echo f_d($sum_kredit_end); ?></b></td>
			<td><b><?php echo f_d($sum_itogo_kvt); ?></b></td>
			
			<?php 
			$u_sum_debet+=$sum_debet;
			$u_sum_kredit+=$sum_kredit;
			$u_sum_nachisleno+=$sum_nachisleno;
			$u_sum_oplata+=$sum_oplata;
			$u_sum_kredit_end+=$sum_kredit_end;
			$u_sum_debet_end+=$sum_debet_end;
			$u_sum_itogo_kvt+=$sum_itogo_kvt;
			?>
			<?php $sum_debet=0;$sum_kredit=0;$sum_nachisleno=0;$sum_oplata=0;$sum_kredit_end=0;$sum_debet_end=0;$sum_itogo_kvt=0;?>
		</tr>
	<?php endif;?>
<tr><td colspan=9><b><?php echo $data->subgroup_name;?> </b></td></tr>
<?php endif;?>
<tr>
<td align=center>
<?php echo $data->dogovor;?>
</td>
<td>
<?php echo $data->firm_name;?>
</td>
<td align=right>&nbsp;
<?php echo f_d($data->debet_value);?>
</td>
<td align=right>&nbsp;
<?php echo f_d($data->kredit_value);?>
</td>
<td align=right>
<?php echo f_d($data->nachisleno);?>
</td>
<td align=right>
<?php echo f_d($data->oplata_value);?>
</td>
<?php $saldo=
$data->debet_value- $data->kredit_value-
$data->oplata_value+$data->nachisleno+$data->last_nachisleno;

 ?>
<td align=right>
 <?php if ($saldo>0) echo f_d($saldo); else echo "&nbsp;";?>
</td>
<td align=right>
 <?php if ($saldo<0) echo f_d(-1*$saldo); else echo "&nbsp;"; ?>
</td>
<td align=right>
<?php echo f_d($data->last_nachisleno);?>
</td>

</tr>
<?php 
$last_group=$data->subgroup_id;
$sum_debet+=$data->debet_value;
$sum_kredit+=$data->kredit_value;
$sum_nachisleno+=$data->nachisleno;
$sum_oplata+=$data->oplata_value;
$sum_kredit_end+=($saldo<0?-1*$saldo:0);
$sum_debet_end+=($saldo>0?$saldo:0);
$sum_itogo_kvt+=$data->last_nachisleno;
?>
<?php endforeach;?>
<tr align=right><td colspan=2 align=right><b>Итого по группе</b></td>
			<td><b><?php echo f_d($sum_debet); ?></b></td>
			<td><b><?php echo f_d($sum_kredit); ?></b></td>
			<td><b><?php echo f_d($sum_nachisleno); ?></b></td>
			<td><b><?php echo f_d($sum_oplata); ?></b></td>
			<td><b><?php echo f_d($sum_debet_end); ?></b></td>
			<td><b><?php echo f_d($sum_kredit_end); ?></b></td>
			<td><b><?php echo f_d($sum_itogo_kvt); ?></b></td>
		</tr>
		<?php 
			$u_sum_debet+=$sum_debet;
			$u_sum_kredit+=$sum_kredit;
			$u_sum_nachisleno+=$sum_nachisleno;
			$u_sum_oplata+=$sum_oplata;
			$u_sum_kredit_end+=$sum_kredit_end;
			$u_sum_debet_end+=$sum_debet_end;
			$u_sum_itogo_kvt+=$sum_itogo_kvt;
			?>
<tr><td colspan=9>&nbsp;</td></tr>
<tr>
<td colspan=2 align=right>Итого</td>
<td><font size=1><?php echo f_d($u_sum_debet); ?></font></td>
			<td><font size=1><?php echo f_d($u_sum_kredit); ?></font></td>
			<td><font size=1><?php echo f_d($u_sum_nachisleno); ?></font></td>
			<td><font size=1><?php echo f_d($u_sum_oplata); ?></font></td>
			<td><font size=1><?php echo f_d($u_sum_debet_end); ?></font></td>
			<td><font size=1><?php echo f_d($u_sum_kredit_end); ?></font></td>
			<td><font size=1><?php echo f_d2($u_sum_itogo_kvt); ?></font></td>
</tr>

</table>

</center>
</html>
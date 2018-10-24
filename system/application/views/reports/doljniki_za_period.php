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
<title>Список потребителей</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<center>Список потребителей <?php echo " ".$nazv." ";?> по оплате за потребленную электроэнергию</center>
<center><?php echo $org_info->org_name;?> за <?php echo $period->name." ";
if ($use_ture='1')
  $ture;?> </center>
<?php 
$last_group=-1;
$pp = 1;
?>

<table  width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: xx-small;">
<tr align=center>
<td>
№
</td>
<td>
№ Договора
</td>
<td>
Наименование потребителя
</td>
<td>
Телефон
</td>
<td>
Адрес
</td>
<td>
Последнее начисление (тенге)
</td>
<td>
<?php if ($nazv == " дебиторов "){ echo "Дебет (тенге)";} else {echo "Кредит (тенге)";} ?>
</td>
</tr>
<!-- Конец шапки -->
<?php $sum_debet=0;$sum_kredit=0;$sum_nachisleno=0;$sum_oplata=0;$sum_kredit_end=0;$sum_debet_end=0;$sum_itogo_kvt=0?>
<?php foreach($sql_result->result() as $data):?>
<tr>
<td align=center>
<?php echo $pp++;?>
</td>
<td align=center>
<?php echo $data->dogovor;?>
</td>
<td>
<?php echo $data->firm_name;?>
</td>
<td>
<?php echo $data->telefon;?>
</td>
<td>
<?php echo $data->address;?>
</td>
<td align=right>
<?php if (!$data->nachisleno){echo "0.00";}else{echo f_d($data->nachisleno);}?>
</td>
<td align=right>
<?php if ($nazv == " дебиторов "){ if (!$data->debet_value){echo "0.00";}else{echo f_d($data->debet_value);}} else { if (!$data->kredit_value){echo "0.00";}else{echo f_d($data->kredit_value);}}?>
</td>
</tr>
<?php 
$sum_debet+=$data->debet_value;
$sum_kredit+=$data->kredit_value;
$sum_nachisleno+=$data->nachisleno;
?>
<?php endforeach;?>
<tr align=right><td colspan=5 align=left><b>Итого:</b></td>
<td><b><?php echo f_d($sum_nachisleno); ?></b></td>
			<td><b><?php if ($nazv == " дебиторов "){echo f_d($sum_debet);} else { echo f_d($sum_kredit);}?></b></td>
			</tr>
		</table>
<br>
<br>
<center>
<table>
<tr>
<td>Главный бухгалтер</td><td width=150px></td><td> <?php echo $org_info->glav_buh;?></td>
</tr><tr>
<td>Начальник отдела сбыта</td><td width=150px></td><td> <?php echo trim($org_info->nachalnik_otdela_sbyta);?></td>
</tr>
</table>
</center>
</html>
<html>
<head>
<title>Учет электроэнергии. Промышленный отдел</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php 
function nbsp($var)
{
 for ($i=0;$i<$var;$i++) echo "&nbsp;";
}
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
</head>
<CENTER>АКТ <br> сверки взаиморасчетов</CENTER>
<br>
<br>
Мы, нижеподписавшиеся, бухгалтер  <?php echo $org_info->org_name;?><br><br>
__________________________________________<br>
с одной стороны и бухгалтер <?php echo $firm->name;?><br><br>
__________________________________________<br>
с другой стороны сего числа произвели сверку взаиморасчетов<br>
по состоянию на  1 <?php echo $last_period->name;?><br><br>

<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: xx-small;">
<tr> 
 <td rowspan=2 width=33%>Содержание записи</td>
 <td colspan=2 width=33%><?php echo $org_info->org_name;?></td>
 <td colspan=2><?php echo $firm->name;?></td>
</tr>
<tr>
 <td>Дебет</td>
 <td>Кредит</td>
 <td>Дебет</td>
 <td>Кредит </td>
</tr>
<tr>
<td>
Сальдо на
<?php echo $first_period->name; ?>
</td>
<td align=right> <?php echo f_d($begin_saldo->value>0?$begin_saldo->value:0)?> </td>
<td align=right> <?php echo f_d($begin_saldo->value<0?$begin_saldo->value*-1:0)?> </td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<?php
$sum_debet=0;
$sum_kredit=0;
$last_period_id="";
 foreach($akt->result() as $a):
if ($last_period_id!=$a->period_name)
{ 
	$sum_debet+=f_d($a->nachisleno==null?0:$a->nachisleno);
		
}
$sum_kredit+=f_d($a->oplata_value==null?0:$a->oplata_value);
?>
<tr> 
 <td>Счет <?php echo $firm->dogovor;?> за <?php echo $a->period_name;?>
  <?php if ($a->payment_number_name!=null)
               echo $a->payment_number_name." от ".datetostring($a->oplata_data); 
	?></td>
 <td align=right>&nbsp;<?php if($last_period_id!=$a->period_name) echo f_d($a->nachisleno);?></td>
 <td align=right>&nbsp;<?php echo f_d($a->oplata_value);?></td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
</tr>
<?php $last_period_id=$a->period_name;
endforeach;?>
<tr>
<td>
<b>Итого оборотов за период</b>
</td>
<td align=right> <b> <?php echo f_d($sum_debet);?></b> </td>
<td align=right><b> <?php echo f_d($sum_kredit);?></b> </td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>
Сальдо на
<?php echo $last_period->name; ?>
</td>
<td align=right> <?php echo f_d($end_saldo->value>0?$end_saldo->value:0)?> </td>
<td align=right>  <?php echo f_d($end_saldo->value<0?$end_saldo->value*-1:0)?> </td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

</table>
<br>
<br>
<br>
<center>
<table>
<tr>
<td><u>Директор <?php nbsp(3); echo $org_info->director; nbsp(17);?></u></td>
<td width=70px></td>
<td><u>Директор <?php   nbsp(20);?></u></td>

</tr>
<tr>
<td style="border: black;font-family: Verdana; font-size: xx-small;"><center>(Должность, ФИО, подпись)</center></td>
<td width=70px></td>
<td style="border: black;font-family: Verdana; font-size: xx-small;"><center>(Должность, ФИО, подпись)</center></td>
</tr>
<tr>
<td><u>Гл. бухгалтер  <?php nbsp(3); echo $org_info->glav_buh; nbsp(27);?></u></td>
<td width=70px></td>
<td><u>Гл. бухгалтер <?php   nbsp(30);?></u></td>

</tr>
<tr>
<td style="border: black;font-family: Verdana; font-size: xx-small;" ><center>(Должность, ФИО, подпись)</center></td>
<td width=70px></td>
<td style="border: black;font-family: Verdana; font-size: xx-small;"><center>(Должность, ФИО, подпись)</center></td>
</tr>
<tr>
<td><u>Бухгалтер  <?php nbsp(3); nbsp(30);?></u></td>
<td width=70px></td>
<td><u>Бухгалтер <?php   nbsp(30);?></u></td>

</tr>
<tr>
<td style="border: black;font-family: Verdana; font-size: xx-small;"><center>(Должность, ФИО, подпись)</center></td>
<td width=70px></td>
<td style="border: black;font-family: Verdana; font-size: xx-small;"><center>(Должность, ФИО, подпись)</center></td>
</tr>
</table>
</center>
</html>
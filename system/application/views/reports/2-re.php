<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}?>
<html>
<head>
<title>Отчет по оплате за электроэнергию</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>

<center><b> <?php echo $org_info->org_name;?> Щучинские городские электросети <br> Отчет по оплате за электроэнергию и по задолжностям групп потребителей <br> за <?php echo $period->name;?>.</b></center>
<br>
<br>
<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr align=center>
<td rowspan=2>Наименование </td>
<td colspan=2>Сальдо на начало периода</td>
<td rowspan=2>Начислено</td>
<td rowspan=2>Оплачено</td>
<td colspan=2>В том числе по видам средств</td>
<td colspan=2>Сальдо на конец периода</td>
</tr>
<tr align=center>
<td> Дебет </td>
<td >Кредит</td>
<td> Деньги </td>
<td> Прочие</td>
<td> Дебет</td>
<td >Кредит</td>
</tr>
<?php $u_debet_begin=0;$u_kredit_begin=0;$u_nachisleno=0;
$u_oplata=0;
$u_oplata_prochee=0;
$u_debet_end=0;$u_kredit_end=0;?>
<?php foreach($sql_result->result() as $a): ?>
<tr align=right>
<td align=left> <?php echo $a->subgroup_name;?></td>
<td> <?php echo f_d($a->sum_debet_begin);?></td>
<td> <?php echo f_d($a->sum_kredit_begin);?></td>
<td> <?php echo f_d($a->sum_nachisleno);?></td>
<td> <?php echo f_d($a->sum_oplata);?></td>
<td> <?php echo f_d($a->sum_oplata)-f_d($a->sum_oplata_prochee);?></td>
<td> <?php echo f_d($a->sum_oplata_prochee);?></td>

<td> <?php echo f_d($a->sum_debet);?></td>
<td> <?php echo f_d($a->sum_kredit);?></td>
</tr>
<?php 
$u_debet_begin+=$a->sum_debet_begin;
$u_kredit_begin+=$a->sum_kredit_begin;
$u_nachisleno+=$a->sum_nachisleno;
$u_oplata+=$a->sum_oplata;
$u_oplata_prochee+=$a->sum_oplata_prochee;
$u_debet_end+=$a->sum_debet;
$u_kredit_end+=$a->sum_kredit;
?>
<?php endforeach; ?>

<tr align=center>
<td align=right> <b>Всего</b> </td>
<td ><b><?php echo f_d($u_debet_begin); ?></b></td>
<td ><b><?php echo f_d($u_kredit_begin); ?></b></td>
<td ><b><?php echo f_d($u_nachisleno); ?></b></td>
<td ><b><?php echo f_d($u_oplata); ?></b></td>
<td  align=right><b>&nbsp;<?php echo f_d($u_oplata-$u_oplata_prochee); ?></b></td>
<td  align=right><b>&nbsp;<?php echo f_d($u_oplata_prochee); ?></b></td>
<td ><b><?php echo f_d($u_debet_end); ?></b></td>
<td ><b><?php echo f_d($u_kredit_end); ?></b></td>
</tr>
</table>

<br>
<br>
<br>
<table align=center>
<tr height=50px>
<td><b>Начальник:</b></td>
<td width=150px></td>
<td> <b><?php echo $org_info->nachalnik;?></b></td>
</tr>
<tr>
<td> <b>Бухгалтер ЩГЭС:</b></td>
<td width=150px></td>
<td><b> <?php echo $org_info->buh;?></b></td>
</tr>
</table>
</html>
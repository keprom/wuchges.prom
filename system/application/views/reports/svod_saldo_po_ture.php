<?php
function f_d($var)
{
	if ($var==0) return "0.00"; else
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
<table width=100% border=1px >
<tr>
<td align=center>
<b>Свод сальдо по участкам на
 <?php echo $period_name->current_period;?></b>
</td>
</tr>
</table>
<br>
<br>
<table width=100% border=1px >
 <tr>
 <th align=center>
  <b>Наименование участка</b>
 </th>
 <th align=center>
  <b>Дебет</b>
 </th>
 <th align=center>
  <b>Кредит</b>
 </th>
 </tr>
<?php $sum_debet=0;$sum_kredit=0; foreach($ture->result() as $t ):?>
 <tr>
 <td align=left>
   <?php echo $t->ture_name;?>
 </td>
 <td align=right>
  <?php echo f_d($t->sum_debet);?>
 </td>
 <td align=right>
  <?php echo f_d($t->sum_kredit);?>
 </td>
 </tr>
 <?php $sum_debet+=$t->sum_debet;$sum_kredit+=$t->sum_kredit; endforeach;?>
  <tr>
 <th align=right>
  <b>Итого</b>
 </th>
 <th align=right>
  <b><?php echo f_d($sum_debet);?></b>
 </th>
 <th align=right>
  <b><?php echo f_d($sum_kredit);?></b>
 </th>
 </tr>
 </table>
 </body>
</html>
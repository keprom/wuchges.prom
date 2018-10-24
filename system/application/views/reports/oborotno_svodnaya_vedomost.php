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

<center><b><h3>Оборотно-сводная ведомость<br>за <?php echo $period_name;?> </h3></b></center>
<br>
<br>
<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
  <tr align=center>
 <th >
   Наименование ТУРЭ
 </th>
 <th>
  Дебет
 </th>
 <th>
  Кредит
 </th>
 <th>
  Оплата
 </th>
 <th>
  Начислено
 </th>
 <th>
  Дебет
 </th>
 <th>
  Кредит
 </th>
 <th>
  кВт
 </th>
 </tr>
 
<?php 
	$sum_debet=0;$sum_kredit=0; 
	$oplata_value_sum=0;$nachisleno_sum=0;
	$sum_debet_end=0;$sum_kredit_end=0; 
	$itogo_kvt=0; 
	
	$_sum_debet=0;$_sum_kredit=0; 
	$_oplata_value_sum=0;$_nachisleno_sum=0;
	$_sum_debet_end=0;
	$_sum_kredit_end=0; 
	$_itogo_kvt=0; 
	
	$last_group=-1;
foreach($oborotka->result() as $o ):?>
	<?php
	 if ($last_group==-1)
	 {
		echo "<tr><td colspan=8><b>{$o->subgroup_name} </b></td></tr>";
		$last_group=$o->subgroup_name;
	 }
	 if ($o->subgroup_name!=$last_group)
	 {
		echo "<tr align=right><td align=left><b>ИТОГО:</b></td>
		<td><b>".f_d($sum_debet)."</b></td>
		<td><b>".f_d($sum_kredit)."</b></td>
		<td><b>".f_d($oplata_value_sum)."</b></td>
		<td><b>".f_d($nachisleno_sum)."</b></td>
		<td><b>".f_d($sum_debet_end)."</b></td>
		<td><b>".f_d($sum_kredit_end)."</b></td>
		<td><b>".f_d($itogo_kvt)."</b></td>
		</tr>";
		echo "<tr><td colspan=8><b>{$o->subgroup_name}</b> </td></tr>";
		$last_group=$o->subgroup_name;
		$sum_debet=0;$sum_kredit=0; 
	$oplata_value_sum=0;$nachisleno_sum=0;
	$sum_debet_end=0;$sum_kredit_end=0; 
	$itogo_kvt=0;
	 }
	?>
 <tr>
 <td align=left>
   <?php echo $o->ture_name;?>
 </td>
 <td align=right>
  <?php echo f_d($o->debet_value);?>
 </td>
 <td align=right>
  <?php echo f_d($o->kredit_value);?>
 </td>
 <td align=right>
  <?php echo f_d($o->oplata_value);?>
 </td>
 <td align=right>
  <?php echo f_d($o->nachisleno);?>
 </td>
 <td align=right>
  <?php echo f_d($o->debet_value_end);?>
 </td>
 <td align=right>
  <?php echo f_d($o->kredit_value_end);?>
 </td>
 <td align=right>
  <?php echo f_d($o->itogo_kvt);?>
 </td>
 </tr>
 <?php 
 $sum_debet+=$o->debet_value;
 $sum_kredit+=$o->kredit_value;
 $sum_debet_end+=$o->debet_value_end;
 $sum_kredit_end+=$o->kredit_value_end;
 $nachisleno_sum+=$o->nachisleno;
 $oplata_value_sum+=$o->oplata_value;
 $itogo_kvt+=$o->itogo_kvt;
 
 $_sum_debet+=$o->debet_value;
 $_sum_kredit+=$o->kredit_value;
 $_sum_debet_end+=$o->debet_value_end;
 $_sum_kredit_end+=$o->kredit_value_end;
 $_nachisleno_sum+=$o->nachisleno;
 $_oplata_value_sum+=$o->oplata_value;
 $_itogo_kvt+=$o->itogo_kvt;
 endforeach;
 ////////////////////////////////
 
	echo "<tr align=right><td align=left><b>ИТОГО:</b></td>
	<td><b>".f_d($sum_debet)."</b></td>
	<td><b>".f_d($sum_kredit)."</b></td>
	<td><b>".f_d($oplata_value_sum)."</b></td>
	<td><b>".f_d($nachisleno_sum)."</b></td>
	<td><b>".f_d($sum_debet_end)."</b></td>
	<td><b>".f_d($sum_kredit_end)."</b></td>
	<td><b>".f_d($itogo_kvt)."</b></td>
	</tr>";


	//////////////////////////////
	 ?>
  <tr>
 <td align=right>
  <b>Итого</b>
 </td>
 <td align=right>
  <b><?php echo f_d($_sum_debet);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($_sum_kredit);?></b>
 </td>
  <td align=right>
  <b><?php echo f_d($_oplata_value_sum);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($_nachisleno_sum);?></b>
 </td>
  <td align=right>
  <b><?php echo f_d($_sum_debet_end);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($_sum_kredit_end);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($_itogo_kvt);?></b>
 </td>
 </tr>
 </table>
 </body>
</html>
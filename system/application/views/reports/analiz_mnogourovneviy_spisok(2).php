<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	{
		if  ($var == null ) return "&nbsp;"; else
			return sprintf("%22.2f",$var);
	}
}
function f_d2($var)
{
	if ($var==0) return "&nbsp;"; else
	{
		if  ($var == null ) return "&nbsp;"; else
			return sprintf("%22.0f",$var);
	}
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

<center>
<b>Анализ<br> учета полученной товарной продукции ( электроэнергии )<br> по <?php echo $org->org_name; ?><br> с применением многоуровневого тарифа за 
 <?php echo $period->name;?></b>
</center>
<br>
<br>

<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
 <tr align=center>
 <td rowspan=3>№
 </td>
 <td rowspan=3>Наименование потребителя
 </td>
 <td colspan=6>Получено товарной продукции
 </td>
 <td rowspan=3 width=80px>Всего кВт/ч
 </td>
 <td rowspan=3 width=100px>Всего тенге (без НДС)
 <td rowspan=3 width=110px>По ср. отпускному тарифу (без НДС: 12,307)
 </td>
 <td rowspan=3 width=110px>Разница (+,-)
 </td>
 </tr>
 <tr align=center>
 <td colspan=2>
  По 1 уровню (без НДС 11,857)
 </td>
 <td colspan=2>
  По 2 уровню (без НДС 14,768)
 </td>
 <td colspan=2>
  По 3 уровню (без НДС 18,46)
 </td>
 </tr>
 <tr>
 <td >
  кВт/ч
 </td>
 <td >
  тенге
 </td>
 <td >
  кВт/ч
 </td>
 <td >
  тенге
 </td>
 <td >
  кВт/ч
 </td>
 <td >
  тенге
 </td>
 
 </tr>
<?php 
$sum_ur1_kvt=0;$sum_ur1_tenge=0;
$sum_ur2_kvt=0;$sum_ur2_tenge=0;
$sum_ur3_kvt=0;$sum_ur3_tenge=0;
$sum=0;$sum_with_nds=0;$sum_otp_nds=0;

$_sum_ur1_kvt=0;$_sum_ur1_tenge=0;
$_sum_ur2_kvt=0;$_sum_ur2_tenge=0;
$_sum_ur3_kvt=0;$_sum_ur3_tenge=0;
$_sum=0;$_sum_with_nds=0;$_sum_otp_nds=0;

$j=1;
$last_group=-1;$last_group_name='';
foreach($diff->result() as $d ):
if ($last_group==-1)
{
	echo "<tr><td colspan=13> <b>{$d->firm_subgroup_name}</b> </td></tr>";
	$last_group=$d->firm_subgroup_id;
	$last_group_name=$d->firm_subgroup_name;
}

//!
if ($last_group<>$d->firm_subgroup_id):
	?>
	<tr>
	  <td>&nbsp;
	  </td>
	 <td align=right>
	  <b>Итого по <?php echo $last_group_name; ?></b>
	 </td>
	 <td align=right>
	  <b><?php echo f_d2($sum_ur1_kvt);?></b>
	 </td>
	 <td align=right>
	  <b><?php echo f_d($sum_ur1_tenge);?></b>
	 </td>
	 <td align=right>
	  <b><?php echo f_d2($sum_ur2_kvt);?></b>
	 </td>
	 <td align=right>
	  <b><?php echo f_d($sum_ur2_tenge);?></b>
	 </td>
	 <td align=right>
	  <b><?php echo f_d2($sum_ur3_kvt);?></b>
	 </td>
	 <td align=right>
	  <b><?php echo f_d($sum_ur3_tenge);?></b>
	 </td>
	  <td align=right>
	  <b><?php echo f_d2($sum_ur1_kvt+$sum_ur2_kvt+$sum_ur3_kvt);?></b>
	 </td>
	  <td align=right>
	  <b><?php echo f_d($sum);?></b>
	 </td>
	 <td align=right>
	  <b><?php echo f_d($sum_otp_nds);?></b>
	 </td>
	 <td align=right>
	  <b><?php echo f_d($sum-$sum_otp_nds);?></b>
	 </td>
	</tr>
	<?php	
	$sum_ur1_kvt=0;$sum_ur1_tenge=0;
	$sum_ur2_kvt=0;$sum_ur2_tenge=0;
	$sum_ur3_kvt=0;$sum_ur3_tenge=0;
	$sum=0;$sum_with_nds=0;$sum_otp_nds=0;
		echo "<tr><td colspan=13> <b>{$d->firm_subgroup_name}</b> </td></tr>";
		$last_group=$d->firm_subgroup_id;
		$last_group_name=$d->firm_subgroup_name;
		
		
endif;

$sum_ur1_kvt += $d->itogo_kvt_ur1;
$sum_ur1_tenge += $d->tenge_ur1;
$sum_ur2_kvt += $d->itogo_kvt_ur2;
$sum_ur2_tenge += $d->tenge_ur2;
$sum_ur3_kvt += $d->itogo_kvt_ur3;
$sum_ur3_tenge += $d->tenge_ur3;

$sum+=($d->tenge_ur3+$d->tenge_ur1+$d->tenge_ur2);
$sum_with_nds+=($d->tenge_ur3+$d->tenge_ur1+$d->tenge_ur2)*($d->nds+100)/100;
$sum_otp_nds+=($d->itogo_kvt_ur1+$d->itogo_kvt_ur2+$d->itogo_kvt_ur3)*12.307;

$_sum_ur1_kvt+=$d->itogo_kvt_ur1;
$_sum_ur1_tenge+=$d->tenge_ur1;
$_sum_ur2_kvt+=$d->itogo_kvt_ur2;
$_sum_ur2_tenge+=$d->tenge_ur2;
$_sum_ur3_kvt+=$d->itogo_kvt_ur3;
$_sum_ur3_tenge+=$d->tenge_ur3;

$_sum+=($d->tenge_ur1+$d->tenge_ur2+$d->tenge_ur3);
$_sum_with_nds+=($d->tenge_ur1+$d->tenge_ur2+$d->tenge_ur3)*($d->nds+100)/100;
$_sum_otp_nds+=($d->itogo_kvt_ur1+$d->itogo_kvt_ur2+$d->itogo_kvt_ur3)*12.307;


?>
<tr align=right>
<td>
	<?php echo $j++;?>
</td> 
<td align=left>
	<?php echo $d->firm_name;?>
</td> 
<td>
	<?php echo f_d2($d->itogo_kvt_ur1);?>
</td> 
<td>
	<?php echo f_d($d->tenge_ur1);?>
</td> 
<td>
	<?php echo f_d2($d->itogo_kvt_ur2);?>
</td> 
<td>
	<?php echo f_d($d->tenge_ur2);?>
</td> 
<td>
	<?php echo f_d2($d->itogo_kvt_ur3);?>
</td> 
<td>
	<?php echo f_d($d->tenge_ur3);?>
</td> 
<td>
	<?php echo f_d2($d->itogo_kvt_ur1+$d->itogo_kvt_ur2+$d->itogo_kvt_ur3);?>
</td> 
<td>
	<?php echo f_d($d->tenge_ur1+$d->tenge_ur2+$d->tenge_ur3);?>
</td> 
<td>
	<?php echo f_d(($d->itogo_kvt_ur1+$d->itogo_kvt_ur2+$d->itogo_kvt_ur3)*12.307);?>
</td> 

<td>
	<?php echo f_d(($d->tenge_ur1+$d->tenge_ur2+$d->tenge_ur3)-(($d->itogo_kvt_ur1+$d->itogo_kvt_ur2+$d->itogo_kvt_ur3)*12.307));?>
</td> 

</tr> 
 <?php endforeach;?>
 
 <tr>
  <td>&nbsp;
  </td>
 <td align=right>
  <b>Итого по <?php echo $last_group_name; ?></b>
 </td>
 <td align=right>
  <b><?php echo f_d2($sum_ur1_kvt);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($sum_ur1_tenge);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d2($sum_ur2_kvt);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($sum_ur2_tenge);?></b>
 </td>
  <td align=right>
  <b><?php echo f_d2($sum_ur3_kvt);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($sum_ur3_tenge);?></b>
 </td>
  <td align=right>
  <b><?php echo f_d2($sum_ur1_kvt+$sum_ur2_kvt+$sum_ur3_kvt);?></b>
 </td>
  <td align=right>
  <b><?php echo f_d($sum_ur1_tenge+$sum_ur2_tenge+$sum_ur3_tenge);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($sum_otp_nds);?></b>
 </td>
 
 <td align=right>
  <b><?php echo f_d(($sum_ur1_tenge+$sum_ur2_tenge+$sum_ur3_tenge)-$sum_otp_nds);?></b>
 </td>
 
</tr>

  <tr>
  <td>&nbsp;
  </td>
 <td align=right>
  <b>Итого</b>
 </td>
 <td align=right>
  <b><?php echo f_d2($_sum_ur1_kvt);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($_sum_ur1_tenge);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d2($_sum_ur2_kvt);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($_sum_ur2_tenge);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d2($_sum_ur3_kvt);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($_sum_ur3_tenge);?></b>
 </td>
 
 <td align=right>
  <b><?php echo f_d2($_sum_ur2_kvt+$_sum_ur1_kvt+$_sum_ur3_kvt);?></b>
 </td>
  <td align=right>
  <b><?php echo f_d($_sum_ur2_tenge+$_sum_ur1_tenge+$_sum_ur3_tenge);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($_sum_otp_nds);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d(($_sum_ur2_tenge+$_sum_ur1_tenge+$_sum_ur3_tenge)-$_sum_otp_nds);?></b>
 </td>
 
 </tr>
 </table><br>
 <table width=100% style="border: black;font-family: Verdana; font-size:  small;">
 <tr align=center>

<td > Зам. Директора по сбыту</td>
<td> <?php echo $org->zam_directora_po_sbytu;?></td>
</tr>

</table> </center>
 </body>
</html>
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
<b>Анализ<br> учета полученной товарной продукции ( электроэнергии )<br> по <?php echo $org->org_name; ?><br> с применением общего тарифа за 
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
 <td colspan=2>Получено товарной продукции
 </td>
 <td rowspan=3 width=80px>Всего кВт/ч
 </td>
 <td rowspan=3 width=100px>Всего тенге (без НДС)
 </td>



 </tr>
 <tr align=center>
 <td colspan=2>
  По тарифу общий
 </td>

 </tr>
 <tr>
 <td >
  кВт/ч
 </td>
 <td >
  тенге
 </td>
  
 </tr>
<?php 
$sum_day_kvt=0;$sum_day_tenge=0;

$sum=0;

$_sum_day_kvt=0;$_sum_day_tenge=0;

$_sum=0;

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
	  <b><?php echo f_d2($sum_day_kvt);?></b>
	 </td>
	 <td align=right>
	  <b><?php echo f_d($sum_day_tenge);?></b>
	 </td>
	
	
	
	
	  <td align=right>
	  <b><?php echo f_d2($sum_day_kvt);?></b>
	 </td>
	  <td align=right>
	  <b><?php echo f_d($sum);?></b>
	 </td>
	
	 
	
	</tr>
	<?php	
	$sum_day_kvt=0;$sum_day_tenge=0;
	
	$sum=0;
		echo "<tr><td colspan=13> <b>{$d->firm_subgroup_name}</b> </td></tr>";
		$last_group=$d->firm_subgroup_id;
		$last_group_name=$d->firm_subgroup_name;
		
		
endif;

$sum_day_kvt += $d->itogo_kvt_day;
$sum_day_tenge += $d->tenge_day;


$sum+=($d->tenge_day);

$_sum_day_kvt+=$d->itogo_kvt_day;
$_sum_day_tenge+=$d->tenge_day;


$_sum+=($d->tenge_day);

?>
<tr align=right>
<td>
	<?php echo $j++;?>
</td> 
<td align=left>
	<?php echo $d->firm_name;?>
</td> 
<td>
	<?php echo f_d2($d->itogo_kvt_day);?>
</td> 
<td>
	<?php echo f_d($d->tenge_day);?>
</td> 


 

<td>
	<?php echo f_d2($d->itogo_kvt_day);?>
</td> 
<td>
	<?php echo f_d($d->tenge_day);?>
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
  <b><?php echo f_d2($sum_day_kvt);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($sum_day_tenge);?></b>
 </td>


  <td align=right>
  <b><?php echo f_d2($sum_day_kvt);?></b>
 </td>
  <td align=right>
  <b><?php echo f_d($sum_day_tenge);?></b>
 </td>


 
</tr>

  <tr>
  <td>&nbsp;
  </td>
 <td align=right>
  <b>Итого</b>
 </td>
 <td align=right>
  <b><?php echo f_d2($_sum_day_kvt);?></b>
 </td>
 <td align=right>
  <b><?php echo f_d($_sum_day_tenge);?></b>
 </td>

 
 <td align=right>
  <b><?php echo f_d2($_sum_day_kvt);?></b>
 </td>
  <td align=right>
  <b><?php echo f_d($_sum_day_tenge);?></b>
 </td>


 
 </tr>
 </table><br>
 <table width=100% style="border: black;font-family: Verdana; font-size:  small;">
 <tr align=center>
<td > Директор филиала ТОО КЭЦ Горэлектросети </td>
<td> <?php echo $org->director;?></td>
</tr><tr></tr><tr></tr>
 <tr align=center>
<td > Зам. Директора по сбыту</td>
<td> <?php echo $org->zam_directora_po_sbytu;?></td>
</tr>

</table> </center>
 </body>
</html>
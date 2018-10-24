<?php
function f_d($var)
{
	if ($var == null) return " ";
	if ($var == 0) return " "; else
	return sprintf("%22.2f",$var);
}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<table width=50%>
	<tr><td align=center><b>АКТ</b></td></tr>
	<tr><td align=center><b>снятия показаний приборов коммерческого учета и расчета</b></td></tr>
	
<br>

<table width=50% border="1" cellspacing="0">
<tr>
<td rowspan=2 width=30% border=1px>Наименование приборов учета</td>
<td colspan=2>Показание</td>
<td rowspan=2 width=14% border=1px>Разница</td>
<td rowspan=2 width=14% border=1px>Коэф-т</td>
<td rowspan=2 width=14% border=1px>кВт.ч.</td>
</tr>
<tr>
<td width=14% border=1px>Начальное</td>
<td width=14% border=1px>Конечное</td>
</tr>
</table>
<br>

<?php $itogokvt=0;
	  $akt=0;
	  $sub=0;
	  $neuch=0;
	  $itogo=0;
	  $k=0;
	  ?>


<?php

	echo "За ".$period->row()->name."<br><br>";
	?>
	<table width=50% border="1" cellspacing="0">
<?php	
$lfi = -1;
$lfn = "-1";
$it = 0;
$k = 0;
	foreach($vedomost->result() as $v ):
	if ($it == 0){
	$lfi = $v->dogovor;
	if ($v->firm_name == "neuch") {$neuch+=$v->neuchtennyy; continue;}
	if ($v->firm_name == "akt") {$akt+=$v->neuchtennyy; continue;}
	if ($v->firm_name == "sub") {$sub+=$v->neuchtennyy; continue;}
	$lfn = $v->firm_name;
	echo "<table width = 50%><tr><td>".$lfn." Договор №".$v->dogovor." </td></tr></table><table width = 50% border = 1 cellspacing=\"0\">";
	$it = 1;
	$k = 1;
	}
	else
	{
	if  ($lfi!=$v->dogovor){
	if ($k == 0) {$lfn = $v->bill_name;echo "<br><br><table width = 50%><tr><td>".$lfn." Договор №".$v->dogovor." </td></tr></table><table width = 50% border = 1 cellspacing=\"0\">"; $k = 1;}
	?>

<tr>
<td width=30%> <?php echo "Не учтенный расход"?> </td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%> <?php echo $neuch;?> </td>
</tr>
<tr>
<td width=30%> <?php echo "Субабоненты"?> </td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%> <?php echo $sub;?> </td>
</tr>
<tr>
<td width=30%> <?php echo "Акты"?> </td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%> <?php echo $akt;?> </td>
</tr>
<tr>
<td colspan=5><?php echo "<b>Итого по ".$lfn.":</b>"?></td>
<td><?php $itogokvt+=$neuch+$sub+$akt; echo "<b>".$itogokvt."</b>"; $itogo+=$itogokvt; $itogokvt=0; $neuch=0; $sub=0; $akt=0;?></td>
</tr>
</table>

<?php 
	$k = 0;
	$lfi = $v->dogovor;
	if ($v->firm_name == "neuch") {$neuch+=$v->neuchtennyy; continue;}
	if ($v->firm_name == "akt") {$akt+=$v->neuchtennyy; continue;}
	if ($v->firm_name == "sub") {$sub+=$v->neuchtennyy; continue;}
	$lfn = $v->firm_name;
	echo "<br><br><table width = 50%><tr><td>".$lfn." Договор №".$v->dogovor." </td></tr></table><table width = 50% border = 1 cellspacing=\"0\">";
	$k = 1;
  }
 
	if ($v->firm_name == "neuch") {$neuch+=$v->neuchtennyy; continue;}
	if ($v->firm_name == "akt") {$akt+=$v->neuchtennyy; continue;}
	if ($v->firm_name == "sub") {$sub+=$v->neuchtennyy; continue;}
	if ($k == 0) {$lfn = $v->firm_name;echo "<br><br><table width = 50%><tr><td>".$lfn." Договор №".$v->dogovor." </td></tr></table><table width = 50% border = 1 cellspacing=\"0\">"; $k = 1;}
	?>
<tr>
<td width=30%  > <?php echo $v->bill_name;?> </td>
<td width=14%  > <?php if ($v->new_pokaz=='') {echo "0";$v->new_pokaz=0;}else{echo sprintf("%.0f",$v->new_pokaz);}?> </td>
<td width=14%  > <?php if ($v->old_pokaz=='') {echo sprintf("%.0f",$v->new_pokaz);}else{echo sprintf("%.0f",$v->old_pokaz);}?> </td>
<td width=14%  > <?php if ($v->counter_diff=='') {echo "0";}else{echo sprintf("%.0f",$v->counter_diff);}?> </td>
<td width=14%  > <?php if ($v->transform=='') {echo "0";}else{echo sprintf("%.0f",$v->transform);}?> </td>
<td width=14%  > <?php echo sprintf("%.0f",$v->itogo_uchtennyy_kvt); $itogokvt+=$v->itogo_uchtennyy_kvt;?> </td>
</tr>

<?php }endforeach;?>

<tr>
<td width=30%> <?php echo "Не учтенный расход"?> </td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%> <?php echo $neuch;?> </td>
</tr>
<tr>
<td width=30%> <?php echo "Субабоненты"?> </td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%> <?php echo $sub;?> </td>
</tr>
<tr>
<td width=30%> <?php echo "Акты"?> </td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%>0</td>
<td width=14%> <?php echo $akt;?> </td>
</tr>
<tr>
<td colspan=5><?php echo "<b>Итого по ".$lfn.":</b>"?></td>
<td><?php $itogokvt+=$neuch+$sub+$akt; echo "<b>".$itogokvt."</b>"; $itogo+=$itogokvt; $itogokvt=0; $neuch=0; $sub=0; $akt=0;$k=0;?></td>
</tr>
</table>
<br>
<table width=50%>
<tr>
<td colspan=5><?php echo "<b>Итого:</b>"?></td>
<td width=14%><?php echo "<b>".$itogo." кВт</b>";?></td>
</tr>
</table>
</body>
</html>
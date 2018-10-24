<?php
function f_d($var)
{
	if ($var == null) return " ";
	if ($var == 0) return " "; else
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
<center>
Счет № <?php echo $org->dogovor;?> за потребленную электроэнергию за 
	<?php echo $period->name; ?>
</center>
<br>
<table>
<tr>
<td>
<b>Поставщик</b> <?php echo $org_info->name;?><br>
РНН <?php echo $org_info->rnn;?> Расч. счет <?php echo $org_info->IIK;?> КБЕ - 
<?php echo $org_info->Bank_kbe;?> КНП <?php echo $org_info->bank_knp;?>
<br>
<?php echo $org_info->address;?><br>
Телефон<?php echo $org_info->telefon;?><br>
<?php echo $org_info->bank_name;?><br>
МФО <?php echo $org_info->bank_bik;?> <br>
</td>
<td>
</td>
</tr>
</table>
</body>
</html>
<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}
function datetostring($date)
{
	$d=explode("-",$date); 
	return $d['1'].'.'.$d['0'].'.'.$d['2'];
}
?>
<html>
<head>
<title>Отчет по оплате за электроэнергию</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>


<center><?php echo ($type==0?"Отчитавшиеся":"Неотчитавшиеся");?> на <?php echo datetostring(date("m-d-Y"));?><br> <?php echo $ture->name; ?></center>

<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>
<td>№</td>
<td>Договор</td>
<td>Наименование</td>
<td>Адрес предприятия</td>
<td>Телефон</td>
</tr>

<?php $i=1;foreach($firms->result() as $firm):?>
<tr>
<td><?php echo $i++;?></td>
<td><?php echo $firm->dogovor;?></td>
<td><?php echo $firm->firm_name;?></td>
<td><?php echo $firm->firm_address;?></td>
<td>&nbsp;<?php echo $firm->telefon;?></td>
</tr>
<?php endforeach; ?>
</table>

</html>
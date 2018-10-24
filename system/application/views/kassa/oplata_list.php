<html>
<head>
<title>Оплата</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<body>
<br />
<center> Оплата  за <?php echo $data;?>
</center>
<br />

<table  width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>
	<td>№</td>
	<td>Абон</td>
	<td>ФИО</td>
	<td>Адрес</td>
	<td align=center >Дата платежа</td>
	<td align=center >Сумма</td>
	</tr>	
<?php
$i=1;$sum=0;$_sum=0;
$_i=0;
foreach ($oplata->result() as $o)
{
	$_i++;
	echo "<tr>
	<td>".($i++)."</td>
	<td>{$o->number}</td>
	<td>{$o->fio}</td>
	<td>".$o->street_name."  ".$o->dom." ".$o->kv."</td>
	<td align=center>".$data."</td>
	<td align=center>".anchor("kassa/delete_oplata/".$o->id,$o->value)."</td>
	</tr>";	
	$sum+=$o->value;
	$_sum+=$o->value;
	if ( $i>30 )
	{
		echo "<tr>
		<td colspan=5 >итого </td>
		<td align=center>{$sum}</td></tr>";	
		$i=1;
		$_sum=0;
	}
}
if ($sum>0)
{
	echo "<tr>
	<td colspan=5 >итого </td>
	<td align=center>{$sum}</td></tr>";	
}
	echo "<tr>
		<td colspan=5 >ВСЕГО $_i </td>
		<td align=center>{$_sum}</td></tr>";	
?>
</table>
</body>
</html>
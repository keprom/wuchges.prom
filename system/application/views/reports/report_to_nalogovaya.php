<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>

<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}
function datetostring($date)
{
	$d=explode("-",$date); 
	return $d['0'].'.'.$d['1'].'.'.$d['2'];
}
echo "<table>";
echo "<tr>
		<td>Название организации</bd>
		<td># Дог</td>
		<td>П/п</td>
		<td></td>
		<td>РНН</td>
		<td>БИН</td>
		<td>Номер сч/ф</td>
		<td>Дата</td>
		<td></td>
		<td></td>
		<td>Сумма без ндс</td>
		<td>НДС</td>
		<td>НДС</td></tr>";
		$j=1;
foreach ($nalog->result() as $n)
{
	echo "<tr>
		<td>{$n->firm_name}</bd>
		<td>{$n->dogovor}</td>
		<td>".($j++)."</td>
		<td></td>
		<td>'{$n->rnn}</td>
		<td>'{$n->bin}</td>
		<td>{$n->id}</td>
		<td>{$n->schetfactura_date}</td>
		<td></td>
		<td></td>
		<td>{$n->itog_tenge}</td>
		<td>{$n->itogo_nds}</td>
		<td>{$n->itogo_nds}</td></tr>";
}

?>
</table>
</html>
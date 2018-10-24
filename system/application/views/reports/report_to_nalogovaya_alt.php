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
foreach ($nalog->result() as $q)
{
	$fid=$q->fid;
	$ssql='SELECT round("7-re".nachisleno * "7-re".nds / (100.0 + "7-re".nds)) AS itogo_nds, round("7-re".nachisleno - "7-re".nachisleno * "7-re".nds / (100.0 + "7-re".nds)) AS itog_tenge, schetfactura_date.id, firm.name AS firm_name, firm.bin, firm.rnn, firm.dogovor, "7-re".period_id, schetfactura_date.date AS schetfactura_date
   FROM industry."7-re"
   LEFT JOIN industry.firm ON "7-re".firm_id = firm.id
   LEFT JOIN industry.schetfactura_date ON schetfactura_date.period_id = "7-re".period_id AND schetfactura_date.firm_id = "7-re".firm_id
  WHERE round("7-re".nachisleno * "7-re".nds / 100.0) IS NOT NULL AND round("7-re".nachisleno * "7-re".nds / 100.0) <> 0::numeric
and "7-re".period_id>=59 and  "7-re".period_id <=61
and "7-re".firm_id='.$fid.'
  ORDER BY schetfactura_date.date, firm.dogovor;';
  $nlg=$this->db->query($ssql);
  foreach ($nlg->result() as $n){
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
}

?>
</table>
</html>
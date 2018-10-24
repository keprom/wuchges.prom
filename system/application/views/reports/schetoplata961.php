<?php 
function datetostring($date)
{
	$d=explode("-",$date); 
	return $d['2'].'.'.$d['1'].'.'.$d['0'];
}
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",round($var*100)/100);
}
function f_d2($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",round($var*100)/100);
}
?>
<html>
<head>
<title>Счет на оплату</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
 <table width=100% >
 <tr>
 <td align=left> <center><b>СЧЕТ<?php echo $schet;?> №</b>
<?php echo $number.' от ';
if (strlen($data_schet)==0){ echo datetostring($schetfactura_date->date);} else { echo $data_schet;}?>
 </center> </td>
 <td> (1)</td>
 </tr>
 
 <tr>
 <td align=left> <b>Поставщик</b> <u><?php echo $org->org_name; ?></u> </td>
 <td> (2)</td>
 </tr>
 <tr>
 <td align=left> РНН и адрес поставщика <?php echo $org->rnn."  Адрес: <u>".$org->address;?></u> </td>
 <td> (3)</td>
 </tr>
 <tr>
 <td align=left>  <?php echo $org->svidetelstvo_nds;?> </td>
 <td> (4)</td>
 </tr>
 <tr>
 <td align=left> ИИК поставщика № <u><?php echo $org->IIK; ?></u>&nbsp;&nbsp;&nbsp;&nbsp; 
 КБЕ-<?php echo $org->Bank_kbe;?>&nbsp;&nbsp;&nbsp;&nbsp; КНП-<?php echo $org->bank_knp; ?> </td>
 <td> (5)</td>
 </tr> 
 <tr>
 <td align=left>  <u><?php echo $org->bank_name; ?></u>&nbsp;&nbsp;&nbsp;&nbsp; 
 БИК  <?php echo $org->bank_bik;?>&nbsp;&nbsp;&nbsp;&nbsp; БИН  <?php echo $org->bin; ?> </td>
 <td> </td>
 </tr>
 <tr>
 <td align=left> Договор(контракт) на поставку товаров (работ, услуг) № <?php echo $firm->dogovor." от ".datetostring($firm->dogovor_date);?></td>
 <td> (3)</td>
 </tr>
 <tr>
 <td align=left> Условия оплаты по договору (контракту) <u><?php echo $firm->edit1; ?></u>________________</td>
 <td> (3а)</td>
 </tr>
 <tr>
 <td align=left> Пункт назначения поставляемых товаров (работ, услуг) <u><?php echo $firm->edit2; ?></u>_________________________</td></td>
 <td> (4)</td>
 </tr>
 <tr>
 <td align=right> <FONT size=1>(государство, регион, область, город, район)</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
 <td> </td>
 </tr>
  <tr>
 <td align=left> Поставка товаров осуществлена по доверенности №<u><?php echo $firm->edit3; ?></u>__________________________</td>
 <td> (5)</td>
 </tr>
 <tr>
 <td align=left> Способ отправления <u><?php echo $firm->edit4; ?></u>________________________________________________________</td>
 <td> (6)</td>
 </tr>
 <tr>
 <td align=left> Грузоотправитель <u><?php echo $firm->edit5; ?></u>__________________________________________________________</td>
 <td> (7)</td>
 </tr>
 <tr>
 <td align=left> Грузополучатель <u><u><?php echo $firm->name; ?></u><?php echo $firm->address; ?></u></td>
 <td> (8)</td>
 </tr>
  <tr>
 <td width=2100px> Покупатель <u><?php echo "{$firm->name} БИН {$firm->bin}   ИИН {$firm->iin}"; ?></u></td>
 <td> (8а)</td>
 </tr>
 <tr>
 <td align=left> РНН и адрес покупателя &nbsp;<u><?php echo $firm->rnn; ?></u> &nbsp;&nbsp;&nbsp; <u><?php echo $firm->edit6; ?></u></td>
 <td> (8б)</td>
 </tr>
 <tr>
 <td align=left> ИИК покупателя: <?php echo $firm->raschetnyy_schet;?> в <?php echo $bank->name." <br> БИК  ".$bank->mfo;?>
 
 </td>
 <td> (8в)</td>
 </tr>
 <tr>
 <td align=left> БИН <?php echo $firm->bin;?></td>
 <td> (8г)</td>
 </tr>
 </table><br>
 <table cellSpacing=0 border=1>
 <TR>
    <TD vAlign=center align=middle rowSpan=2><FONT size=2>№ п/п</FONT> 
    <TD vAlign=center align=middle rowSpan=2><FONT size=2>Наименование товаров 
      (работ, услуг)</FONT> 
    <TD vAlign=center align=middle rowSpan=2><FONT size=2>Ед. изм.</FONT> 
    <TD vAlign=center align=middle rowSpan=2><FONT size=2>Кол-во 
      (объем)</FONT> 
    <TD vAlign=center align=middle rowSpan=2><FONT size=2>Цена тенге</FONT> 
    <TD vAlign=center align=middle rowSpan=2><FONT size=2>Стоимость товаров 
      (работ, услуг) без НДС</FONT> 
    <TD vAlign=center align=middle colSpan=2><FONT size=2>НДС</FONT> 
    <TD vAlign=center align=middle rowSpan=2><FONT size=2>Всего стоимость 
      реализации</FONT> 
    <TD vAlign=center align=middle colSpan=2><FONT size=2>Акциз</FONT> </TD>
  <TR>
    <TD vAlign=center align=middle><FONT size=2>Ставка</FONT> 
    <TD vAlign=center align=middle><FONT size=2>Сумма</FONT> 
    <TD vAlign=center align=middle><FONT size=2>Ставка</FONT> 
    <TD vAlign=center align=middle><FONT size=2>Сумма</FONT> </TD>
  <TR>
    <TD vAlign=center align=middle><FONT size=1><I>1</I></FONT> 
    <TD vAlign=center align=middle><FONT size=1><I>2</I></FONT> 
    <TD vAlign=center align=middle><FONT size=1><I>3</I></FONT> 
    <TD vAlign=center align=middle><FONT size=1><I>4</I></FONT> 
    <TD vAlign=center align=middle><FONT size=1><I>5</I></FONT> 
    <TD vAlign=center align=middle><FONT size=1><I>6</I></FONT> 
    <TD vAlign=center align=middle><FONT size=1><I>7</I></FONT> 
    <TD vAlign=center align=middle><FONT size=1><I>8</I></FONT> 
    <TD vAlign=center align=middle><FONT size=1><I>9</I></FONT> 
    <TD vAlign=center align=middle><FONT size=1><I>10</I></FONT> 
    <TD vAlign=center align=middle><FONT size=1><I>11</I></FONT> </TD>
	<?php $sum_bez_nds=0;$sum_nds=0;$sum=0;$i=1;
	for($j=0;$j<$tariff_count;$j++):  
	if ($tariff_kvt[$j]==0) continue;
	?>
	<TR>
		<TD vAlign=center align=middle><FONT size=1><?php echo $i++;?> </FONT> 
		<TD vAlign=center align=middle><FONT size=1>Электроэнергия</FONT> 
		<TD vAlign=center align=middle><FONT size=1>кВт</FONT> 
		<TD vAlign=center align=middle><FONT size=1> 
		<?php echo f_d($tariff_kvt[$j]); ?> </FONT> 
		<TD vAlign=center align=middle><FONT size=1> 
		<?php echo f_d($tariff_value[$j]);?> </FONT> 
		<TD vAlign=center align=middle><FONT size=1> 
		<?php 
		echo f_d($tariff_kvt[$j]*$tariff_value[$j]);
		$sum_bez_nds+=f_d2($tariff_kvt[$j]*$tariff_value[$j]);	
		?> </FONT> 
		<TD vAlign=center align=middle><FONT size=1> <?php echo f_d($period->nds);?> </FONT> 
		<TD vAlign=center align=middle><FONT size=1> 
		<?php echo f_d($period->nds*$tariff_kvt[$j]*$tariff_value[$j]/100);
		$sum_nds+=$period->nds*$tariff_kvt[$j]*$tariff_value[$j]/100;?> 
		</FONT> 
		<TD vAlign=center align=middle><FONT size=1> 
		<?php echo 
		f_d(($period->nds+100)*$tariff_kvt[$j]*$tariff_value[$j]/100);
		$sum+=($period->nds+100)*$tariff_kvt[$j]*$tariff_value[$j]/100;?> 
		</FONT> 
		<TD vAlign=center align=middle><FONT size=1>0</FONT> 
		<TD vAlign=center align=middle><FONT size=1>0</FONT> </TD>
<?php endfor;?>
  <TR>
    <TD align=left colSpan=5><FONT size=2><B>Всего по счету:</B></FONT> 
    <TD align=right><FONT size=2><B>&nbsp;<?php echo f_d2($sum_bez_nds);?></B></FONT> 
    <TD align=right bgColor=#c0c0c0><FONT size=2>&nbsp;</FONT> 
    <TD align=right><FONT size=2><B>&nbsp;<?php echo f_d2($sum_nds);?></B></FONT> 
    <TD align=right><FONT size=2><B>&nbsp;<?php echo f_d2($sum_bez_nds + $sum_nds);?></B></FONT> 
    <TD align=right bgColor=#c0c0c0><FONT size=2>&nbsp;</FONT> 
    <TD align=right><FONT size=2><B>&nbsp;</B></FONT> </TD>
 
 </table>
 <center>
 <?php echo num2str(f_d2($sum_bez_nds + $sum_nds));?>
 </center>
	<br>
	<table width=100%  >
	<tr>
	<td align=left>Руководитель организации</td><td align=right>ВЫДАЛ (Ответственное лицо поставщика)</td>
	</tr>
	<tr>
	<td align=left><?php echo $org->director; ?>____________</td><td align=right>Техник ____________________________</td>
	</tr>
	<tr>
	<td align=left>(Ф.И.О., подпись)</td><td align=right>(Ф.И.О., подпись)</td>
	</tr>
	<tr>
	<td align=left>&nbsp; </td><td align=right>&nbsp;</td>
	</tr>
	
	<tr>
	<td align=left>Главный бухгалтер организации</td><td align=right>Бухгалтер потребителя&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<td align=left><?php echo $org->glav_buh; ?>_______________</td><td align=right>___________________</td>
	</tr>
	<tr>
	<td align=left>(Ф.И.О., подпись)</td><td align=right>(Ф.И.О., подпись)</td>
	</tr>
	</table>
</body>
</html>
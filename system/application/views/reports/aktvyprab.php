<?php 
function datetostring($date)
{
	$d=explode("-",$date); 
	return $d['2'].'.'.$d['1'].'.'.$d['0'];
}
function f_d($var)
{
	if (($var==0)or($var==NULL)) return "0.00"; else
	return sprintf("%22.2f",$var);
}
function f_d3($var)
{
	if (($var==0)or($var==NULL)) return "0.000"; else
	return sprintf("%22.3f",$var);
}

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<FONT size=7>
 <table width=100%>
 <tr align=center>
 <td width=2100px> <b><?php echo (strlen(trim($akt_vypolnenyh_rabot))==0?"СЧЕТ-ФАКТУРА":$akt_vypolnenyh_rabot);?> №</b> <?php echo $schetfactura_date->id.' от ';
if (strlen($data_schet)==0){ echo datetostring($schetfactura_date->date);} else { echo $data_schet;}?>
 </td>
 <td align=left> (1)</td>
 </tr>
 <tr><td></td><td></td></tr>
 <tr >
 <td width=2100px> <b>Поставщик</b> <u><?php echo $org->org_name; ?></u>
 
 </td>
 <td> (2)</td>
 </tr>
 <tr >
 <td width=2100px> РНН, БИН и адрес местнахождения поставщика <?php echo " <u>".$org->rnn." ".$org->bin." ".$org->address;?></u>
 </td>
 <td> (2а)</td>
 </tr>
 <tr>
 <td width=2100px> Расчетный счет поставщика <u><?php echo $org->IIK;?> КБЕ-<?php echo $org->Bank_kbe;?> КНП-<?php echo $org->bank_knp;?> <?php echo $org->bank_name; ?>              
 БИК <?php echo $org->bank_bik;?>  </u></td>
 <td> (2б)</td>
 </tr>
 <tr>
 <td width=2100px> Свидетельство о постановке на регистрационный учет по НДС <?php echo $org->svidetelstvo_nds;?> </td>
 <td></td>
 </tr>
 <tr>
 <td width=2100px> Договор(контракт) на поставку товаров (работ, услуг) №<u><?php echo $firm->dogovor."        </u> от <u>       ".datetostring($firm->dogovor_date);?>                 </u></td>
 <td> (3)</td>
 </tr>
 <tr>
 <td width=2100px> Условия оплаты по договору (контракту)<u><?php echo $edit1; ?>                                                                                                                             </u></td>
 <td> (3а)</td>
 </tr>
 <tr>
 <td width=2100px> Пункт назначения поставляемых товаров (работ, услуг)<u><?php echo $edit2; ?>                                                                                                                                           </u></td>
 <td> (4)</td>
 </tr>
 <tr align=right>
 <td width=2100px><i><FONT size=5>(государство, регион, область, город, район)                                                                         </font> </i>                          </td>
 <td> </td>
 </tr>
  <tr>
 <td width=2100px> Поставка товаров осуществлена по доверенности №<u><?php echo $edit3; ?>                                                       </u></td>
 <td> (5)</td>
 </tr>
 <tr>
 <td width=2100px> Способ отправления <u><?php echo $edit4; ?>                                                                                                                                                    </u></td>
 <td> (6)</td>
 </tr>
 <tr>
 <td width=2100px> Товарно-транспортная накладная №_______________________     от ________________________________________ </td>
 <td> (7)</td>
 </tr>
 <tr>
 <td width=2100px> Грузоотправитель <u><?php echo $edit5; ?>                                                                                                                     </u></td>
 <td> (8)</td>
 </tr>
 <tr align=right>
 <td width=2100px><i><FONT size=5>(РНН, наименование и адрес места нахождения)                                                                                                                        </font></i></td>
 <td> </td>
 </tr>
 <tr>
 <td width=2100px> Грузополучатель  <u><?php echo $edit6; ?>                                                                                                                     </u>   </td>
 <td> (9)</td>
 </tr>
 <tr align=right>
 <td width=2100px><i><FONT size=5>(РНН, наименование и адрес места нахождения)                                                                                                                        </font></i></td>
 <td> </td>
 </tr>
  <tr>
 <td width=2100px> Получатель <u><?php echo "{$firm->name}"; ?>                </u></td>
 <td> (10)</td>
 </tr>
 <tr>
 <td width=2100px> РНН, БИН и адрес местонахождения получателя   <u><?php echo $firm->rnn.", ".$firm->bin." ".$firm->address; ?></u></td>
 <td> (10а)</td>
 </tr>
 <tr>
 <td width=2100px> Расчетный счет получателя <u><?php echo $firm->raschetnyy_schet;?></u> в банке <u><?php echo $bank->name;?></u></td>
 <td> (10б)</td>
 </tr>
 </table>
 <br>
 
 <table border="1px" width="100%" align="center" > 
 <tr>
	<td rowspan="2" width="60px">№<br />П/п</td>
	<td rowspan="2" width="400px">Наименование товаров<br /> (работ, услуг)</td>
	<td rowspan="2" width="100px">Ед.<br />изм.</td>
	<td rowspan="2" width="200px">Кол-во<br />(обьем)</td>
	<td rowspan="2" width="100px">Цена<br />тенге</td>
	<td rowspan="2" width="300px">Стоимость товаров<br />(работ, услуг) без НДС</td>
	<td colspan="2" width="360px">НДС</td>
	<td rowspan="2" width="400px">Всего<br />стоимость<br />реализации</td>
	<td colspan="2" width="210px">Акциз</td>	
</tr>
<tr>
	<td width="110px">Ставка</td>
	<td width="250px">Сумма</td>
	<td width="110px">Ставка</td>
	<td width="100px">Сумма</td>
</tr>
<tr>
<td width="60px">1</td>
<td width="400px">2</td>
<td width="100px">3</td>
<td width="200px">4</td>
<td width="100px">5</td>
<td width="300px">6</td>
<td width="110px">7</td>
<td width="250px">8</td>
<td width="400px">9</td>
<td width="110px">10</td>
<td width="100px">11</td>
</tr>
<?php 
$sum_bez_nds=0;$sum_nds=0;$sum=0;$i=1;

$i_t=$itog->itog_tenge;
$i_nds=$itog->itogo_nds;
$i_itogo=$itog->itogo_with_nds;

foreach($s as $s2 ): 
?>	
<tr align="center">
	<TD width="60px"><?php echo $i++;?></td>
	<TD width="400px">Электроэнергия</td>
	<TD width="100px">кВт</td>
	<TD width="200px"><?php echo f_d($s2->kvt); ?></td>
	<TD width="100px"><?php echo f_d3($s2->tariff_value);?></td>
	<TD width="300px" align="right">
	<?php
		if ($i_t-$s2->tenge>1)
		{
			echo f_d($s2->tenge);
			$sum_bez_nds+=$s2->tenge;
			$i_t-=f_d($s2->tenge);
		}
		else echo $i_t;
	?></td>
	<TD width="110px">
	<?php 
		echo f_d($s2->nds);
	?>
	</td>
	<TD width="250px" align="right">
	<?php
		if ($i_nds-$s2->nds_value>1)
		{
			echo f_d($s2->nds_value);
			$sum_nds+=$s2->nds_value;
			$i_nds-=f_d($s2->nds_value);
		}
		else
			echo f_d($i_nds);
	?>
	</td>
	<TD width="400px" align="right">
	<?php 
		if ($i_itogo-$s2->with_nds>1)
		{
			echo f_d($s2->with_nds);
			$sum+=$s2->with_nds;
			$i_itogo-=f_d($s2->with_nds);
		}
		else
			echo f_d($i_itogo);
	?>
	</td>
	<TD width="110px">0</td>
	<TD width="100px">0</TD>
</tr>
<?php  endforeach;?>
<tr align="center">
<td width="860px" colspan = "5" ><b align="left">Всего по счету:</b></td>
<td width="300px" align="right"><b><?php echo f_d($itog->itog_tenge);?></b></td>
<td width="110px" bgColor=#c0c0c0></td>
<td width="250px" align="right"><b><?php echo f_d($itog->itogo_nds);?></b></td>
<td width="400px" align="right"><b><?php echo f_d($itog->itogo_with_nds);?></b></td>
<td width="110px" bgColor=#c0c0c0></td>
<td width="100px"></td>
</tr>
</table>
</font>
<table width="100%">
<tr>
<td align="center" >ИТОГО: <?php echo num2str($itog->itogo_with_nds);?></td>
</tr>
</table>
<br />
<br />
 <FONT size=7>
 <table width="100%" align=left>
 <tr>
 <td align="left"><b>Руководитель организации:</b></td>
 <td align="right"><b>ВЫДАЛ (ответственное лицо поставщика) </b></td>
 </tr>
 <tr>
 <td align="left"> </td>
 <td align="right"> </td>
 </tr>
  <tr>
 <td align="left"><?php echo trim($org->director); ?>    ___________</td>
 <td align="right">Техник ____________________________</td>
 </tr>
  <tr>
 <td align="left"><font size=6>(Ф.И.О.,подпись)</font></td>
 <td align="right"><font size=6>(Ф.И.О.,подпись)</font></td>
 </tr>
   <tr>
 <td align="center"></td>
 <td align="center"></td>
 </tr>
 <tr>
 <td align="left"><b>Главный бухгалтер организации:</b></td>
 <td align="right">Бухгалтер потребителя</td>
 </tr>
 <tr>
 <td align="left"> </td>
 <td align="right"> </td>
 </tr>
  <tr>
 <td align="left"><?php echo trim($org->glav_buh); ?>   ____________</td>
 <td align="right">____________________________</td>
 </tr>
  <tr>
 <td align="left"><font size=6>(Ф.И.О.,подпись)</font></td>
 <td align="right"><font size=6>(Ф.И.О.,подпись)</font></td>
 </tr>
 <tr>
	<td align=left><br />Примечание. Без печати недействительно.<br />Оригинал (первый экземпляр)-покупателю.<br />Копия (второй экземпляр)-поставщику.</td><td ></td>
	</tr>
 </table>

 
  </FONT>
</body>
</html>
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
		<meta http-equiv=Content-Type content="text/html; charset=utf-8"> 
		<title>Накладная</title> 
		<style> 
		</style> 
	</head> 
	<body lang=RU>
	<table width=1050px>
	<tr><td>
		<table width=1050px>
			<tr>
				<td width=507px>
					<center>
						<font size=4><?php echo $org->org_name; ?></font><hr>
						<i>организация (индивидуальный предприниматель)</i>
					</center>
				</td>
				<td align=right>
					<i>Приложение 13<o:p></o:p><br>
					к приказу Министра финансов Республики Казахстан<br>
					от 21 июня 2007 года № 216 </i>
				</td>
			</tr>
			</table>		
			<p><o:p> </o:p>
			<table width=1050px>
			<tr>
				<td>
				</td>
				<td align=right>
					Форма З-8
					<p>
					<B><o:p> </o:p></B>
					<table border=1 cellspacing=0 cellpadding=0 width=230>
						<tr>
							<td> </td>
							<td align=center>Коды </td>
						</tr>
						<tr>

							<td>ОКПО</td>
							<td align=center> </td>
						</tr>
						<tr>

							<td>БИН </td>
							<td align=center><?php echo $org->bin;?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</td></tr>
		<tr><td>
 	<p><o:p> </o:p>
		<table border=1 cellspacing=0 cellpadding=0 align=right width=1050 >
			<tr>
				<td rowspan=2 width=600 valign=bottom><font size=5>Накладная на отпуск запасов на сторону</font></td>
				<td align=center>Номер документа</td>
				<td align=center>Дата составления</td>
			</tr>
			<tr>
				
				<td align=center><?php echo $schetfactura_date->id; ?></td>
				<td align=center><? if (strlen($data_schet)==0){ echo datetostring($schetfactura_date->date);} else { echo $data_schet;}?></td>
			</tr>
		</table>
		</td></tr>
		<tr><td>	
		<p><o:p> </o:p>

		<table border=1 cellspacing=0 cellpadding=0 width=1050 >
			<tr>
				<td>Организация (индивидуальный предприниматель) - отправитель</td>
				<td>Организация (индивидуальный предприниматель)- получатель</td>
				<td>Ответственный за поставку (Ф.И.О.)</td>
				<td>Транспортная организация</td>
				<td>Товарно - транспортная накладная (номер, дата) </td>
				<td> </td>
			</tr>
			<tr> 
				<td> </td>
			</tr>
			<tr>
				<td><?php echo $org->org_name; ?></td>
				<td><?php echo "{$firm->name}"; ?></td>
				<td><o:p> </o:p></td>
				<td><o:p> </o:p></td>
				<td><o:p> </o:p> </td>
				<td> </td>
			</tr>
		</table>
		<p><o:p> </o:p> 
		<table border=1 cellspacing=0 cellpadding=0 width=1050>
			<tr>
				<td rowspan=2 align=center>№ п./п.</td>
				<td rowspan=2 align=center>Наименование материалов, сорт, марка, размер</td>
				<td rowspan=2 align=center>Номенклатурный номер</td>
				<td rowspan=2 align=center>Единица измерения</td>
				<td colspan=2 align=center>Количество</td>
				<td rowspan=2 align=center>Цена, в тенге</td>
				<td rowspan=2 align=center>Сумма с НДС, в тенге</td>
				<td rowspan=2 align=center>Сумма НДС, в тенге</td>
			</tr>
			<tr>
				<td align=center>Надлежит отпуску</td>
				<td align=center>Отпущено</td>
			</tr>
			<tr>
				<td align=center>1</td>
				<td align=center>2</td>
				<td align=center>3</td>
				<td align=center>4</td>
				<td align=center>5</td>
				<td align=center>6</td>
				<td align=center>7</td>
				<td align=center>8</td>
				<td align=center>9</td>
			</tr>
			
			
			<?php 
$sum_bez_nds=0;$sum_nds=0;$sum=0;$i=1;

$i_t=$itog->itog_tenge;
$i_nds=$itog->itogo_nds;
$i_itogo=$itog->itogo_with_nds;

foreach($s as $s2 ): 
?>	

			<tr>
				<td align=center><?php echo $i++;?></td>
				<td align=center>Электроэнергия</td>
				<td align=center><o:p> </o:p></td>
				<td align=center>кВт</td>
				<td align=center><?php echo f_d($s2->kvt); ?></td>
				<td align=center><?php echo f_d($s2->kvt); ?></td>
				<td align=center><?php echo f_d($s2->tariff_value);?></td>
				<td align=center><?php 
		if ($i_itogo-$s2->with_nds>1)
		{
			echo f_d($s2->with_nds);
			$sum+=$s2->with_nds;
			$i_itogo-=f_d($s2->with_nds);
		}
		else
			echo f_d($i_itogo);
	?></td>
				<td align=center>	<?php
		if ($i_nds-$s2->nds_value>1)
		{
			echo f_d($s2->nds_value);
			$sum_nds+=$s2->nds_value;
			$i_nds-=f_d($s2->nds_value);
		}
		else
			echo f_d($i_nds);
	?></td>
			</tr>
			<?php  endforeach;?>
			
			<tr>
				<td colspan=6></td>
				<td align=right><b>Итого</b></td>
				<td align=center><b><?php echo f_d($itog->itog_tenge);?></b></td>
				<td align=center><b><?php echo f_d($itog->itogo_nds);?></b></td>
			</tr>
		</table>
		<p><o:p> </o:p>
		<p>Всего отпущено запасов (количество прописью): <?php echo num2str($s2->kvt);?>
		<p><o:p> </o:p>
		<p>Всего отпущено на сумму (прописью), в KZT: <?php echo num2str($itog->itogo_with_nds);?>
		<p><o:p> </o:p> 
		<table border=0 cellspacing=0 cellpadding=0 width=1050px>
			<tr>
				<td>
					<table border=0 cellspacing=0 width=525px>
						<tr>
								<td width=140px>Отпуск разрешил</td>
								<td colspan=3> <hr></td></tr>
								<tr><td ></td>
								<td align=center width=100px> <sup><i>(должность)</i></sup> </td>
								<td align=center> <sup><i>(Ф.И.О.)</i></sup></td>
								<td align=center width=70px> <sup><i> (Подпись)</i></sup></td>
						</tr><tr><td><br></td></tr><tr>
								
								<td>Главный бухгалтер</td> 
								<td colspan=3 ><u> <?php echo trim($org->glav_buh); ?> </u></td></tr><tr>
								<td></td><td colspan=2 align=center> <sup><i>(Ф.И.О.)</i></sup></td>
								<td align=center><sup><i> (Подпись)</i></sup></td></tr><tr>
								<td align=center> М.П.</td>
						</tr><tr><td><br></td></tr><tr>
							
								<td>Отпустил</td>
								<td colspan=3><hr></td></tr><tr>
								<td></td>
								<td colspan=2 align=center> <sup><i>(Ф.И.О.)</i></sup></td>
								<td align=center> <sup><i>(Подпись)</i></sup></td></tr>
					
					</table></td>
					<td width=50px></td>
				<td> 
					<table width=475>
						<tr>
							<td colspan=2>
								По доверенности № <?php echo $edit3; ?>
							</td> <td> 
								от ________________
							</td>
						</tr><tr>
							<td colspan=3> 
								выданной ________________________________________________
							</td>
						</tr><tr><td><br><br><br><br><br></td></tr><tr>
							<td colspan=3> 
								Запасы получил ___________________________________________
							</td>
						</tr><tr>
							<td></td> 
							<td align=center>	
								<sup><i>(Ф.И.О.) </i></sup>
							</td><td align=center>
								<sup><i>(Подпись)</i></sup>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<p><o:p> </o:p> 
				</td></tr>
	</table>
	</body> 
</html> 
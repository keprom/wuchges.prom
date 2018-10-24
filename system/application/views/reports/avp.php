<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
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
<body>
<table border=0 width='735px' cellspacing='10px'>
<tr>
<td>

<table width='735px' border=0>
<tr>
	<td width='588px'>
	
	</td>
	<td width='147px'>
		<p align=right>
		Форма Р-1	
		</p>
	</td>
</tr>
</table>
</td></tr><tr><td>
<table width='735px' border=1px cellspacing=0 cellpadding=0>
<tr>
	<td width='735px'>
	
		<table width='735px' cellspacing='7px'>
			<tr>
				<td width='588px'>
				</td>
				<td width='147px'>
					<p align=center>ИИН/БИН</p>
				</td>
			</tr>
			<tr>
				<td width='588px'>
					<p align=center>Заказчик 
					<?php 
					echo " "."{$firm->name}"." ".$firm->address; 
					?>
					</p>
				</td>
				<td width='147px'>
					<table width='147px' border=1 cellspacing=0 cellpadding=0>
						<tr>
							<td width='147px'>
							<p>
							<?php
							echo $firm->bin; 
							?>
							</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width='588px'>
					<p align=center><sup>полное наименование, адрес, данные о средствах связи</sup></p>
				</td>
				<td width='147px'>
				<p>&nbsp </p>
				</td>
			</tr>
			<tr>
				<td width='588px'>
					<p align=center>Исполнитель
					<?php 
					echo $org->org_name." ".$org->address;
					?>
					</p>
				</td>
				<td width='147px'>
							<table width='147px' border=1 cellspacing=0 cellpadding=0>
								<tr>
									<td width='147px'>
									<p>
									<?php 
									echo $org->bin;
									?> 
									</p>
									</td>
								</tr>
							</table>
				</td>
			</tr>
			<tr>
				<td width='588px'>
					<p align=center><sup>полное наименование, адрес, данные о средствах связи</sup></p>
				</td>
				<td width='147px'>
				</td>
			</tr>
			<tr>
				<td width='588px'>
					<p align=center>Договор (контракт) №
					<?php 
					echo " ".$firm->dogovor." ".datetostring($firm->dogovor_date); 
					?> 
					</p>
				</td>
				<td width='147px'>
				</td>
			</tr>
		</table>
	
	</td>
</tr>
</table>
</td></tr><tr><td align=center>


			<table width='500px' border=1px cellspacing=0 cellpadding=0>
				<tr>
					<td width='234px' rowspan=2>
						<p align=center>Номер документа</p>
					</td>
					<td width='82px' rowspan=2>
						<p align=center>Дата составления</p>
					</td>
					<td width='184px' colspan=2>
						<p align=center>Отчётный период</p>
					</td>
				</tr>
				<tr>
					<td width='92px'>
						<p align=center>с</p>
					</td>
					<td width='92px'>
						<p align=center>по</p>
					</td>
				</tr>
				<tr>
					<td width='234px'>
					<p align=center>
					<?php
					echo $schetfactura_date->id;
					?> 
					</p>	
					</td>
					<td width='82px'>
					<p align=center>
					<?php 
					if (strlen($data_schet)==0){ 
						echo datetostring($schetfactura_date->date);
						} 
						else 
						{
							echo $data_schet; 
							}
						?> 
						</p>	
					</td>
					<td width='92px' align=center>
					<p><?php
						echo datetostring($period->begin_date);
						?></p>	
					</td>
					<td width='92px' align=center>
							<p><?php
						echo datetostring($period->end_date);
						?></p>
					</td>
				</tr>
			</table>

	
</td></tr><tr><td width='735px' align=center>

		<p align=center>
			<h4>АКТ ВЫПОЛНЕННЫХ РАБОТ (ОКАЗАННЫХ УСЛУГ)*</h4>
		</p>

</td></tr><tr><td>

<table width='735px' border=1px cellspacing=0 cellpadding='2px'>
	<tr>
		<th rowspan=2 width='88px'>
			Номер по порядку
		</th>
		<th rowspan=2 width='89px'>
			Наименование работ (услуг)
		</th>
		<th rowspan=2 width='145px'>
			Сведения о наличии отчет о маркетинговых исследованиях, консультационных и прочих услуг (дата, номер, количество страниц)
		</th>
		<th rowspan=2 width='82px'>
			Единица измерения
		</th>
		<th colspan=3 width='331px'>
			Выполнено работ (услуг)
		</th>
	</tr>
	<tr>
		<th width='92px'>
			количество
		</th>
		<th width='92px'>
			цена за единицу
		</th>
		<th width='147px'>
			стоимость
		</th>
	</tr>
	<tr>
		<td width='88px' align=center>
			1
		</td>
		<td width='89px' align=center>
			2
		</td>
		<td width='145px' align=center>
			3
		</td>
		<td width='82px' align=center>
			4
		</td>
		<td width='92px' align=center>
			5
		</td>
		<td width='92px' align=center>
			6
		</td>
		<td width='147px' align=center>
			7
		</td>
	</tr>
	
	<?php 
$sum_bez_nds=0;$sum_nds=0;$sum=0;$i=1;

$i_t=$itog->itog_tenge;
$i_nds=$itog->itogo_nds;
$i_itogo=$itog->itogo_with_nds;

foreach($s as $s2 ): 
?>	
	
		<tr>
		<td width='88px' align=center>
			<p>
			<?php 
			echo $i++;
			?>
			</p>
		</td>
		<td width='89px' align=center>
			<p>Электроэнергия</p>
		</td>
		<td width='145px' align=center>
			<p>Нет</p>
		</td>
		<td width='82px' align=center>
			<p>кВт</p>
		</td>
		<td width='92px' align=center>
			<p>
			<?php 
			echo f_d($s2->kvt);
			?>
			</p>
		</td>
		<td width='92px' align=center>
			<p>
			<?php 
			echo f_d3($s2->tariff_value);
			?>
			</p>
		</td>
		<td width='147px' align=center>
			<p>
			<?php
		if ($i_t-$s2->tenge>1)
		{
			echo f_d($s2->tenge);
			$sum_bez_nds+=$s2->tenge;
			$i_t-=f_d($s2->tenge);
		}
		else echo $i_t;
	?>
	</p>
		</td>
	</tr>
	
	<?php 
	endforeach;
	?>
	
			<tr>
		<th width='88px' >
			<p>&nbsp </p>
		</th>
		<th width='89px' >
			<p>&nbsp </p>
		</th>
		<th width='145px' >
			<p>&nbsp </p>
		</th>
		<th width='82px' >
			<p>Итого</p>
		</th>
		<th width='92px' >
			<p>&nbsp </p>
		</th>
		<th width='92px' >
			<p>x</p>
		</th>
		<th width='147px' >
			<p>
			<?php
			echo f_d($itog->itog_tenge);
			?>
			</p>
		</th>
	</tr>
				<tr>
		<th width='588px' colspan=6>
			<p align=center>В том числе НДС</p>
		</th>
		<th width='147px'>
			<p>
			<?php 
			echo f_d($itog->itogo_with_nds);
			?>
			</p>
		</th>
	</tr>
</table>
</td></tr><tr><td>

<table width='735px' border=0px cellspacing=0 cellpadding=0>
	<tr>
		<td width='550px'>
			<p>Сведения об использовании запасов, полученных от заказчика</p>
		</td>
		<td width='185px'>
			<p>____________________________________</p>
		</td>
	</tr><tr>
		<td width='550px'>
		</td>
		<td width='185px'>
			<p align=center><sup>наименование, количество, стоимость</sup></p>
		</td>
	</tr>
</table>

</td></tr><tr><td>

<table width='735px' border=0px cellspacing=0 cellpadding=0>
	<tr>
		<td width='735px'>
			<p>Приложение: Перечень документации________________________________</p>
		</td>
	</tr>
</table>

</td></tr><tr><td>

<table width='735px' border=0px cellspacing=0 cellpadding=0>
	<tr>
		<td width='316px'>
			<table width='316px' border=1px cellspacing=0 cellpadding=0>
				<tr>
					<td width='316px'>
						<table width='316px' border=0px cellspacing=0 cellpadding='5px'>
							<tr>
								<td width='316px' colspan=3>
									<p>
									Сдал (Исполнитель)_____/_____/_____
									</p>
								</td>
							</tr>
							<tr>
								<td width='79px' align=center>
									<p>___________</p>
								</td>
								<td width='79px' align=center>
									<p>___________</p>
								</td>
								<td width='158px' align=center>
									<p>___________</p>
								</td>
							</tr>
							<tr>
								<td width='79px' align=center>
									<p align=center><sup>должность</sup></p>
								</td>
								<td width='79px' align=center>
									<p align=center><sup>подпись</sup></p>
								</td>
								<td width='158px' align=center>
									<p align=center><sup>расшифровка подписи</sup></p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<p align=right>М.П.</p>
		</td>
		<td width='103px'>
		</td>
		<td width='316px'>
					<table width='316px' border=1px cellspacing=0 cellpadding=0>
				<tr>
					<td width='316px'>
									<table width='316px' border=0px cellspacing=0 cellpadding='5px'>
							<tr>
								<td width='316px' colspan=3>
									<p>
									Принял (Заказчик)_____/_____/_____
									</p>
								</td>
							</tr>
							<tr>
								<td width='79px' align=center>
									<p>___________</p>
								</td>
								<td width='79px' align=center>
									<p>___________</p>
								</td>
								<td width='158px' align=center>
									<p>___________</p>
								</td>
							</tr>
							<tr>
								<td width='79px' align=center>
									<p align=center><sup>должность</sup></p>
								</td>
								<td width='79px' align=center>
									<p align=center><sup>подпись</sup></p>
								</td>
								<td width='158px' align=center>
									<p align=center><sup>расшифровка подписи</sup></p>
								</td>
							</tr>
						</table>
											</td>
				</tr>
			</table>
				<p align=right>М.П.</p>
		</td>
	</tr>
</table>
	
</td></tr><tr><td>

<h5>* Применяется для приемки-передачи выполненных работ (оказанных услуг), за исключением строительно-монтажных работ.</h5>
	
</td></tr>
</table>
</body>
</html>
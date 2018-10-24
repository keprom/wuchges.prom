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
function datetostring2($date)
{
	$d=explode("-",$date); 
	return $d['1'].'.'.$d['0'];
}

?>
<html> 

	
	<body lang=RU>
	</body> 
	<table width =100%>
	
		<tr>
 <td width=2100px align=right> <b>РНН:</b> <?php echo $org->rnn; ?>
 </td>
 </tr>
 		<tr>
 <td width=2100px> <b>ЖСК/ИИК:</b> <?php echo $org->IIK." в ".$org->bank_name; ?>
 </td>
 </tr>
 		<tr>
 <td width=2100px> <b>БИК:</b> <?php echo $org->bank_bik; ?>
 </td>
 </tr>
 		<tr>
 <td width=2100px> <b>БСН/БИН:</b> <?php echo $org->bin; ?>
 </td>
 </tr>
 <tr><td width=2100px> <?php echo $org->svidetelstvo_nds ?>
 </td>
 </tr>

 <tr><td width=2100px> <?php echo $org->org_name; ?>
 </td>
 </tr>
 
 <tr><td width=2100px><b>Мекенжай/Адрес:</b> <?php echo $org->address; ?> 
 </td>
 </tr>
 <tr><td></td></tr>
<tr align=center><td>
	<b>Тұтынушылардың есебіне сәйкус<br/>
	эл.энергиясын беру үшін <br/>
	жөнелтпе құжат<br/></br>
 <b>№</b> <?php echo $schetfactura_date->id.' от ';
if (strlen($data_schet)==0){ echo datetostring($schetfactura_date->date);} else { echo $data_schet;}?>
 </td>

 </tr>
<tr><td></td></tr>
 <tr>
<td> <?php echo "От кого ".$org->org_name; ?></td>	</tr>
			<tr>	<td><?php echo "Кому ".$firm->name; ?></td></tr>
	</table>
	 <br>
	
	 <table border="1px" width="100%" align="center" > 
 <tr>
	<td rowspan="1" width="100px"valign="middle">№ п/п</td>
	<td rowspan="1" width="600px"valign="middle">Наименование материалов</td>
	<td rowspan="1" width="200px"valign="middle">Ед.изм.<br/></td>
	<td rowspan="1" width="500px"valign="middle">Кол-во<br/></td>
	<td rowspan="1" width="300px"valign="middle">Цена без НДС</td>
	<td rowspan="1" width="300px"valign="middle">Сумма<br/></td>
</tr>

<tr>
<td width="100px">1</td>
<td width="600px">2</td>
<td width="200px">3</td>
<td width="500px">4</td>
<td width="300px">5</td>
<td width="300px">6</td>
</tr>
<?php 
$sum_bez_nds=0;$sum_nds=0;$sum=0;$i=1;

$i_t=$itog->itog_tenge;
$i_nds=$itog->itogo_nds;
$i_itogo=$itog->itogo_with_nds;

foreach($s as $s2 ): 
?>	
<tr align="center">
	<TD width="100px"><?php echo $i;?></td>
	<TD width="600px">электроэнергии<?php echo datetostring2($schetfactura_date->date);?> </td>
	<TD width="200px">КВТ.Ч</td>
	<TD width="500px"align="right"><?php echo f_d($s2->kvt); ?></td>
	<TD width="300px" align="right">
	<?php echo f_d3($s2->tariff_value);?></td>


	<TD width="300px" align="right">
		<?php
		if ($i_t-$s2->tenge>1)
		{
			echo f_d($s2->tenge);
			$sum_bez_nds+=$s2->tenge;
			$i_t-=f_d($s2->tenge);
		}
		else echo $i_t;
	?>
	</td>

</tr>
<?php  endforeach;?>
<tr align="center">
	<TD width="100px"></td>
	<TD width="600px">НДС 12% </td>
	<TD width="200px"></td>
	<TD width="500px"></td>
	<TD width="300px"></td>
	<TD width="300px"align="right">
				<?php echo f_d($itog->itogo_nds);?>
	</td>
</tr>
<tr align="center">
	<TD width="100px"></td>
	<TD width="600px">Итого с НДС </td>
	<TD width="200px"></td>
	<TD width="500px"></td>
	<TD width="300px"></td>
	<TD width="300px"align="right">
				<?php echo f_d($itog->itogo_with_nds);?>
	</td>
</tr>

</table>
<br/>
<table>
<tr><td></td><td></td><td></td></tr>
<tr>
<td align="left">Разрешил директор:</td>
<td align="right"> <?php echo trim($org->director); ?></td>
<td></td>
</tr>

<tr>
<td align="left">Гл. бухгалтер:</td>
<td align="right"> <?php echo trim($org->glav_buh); ?></td>
<td></td>
</tr>

<tr>
<td align="left">Отпустил инженер ос:</td>
<td align="right"> <?php echo trim($org->nachalnik_otdela_sbyta); ?></td>
<td></td>
</tr>

<tr>
<td align="left">Получил:</td>
<td align="right"></td>
<td></td>
</tr>
</table>
			
</html> 
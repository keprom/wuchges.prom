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
<table width=100%>
	<tr><td align=center><b>Ведомость электропотребления  </b></td></tr>
	<tr><td align=center><b><?php echo $itogo->period_name;?></b></td></tr></table>
<br>

<table width=100%>
<tr>
<td width=900px ><?php echo $firm->name;?></td>
<td width=900px >Адрес <?php echo $firm->address;?></td>
<td width=400px >Абонент <?php echo $firm->dogovor;?></td>
<td width=500px >РНН <?php echo $firm->rnn;?></td>
<td width=400px >Тел:<?php echo $firm->telefon;?></td>
</tr>
</table>

<table border=1px  >
<tr >
<td width=140px >Т.У.</td>
<td width=520px >Наименование т.у.</td>
<td width=160px >Тариф</td>
<td width=200px >Номер счетчика</td>
<td width=255px >Показание старое</td>
<td width=255px >Показание новое</td>
<td width=250px >Разность показаний</td>
<td width=150px >Расчет. коэф.</td>
<td width=250px >Учтенный расход</td>
<td width=250px >Не учт. расход</td>
<td width=250px >Итоговый расход</td>
<td width=130px >Тариф</td>
<td width=300px >Сумма без НДС</td>
</tr>
<?php foreach($vedomost->result() as $v): ?>
<tr>
<td width="140px" ><?php  echo $v->bill_id; ?></td>
<td width="520px" ><?php echo $v->bill_name; ?></td>
<td width="160px" ><?php if ($v->tariff_name=="Многоуровневый"){
	if ($v->pokaz_uroven!=0){echo "Уровень ".$v->pokaz_uroven;}
	if ($v->nadbavka_uroven!=0){echo "Уровень ".$v->nadbavka_uroven;}
	if (($v->pokaz_uroven==0)&&($v->nadbavka_uroven==0)){echo "Общий основной";}
}else{echo $v->tariff_name;} ?></td>
<td width="200px" align="center"><?php echo $v->gos_nomer; ?></td>
<td  width="255px" align="right"><?php echo $v->old_pokaz; ?></td>
<td  width="255px" align="right"><?php echo $v->new_pokaz; ?></td>
<td  width="250px" align="right"><?php  echo f_d($v->counter_diff); ?></td>
<td width="150px" align="right"><?php echo sprintf("%22.0f",$v->transform);?></td>
<td width="250px" align="right"><?php echo f_d($v->itogo_uchtennyy_kvt);?></td>
<td  width="250px" align="right"><?php echo f_d($v->neuchtennyy);?></td>
<td  width="250px" align="right"><?php echo f_d($v->itogo_kvt);?></td>
<td  width="130px" align="right"><?php echo f_d($v->tariff_value); ?></td>
<td  width="300px" align="right" ><?php echo f_d($v->itogo_tenge); ?></td>
</tr>
<?php endforeach;?>
</table>
<table width=100%>
<tr>
<td width="1550px"></td>
<td width="430px">По предприятию</td>
<td width="200px"><b><?php echo $itogo->uch_kvt;?></b></td>
<td width="250px" align="right"><b><?php echo $itogo->neuch_kvt;?></b></td>
<td width="250px" align="right"><b><?php echo $itogo->itog_kvt;?></b></td>
<td width="150px">  </td>
<td  width="280px" align="right"><b><?php echo f_d($itogo->itog_tenge); ?></b></td>
</tr>
</table>
<table width=100%>
<tr align=right>
<td width=2300px><b>НДС</b></td><td width=800px><b><?php echo $itogo->itogo_nds; ?></b></td>
</tr>
<tr align=right>
<td width=2300px><b>Начислено</b></td><td width=800px><b><?php echo $itogo->itogo_with_nds; ?></b></td>
</tr>
<tr align=right>
<td width=2300px><b>Сальдо на начало текущего месяца</b></td><td width=800px><b><?php echo f_d($itogo->saldo_value); ?></b></td>
</tr>
<tr align=right>
<td width=2300px><b>Оплата текущего месяца</b></td><td width=800px><b><?php echo f_d(($oplata_value==null)?0:$oplata_value);?></b></td>
</tr>
<tr align=right>
<td width=2300px><b>Сальдо на конец текущего месяца</b></td><td width=800px><b>
<?php 
$saldo_end=$itogo->saldo_value-$oplata_value+$itogo->itogo_with_nds; 
echo f_d($saldo_end);
?>
</b></td>
</tr>

<tr align=right>
<td width=2300px><b>К оплате</b></td><td width=800px><b>
<?php 
if ($saldo_end>0) $opl=$saldo_end; else $opl=0;

echo f_d($opl);

?>
</b></td>
</tr>
<!---
<tr align=right>
<td width=2300px><b>100% предоплата</b></td><td width=800px><b>
<?php 
echo f_d($itogo->last_nachisleno);?>
</b></td>
</tr>
<tr align=right>
<td width=2300px><b>100% предоплата + к оплате</b></td><td width=800px><b>
<?php 
echo f_d($itogo->last_nachisleno+$opl);?>
</b></td>
</tr>
</table>--->
<table width=100%>
<tr align=right>
<td width=20%><b>Подписи поставщика</b></td>
</tr>
<tr align=right>
<td width=20%><b></b></td>
</tr>
<tr align=right>
<td width=20%><b></b></td>
</tr>
<tr align=right>
<td width=20%><b>Подписи потребителя</b></td>
</tr>
</table>

</body>
</html>
<?php 
function f_d($var,$digit_count,$digit_count_drobnye)
{
	if ($var == null) return " ";
	if ($var == 0) return " "; else
	return sprintf("%22.{$digit_count_drobnye}f",$var);
}?>
<html>
<head>
<title>Учет электроэнергии. Промышленный отдел</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<center>
<h2>Сведения о расходе электроэнергии</h2>
</center>
<table width=100%> 
<tr>
<td align=left colspan=3><b>Поставщик</b>  ТОО "Горэлектросети"</td>
<td align=right><b>Тел.</b> 26-47-46</td>
</tr>
<tr>
<td align=left><b>Покупатель</b> <?php echo $firm_data->name;?></td>
<td align=left><b>РНН</b> <?php echo $firm_data->rnn;?></td>
<td align=left><b>Абонент</b> <?php echo $firm_data->dogovor;?></td>

<td align=right><b>Телефон</b> <?php echo $firm_data->telefon;?></td>
</tr>
</table> 

<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr> 
 <td>П/П</td>
 <td>№ Т.У.</td>
 <td>Наименование</td>
 <td>№ счетчика</td>
 <td>Вид счетчика</td>
 <td align=center >Показание</td>
 <td>Коэффиц. транс. тока</td>
 <td>Показание</td>
</tr>
<?php $i=0;?>
<?php foreach($points_data->result() as $point): ?>
<tr> 
 <td><?php echo $i++; ?></td>
 <td><?php echo $point->billing_point_id;?></td>
 <td><?php echo $point->billing_point_name;?></td>
 <td><?php echo $point->gos_nomer;?></td>
 <td><?php echo $point->tariff_name;?></td>
 <td align=right><?php echo f_d($point->value,$point->digit_count,$point->digit_count_drobnye);?></td>
 <td><?php echo $point->transform;?></td>
 <td>&nbsp;</td>
</tr>
<?php endforeach;?>
</table>
<br>
<br>
<br>
<center>
<table>
<tr>
<td>Выдал (Должность, ФИО)</td>
<td> _________________________</td>
</tr>
<tr>
<td>Принял (Должность, ФИО)</td>
<td> _________________________</td>
</tr>
</table>
</center>
<div align=right>отдел Сбыта</div>

</html>
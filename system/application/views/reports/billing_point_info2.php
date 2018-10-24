<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}?>
<html>
<head>
<title>Информация о точках учета </title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<center>Информация по точкам учета <br>договор № <?php echo $firm->dogovor."  ".$firm->name;?></center><br />
<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>

<td>№</td>
<td>
Наименование обьекта 
</td>
<td>
место установки учета
</td>
<td>
Тип счетчика
</td>
<td>
Номер счетчика
</td>
<td>
Коэфициент трансформации
</td>
<td>
Установленная мощность эл. установок
</td>
<td>
Кол-во часов работы в сутки
</td>
<td>
Кол-во выходных
</td>
<td>
Ампераж
</td>

</tr>

<?php $j=1;foreach($info->result() as $i ):?>
<tr>
<td><?php echo $j++;?></td>
<td>
<?php echo $i->billing_point_name;?>
</td>
<td>
<?php echo $i->billing_point_address;?>
</td>
<td>
<?php echo $i->counter_type_name;?>
</td>
<td>
&nbsp;<?php echo $i->gos_nomer;?>
</td>
<td>
&nbsp;<?php echo $i->transform;?>
</td>
<td>
&nbsp;<?php echo $i->power;?>
</td>
<td>
&nbsp;<?php echo $i->time_in_day;?>
</td>
<td>
&nbsp;<?php echo $i->not_worked_day;?>
</td>
<td>
&nbsp;<?php echo $i->amper;?>
</td>


</tr>
<?php endforeach;?>
</table>
</body>
</html>

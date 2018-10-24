<H4>Показания счетчика по тарифу <?php  echo $sets_type; ?></H4>
Коэффициент трансформации:
<?php 
echo $counter_data->transform;
?>&nbsp;&nbsp;<br>
Разрядность счетчика:
<?php 
echo $counter_data->digit_count;
?><br>
Гос номер счетчика:
<?php 
echo $counter_data->gos_nomer;


function datetostring($date)
{
	$d=explode("-",$date); 
	return $d['2'].'/'.$d['1'].'/'.$d['0'];
}

?>
<br><br>
<table >
<tr align=center>
<td><b> <small>Показание</small></b> </td><td><small> <b>Разность</small></b> </td> <td> <b><small>Дата показания</small></b> </td>  <td> <b><small>Тариф</small></b> </td> <td> <b><small>НДС</small></b> </td><td> <b><small>Итого квт</small></b> </td><td> <b><small>Итого тенге</small></b> </td> <td> <b><small>Итого НДС</small></b> </td> <td> <b><small>Сумма</small></b> </td>  </tr>
<?php  foreach($query->result() as $r): ?>
<?php 
$itogo_kvt=$counter_data->transform * $r->diff;
$itogo_tenge=$counter_data->transform*$r->diff * $r->tariff_value;
$itogo_nds=$counter_data->transform*$r->diff*$r->tariff_value*($r->nds/100);
$summa=$counter_data->transform*$r->diff*$r->tariff_value*($r->nds/100+1);

?>
<tr>
<td><small> <?php  echo $r->value; ?> </small></td>
<td><small> <?php  echo $r->diff; ?> </small></td>
<td><small> <?php  echo datetostring($r->data);?></small> </td>
<td><small> <?php  echo $r->tariff_value;?> </small></td>
<td><small> <?php  echo $r->nds;?>%</small> </td>
<td><small> <?php  echo $itogo_kvt;?> </small></td>
<td><small> <?php  echo $itogo_tenge;?> </small></td>
<td><small> <?php  echo $itogo_nds;?> </small></td>
<td><small> <?php  echo $summa; ?>  </small></td>
<td><?php echo anchor("billing/delete_pokazanie/".$r->id,"<img src=".base_url()."img/delete.png />"); ?></td>

</tr>
<?php  endforeach; ?>
</table>
<br><br>


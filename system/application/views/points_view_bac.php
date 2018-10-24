
<h4>Точки учета</h4>
<table width=100% cellspacing=0px cellpadding=5px border =1px>
<tr>
<td>Название точки учета</td>   <td>ТП</td><td>Адрес</td><td>.</td>
</tr>
<?php 
foreach ($result->result() as $r):
?>

<tr>
<td> <?php  echo anchor("billing/point/".$r->id,$r->name."<br><font color=green>".$r->gos_nomer."</font> <font color=blue>".$r->counter_type_name."</font><br/>
<font color=red >".$r->data_gos_proverki."</font><br/>
<font color=purpure>".$r->crafted_year."</font>"); ?></td>
<td> <?php  echo $r->tp_name; ?></td>
<td> <?php  echo $r->address."<br>".anchor("billing/last_edit/".$r->id,"гос проверка:".$r->last_gos_proverka."<br>Плановая проверка:".$r->last_plan_proverka); ?></td>
<td> <?php  echo anchor("billing/delete_billing_point/".$r->id,"Удалить")."<br/>".
				anchor("billing/edit_billing_point/".$r->id,"Редактировать")."<br/><br/>".
				anchor("billing/tp_billing_point/".$r->id."/".$r->firm_id,"<font color='".($r->in_tp=='t'?"green":"red")."'>В ТП</font>")."<br/><br/>".
				anchor("billing/close_billing_point/".$r->id."/".$r->firm_id,"снять точку учета"); 
				
	?></td>
</tr>
<?php 
endforeach;
?>
</table>
<?php 
echo "<br><br><br>";
?>
<hr>
<h4>Добавление точки учета</h4>


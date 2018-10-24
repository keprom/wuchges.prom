
<h4>Точки учета</h4>
<table width=100% cellspacing=0px cellpadding=5px border =1px>
<tr>
<td>Название точки учета</td>   <td>ТП</td><td>Адрес</td><td>.</td>
</tr>
<?php 
foreach ($result->result() as $r):
?>

<tr>
<td> <?php  echo anchor("billing/point/".$r->id,$r->name); ?></td>
<td> <?php  echo $r->tp_name; ?></td>
<td> <?php  echo $r->address; ?></td>
<td> <?php  echo anchor("billing/delete_billing_point/".$r->id,"Удалить")."<br/>".
				anchor("billing/edit_billing_point/".$r->id,"Редактировать"); 
				
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


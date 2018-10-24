<?php
function select($var,$name,$value)
{
	$string="<select name={$name}_id>";
	foreach ($var->result() as $v) 
	{
		$string.="<option value={$v->id} ".($v->id==$value?" selected ":"")." >{$v->name}</option>";
	}
	$string.="</select><br>";
	echo $string;
}
?>
<?php echo anchor('billing/firm/'.$point->firm_id,"Назад к фирме");?>
<h4>Редактирование точки  учета</h4>
<br>
<?php echo form_open('billing/edition_billing_point/'.$point_id);?>
Название: <input name=name  value='<?php echo $point->name; ?>' />
<br>
Адрес: <input name=address  value='<?php echo $point->address; ?>' />
<br><br>
Тп:
<?php
select ($tp,'tp',$point->tp_id);
?>
Учет:
<select name=phase >
<option value=1  <?php echo ($point->phase==1?" selected":"");?> >Однофазный</option>
<option value=3 <?php echo ($point->phase==3?" selected":"");?>>Трехфазный</option>
</select >
<br>
Группа по мощности:
<?php
select ($power_group,'power_group',$point->power_group_id);
?>
<input type=submit value='Обновить данные'>
</form>

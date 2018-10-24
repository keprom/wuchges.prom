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

<b>Редактирование счетчика</b>
<br>
<?php echo form_open('billing/changing_counter/'.$counter->id);?>
Коэффициент трансформации <input name=transform value='<?php echo $counter->transform; ?>' ><br>
Разрядность <input name=digit_count value='<?php echo $counter->digit_count; ?>' ><br>
Гос номер <input name=gos_nomer value='<?php echo $counter->gos_nomer; ?>' ><br>
Дата гос проверки <input name=data_gos_proverki value='<?php echo $counter->data_gos_proverki; ?>' ><br>
Тип счетчика <?php select($counter_type,'type',$counter->type_id); ?>


<br><br>
<input type=submit value='Обновить'>
</form>
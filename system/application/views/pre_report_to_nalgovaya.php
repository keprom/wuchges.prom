<?php echo form_open('billing/report_to_nalogovaya/');

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
Начальный период : <?php select($period,'start_period',$current_period);?> <br>
Конечный период : <?php select($period,'finish_period',$current_period);?> <br>
<br>
<input type=submit value='Выдать отчет для налоговой'>

</form>
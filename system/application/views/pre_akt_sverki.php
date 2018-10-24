<?php echo form_open('billing/akt_sverki/'.$r->id);

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
<input type=hidden name=firm_id value='<?php echo $firm_id; ?>' >
<input type=submit value='Выдать акт сверки'>

</form>
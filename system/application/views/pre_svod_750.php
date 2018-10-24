<?php echo form_open('billing/svod_750');

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
Начальный период : <?php select($period,'start_period',-1); ?> <br>
Конечный период : <?php select($period,'finish_period',-1); ?> <br>
<br>
Фильтрация : <select name=type >
<option value=1 >Выдать всех</option>
<option value=2 >Только Юр лица</option>
<option value=3 >Только ИП</option>
<option value=4 >Только бюджет</option>
</select>
<br><br>
<input type=submit value='Выдать'>

</form>
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
<?php echo form_open("billing/edition_tp/".$query->id);?>
Наименование тп: <input name=name value="<?php echo $query->name;?>"><br>
<?php select ($ture,'ture',$query->ture_id);?>
<br />
<input type=submit value="Обновить данные">
</form>
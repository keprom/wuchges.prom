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
}?>

<h3>Добавление акта</h3>
<?php echo form_open("billing/adding_akt_with_tariff/{$firm_id}"); ?>
<input type=hidden name="firm_id" value="<?php echo $firm_id; ?>">
Количество киловатт <input type=text name=kvt /><br>
Дата начисления акта <input type=text name=data /><br>
Тариф 
<select name=tariff >
 <?php 
  foreach ($tariffs->result() as $t)
  {
     echo "<option value='{$t->tariff_id}|{$t->value}' >{$t->name}</option>";
  }
 ?>
</select>
<br>
Счетчик 
<select name=counter_id >
 <?php 
  foreach ($counters->result() as $c)
  {
     echo "<option value={$c->counter_id} >{$c->gos_nomer} {$c->name}</option>";
  }
 ?>
</select>
<br>
<input type=submit value='Добавить акт'>
</form>
<br/>
<hr/>
Текущие акты:
<br/>
<?php foreach ($akts->result() as $a){
  echo "<b>".$a->data."</b> <br>тариф:{$a->tariff_value}тенге <br> {$a->kvt}кВт  {$a->name}".anchor("billing/delete_akt_with_tariff/{$firm_id}/".$a->id," x ")."<br><br><br>"; 
}
?>

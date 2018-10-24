<?php echo form_open("billing/snyatie_counter_value"); ?>
ТУРЭ
<select name=ture_id>
<?php foreach ($ture->result() as $t):?>
	<option value=<?php echo $t->id;?>><?php echo $t->name;?></option>
<?php endforeach;?>
</select>
<br>

<br>
<br>
<input type=submit value='Выдать отчет' />
</form>

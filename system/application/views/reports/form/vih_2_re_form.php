<?php echo form_open("billing/vih_2_re"); ?>
<select name=period_id>
<?php foreach ($periods->result() as $period):?>
	<option value=<?php echo $period->id;?>><?php echo $period->name;?></option>
<?php endforeach;?>
</select>
<br>
<br>
<br>
<input type=submit value='Отчет 2-РЭ' />
</form>

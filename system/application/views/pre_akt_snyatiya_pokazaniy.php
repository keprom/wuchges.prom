<?php echo form_open("billing/akt_snyatiya_pokazaniy"); ?>
Период
<select name=period_id>
<?php foreach ($period->result() as $p):?>
	<option value=<?php echo $p->id;?>><?php echo $p->name;?></option>
<?php endforeach;?>
</select>
<input type=submit value='Выдать акт' />
</form>
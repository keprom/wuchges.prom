<?php echo form_open("billing/svod_po_tp"); ?>
ТУРЭ
<select name=ture_id>
<?php foreach ($ture->result() as $t):?>
	<option value=<?php echo $t->id;?>><?php echo $t->name;?></option>
<?php endforeach;?>
</select>
<br>
Период
<select name=period_id>
<?php foreach ($period->result() as $p):?>
	<option value=<?php echo $p->id;?>><?php echo $p->name;?></option>
<?php endforeach;?>
</select>
<br>

<br>
<br>
<input type=submit value='Выдать отчет' />
</form>

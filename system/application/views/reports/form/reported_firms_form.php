<?php echo form_open("billing/reported_firms"); ?>
ТУРЭ
<select name=ture_id>
<?php foreach ($ture->result() as $t):?>
	<option value=<?php echo $t->id;?>><?php echo $t->name;?></option>
<?php endforeach;?>
</select>
<br>
Тип отчета <select name=reported_or_notreported >
	<option value=0 >Отчитавшиеся организации </option>
	<option value=1 >Не отчитавшиеся организации </option>
</select>
<br>
<br>
<input type=submit value='Выдать отчет' />
</form>

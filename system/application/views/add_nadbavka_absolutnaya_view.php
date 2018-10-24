<hr>
<h3>Добавление абсолютной надбавки</h3>
<?php echo form_open("billing/adding_ab_nadbavka"); ?>
<input type=hidden name="values_set_id" value="<?php echo $vs_id; ?>">
Количество надбавки <input name=value /><br>
Дата надбавки <input name=data /><br>
<input type=submit value='Добавить надбавку'>
</form>
<br/>
<hr/>
<br/>

<h3>Добавление акта</h3>
<?php echo form_open("billing/adding_akt"); ?>
<input type=hidden name="values_set_id" value="<?php echo $vs_id; ?>">
Количество киловатт <input name=value /><br>
Дата начисления акта <input name=data /><br>
<input type=submit value='Добавить акт'>
</form>
<br/>
<hr/>
<br/>

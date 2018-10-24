<hr>
<h3>Добавление относительной надбавки</h3>
<?php echo form_open("billing/adding_ot_nadbavka"); ?>
<input type=hidden name="billing_point_id" value="<?php echo $point_id; ?>">
Количество надбавки <input name=value /><br>
<input type=submit value='Добавить надбавку'>
</form>
<br/>
<hr/>
<br/>

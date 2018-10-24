<?php foreach($query->result() as $row): ?>
<?php echo $row->name; ?>
<?php  echo form_open("billing/update_tariff");?>
<input name="value" value= "<?php echo $row->value; ?>" />
<input type="hidden" name='id' value= " <?php echo $row->id; ?> " />
<br/><input type='submit' value="обновить тариф <?php echo $row->name;?>">
</form><br/>
<?php endforeach;?>

<br><br><br>
<h4>Изменение НДС </h4>
<?php echo form_open("billing/update_nds");?>
<input name='value' value= "<?php echo $nds; ?> " />
<br><br>
<input type=submit value="Отправить">
</form>

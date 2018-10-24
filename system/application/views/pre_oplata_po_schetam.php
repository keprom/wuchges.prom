<?php echo form_open("billing/oplata_po_schetam"); ?>
Период
<select name=period_id>
<?php foreach ($period->result() as $p):?>
	<option value=<?php echo $p->id;?>><?php echo $p->name;?></option>
<?php endforeach;?>
</select>
<br>
<br>
<br>
или  за период
 
 <br>
 Стартовая дата <input name=start >  <br>окончательная дата <input name=end >
<br>
<br>
<input type=submit value='Выдать отчет' />
</form>

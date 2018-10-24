<table>
<tr><td><b>Название типа счетчика</b></td></tr>
<?php foreach($query->result() as $row): ?>
<tr><td><?php echo $row->name; ?></td></tr>
<?php endforeach;?>
</table>

<h4>добавить тип счетчика</h4>
<?php echo form_open("billing/adding_counter_types"); ?>
Наименование счетчика <input name="name" />
<br/><br/>
<input type=submit value="добавить тип счетчика" />
</form>

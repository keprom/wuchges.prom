<table>
<tr><td><b>Название улицы</b></td></tr>
<?php foreach($query->result() as $row): ?>
<tr><td><?php echo $row->name; ?></td></tr>
<?php endforeach;?>
</table>
<br><br>
<h4>добавить улицу</h4>
<?php echo form_open("billing/adding_streets"); ?>
Наименование улицы <input name="name" />
<br/><br/>
<input type=submit value="добавить улицу" />
</form>

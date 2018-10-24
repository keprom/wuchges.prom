<table>
<tr><td><b>Название банка</b></td><td><b>МФО</b></td>
<td><b>Корреспонденский счет</b></td><td><b>Адрес</b></td></tr>
<?php foreach($query->result() as $row): ?>
<tr>
<td><?php echo anchor("billing/bank_edit/".$row->id,$row->name); ?></td><td><?php echo $row->mfo; ?></td>
<td><?php echo $row->korr_account; ?></td><td><?php echo $row->address; ?></td>
</tr>
<?php endforeach;?>
</table>

<h4>добавить БАНК</h4>
<?php echo form_open("billing/adding_banks"); ?>
Название банка <input name="name" /><br/>
MFO <input name="mfo" /><br/>
корреспонденский счет <input name="korr_account" /><br/>
Адрес <input name="address" /><br/>


<br/><br/>
<input type=submit value="добавить Банк" />
</form>

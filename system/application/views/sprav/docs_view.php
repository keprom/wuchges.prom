<table>
<tr><td><b>Название документа</b></td></tr>
<?php foreach($query->result() as $row): ?>
<tr>
<td><?php echo anchor("billing/docs_edit/".$row->id,$row->name); ?></td>
</tr>
<?php endforeach;?>
</table>

<h4>добавить документ</h4>
<?php echo form_open("billing/adding_docs"); ?>
Название документа <input name="name" /><br/>
<br/><br/>
<input type=submit value="добавить документ" />
</form>

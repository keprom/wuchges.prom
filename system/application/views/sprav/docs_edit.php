
<h4>Изменение документа</h4>
<?php echo form_open("billing/edition_docs/".$docs_id); ?>
Название документа 
<input name="name" value='<?php echo $doc->name; ?>' /><br/>

<br/><br/>
<input type=submit value="изменить документ" />
</form>

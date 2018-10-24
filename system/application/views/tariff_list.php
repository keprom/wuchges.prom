<h3>Список тарифов
</h3>
<h5>
<?php 
 foreach ($tariff_list->result() as $t){
	echo anchor("billing/tariff/{$t->id}","{$t->name}:{$t->type_name}")."<br><br>";
 }
?>
</h5>
<br>
<br>
<br>
<?php echo form_open("billing/adding_tariff");?>
Наименование тарифа <input name=name /><br/>
Длинное название тарифа <input name=type_name /><br/>
<input type=submit value='Добавить тарифф' />
</form>

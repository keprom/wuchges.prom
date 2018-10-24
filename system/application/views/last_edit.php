<h3>Редактирование последней гос проверки</h3>
<?php 
$r=$point->row();
echo form_open("billing/last_edition/".$r->id); ?>
Последняя гос проверка <input name=value  value="<?php echo $r->last_gos_proverka;?>" />
<br/>
Последняя плановая проверка <input name=value2  value="<?php echo $r->last_plan_proverka;?>" />
<br/>
<br/>
<input type=submit value='Обновить данные' />
</form>

</p>

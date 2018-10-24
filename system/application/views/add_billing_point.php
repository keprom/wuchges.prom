
<?php
echo form_open("billing/adding_point");
?>
<h5>Наименование точки учета</h5>
<input type="text" name="name" value="" size="50" /><br>
<h5>Адрес точки учета</h5>
<input type="text" name="address" value="" size="50" /><br>
<h5>Наименование ТП</h5>
<select name=tp_id >
<?php foreach($tps->result() as $row): ?>
<option value=<?php echo $row->id;?> ><?php echo $row->name; ?></td></tr>
<?php endforeach;?>
</select>
<br>
<h5>Фазность </h5>
<select name=phase >
<option value=1 >Однофазный </option>
<option value=3 >Трехфазный </option>
</select>
 <input type="hidden" name='firm_id' value =<?php echo $firm_id;?>>
 <br> <br> <br>
<input type='submit' value='Добавить  точку учета'/>
</form>
<hr/>

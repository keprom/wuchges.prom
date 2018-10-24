<hr>
<h3>Добавление абсолютного совместного учета</h3>
<?php echo form_open("billing/adding_sovm_ab"); ?>
<input type=hidden name="values_set_id" value="<?php echo $values_set_id; ?>" />
<br/><br/>
Количество <input name=value style="width : 50" /> кВт <br>
Родительская фирма
<select name="parent_firm_id" style="width : 150">
<?php foreach ($firms->result() as $row ): ?>
  <option value="<?php echo $row->id; ?>"><?php echo $row->firm_info;?></option>
<?php endforeach; ?>
</select>
Дата занесения <input name=data style="width : 50" >
<br><br>
<input type=submit value="Добавить совместный абсолютный учет" >
</form>
<br/>
<hr/>

<hr>
<h3>Добавление  учета путем вычета</h3>
<?php echo form_open("billing/adding_sovm_by_counter"); ?>
<input type=hidden name="billing_point_id" value="<?php echo $point_id; ?>" />
<br/><br/>
Родительская фирма
<select name="parent_firm_id" style="width : 200">
<?php foreach ($firms->result() as $row ): ?>
  <option value="<?php echo $row->id; ?>"><?php echo $row->firm_info;?></option>
<?php endforeach; ?>
</select>
<br><br>
<input type=submit value="Добавить совместный учет" >
</form>
<br/>
<hr/>

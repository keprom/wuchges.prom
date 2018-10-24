<?php
echo form_open("billing/adding_sets");
?>
<h5>Выберите тарифный план</h5>

<select name="tariff_id" style="width : 200">
<?php foreach($tariff->result() as $row): ?>
  <option value="<?php echo $row->id; ?>" > <?php echo $row->type_name; ?></option>
<?php endforeach; ?>
 </select>
 <input type=hidden name=counter_id value= "<?php echo $counter_id;  ?>" />
 <br> <br> <br>
<input type='submit' value="Добавить  точку учета" />
</form>

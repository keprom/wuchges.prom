<h4>Добавление счетчика</H4>
<?php
echo form_open("billing/adding_counter");
?>
Гос номер счетчика
<input type="text" name="gos_nomer" value="" size="20"/><br/>
Коэффициент трансформации
<input type="text" name="transform" value="" size="20"/><br/>
Номер пломбы
<input type="text" name="plomba" value="" size="20"/><br/>
Дата гос проверки ( пример:01.01.10 )
<input type="text" name="data_gos_proverki" value="" size="20"/><br/>
Разрядность счетчика
<input type="text" name="digit_count" value="" size="20"/><br/>
Разрядность счетчика после запятой
<input type="text" name="digit_count_drobnye" value="" size="1"/><br/>
Тип счетчика
<select name="type_id" style="width : 200">
    <?php foreach ($types->result() as $row): ?>
        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
    <?php endforeach; ?>
</select>
<input type='hidden' name='point_id' value= "<?php echo $point_id; ?>"/>

<h5>Дата установки</h5>
День <input type="text" name="day" value="" size="5"/>
Месяц <input type="text" name="month" value="" size="5"/>
Год <input type="text" name="year" value="" size="5"/>
<br><br><br>
<input type='submit' value="добавить счетчик"/>
</form>

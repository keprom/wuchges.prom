<?php
echo form_open("billing/adding_firm");
?>
<h5>Название фирмы</h5>
<input type="text" name="name" value="" size="50"/>
<BR><BR>
<b>Номер договора </B>
<input type="text" name="dogovor" value="" size="10"/>
<br><br>
<b>Банк</b>
<select name="bank_id" style="width : 200">
    <?php foreach ($banks->result() as $row): ?>
        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
    <?php endforeach; ?>
</select>
<br><br>
<select name=subgroup_id>
    <?php foreach ($subgroups->result() as $row): ?>
        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
    <?php endforeach; ?>
</select>

<br><br>
<b>Адрес</b> <input type="text" name="address" value="" size="20"/>
<br/><br/>
<b>Директор</b> <input type="text" name="director_name" value="" size="20"/>
<br/><br/>
<b>Количество учредителей: </b> <input type="text" name="person" value="1" size="5"/>
<br/><br/>
<b>Телефон</b>
<input type="text" name="telefon" value="" size="15"/><br/><br/>
<b>РНН</b>
<input type="text" name="rnn" value="" size="20"/><br/><br/>
<b>Дата договора</b><br>
День <input type="text" name="day" value="" size="5"/>
Месяц <input type="text" name="month" value="" size="5"/>
Год <input type="text" name="year" value="" size="5"/>
<br><br><br>
<input type='submit' value='добавить фирму'/>
</form>

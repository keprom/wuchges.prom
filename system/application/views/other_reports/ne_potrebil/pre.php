<?php echo form_open("billing/ne_potrebil"); ?>
Период
<select name=period_id>
    <?php foreach ($period as $p): ?>
        <option value=<?php echo $p->id; ?>><?php echo $p->name; ?></option>
    <?php endforeach; ?>
</select>
<br>
<br>
Выдать
<select name="debt_type_id" id="">
    <option value="-1">всех</option>
    <option value="0">только дебиторов</option>
    <option value="1">только кредиторов</option>
</select>
<br>
<br>
<input type=submit value='Выдать отчет'/>
</form>

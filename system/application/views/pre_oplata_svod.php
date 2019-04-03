<?php echo form_open("billing/oplata_svod"); ?>
Период
<select name="period_id">
    <?php foreach ($period as $p): ?>
        <option value=<?php echo $p->id; ?>><?php echo $p->name; ?></option>
    <?php endforeach; ?>
</select>
<br><br>
Номер счета
<select name="payment_number_id">
    <option value="0">Все</option>
    <?php foreach ($pay_number as $pn): ?>
        <option value=<?php echo $pn->id; ?>><?php echo $pn->number; ?></option>
    <?php endforeach; ?>
</select>
<br>
<br>
<input type="submit" value='Выдать отчет' />
</form>

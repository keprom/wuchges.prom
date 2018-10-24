<?php echo form_open('billing/fine_akt_sverki/'.$firm_id); ?>
    <label for="period_id_start">Начало</label>
    <select name="period_id_start" id="period_id_start">
        <?php foreach ($period as $p): ?>
            <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
        <?php endforeach; ?>
    </select>
    <label for="period_id_end">Конец</label>
    <select name="period_id_end" id="period_id_end">
        <?php foreach ($period as $p): ?>
            <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Открыть акт сверки">
<?php echo form_close(); ?>
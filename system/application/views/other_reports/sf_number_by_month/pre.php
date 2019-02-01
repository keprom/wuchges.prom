<?php echo form_open("billing/sf_number_by_month"); ?>
    <select name="period_id" id="">
        <?php foreach ($period as $p): ?>
            <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Открыть">
<?php echo form_close(); ?>
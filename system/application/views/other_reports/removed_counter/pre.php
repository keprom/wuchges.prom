<?php echo form_open('billing/removed_counter'); ?>
    <fieldset>
        <legend>Снятые счетчики за год</legend>
        <select name="period_year" id="">
            <?php foreach ($period_years as $year): ?>
                <option value="<?php echo $year->period_year; ?>"><?php echo $year->period_year; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Открыть">
    </fieldset>
<?php echo form_close(); ?>
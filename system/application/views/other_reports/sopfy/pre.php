<?php echo form_open('billing/svod_oplat_po_firmam_year'); ?>
    <fieldset>
        <legend>Годовой свод оплат в разрезе фирм</legend>
        <select name="period_year" id="">
            <?php foreach ($period_years as $year): ?>
                <option value="<?php echo $year->period_year; ?>"><?php echo $year->period_year; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Выдать">
    </fieldset>
<?php echo form_close(); ?>
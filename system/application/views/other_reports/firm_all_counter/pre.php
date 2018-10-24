<?php echo form_open('billing/firm_all_counter'); ?>
    <fieldset>
        <legend>Счетчики</legend>

        <label for="">Год введения в эксплуатацию</label>
        <select name="year_start" id="">
            <option value="-1">Все</option>
            <?php foreach ($period_years as $ys): ?>
                <option value="<?php echo $ys->period_year; ?>"><?php echo $ys->period_year; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <br>
        <label for="">Год снятия с эксплуатации</label>
        <select name="year_finish" id="">
            <option value="-1">Все</option>
            <option value="-2">Не снят</option>
            <?php foreach ($period_years as $yf): ?>
                <option value="<?php echo $yf->period_year; ?>"><?php echo $yf->period_year; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <br><input type="submit" value="Открыть">
    </fieldset>
<?php echo form_close(); ?>
<?php
if (empty($fine_firm) or ($fine_firm->is_fine != 't')) {
    $checked = '';
} elseif ($fine_firm->is_fine == 't') {
    $checked = 'checked';
}

?>
<?php echo anchor(base_url() . "/billing/firm/" . $firm_info->id, "Назад к фирме") . "<br><br>"; ?>
<fieldset>

    <h4><?php echo '№' . $firm_info->dogovor . ' ' . $firm_info->name; ?></h4>
    <p>Сальдо пени на начало месяца: <?php echo(empty($fine_saldo) ? '0.00' : prettify_number($fine_saldo->value)); ?></p>

    <?php if (!empty($fine_periods)): ?>
        <?php echo form_open('billing/fine_firm/' . $fine_firm->firm_id) ?>
        <select name="period_id" id="period_id">
            <?php foreach ($fine_periods as $f): ?>
                <option value="<?php echo $f->id; ?>"><?php echo $f->name; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="look_fine_firm" value="Просмотр">
        <?php echo form_close(); ?>
    <?php endif; ?>

    <?php if (!empty($fine_firm_oplata_periods)): ?>
        <?php echo form_open('billing/fine_firm_oplata/' . $firm_info->id); ?>
        <select name="period_id" id="period_id">
            <?php foreach ($fine_firm_oplata_periods as $ffop): ?>
                <option value="<?php echo $ffop->id; ?>"><?php echo $ffop->name; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Оплата пени">
        <?php echo form_close(); ?>
    <?php endif; ?>
    <br>

    <?php if (!empty($fine_periods)): ?>
        <?php echo form_open('billing/fine_saldo_origin/' . $firm_info->id); ?>
        <input type="submit" value="Образование сальдо">
        <?php echo form_close(); ?>
    <?php endif; ?>
    <br>

    <fieldset>
        <legend>Параметры</legend>
        <?php echo form_open('billing/change_fine_parameter'); ?>
        <label for="is_fine">Начислять пеню </label>
        <input type="checkbox" name="is_fine" <?php echo $checked; ?>>
        <label for="border_day">День, указанный в договоре</label>
        <input type="text" name="border_day" value="<?php echo $fine_firm->border_day; ?>" style="width: 20px">
        <input type="hidden" name="period_id" value="<?php echo $fine_firm->period_id; ?>">
        <select name="is_calendar" id="">
            <option <?php if($fine_firm->is_calendar == 0) echo 'selected'; ?> value="0">Рабочий</option>
            <option <?php if($fine_firm->is_calendar == 1) echo 'selected'; ?> value="1">Календарный</option>
        </select>
        <input type="hidden" name="firm_id" value="<?php echo $fine_firm->firm_id; ?>">
        <input type="submit" name="change_is_fine" value="Сохранить">
        <?php echo form_close(); ?>
    </fieldset>


</fieldset>
<?php echo form_open("billing/report_2000"); ?>
<select name="period_year" id="">
    <?php foreach ($period_years as $p): ?>
        <option value="<?php echo $p->period_year; ?>"><?php echo $p->period_year; ?></option>
    <?php endforeach; ?>
</select>
Фильтрация : <select name='firm_type'>
    <option value='1' >Выдать всех</option>
    <option value='2' >Только Юр лица</option>
    <option value='3' >Только ИП</option>
</select>
<input type="submit" value="Открыть">
<?php echo form_close(); ?>

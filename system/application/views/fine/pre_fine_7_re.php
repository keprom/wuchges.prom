<?php echo form_open('billing/fine_7_re', "method='post'") ?>
<label for="period_id">Месяц</label>
<select name="period_id" id="period_id">
    <?php foreach ($periods as $period): ?>
        <option value="<?php echo $period->id; ?>"><?php echo $period->name; ?></option>
    <?php endforeach; ?>
</select>

<label for="">ТУРЭ</label>
<select name="ture_id" id="ture_id">
    <option value="-1" selected>Все</option>
    <?php foreach ($ture as $t): ?>
        <option value="<?php echo $t->id; ?>"><?php echo $t->name; ?></option>
    <?php endforeach; ?>
</select>
<input type="submit" value="7-РЭ (пеня)">
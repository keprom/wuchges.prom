<?php echo form_open("billing/sf_verification"); ?>
<label for="">Счета-фактуры</label>
<select name="kvt_type" id="">
    <option value="1">кВт больше 0</option>
    <option value="-1">кВт меньше 0</option>
</select>
<input type="submit" value="Открыть">
<?php echo form_close(); ?>

<?php echo form_open('billing/report_info/'); ?>

<select name=subgroup_id>
    <?php foreach ($subgroup->result() as $t): ?>
        <option value=<?php echo $t->id; ?>><?php echo $t->name; ?></option>
    <?php endforeach; ?>
</select>
</select>
<input type=submit value='Выдать организации'/>
</form>
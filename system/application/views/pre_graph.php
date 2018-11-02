<?php echo anchor("billing/firm/{$firm_id}","Назад к фирме"); ?><br><br>
<?php echo form_open('billing/graph/' . $firm_id);

function select($var, $name, $value)
{
    $string = "<select name={$name}_id>";
    foreach ($var->result() as $v) {
        $string .= "<option value={$v->id} " . ($v->id == $value ? " selected " : "") . " >{$v->name}</option>";
    }
    $string .= "</select><br>";
    echo $string;
}

?>
Выберите диапазон(не более 12 месяцев):
<br>
<br>
Начальный период : <?php select($period, 'start_period', $current_period); ?> <br>
Конечный период : <?php select($period, 'finish_period', $current_period); ?> <br>
<br>
<br>
<select name=type>
    <option value=1>Потребление киловатт</option>
    <option value=2>Оплата/Начисление</option>
</select>
<br>

<input type=hidden name=firm_id value='<?php echo $firm_id; ?>'>
<input type=submit value='Показать график'>

</form>
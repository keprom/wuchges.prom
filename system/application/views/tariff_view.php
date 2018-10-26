<h3>Описание тарифа <?php echo $tariff->name . " " . $tariff->type_name; ?>
</h3>
<h5>
    <?php
    function f_d($var)
    {
        if ($var == 0) return "&nbsp;"; else
            return sprintf("%22.2f", $var);
    }

    foreach ($tariff_list->result() as $t) {
        echo $t->data . " &nbsp;&nbsp;&nbsp;" . f_d($t->value) . "<br>"; //anchor("billing/tariff/{$t->id}","{$t->name}:{$t->type_name}")."<br><br>";
    }
    ?>
</h5>
<br>
<br>
<br>
<?php echo form_open("billing/adding_tariff_value/{$tariff->id}"); ?>
Дата действия тарифа <input name=date/><br/>
Значение тарифа  <input name=value/><br/>
<input type=submit value='Добавить тарифф'/>
</form>

<?php
function anchor_form($link, $name)
{
    return form_open($link) . "<input type=submit value='" . $name . "'></form>";
}

if ($this->session->flashdata("is_deleted") > 0) echo "<h3>Точка учета не может быть удалена так, как на ней имеются счетчики. Удалите сначала все счетчики</h3>";
if ($this->session->flashdata("is_deleted") == -1) echo "<h3>Точка учета  успешно удалена</h3>";

?>
<h5>#
    <?php

    echo ($is_closed->closed == 't' ? "<font color=red>" : "") . $r->dogovor . "  " . $r->name . ($is_closed->closed == 't' ? "</font>" : ""); ?>
    <br>
    <?php if ($r->firm_closed == 't') echo "<h1><font color=" . (($r->close_type == 1) ? "green" : "yellow") . ">АБОНЕНТ ЗАКРЫТ.<br> ЗАНЕСЕНИЕ ДАННЫХ НЕ ДОЛЖНО БЫТЬ ПРОИЗВЕДЕНО</font></h1>"; ?>
    <br>
    <p>
        <?php
        echo "<b>Адрес</b>: " . $r->address . "<br>";
        echo "<b>Телефон</b>: " . $r->telefon . "<br><br>";
        echo "<b>БИН</b>: " . $r->bin . "<br><br>";
        echo "<b>РНН</b>: " . $r->rnn . "<br><br>";
        echo "<b>Дата договора</b>: " . $r->dogovor_date . "<br>";
        echo "<b>Турэ</b>: " . $r->ture_name . "<br>";
        echo "<br>
<table>";

        echo "<tr><td>" . anchor_form("billing/firm_edit/{$r->id}", "Редактирование данных о фирме") . "</td><td> " . anchor_form("billing/oborotka/{$r->id}", "Выдать оборотку по орг-ции") . "</td></tr>";
        echo "<tr><td>" . anchor_form("billing/edit_pokaz/{$r->id}", "Редактирование показаний") . "</td><td> " . anchor_form("billing/firm_oplata/{$r->id}", "Выдать оплату по орг-ции за период") . "</td></tr>";
        echo "<tr><td>" . anchor_form("billing/close_firm/{$r->id}", "Начислить") . "</td><td> " . anchor_form("billing/open_firm/{$r->id}", "x") . "</td></tr>";
        echo "<tr><td>" . anchor_form("billing/rashod_electro/{$r->id}", "Сведения о расходе электроэнергии") . "</td><td>";
        echo anchor_form("billing/pre_schetfactura/{$r->id}", "Выдать счет фактуру") . "</td></tr>";
        echo "<tr><td>" . anchor_form("billing/pre_schetoplata/{$r->id}", "Выдать счет на оплату") . "</td><td>" . anchor_form("billing/pre_akt_sverki/{$r->id}", "Выдать акт сверки") . "</td></tr>";
        echo "<tr><td>" . anchor_form("billing/full_close_firm/{$r->id}", "Закрыть/открыть  предприятие'><br /> (Закрыть временно <input type=checkbox name=vremenno>) <input type=hidden value='") . "</td></tr>";
        echo "<tr><td>" . anchor_form("billing/schetfactura_numbers/{$r->id}", "Номера фактур") . "</td><td></td></tr>";
        echo "<tr><td>" . anchor_form("billing/pre_graph/{$r->id}", "График потребления") . "</td></tr>";
        //echo "<tr><td>".anchor_form("billing/pre_nakladnaya/{$r->id}","Накладная")."</td></tr>";
        echo "</table><br>";
        echo "Выдать ведомость за период ";

        echo form_open("billing/vedomost");
        echo "<input type=hidden name=firm_id value=" . $r->id . " >";
        echo "<select name=period_id >";
        foreach ($period->result() as $p) {
            echo "<option value='{$p->id}' {$p->checked} >{$p->name}</option>";
        }
        echo "</select>";
        echo "<input type=submit value='Открыть ведомость' />";
        echo "</form><br>";

        ?>
    </p>

    </h3>
    <hr/>

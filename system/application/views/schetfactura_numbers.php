<?php echo anchor("billing/firm/{$firm_id}","Назад к фирме"); ?><br>
<h2> Список номеров счет фактур </h2>
<table border=1>
    <tr>
        <th>Номер</th>
        <th> Период</th>
    </tr>
    <?php

    foreach ($numbers->result() as $n) {
        echo "<tr><td>{$n->schet_new}</td><td>{$n->period_name}</td></tr>";
    }
    ?>
</table>
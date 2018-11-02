<?php echo anchor("billing/point/{$counter_info->point_id}","Назад к списку счетчиков"); ?><br><br>
<b>Установленные тарифы на счетчике №<?php echo $counter_info->gos_nomer; ?>:</b><br/><br/>
<?php echo anchor("billing/change_counter/" . $counter_id, "Редактировать счетчик"); ?><br><br><br>
<table>
    <tr>
        <td>Тариф</td>
    </tr>
    <?php if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            echo "<tr><td>" . anchor("billing/values_sets/" . $row->id, $row->type) . "</td><td>" . anchor("billing/delete_values_set/" . $row->id . "/" . $counter_id, "удалить") . "</td></tr>";
        }
    } else {
        echo "Установленых тарифов на счетчике нету";
    }
    ?>
</table>
<br><br><br>
<?php echo anchor("billing/add_sets/" . $counter_id, "Добавить тариф на счетчик"); ?>

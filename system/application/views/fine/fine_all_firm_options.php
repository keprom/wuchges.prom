<style>
    .border-table {
        border-collapse: collapse;
    }

    .border-table td, .border-table tr, .border-table th {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .border-table tr:hover {
        background-color: #dddddd;
    }

    .no-decoration {
        text-decoration: none;
    }
</style>
<table class="border-table">
    <thead>
    <tr>
        <th>Группа</th>
        <th>Подгруппа</th>
        <th>Дог.</th>
        <th>Организация</th>
        <th>Начисляется?</th>
        <th>День</th>
        <th>Какой</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($options as $option): ?>
        <tr>
            <td><?php echo $option->group_name; ?></td>
            <td><?php echo $option->subgroup_name; ?></td>
            <td><?php echo $option->dogovor; ?></td>
            <td>
                <a class="no-decoration" target="_blank"
                   href="<?php echo site_url('billing/fine/' . $option->firm_id); ?>"><?php echo $option->firm_name; ?></a>
            </td>
            <?php
            if ($option->is_fine == 't') {
                $is_fine = 'Да';
            } elseif($option->is_fine == 'f') {
                $is_fine = 'Нет';
            }
            ?>
            <td align="center"><?php echo $is_fine ?></td>
            <td align="center"><?php echo $option->border_day; ?></td>
            <?php
            if ($option->is_calendar == 1) {
                $is_cal = 'Календарный';
            } elseif($option->is_calendar == 0) {
                $is_cal = 'Рабочий';
            }
            ?>
            <td align="center"><?php echo $is_cal; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
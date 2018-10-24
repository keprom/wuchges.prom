<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>7-РЭ (пеня)</title>
    <link rel="stylesheet" href="<?php echo base_url() . 'css/fullpage.css'; ?>">
</head>
<body>

<table class="border-table">
    <caption>
        <h2>
            Оборотная ведомость по неустойке за
            <?php echo $period_name; ?><?php if (isset($ture_name) != NULL) echo ' по ТУРЭ ' . $ture_name; ?>
        </h2>
    </caption>
    <thead>
    <tr>
        <th rowspan=2>Дог</th>
        <th rowspan=2>Потребитель</th>
        <th colspan=2>Сальдо на начало периода</th>
        <th rowspan=2>Начислено</th>
        <th rowspan=2>Оплачено</th>
        <th colspan=2>Сальдо на конец периода</th>
    </tr>
    <tr>
        <th>Дебет</th>
        <th>Кредит</th>
        <th>Дебет</th>
        <th>Кредит</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $last_group = -1;
    $last_firmgroup = '';
    $u_sum_debet = 0;
    $u_sum_kredit = 0;
    $u_sum_nachisleno = 0;
    $u_sum_oplata = 0;
    $u_sum_kredit_end = 0;
    $u_sum_debet_end = 0;

    $sum_debet = 0;
    $sum_kredit = 0;
    $sum_nachisleno = 0;
    $sum_oplata = 0;
    $sum_kredit_end = 0;
    $sum_debet_end = 0;

    ?>
    <?php foreach ($re as $r): ?>

        <?php if ($last_group != $r->firm_subgroup_id): ?>
            <?php if ($last_group != -1): ?>
                <tr align=right>
                    <td colspan=2 align=left><b>Итого по группе (<?php echo $last_firmgroup; ?>)</b></td>
                    <td class="td-number"><b><?php echo prettify_number($sum_debet); ?></b></td>
                    <td class="td-number"><b><?php echo prettify_number($sum_kredit); ?></b></td>
                    <td class="td-number"><b><?php echo prettify_number($sum_nachisleno); ?></b></td>
                    <td class="td-number"><b><?php echo prettify_number($sum_oplata); ?></b></td>
                    <td class="td-number"><b><?php echo prettify_number($sum_debet_end); ?></b></td>
                    <td class="td-number"><b><?php echo prettify_number($sum_kredit_end); ?></b></td>

                    <?php
                    $u_sum_debet += $sum_debet;
                    $u_sum_kredit += $sum_kredit;
                    $u_sum_nachisleno += $sum_nachisleno;
                    $u_sum_oplata += $sum_oplata;
                    $u_sum_kredit_end += $sum_kredit_end;
                    $u_sum_debet_end += $sum_debet_end;

                    $sum_debet = 0;
                    $sum_kredit = 0;
                    $sum_nachisleno = 0;
                    $sum_oplata = 0;
                    $sum_kredit_end = 0;
                    $sum_debet_end = 0;
                    ?>
                </tr>
            <?php endif; ?>
            <tr>
                <td colspan=9><b><?php echo $r->firm_subgroup_name; ?> </b></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td align=center>
                <?php echo $r->dogovor; ?>
            </td>
            <td>
                <?php echo $r->firm_name; ?>
            </td>
            <td class="td-number" t>&nbsp;
                <?php echo prettify_number($r->debet_start); ?>
            </td>
            <td class="td-number">&nbsp;
                <?php echo prettify_number($r->kredit_start); ?>
            </td>
            <td class="td-number">
                <?php echo prettify_number($r->nachisleno); ?>
            </td>
            <td class="td-number">
                <?php echo prettify_number($r->oplata); ?>
            </td>
            <td class="td-number">
                <?php echo prettify_number($r->debet_end); ?>
            </td>
            <td class="td-number">
                <?php echo prettify_number($r->kredit_end); ?>
            </td>

        </tr>
        <?php
        $last_group = $r->firm_subgroup_id;
        $last_firmgroup = $r->firm_subgroup_name;
        $sum_debet += $r->debet_start;
        $sum_kredit += $r->kredit_start;
        $sum_nachisleno += $r->nachisleno;
        $sum_oplata += $r->oplata;
        $sum_kredit_end += $r->kredit_end;
        $sum_debet_end += $r->debet_end;
        ?>


    <?php endforeach; ?>

    <tr align=right>
        <td colspan=2 align=left><b>Итого по группе (<?php echo $r->firm_subgroup_name; ?>)</b></td>
        <td class="td-number"><b><?php echo prettify_number($sum_debet); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($sum_kredit); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($sum_nachisleno); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($sum_oplata); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($sum_debet_end); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($sum_kredit_end); ?></b></td>
    </tr>
    <?php
    $u_sum_debet += $sum_debet;
    $u_sum_kredit += $sum_kredit;
    $u_sum_nachisleno += $sum_nachisleno;
    $u_sum_oplata += $sum_oplata;
    $u_sum_kredit_end += $sum_kredit_end;
    $u_sum_debet_end += $sum_debet_end;
    ?>
    <tr>
        <td colspan=9>&nbsp;</td>
    </tr>
    <tr>
        <td colspan=2 align='left'><b>ИТОГО<b></td>
        <td class="td-number"><b><?php echo prettify_number($u_sum_debet); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($u_sum_kredit); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($u_sum_nachisleno); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($u_sum_oplata); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($u_sum_debet_end); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($u_sum_kredit_end); ?></b></td>
    </tr>


    </tbody>
</table>
</body>
</html>
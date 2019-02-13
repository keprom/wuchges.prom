<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Миграция</title>
</head>
<body>
<table>
    <thead>
    <tr>
<!--        <th>ЭСО</th>-->
<!--        <th>Филиал</th>-->
        <th>Подразделение</th>
        <th>Отраслевая группа</th>
        <th>Номер договора</th>
        <th>Дата открытия</th>
        <th>Срок действия (если договор срочный)</th>
        <th>Дата оплаты по договору</th>
        <th>Признак расчета пени (1-не считать пеню, 0-считать пеню)</th>
        <th>Вид расчета пени (% в день или 1,5 ставка)</th>
        <th>срок оплаты до отключения (кол-во дней после вручения предупреждения)</th>
        <th>ОПФХ - Организационно-правовая форма хозяйствования (ГУ, ИП, ТОО, КХ и т.д.)</th>
        <th>Полное название потребителя</th>
        <th>БИН потребителя</th>
        <th>Признак ГУ (оплата через казначейство)</th>
        <th>Код населенного пункта (юр.адрес потребителя)</th>
        <th>Населенный пункт</th>
        <th>Код улицы </th>
        <th>Улица</th>
        <th>Код дома</th>
        <th>Дом (полный номер)</th>
        <th>Квартира (полный номер)</th>
        <th>Телефон</th>
        <th>Эл. адрес</th>
        <th>ИИК</th>
        <th>БИК</th>
        <th>Банк потребителя</th>
        <th>ОПФХ</th>
        <th>Полное название получателя</th>
        <th>БИН получателя</th>
        <th>Признак ГУ</th>
        <th>Код населенного пункта (юр.адрес получателя)</th>
        <th>Населенный пункт</th>
        <th>Код улицы </th>
        <th>Улица</th>
        <th>Код дома</th>
        <th>Дом (полный номер)</th>
        <th>Квартира (полный номер)</th>
        <th>Контакты получателя</th>
        <th>ИИК</th>
        <th>БИК </th>
        <th>Банк получателя</th>
        <th>ФИО контроллера</th>
        <th>Код ТУ</th>
        <th>Название ТУ</th>
        <th>Статус ТУ (1-отключена; 0-подключена)</th>
        <th>Дата отключения ТУ</th>
        <th>сетевой район (деление по структуре ЭПО)</th>
        <th>Код населенного пункта (адрес ТУ)</th>
        <th>Населенный пункт</th>
        <th>Код улицы </th>
        <th>Улица</th>
        <th>Код дома</th>
        <th>Дом (полный номер)</th>
        <th>Квартира (полный номер)</th>
        <th>Признак расчета потерь в трансформаторе (1 - считаются потери, 0-не считаются)</th>
        <th>Признак расчета потерь в ЛЭП (1 - считаются потери, 0-не считаются)</th>
        <th>Признак субабонента (1-является субабонентом, 0-самостоятельная ТУ)</th>
        <th>Код головной ТУ (если есть субчики)</th>
        <th>Вид расчета (по мощности)</th>
        <th>Мощность (фиксированная величина?)</th>
        <th>Код тарифа</th>
        <th>Тариф без НДС</th>
        <th>Название тарифа</th>
        <th>Код ПУ</th>
        <th>Тип ПУ</th>
        <th>Разрядность ПУ (до запятой)</th>
        <th>Разрядность ПУ (после запятой)</th>
        <th>Код номера ПУ</th>
        <th>Номер ПУ</th>
        <th>ПУ на балансе (ЭПО, потребитель, бесхозное)</th>
        <th>Коэффициент трансформатора (КТ)</th>
        <th>Дата поверки</th>
        <th>Пломба</th>
        <th>Метод снятия показания (ведомость, АСКУЭ, КПК)</th>
        <th>Показание конечное день (если одноставочный, то в этот же столбец ставим показание)</th>
        <th>Показание конечное вечер</th>
        <th>Показание конечное ночь</th>
        <th>Дата снятия конечного показания</th>
        <th>Примечание из ТУ (если есть такое поле)</th>
        <th>Код ПС</th>
        <th>ПС</th>
        <th>Код фидера от ПС</th>
        <th>Фидер (в)</th>
        <th>Код ТП</th>
        <th>ТП</th>
        <th>Код фидера от ТП</th>
        <th>Фидер</th>
        <th>Код секции ТП</th>
        <th>Владелец сети (указать ЭПО)</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($report as $r): ?>
        <tr>
<!--            <td>--><?php //echo $r->eso; ?><!--</td>-->
<!--            <td>--><?php //echo $r->branch; ?><!--</td>-->
            <td><?php echo $r->subdivizion; ?></td>
            <td><?php echo $r->group_name; ?></td>
            <td><?php echo $r->dogovor; ?></td>
            <td><?php echo $r->dogovor_date; ?></td>
            <td><?php echo $r->dogovor_duration; ?></td>
            <td><?php echo $r->payment_day; ?></td>
            <td><?php echo $r->fine_sign; ?></td>
            <td><?php echo $r->fine_type; ?></td>
            <td><?php echo $r->payment_day_off; ?></td>
            <td><?php echo $r->legal_form_type; ?></td>
            <td><?php echo $r->full_name; ?></td>
            <td><?php echo $r->bin; ?></td>
            <td><?php echo $r->gi_sign; ?></td>
            <td><?php echo $r->community_code; ?></td>
            <td><?php echo $r->community; ?></td>
            <td><?php echo $r->street_code; ?></td>
            <td><?php echo $r->street; ?></td>
            <td><?php echo $r->house_code; ?></td>
            <td><?php echo $r->house; ?></td>
            <td><?php echo $r->flat; ?></td>
            <td><?php echo $r->telefon; ?></td>
            <td><?php echo $r->email; ?></td>
            <td><?php echo $r->iik; ?></td>
            <td><?php echo $r->bik; ?></td>
            <td><?php echo $r->bank_name; ?></td>
            <td><?php echo $r->rec_legal_form_type; ?></td>
            <td><?php echo $r->org_name; ?></td>
            <td><?php echo $r->rec_bin; ?></td>
            <td><?php echo $r->rec_gi_sign; ?></td>
            <td><?php echo $r->rec_community_code; ?></td>
            <td><?php echo $r->rec_community; ?></td>
            <td><?php echo $r->rec_street_code; ?></td>
            <td><?php echo $r->rec_street; ?></td>
            <td><?php echo $r->rec_house_code; ?></td>
            <td><?php echo $r->rec_house; ?></td>
            <td><?php echo $r->rec_flat; ?></td>
            <td><?php echo $r->rec_contact; ?></td>
            <td><?php echo $r->rec_iik; ?></td>
            <td><?php echo $r->rec_bik; ?></td>
            <td><?php echo $r->rec_bank_name; ?></td>
            <td><?php echo $r->contoller_fio; ?></td>
            <td><?php echo $r->bp_code; ?></td>
            <td><?php echo $r->bp_name; ?></td>
            <td><?php echo $r->bp_status; ?></td>
            <td><?php echo $r->bp_disconnectioin_time; ?></td>
            <td><?php echo $r->net_district; ?></td>
            <td><?php echo $r->bp_community_code; ?></td>
            <td><?php echo $r->bp_community; ?></td>
            <td><?php echo $r->bp_street_code; ?></td>
            <td><?php echo $r->bp_street; ?></td>
            <td><?php echo $r->bp_house_code; ?></td>
            <td><?php echo $r->bp_house; ?></td>
            <td><?php echo $r->bp_flat; ?></td>
            <td><?php echo $r->bp_loss; ?></td>
            <td><?php echo $r->power_line_loss; ?></td>
            <td><?php echo $r->subuser_sign; ?></td>
            <td><?php echo $r->main_bp_code; ?></td>
            <td><?php echo $r->type_of_power_calculation; ?></td>
            <td><?php echo $r->power_capacity; ?></td>
            <td><?php echo $r->tariff_code; ?></td>
            <td><?php echo $r->tariff_value; ?></td>
            <td><?php echo $r->tariff_name; ?></td>
            <td><?php echo $r->counter_code; ?></td>
            <td><?php echo $r->counter_type_name; ?></td>
            <td><?php echo $r->digit_capacity_before; ?></td>
            <td><?php echo $r->digit_capacity_after; ?></td>
            <td><?php echo $r->gos_nomer_code; ?></td>
            <td><?php echo $r->gos_nomer; ?></td>
            <td><?php echo $r->counter_balance; ?></td>
            <td><?php echo $r->transform; ?></td>
            <td><?php echo $r->data_poverki; ?></td>
            <td><?php echo $r->seal; ?></td>
            <td><?php echo $r->reading_taking_method; ?></td>
            <td><?php echo $r->day_reading; ?></td>
            <td><?php echo $r->day_evening; ?></td>
            <td><?php echo $r->day_night; ?></td>
            <td><?php echo $r->reading_date; ?></td>
            <td><?php echo $r->substation_note; ?></td>
            <td><?php echo $r->substation_code; ?></td>
            <td><?php echo $r->substation; ?></td>
            <td><?php echo $r->substastion_fider_code; ?></td>
            <td><?php echo $r->substastion_fider; ?></td>
            <td><?php echo $r->tp_id; ?></td>
            <td><?php echo $r->tp_name; ?></td>
            <td><?php echo $r->tp_fider_code; ?></td>
            <td><?php echo $r->tp_fider; ?></td>
            <td><?php echo $r->tp_section_code; ?></td>
            <td><?php echo $r->bp_balance; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
<fieldset>
    <legend><h4>Данные для вычисления потерь для данной Т.У.</H4></legend>
    <?php if (!empty($bp_options)): ?>
        <fieldset>
            <legend>История изменений</legend>
            <table class="border-table hover-table">
                <thead>
                <tr class="head-tr">
                    <th>Период</th>
                    <th>Напряжение (U)</th>
                    <th>Сопротивление (r0)</th>
                    <th>Длина (L)</th>
                    <th>Тангенс(tgf)</th>
                    <th>Трансформаторы (Sном)</th>
                    <th>Дельта Ркз уд.</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($bp_options as $bp): ?>
                    <tr>
                        <td><?php echo $bp->period_name; ?></td>
                        <td align="right" class="td-right nowrap"><?php echo $bp->napr; ?></td>
                        <td align="right" class="td-right nowrap"><?php echo $bp->sopr; ?></td>
                        <td align="right" class="td-right nowrap"><?php echo $bp->dlina; ?></td>
                        <td align="right" class="td-right nowrap"><?php echo $bp->tgf; ?></td>
                        <td align="right" class="td-right nowrap"><?php echo $bp->snom; ?></td>
                        <td align="right" class="td-right nowrap"><?php echo $bp->rkz; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </fieldset>
        <br>
    <?php endif; ?>
    <?php
    echo form_open("billing/adding_nagruz");
    echo "<input type=hidden name=billing_point_id value=" . $point_id . " >"; ?>
    <table>
        <tr>
            <td>Напряжение (U)</td>
            <?php $bp_last_options = $bp_options[count($bp_options) - 1]; ?>
            <td><input name='napr' value='<?php echo $bp_last_options->napr; ?>'/><br/></td>
        </tr>
        <tr>
            <td>Сопротивление (r0)</td>
            <td><input name='sopr' value='<?php echo $bp_last_options->sopr; ?>'/><br/></td>
        </tr>
        <tr>
            <td>Длина (L)</td>
            <td><input name='dlina' value='<?php echo $bp_last_options->dlina; ?>'/><br/></td>
        </tr>
        <tr>
            <td>Тангенс (tgf)</td>
            <td><input name='tgf' value='<?php echo $bp_last_options->tgf; ?>'/><br/></td>
        </tr>
        <tr>
            <td>Трансфоматоры(S ном)</td>
            <td><input name='snom' value='<?php echo $bp_last_options->snom; ?>'/><br/></td>
        </tr>
        <tr>
            <td>Дельта Ркз уд.</td>
            <td><input name='rkz' value='<?php echo $bp_last_options->rkz; ?>'/><br/></td>
        </tr>
    </table>
    <br>
    <input type='submit' value="Добавить данные"/>
    <?php echo form_close(); ?>
</fieldset>




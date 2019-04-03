<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Работа с оплатой</title>
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="/css/fullpage.css">
    <link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>
    <style>
        .back-to-top {
            cursor: pointer;
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
        }

    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<br><br>
<?php
function f_d($var)
{
    if ($var == 0) return "&nbsp;"; else
        return sprintf("%22.2f", $var);
}

?>
<?php if ($this->session->flashdata('added') == 'true') echo "<h3>Оплата добавлена по орг-ции:" . $this->session->flashdata('firm_name') . "</h3>"; ?>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Добавление оплаты</div>
                <div class="panel-body">
                    <?php echo form_open('billing/adding_oplata', 'method="post"'); ?>
                    <!-- дата и номер счета-->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="data" class="control-label">Дата</label>
                                <input type="date"
                                       class="form-control"
                                       name="data"
                                       id="data"
                                       value='<?php echo $this->session->userdata('data'); ?>' required>
                            </div>
                            <div class="col-sm-6">
                                <label for="data" class="control-label">Номер счета</label>
                                <select class="form-control" name="payment_number_id" id="payment_number_id" required>
                                    <option value="" disabled selected>Выберите номер счета</option>
                                    <?php foreach ($payment_number as $pn): ?>
                                        <option value="<?php echo $pn->id; ?>"><?php echo $pn->number; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- номер договора-->
                    <div class="form-group">
                        <select class="form-control multiple-select" name="firm_id" id="firm_id" required>
                            <option value="" disabled selected>Выберите номер договора!</option>
                            <?php foreach ($firm as $f): ?>
                                <option value="<?php echo $f->id; ?>"><?php echo $f->dogovor . ": " . $f->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- сумма-->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="value" class="control-label">Сумма</label>
                                <input type="text" class="form-control" name="value" id="value" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="document_number" class="control-label">Номер документа</label>
                                <input type="text" class="form-control" name="document_number" id="document_number"
                                       required>
                            </div>
                            <div class="col-sm-4">
                                <label for="is_akt">Пометить как акт</label>
                                <select name="is_akt" id="is_akt" class="form-control" required>
                                    <option value="true">Да, пометить</option>
                                    <option selected value="false">Нет, не помечать</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default block">Добавить</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Установить период</div>
                        <div class="panel-body">
                            <?php echo form_open('billing/change_oplata_period', "class='form-inline', method='post'"); ?>
                            <fieldset>
                                <div class="form-group">
                                    <input type="date"
                                           class="form-control"
                                           name="begin_data"
                                           value="<?php echo $this->session->userdata('begin_data'); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="date"
                                           class="form-control"
                                           name="end_date"
                                           value="<?php echo $this->session->userdata('end_data'); ?>">
                                </div>
                                <button type="submit" class="btn btn-default">Подтвердить</button>
                            </fieldset>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Фильтр по номеру счета</div>
                        <div class="panel-body">
                            <?php echo form_open('billing/change_oplata_period', "class='form-inline', method='post'"); ?>
                            <fieldset>
                                <div class="form-group">
                                    <select name="payment_number_id" id="payment_number_id" class="form-control">
                                        <option value="0">Все</option>

                                        <?php foreach ($pay_number as $pn): ?>
                                            <?php if(($payment_number_id) and ($payment_number_id == $pn->id)){
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            ?>
                                                <option <?php echo $selected; ?> value="<?php echo $pn->id; ?>"><?php echo $pn->number; ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default">Подтвердить</button>
                            </fieldset>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Таблица оплат за период</div>
                <div class="panel-body">
                    <?php $last_opl_data = -1; ?>
                    <table class="table table-hover table-bordered table-condensed table-responsive">
                        <thead>
                        <tr>
                            <th class="text-center">Номер<br>договора</th>
                            <th class="text-center">Дата<br>оплаты</th>
                            <th class="text-center">Номер<br>счета</th>
                            <th class="text-center">Сумма<br>оплаты</th>
                            <th class="text-center">НДС</th>
                            <th class="text-center">Сумма<br>без НДС</th>
                            <th class="text-center">Номер<br>документа</th>
                            <th class="text-center">X</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($oplata->result() as $o): ?>
                            <?php if ($o->data != $last_opl_data): ?>
                                <tr>
                                    <td colspan="8" align="center" style="background-color: #4F5155; color: white;">
                                        <b><?php echo $o->data; ?></b>
                                    </td>
                                </tr>
                                <?php $last_opl_data = $o->data; ?>
                            <?php endif; ?>
                            <tr>
                                <td>
                                    <span class="tooltip-link"
                                          data-toggle="tooltip"
                                          data-placement="right"
                                          title="<?php echo htmlspecialchars($o->name); ?>">
                                        <?php echo $o->dogovor; ?>
                                    </span>
                                </td>
                                <td><?php echo $o->data; ?></td>
                                <td><?php echo $o->number; ?></td>
                                <td class="td-number"><?php echo f_d($o->value * 1.12); ?></td>
                                <td class="td-number"><?php echo f_d($o->value * 0.12); ?></td>
                                <td class="td-number"><?php echo f_d($o->value); ?></td>
                                <td align="right"><?php echo $o->document_number; ?></td>
                                <td><a href="<?php echo site_url("billing/oplata_delete/{$o->id}"); ?>">X</a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<a id="back-to-top"
   href="#"
   class="btn btn-primary btn-lg back-to-top"
   role="button"
   title="Click to return on the top page"
   data-toggle="tooltip"
   data-placement="left">
    <span class="glyphicon glyphicon-chevron-up"></span>
</a>
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.js"></script>
<script src="/plugins/multiselect/js/bootstrap-multiselect.js"></script>
<script src="/js/common.js"></script>
<script>
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
</body>
</html>
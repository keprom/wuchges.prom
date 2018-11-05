<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>img/favicon.png"/>
    <title>Вход</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form {
            border: 3px solid #003399;
        }

        input[type=text], select, input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 2px solid #003399;
            box-sizing: border-box;
        }

        button {
            background-color: #333399;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        select {
            font-weight: bold
        }

        .container {
            padding: 16px;
        }

        .favicon {
            height: 60px;
        }

        h4 {
            margin: 0px;
        }

        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
        }
    </style>
</head>
<body>

<div style="padding: 70px 0; text-align: center;">
    <table style="width: 100%">
        <tr>
            <td></td>
            <td style="vertical-align: center;"><img class="favicon" src="<?php echo base_url(); ?>img/favicon.png"
                                                     alt="">
            </td>
            <td style="vertical-align: center;">
                <div class="orgname-border">
                    <h4 align="center"><?php echo $org_name; ?></h4>
                </div>
            </td>
            <td></td>
        </tr>
        <tr>
            <td style="width: 30%"></td>
            <td colspan="2">
                <?php echo form_open('login/logining'); ?>
                <div class="container" style="text-align: left">
                    <label for="login"><b>Пользователь</b></label>
                    <select name="login">
                        <?php foreach ($logins->result() as $l) {
                            echo "<option value='{$l->id}'>{$l->profa}: {$l->name}</option>";
                        } ?>
                    </select>
                    <label for="psw"><b>Пароль</b></label>
                    <input type="password" placeholder="Введите пароль" name="password">

                    <button type="submit">Вход</button>
                </div>
                <?php echo form_close(); ?>
            </td>
            <td style="width: 30%"></td>
        </tr>
    </table>

</div>


</body>
</html>
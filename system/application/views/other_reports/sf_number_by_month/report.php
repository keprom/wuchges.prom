<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Номера счетов-фактур</title>
    <link rel="stylesheet" href="/css/fullpage.css">
</head>
<body>
<table class="border-table">
    <caption><?php echo $month; ?></caption>
    <thead>
    <tr>
        <th>Договор</th>
        <th>Организация</th>
        <th>Номер</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($report as $r): ?>
    <tr>
        <td><?php echo $r->dog; ?></td>
        <td><?php echo $r->name; ?></td>
        <td><?php echo $r->schet_number; ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>

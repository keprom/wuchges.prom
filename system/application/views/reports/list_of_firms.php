<html>
<head>
<title>Учет электроэнергии. Промышленный отдел</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<center>Перечень действующих организаций и предприятий</center>

<br>
<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>
<td>№ П.П.</td>
<td># Дог.</td>
<td>Наименование предприятия</td>
<td>Адрес предприятия</td>
<td>Телефон</td>
<td>Дата зак.дог.</td>
<td>ТУРЭ:</td>
<td>Список точек учета</td>
</tr>
<?php $last_group=-1;$i=1;foreach($firms->result() as $firm):?>
<?php if($last_group!=$firm->firm_subgroup_name):?>
<tr>
<td colspan=8><b>
<?php echo $firm->firm_subgroup_name;$last_group=$firm->firm_subgroup_name; ?>
</b>
</td>
</tr>
<?php endif;?>
<tr>
<td><?php echo $i++;?></td>
<td><?php echo $firm->dogovor; ?></td>
<td><?php echo $firm->firm_name; ?></td>
<td><?php echo $firm->firm_address; ?></td>
<td><?php echo $firm->telefon; ?></td>
<td><?php echo $firm->dogovor_date; ?></td>
<td><?php echo $firm->ture_name; ?> </td>
<td><?php echo $firm->spisok_tochek; ?></td>
</tr>
<?php endforeach;?>
</table>
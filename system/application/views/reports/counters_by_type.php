<html>
<head>
<title>Учет электроэнергии. Промышленный отдел</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
 <Center>Счетчики имеющие тип</center>
<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>
<td>П/П</td>
<td>Договор</td>
<td>Наименование организации</td>
<td>Т.у.</td>
<td>ТП</td>
<td>Адрес т.у.</td>
<td>№ Заводской</td>
<td>Коэф. транс.</td>
<td>Год выпуска</td>
</tr>
<?php $last_ture=-1; $last_type=-1;?>

<?php $i=0;foreach($counters->result() as $counter):?>

<?php if($counter->counter_type_id!=$last_type ):?>
<tr>
<td colspan=9 ><b><?php echo $counter->counter_type_name; $last_ture=-1; ?></b></td>
</tr>
<?php endif;?>

<?php if($counter->ture_id!=$last_ture ):?>
<tr>
<td colspan=9 ><b>&nbsp;&nbsp;&nbsp;<?php echo $counter->ture_name;?></b></td>
</tr>
<?php endif;?>
<tr>
<td><?php echo $i++; ?></td>
<td><?php echo $counter->dogovor;?></td>
<td><?php echo $counter->firm_name;?></td>
<td><?php echo $counter->billing_point_id;?></td>
<td><?php echo $counter->tp_name;?></td>
<td><?php echo $counter->billing_point_name;?></td>
<td><?php echo $counter->gos_nomer;?></td>
<td><?php echo $counter->transform;?></td>
<td><?php echo $counter->crafted_year;?></td>
</tr>

<?php $last_ture=$counter->ture_id;$last_type=$counter->counter_type_id; endforeach;?>
</table>
</html>
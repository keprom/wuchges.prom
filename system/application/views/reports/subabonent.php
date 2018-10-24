<html>
<head>
<title>Учет электроэнергии. Промышленный отдел</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<center>Список суб-абонентов</center>

<br>
<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>
<td>№ П.П.</td>
<td># Дог. род.</td>
<td >Родительское  предприятие</td>
<td># Дог. доч.</td>
<td >Дочернее предприятие</td>
<td >Тип субабонента</td>
<td>ТУРЭ</td>

</tr>
<?php $i=1; foreach ($firms->result() as $f ):?>
<tr>
<td><?php echo $i++;?></td>
<td><?php echo $f->parent_firm_dogovor; ?></td>
<td><?php echo $f->parent_firm_name; ?></td>
<td><?php echo $f->child_dogovor; ?></td>
<td><?php echo $f->child_firm_name; ?></td>
<td><?php 
	if ($f->type=='by_procent') echo "Процент";
	if ($f->type=='absolut') echo "Абсолютный";
	if ($f->type=='by_counter_value') echo "По счетчику";
 ?></td>
 <td><?php echo $f->ture_name; ?></td>
</tr>
<?php endforeach;?>
</table>
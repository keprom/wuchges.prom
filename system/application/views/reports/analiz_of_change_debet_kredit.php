<html>
<head>
<title>Учет электроэнергии. Промышленный отдел</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}?>
<center>Сравнительный анализ дебиторской и кредиторской задолженности потребителей за электроэнергию</center>
<center>Июнь 2009 года</center>
<br>
<?php 
$last_group=-1;

?>
<table  width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>
<td rowspan=2>№ Дог</td>
<td rowspan=2>Наименование потребителя</td>
<td colspan=2>Дебиторская задолжность</td>
<td colspan=2>Кредиторская задолжность</td>
</tr>
<tr>
<td>+ Увеличение</td>
<td>- Увеличение</td>
<td>+ Увеличение</td>
<td>- Увеличение</td>
</tr>

<?php foreach ($analiz as $a): ?>
<?php if($last_group!=$a->subgroup_name): ?>
  <tr><td colspan=6><b> <?php echo $a->subgroup_name; ?></b></td></tr>
<?php endif; ?>
	<tr>
		<td><?php echo $a->dogovor;?></td>
		<td><?php echo $a->firm_name;?></td>
		<td><?php echo f_d($a->debet_inc);?></td>
		<td><?php echo f_d($a->debet_dec);?></td>
		<td><?php echo f_d($a->kredit_inc);?></td>
		<td><?php echo f_d($a->kredit_dec);?></td>
	</tr>
	
<?php $last_group=$a->subgroup_name; endforeach; ?>
</table>
</html>
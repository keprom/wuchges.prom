<?php
echo anchor("billing/firm/".$firm_id,"назад к фирме");
echo "<br />";
echo "<br />";
$doc[0] = "";
if (isset($info)){
foreach ($info->result() as $inf){
$doc[$inf->point_id][$inf->doc_id]=$inf;
}}
echo "<table border = 1 >";
foreach ($points->result() as $p){
?>
<tr><td><font color=green><b><?php echo $p->name; ?></b></font></td></tr>
<tr><td>
<?php
echo form_open("billing/docs_register_form");
echo "<input type=hidden name=firm_id value=".$firm_id." >";
echo "<input type=hidden name=point_id value=".$p->id." >";
?>
<table>
<tr><td><b>Наименование документа</b></td><td><b>Дата выдачи</b></td><td><b>Наличие</b></td></tr>
<?php 
foreach ($docs->result() as $d):
echo "<tr>
	<td>".$d->name."</td>
	<td><input type=hidden name=doc_".$d->id." value=".$d->id." >
	<input type=\"checkbox\" name = \"data".$d->id."_chek\" onclick=\"this.form.data".$d->id."_v.disabled=!this.form.data".$d->id."_v.disabled\" ".((isset($doc[$p->id][$d->id]->data_reg))?"checked":"").">
	<input name=data".$d->id."_v ".((isset($doc[$p->id][$d->id]->data_reg))?"":"disabled=\"true\"")." maxlength=\"10\" size=\"10\" value = \"".((isset($doc[$p->id][$d->id]->data_reg))?$doc[$p->id][$d->id]->data_reg:"")."\"></td>
	<td><input type=\"checkbox\" name = \"doc".$d->id."_per\" ".((isset($doc[$p->id][$d->id]->persist))?(($doc[$p->id][$d->id]->persist=="t")?"checked":""):"")."></td></tr>";
endforeach;
echo "<tr><td colspan = 3><input type=submit value='Сохранить' /><br /><br /></td></tr></table>";
echo "</form></td></tr>";
}
echo "</table>";

?>
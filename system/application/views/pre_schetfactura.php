<?php
$r=$r->row();
echo form_open("billing/pre_schetfactura2");
echo "<input type=hidden name=firm_id value=".$r->id." >";
echo "<select name=period_id >";
foreach ($period->result() as $p)
{
	echo "<option value='{$p->id}' {$p->checked} >{$p->name}</option>";
}
echo "</select><br><br>";
echo "<input type=submit value='Открыть счетфактуру' />";
echo "</form>";


?>
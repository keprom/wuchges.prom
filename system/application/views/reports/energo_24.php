<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}?>
<html>
<head>
<title>24 Энергетика</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<table>
<?php foreach($energo->result() as $e ):?>
<tr>
<td>
<?php echo $e->firm_otrasl_name;?>
</td>
<td align="right">
<?php echo f_d($e->sum);?>
</td>
</tr>
<?php endforeach;?>
</table>
</body>
</html>

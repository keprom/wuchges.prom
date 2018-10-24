<?php
function f_d($var)
{
	if ($var==0) return "&nbsp;"; else
	return sprintf("%22.2f",$var);
}
function datetostring($date)
{
	$d=explode("-",$date); 
	return $d['0'].'.'.$d['1'].'.'.$d['2'];
}
function dottozpt($var){
	return str_replace(".",",",$var);
}
?>
<html>
<head>
<title>Учет электроэнергии. Промышленный отдел</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>

<center>
<h3>Свод потребления электроэнергии в кВт</h3>
</center>
<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<?php
echo $period_head;
 $j=1;
 foreach($res->result() as $r):
eval($php);
endforeach; ?>

</table>

</html>
<html>
<head>
<title>Информация по ТП</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<center>Информация по ТП</center><br />
<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>


<td>
ТП
</td>
<td>
Наименование абонента
</td>
<td>
Телефон
</td>
</tr>
<?php foreach($disp->result() as $d ):
$firm=$d->name;
$telefon=$d->telefon;
$id=$d->id;
$tp=$d->tp;
break;
endforeach;
foreach($disp->result() as $d ):?>
<?php if ($d->id==$id){
$id=$d->id;} 
else
{?>
<tr>
<td>
<?php echo $tp;?>
</td>
<td>
<?php echo $firm;?>
</td>
<td>
<?php if (($telefon=="")||($telefon==0)) {echo "||-||-||";}else{echo $telefon;}?>
</td>
</tr>
<?php
$firm=$d->name;
$telefon=$d->telefon;
$id=$d->id;
$tp=$d->tp;}
endforeach;?>
<tr>
<td>
<?php echo $tp;?>
</td>
<td>
<?php echo $firm;?>
</td>
<td>
<?php if (($telefon=="")||($telefon==0)) {echo "||-||-||";}else{echo $telefon;}?>
</td>
</tr>
</table>

</body>
</html>

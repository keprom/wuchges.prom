<html>
<head>
<title>Информация по абонентам, имеющим холостой ход</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<center>Информация по абонентам, имеющим холостой ход</center><br />
<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
<tr>


<td>
Договор 
</td>
<td>
Наименование
</td>
<td>
Точка учета
</td>
<td>
ТП
</td>
<td>
кВт
</td>
</tr>
<?php foreach($hol->result() as $h ):
$bp=$h->bill_point_id;
$dog=$h->dogovor;
$firm=$h->firm_name;
$bill=$h->bill_point_name;
$tp=$h->tp_name;
break;
endforeach;
$kvt=0;
foreach($hol->result() as $h ):?>
<?php if ($h->bill_point_id==$bp){
$kvt+=$h->neuchtennyy;} 
else
{?>
<tr>
<td>
<?php echo $dog;?>
</td>
<td>
<?php echo $firm;?>
</td>
<td>
<?php echo $bill;?>
</td>
<td>
<?php echo $tp;?>
</td>
<td>
<?php echo $kvt;?>
</td>
</tr>
<?php
$kvt=0; 
$bp=$h->bill_point_id; 
$kvt+=$h->neuchtennyy;
$dog=$h->dogovor;
$firm=$h->firm_name;
$bill=$h->bill_point_name;
$tp=$h->tp_name;}
endforeach;?>
</table>

</body>
</html>

<?php
function f_d($var)
{
	if (($var==0)or($var==NULL)) return "0.00"; else
	return sprintf("%22.2f",$var);
}
function datetostring($date)
{
	$d=explode("-",$date); 
	return $d['0'].'.'.$d['1'].'.'.$d['2'];
}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body>
<center>
Снятие показаний по ТП за 
 <?php echo $period_name->current_period;?>
  по ТУРЭ <?php 
  //echo $ture->name;
  ?>
 </center>
 
 <br>

 <table  width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: small;">
 <tr>
 <td  width=20px>№</td>
 <td  width=20px>ТП</td>
 <td  width=20px>Дог</td>
 <td width=300px>Организация</td>
 <td width=300px>Адрес точки</td>
 <td  width=70px>Номер<br>сч.</td>
  <td  width=70px>Тариф</td>
 <td>Показание</td>
 
 
 </tr>
 
 <?php $num=1; foreach($naryad->result() as $n):?>
 <tr>
 
 <td>
  &nbsp;<?php echo $num++;?>
 </td>
 <td>
  &nbsp;<?php echo $n->tp_name;?>
 </td>
 <td>
  &nbsp;<?php echo $n->dogovor;?>
 </td>
 <td>
  &nbsp;<?php echo $n->firm_name;?>
 </td>
 <td>
  &nbsp;<?php echo $n->billing_point_address;?>
 </td>
 <td>
  &nbsp;<?php echo $n->gos_nomer;?>
 </td> 
  <td>
  &nbsp;<?php echo $n->tariff_name;?>
 </td> 
 <td>
  &nbsp;
 </td>
 
 </tr>
 <?php endforeach;?>
 </table>
 
 
 </body>
</html>
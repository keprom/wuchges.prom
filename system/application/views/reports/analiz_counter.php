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
Информация счетчиков
 
  по ТУРЭ <?php 
  //echo $ture->name;
  ?>
 </center>
 
 <br>

 <table  width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: small;">
 <tr>
 <td  width=20px>№</td>
 <td  width=20px>Дог</td>
 <td width=300px>Организация</td>
 <td width=300px>Адрес т.у.</td>
 <td  width=70px>Номер сч.</td>
  <td width=70px>Показание</td>
  <td width=100px>Тариф</td>
 <td width=70px>Номер пломбы</td>
 <td width=70px>Дата гос.проверки</td>

 </tr>
 
 <?php $num=1; foreach($naryad->result() as $n):?>
 <tr>
 
 <td>
  &nbsp;<?php echo $num++;?>
 </td>
 <td>
  &nbsp;<?php echo $n->dogovor;?>
 </td>
 <td>
  &nbsp;<?php echo $n->firm_name;?>
 </td>
 <td>
  &nbsp;<?php echo $n->bill_address;?>
 </td>
 <td>
  &nbsp;<?php echo $n->gos_nomer;?>
 </td>
 <td>
  &nbsp;<?php echo $n->counter_value_value;?>
 </td> 
  <td>
  &nbsp;<?php echo $n->tariff_name;?>
 </td> 
  <td>
  &nbsp;<?php echo $n->plomba;?>
 </td> 
 <td>
  &nbsp;<?php echo $n->data_gos_proverki;?>
 </td>

 </tr>
 <?php endforeach;?>
 </table>
 
 
 </body>
</html>
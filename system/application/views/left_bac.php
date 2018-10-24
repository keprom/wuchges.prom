<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Учет электроэнергии. Промышленный отдел</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php  echo base_url();?>css/1.css" type="text/css" media="screen,projection" />

</head>
 
<body>
		
		<div id="container">
           
			<div id="top_shadow"></div>
           
				<div id="header">
					<div id="header_left">
						<div id="logo"><h1><a href="#">Пром. отдел</a></h1> </div>
                    </div>
					<div id="header_right"> </div>
                 </div>
				
                
                <div id="nav">
               
                	<div class="nav_left"> </div>
                    <div class="nav_right"> </div>
					
                </div>
                <div id="nav_m">
			 <ul>
						
							<li><?php  echo anchor("billing","выбор фирмы");?></li>							
							<li><?php  echo anchor("billing/firm_not_closed","Неотчитавшиеся фирмы");?></li>
							<li><?php  echo anchor("billing/my_firm","мои фирмы");?></li>							
							<li><?php  echo anchor("billing/my_firm_not_closed","мои  незакрытые фирмы");?></li>							
							
					</ul>
                    </div>
<?php 
										
function is_s($var,$poisk)
{
	$string='';
	if ($var==$poisk) $string= " selected ";
	$string.= " value=".$var." ";
	return $string;
}
?>

                	<div id="content_conteiner">
                    
                	<div id="left_column">
                    	<div class="menu_item">
                        	<div class="menu_item_header"><h2>поиск</h2> </div>
                    		<div class="menu_item_content">
								<?php  echo form_open("billing/firm_search_by");?>
									<input name="str"  style="width : 100" />
									<select name=type  >
									<option <?php echo is_s('1',$poisk);?> >По номеру договора</option>
									<option <?php echo is_s('2',$poisk);?>>По адресу т.у.</option>
									<option <?php echo is_s('3',$poisk);?>>По адресу фирмы</option>
									<option <?php echo is_s('4',$poisk);?>>По РНН</option>
									<option <?php echo is_s('5',$poisk);?>>По ТП</option>
									<option <?php echo is_s('6',$poisk);?>>По телефону</option>
									<option <?php echo is_s('7',$poisk);?>>По названию фирмы</option>
									<option <?php echo is_s('8',$poisk);?>>По названию т.у.</option>
									<option <?php echo is_s('9',$poisk);?>>По номеру счетчика</option>
									</select><br>
									<input type="submit" value='найти' />
								</form>
							</div>
			
							<div class="menu_item_header"><h2>Справочники</h2> </div>
                    		<div class="menu_item_content"><h3>
							<ul>
                            	<li><?php  echo anchor("billing/tp","ТП");?></li>
                            	<li><?php  echo anchor("billing/streets","Улицы");?></li>
                            	<li><?php  echo anchor("billing/counter_types","Типы счетчиков");?></li>
                            	<li><?php  echo anchor("billing/banks","Банки");?></li>
                            	<li><?php  echo anchor("billing/reports","Отчеты");?></li>
								<li><?php  echo anchor("billing/change_password","Смена пароля");?></li>
								<li><?php  echo anchor("billing/org_info","Данные организации");?></li>
								<li><?php  echo anchor("billing/oplata","работа с оплатой");?></li>
								<li><?php  echo anchor("billing/pre_perehod","сервис");?></li>
							</ul>
                            </div>
							
							<div class="menu_item_header"><h2>Информация о пользователе</h2> </div>
                    		<div class="menu_item_content">
								<h3>
									ФИО:<br><div align=right><?php echo $this->session->userdata('name');?></div><br><br>
									Должность:<br><div align=right><?php echo $this->session->userdata('profa');?> </div><br><br>
									
								</h3>
                            </div>
                        </div>
						<br>
                        <div style="clear:both">
						</div>
                    
					</div>
                  
                    <div id="right_column"> 
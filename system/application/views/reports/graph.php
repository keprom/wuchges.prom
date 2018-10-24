<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<title>График поребления</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if IE]><script language="javascript" type="text/javascript" src="excanvas.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>jquery-1.3.2.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>jquery.jqplot.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>jquery.jqplot.css"/>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>plugins/jqplot.barRenderer.min.js" /></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>plugins/jqplot.categoryAxisRenderer.min.js" /></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>plugins/jqplot.pointLabels.min.js" /></script>
<script type="text/javascript">
$(function(){
  line1 = [<?php echo $itogo_kvt; ?>];
  line2 = [<?php echo $itogo_kvt; ?>];
  //line2 = [<?php echo $itogo_kvt; ?>];
  //line2 = [7, 12, 15, 17, 20, 27, 39];
  $.jqplot("example", [line1], {
    title: "Потребление киловатт по договору №<?php echo $firm_info->dogovor; ?>", 
    //stackSeries: true, 
    series:[
        {label:'Profits', renderer:$.jqplot.BarRenderer}, 
    ],
    axes: {
      xaxis:{ 
		label:'период',
		renderer:$.jqplot.CategoryAxisRenderer,
		ticks:[<?php echo $periods;?>]
	  },	  
      yaxis:
	  {
		label:'кВт',
		autoscale: true,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
		ticks:[<?php echo $numbers;?>] 
	  }
    }
  });
});
</script>
</head>
<body>
<div id="example" style="height:100%; width:100%;"></div>
</body>
</html>
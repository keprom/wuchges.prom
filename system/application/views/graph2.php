<html>
<head>
<style type="text/css">

body { 
 background-color: #fff; 
 margin: 40px; 
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h2 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

</style>
</head>

<body>
<h2>This is displaying a saved image file generated from the controller</h2>
<p>
<?=anchor('welcome', ' Panaci home');?>
</p>
<p>If your charts are not going to change much, this is probably what you want</p>
<img src="<?=base_url() . 'images/file.png';?>" />
<p><br />Page rendered in {elapsed_time} seconds</p>
</body>
</html>
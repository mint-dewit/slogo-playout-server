<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
'';// checking for modification in file:/home/slogo-tv/www/application/views/admin/programma_edit/../layout.tpl
if (!("1449001427" == filemtime('/home/slogo-tv/www/application/views/admin/programma_edit/../layout.tpl'))) { ob_end_clean(); return false; };?><html>
<head>
	<title>Nieuw programma maken - RTV Slogo</title>

	<link rel="icon" type="imge/png" href="<?php echo site_url();?>resources/icon.png">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,400italic" rel="stylesheet" type="text/css">
	<link href="<?php echo site_url();?>resources/admin_style.css" rel="stylesheet" type="text/css">
	
</head>
<body>

<div id="left-nav">
	<ul class="nav-list">
		<a href="<?php echo site_url();?>admin/dashboard"><li>Dashboard</li></a>
		<a href="<?php echo site_url();?>admin/programmering"><li>Programmering</li></a>
		<a href="<?php echo site_url();?>admin/teksttv"><li>Tekst TV</li></a>
		<a href="<?php echo site_url();?>admin/music"><li>Muziek</li></a>
		<a href="<?php echo site_url();?>admin/templates"><li>Templates</li></a>
		<a href="<?php echo site_url();?>admin/sources"><li>Sources</li></a>
		<a href="<?php echo site_url();?>admin/ads"><li>Reclames</li></a>
	</ul>
</div>
<div id="top-bar">
	<div id="top-bar-left-nav">
		<span class="image"></span>
	</div>
	<a href="<?php echo site_url();?>logout"><div id="logout">
		Log uit
	</div></a>
</div>

<div id="content">

<?php echo form_open(current_url());?>

<?php echo form_input('name', '', 'id="programma-naam" placeholder="Programmanaam"');?>

<div class="line" style="height:2px;"></div>
<label>Prioriteit:</label><?php echo form_input('priority', '');?><br />
<label>Categorie:</label><?php echo form_dropdown('category', (isset($this->scope["categories"]) ? $this->scope["categories"] : null));?>

<div class="clear" style="height:10px;"></div>
<?php echo form_submit('Opslaan', 'Opslaan');?>

<?php echo form_close();?>


</div>

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>
<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
'';// checking for modification in file:/home/slogo-tv/www/application/views/admin/layout.tpl
if (!("1449001427" == filemtime('/home/slogo-tv/www/application/views/admin/layout.tpl'))) { ob_end_clean(); return false; };?><html>
<head>
	<title>Reclames beheren - RTV Slogo</title>

	<link rel="icon" type="imge/png" href="<?php echo site_url();?>resources/icon.png">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,400italic" rel="stylesheet" type="text/css">
	<link href="<?php echo site_url();?>resources/admin_style.css" rel="stylesheet" type="text/css">
	<style>
.cards-wrapper {
	list-style-type: none;
	margin: 0;
	padding: 0;
}
</style>
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
5x reclame per uur van max 2:24 minuten<br />
geen reclame onder video uitzendingen...<br />
<br />

<div class="list-content">
	<div class="listhead item"><span style="margin-left:10px">Reclameblokken</div>
	<a href="<?php echo site_url();?>admin/ads/edit/0"><div class="item">
			<span style="margin-left:10px">Reclameblok 1</span>
	</div></a>
	<a href="<?php echo site_url();?>admin/ads/edit/1"><div class="item">
			<span style="margin-left:10px">Reclameblok 2</span>
	</div></a>
	<a href="<?php echo site_url();?>admin/ads/edit/2"><div class="item">
			<span style="margin-left:10px">Reclameblok 3</span>
	</div></a>
	<a href="<?php echo site_url();?>admin/ads/edit/3"><div class="item">
			<span style="margin-left:10px">Reclameblok 4</span>
	</div></a>
	<a href="<?php echo site_url();?>admin/ads/edit/4"><div class="item">
			<span style="margin-left:10px">Reclameblok 5</span>
	</div></a>
</div>
<div class="clear" style="height:10px;"></div>
</div>

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>
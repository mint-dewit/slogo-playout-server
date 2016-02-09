<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
'';// checking for modification in file:/home/slogo-tv/www/application/views/admin/layout.tpl
if (!("1449001427" == filemtime('/home/slogo-tv/www/application/views/admin/layout.tpl'))) { ob_end_clean(); return false; };?><html>
<head>
	<title>Teksttv - RTV Slogo</title>

	<link rel="icon" type="imge/png" href="<?php echo site_url();?>resources/icon.png">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,400italic" rel="stylesheet" type="text/css">
	<link href="<?php echo site_url();?>resources/admin_style.css" rel="stylesheet" type="text/css">
	<script>
	$(document).ready(function(){
		$('#list').sortable({
			axis: "y"
		});


		$( "#list" ).on( "sortstop", function( event, ui ) { 
			$.get('<?php echo site_url();?>admin/teksttv/update_list?' + $( '#list' ).sortable( 'serialize'));
		} );
	});
</script>
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
<div class="header">
	<span>Teksttv</span>
</div>
<div class="clear"></div>

<div style="position:relative;">
	<?php 
$_fh0_data = (isset($this->scope["templates"]) ? $this->scope["templates"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['template'])
	{
/* -- foreach start output */
?>
	<div class="legenda-item">
		<div class="colorpart" style="background:#<?php echo $this->scope["template"]["color"];?>"></div>
		<div style="float:left;margin-right:40px;"><?php echo $this->scope["template"]["title"];?></div>
	</div>
	<?php 
/* -- foreach end output */
	}
}?>

</div>
<div class="clear" style="height:10px;"></div>

<div class="list-content">
	<div class="listhead item">
		<span style="margin-left: 17px;">Playlist</span>
	</div>
	<ul id="list">
	<?php 
$_fh1_data = (isset($this->scope["playlist"]) ? $this->scope["playlist"] : null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['item'])
	{
/* -- foreach start output */
?>
		<li id="order_<?php echo $this->scope["item"]["id"];?>"><a href="<?php echo site_url();?>admin/teksttv/playlist/<?php echo $this->scope["item"]["id"];?>"><div class="item">
			<div style="width:7px; height:40px; float:left; background:#<?php echo $this->scope["item"]["color"];?>;"></div>
			<span style="margin-left: 10px;"><?php echo $this->scope["item"]["title"];?></span>
		</div></a></li>
	<?php 
/* -- foreach end output */
	}
}?>

	</ul>
</div>
<div class="clear" style="height:10px;"></div>
<button type="button"><a href="<?php echo site_url();?>admin/teksttv/playlist/new">Item toevoegen</a></button>
</div>

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>
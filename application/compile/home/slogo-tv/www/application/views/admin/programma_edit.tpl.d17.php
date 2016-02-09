<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
'';// checking for modification in file:/home/slogo-tv/www/application/views/admin/layout.tpl
if (!("1419341299" == filemtime('/home/slogo-tv/www/application/views/admin/layout.tpl'))) { ob_end_clean(); return false; };?><html>
<head>
	<title><?php echo $this->scope["programme_data"]["Naam"];?> - RTV Slogo</title>

	<link rel="icon" type="imge/png" href="<?php echo site_url();?>resources/icon.png">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,400italic" rel="stylesheet" type="text/css">
	<link href="<?php echo site_url();?>resources/admin_style.css" rel="stylesheet" type="text/css">
	
</head>
<body>

<div id="left-nav">
	<ul class="nav-list">
		<a href="<?php echo site_url();?>admin/dashboard"><li>Dashboard</li></a>
		<a href="<?php echo site_url();?>admin/programmering"><li>Programma's</li></a>
		<a href="<?php echo site_url();?>admin/teksttv"><li>Tekst TV</li></a>
		<a href="<?php echo site_url();?>admin/users"><li>Gebruikers</li></a>
		<a href="<?php echo site_url();?>admin/settings"><li>Instellingen</li></a>
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

<?php echo form_input('name', (isset($this->scope["programme_data"]["Naam"]) ? $this->scope["programme_data"]["Naam"]:null), 'id="programma-naam" placeholder="Programmanaam"');?>

<div class="line" style="height:2px;"></div>
<label>Prioriteit:</label><?php echo form_input('priority', (isset($this->scope["programme_data"]["Priority"]) ? $this->scope["programme_data"]["Priority"]:null));?><br />
<label>Categorie:</label><?php echo form_dropdown('category', (isset($this->scope["categories"]) ? $this->scope["categories"] : null), (isset($this->scope["programme_data"]["category"]) ? $this->scope["programme_data"]["category"]:null));?>

<div class="clear" style="height:10px;"></div>
<?php echo form_submit('Opslaan', 'Opslaan');?>

<?php echo form_close();?>

<div class="clear" style="height:10px;"></div>

<div class="title">Afleveringen</div>
<div class="cards-wrapper">
<?php 
$_fh0_data = (isset($this->scope["programme_data"]["episodes"]) ? $this->scope["programme_data"]["episodes"]:null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['episode'])
	{
/* -- foreach start output */
?>
	<a href="<?php echo site_url();?>admin/programmering/<?php echo $this->scope["programme_data"]["programme_id"];?>/episode/<?php echo $this->scope["episode"]["episode_id"];?>"><div class="card">
		<div class="top-bar">
			<span>#</span>
			<span id="input_number"><?php echo $this->scope["episode"]["episode_number"];?></span>
			<span id="input_title"><?php echo $this->scope["episode"]["episode_title"];?></span>
		</div>
	</div></a>
<?php 
/* -- foreach end output */
	}
}?>

</div>

</div>

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>
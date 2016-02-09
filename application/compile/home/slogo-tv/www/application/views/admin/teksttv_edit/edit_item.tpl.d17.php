<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
'';// checking for modification in file:/home/slogo-tv/www/application/views/admin/teksttv_edit/../layout.tpl
if (!("1449001427" == filemtime('/home/slogo-tv/www/application/views/admin/teksttv_edit/../layout.tpl'))) { ob_end_clean(); return false; };?><html>
<head>
	<title><?php echo $this->scope["item"]["title"];?> - RTV Slogo</title>

	<link rel="icon" type="imge/png" href="<?php echo site_url();?>resources/icon.png">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,400italic" rel="stylesheet" type="text/css">
	<link href="<?php echo site_url();?>resources/admin_style.css" rel="stylesheet" type="text/css">
	<script>
	$(document).ready(function(){
		var unique_id = <?php echo count((isset($this->scope["item"]["body"]) ? $this->scope["item"]["body"]:null));?>;
		var cur_template = <?php echo $this->scope["item"]["template"];?>;

		$('#add_field').click(function(e){
			e.preventDefault();
			$('#fields').append('<input type="text" name="fields['+unique_id+'][index]" value="">: <input type="text" name="fields['+unique_id+'][value]" value=""><br />');
			unique_id = unique_id +1;
		});

		$('select[name=template]').change(function(e){
			
			$('#'+cur_template+'.template_values').css({'display':'none'});
			cur_template = $('select[name=template] option:selected').attr('value');
			$('#'+cur_template+'.template_values').css({'display':'block'});
			
		});
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
<?php echo form_open();?>

	<label style="float:left; width:140px;">Titel:</label><?php echo form_input('title', (isset($this->scope["item"]["title"]) ? $this->scope["item"]["title"]:null));?><br />
	<label style="float:left; width:140px">Lengte (in sec):</label><input type="number" name="dur" value="<?php echo $this->scope["item"]["dur"];?>" placeholder="?"><br />
	<label style="float:left; width:140px;">Periode:</label><?php echo form_input('period_start', (isset($this->scope["item"]["period_start"]) ? $this->scope["item"]["period_start"]:null), 'placeholder="0000-00-00 00:00:00"');?> - <?php echo form_input('period_end', (isset($this->scope["item"]["period_end"]) ? $this->scope["item"]["period_end"]:null), 'placeholder="0000-00-00 00:00:00"');?><br />
	<label style="float:left; width:140px;">Template:</label><?php echo form_dropdown('template', (isset($this->scope["templates"]) ? $this->scope["templates"] : null), (isset($this->scope["item"]["template"]) ? $this->scope["item"]["template"]:null));?><br />
	<div class="clear" style="height:20px;"></div>
	<label style="float:left; width:140px;">Gegevens:</label><br />
	<?php 
$_fh1_data = (isset($this->scope["templates_keys"]) ? $this->scope["templates_keys"] : null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['i']=>$this->scope['template'])
	{
/* -- foreach start output */
?>
	<div class='template_values' id='<?php echo $this->scope["template"]["id"];?>' <?php if ((isset($this->scope["item"]["template"]) ? $this->scope["item"]["template"]:null) != (isset($this->scope["template"]["id"]) ? $this->scope["template"]["id"]:null)) {
?>style="display:none"<?php 
}?>>
		<?php 
$_fh0_data = (isset($this->scope["template"]["keys"]) ? $this->scope["template"]["keys"]:null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['key'])
	{
/* -- foreach start output */
?>
		<label style="float:left; width:140px;"><?php echo $this->scope["key"]["key_name"];?>:</label><?php echo form_input('values['.(isset($this->scope["template"]["id"]) ? $this->scope["template"]["id"]:null).']['.(isset($this->scope["key"]["key_id"]) ? $this->scope["key"]["key_id"]:null).']', $this->readVar("values.".(isset($this->scope["key"]["key_id"]) ? $this->scope["key"]["key_id"]:null)));?><br />
		<?php 
/* -- foreach end output */
	}
}?>

	</div>
	<?php 
/* -- foreach end output */
	}
}?>

	<div class="clear" style="height:20px;">
	</div>
	<?php echo form_submit('save', 'Opslaan');?>

	<a href="<?php echo site_url();?>admin/teksttv/delete/<?php echo $this->scope["item"]["id"];?>"><button type="button">Verwijderen</button></a>
<?php echo form_close();?>

</div>

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>
<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
'';// checking for modification in file:/home/slogo-tv/www/application/views/admin/teksttv_edit/../layout.tpl
if (!("1441815428" == filemtime('/home/slogo-tv/www/application/views/admin/teksttv_edit/../layout.tpl'))) { ob_end_clean(); return false; };?><html>
<head>
	<title>Nieuwe template toevoegen - RTV Slogo</title>

	<link rel="icon" type="imge/png" href="<?php echo site_url();?>resources/icon.png">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,400italic" rel="stylesheet" type="text/css">
	<link href="<?php echo site_url();?>resources/admin_style.css" rel="stylesheet" type="text/css">
	<script>
	$(document).ready(function(){
		var unique_id = 0;

		$('#add_field').click(function(e){
			e.preventDefault();
			$('#fields').append('<span id="new'+unique_id+'" class="key">\
						<a href="#" class="remove_key" id="new'+unique_id+'"><img style="width:10px;" src="/resources/cross-icon.png"></a>\
						<input type="text" name="fields[new]['+unique_id+'][key_name]" value=""> WYSIWYG: <input type="checkbox" name="fields[new]['+unique_id+'][WYSIWYG]" value="">\
						<br /></span>');
			unique_id = unique_id +1;
		});

		$('.remove_key').on('click',function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			$.get('<?php echo site_url();?>admin/templates/delete?type=key&id='+id);
			$('#'+id+'.key').remove();
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
		<br>
		<a href="<?php echo site_url();?>admin/scheduling"><li>Scheduling</li></a>
		<a href="<?php echo site_url();?>admin/programmes"><li>Programmes</li></a>
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

	<label style="float:left; width:140px;">Titel:</label><?php echo form_input('title');?><br />
	<label style="float:left; width:140px;">Kleur:</label>
	<div style="float: left;">
        <?php $this->scope["colors"]["1"]='7a0026'?>

        <?php $this->scope["colors"]["2"]='ed145b'?>

        <?php $this->scope["colors"]["3"]='f26c4f'?>

        <?php $this->scope["colors"]["4"]='fbaf5d'?>

        <?php $this->scope["colors"]["5"]='fff799'?>

        <?php $this->scope["colors"]["6"]='82ca9c'?>

        <?php $this->scope["colors"]["7"]='7accc8'?>

        <?php $this->scope["colors"]["8"]='6dcff6'?>

        <?php $this->scope["colors"]["9"]='2e3192'?>

        <?php $this->scope["colors"]["10"]='92278f'?>

        <?php $this->scope["i"]=0;

$_fh0_data = (isset($this->scope["colors"]) ? $this->scope["colors"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['color'])
	{
/* -- foreach start output */

$this->scope["radio"]=false?>

        <?php echo form_radio('color', (isset($this->scope["color"]) ? $this->scope["color"] : null), (isset($this->scope["radio"]) ? $this->scope["radio"] : null), 'id="department-color-'.(isset($this->scope["color"]) ? $this->scope["color"] : null).'" style="float: left;"');?><label for="department-color-<?php echo $this->scope["color"];?>"><div style="position: relative; float: left; width: 14px; height: 14px; margin: 0px 10px; border-radius: 3px; background-color: #<?php echo $this->scope["color"];?>;"></div></label>
        <?php if ((isset($this->scope["i"]) ? $this->scope["i"] : null) === 0) {

$this->scope["i"]=1;

}
else {

$this->scope["i"]=0?><br /><?php 
}

/* -- foreach end output */
	}
}?>

    </div>
	<div class="clear" style="height:20px;"></div>
	<label style="float:left; width:140px;">Invoervelden:</label><br />
	<div id="fields"></div>
	<a href="#" id="add_field">Voeg veld toe</a>
	<div class="clear" style="height:20px;"></div>
	<?php echo form_submit('save', 'Opslaan');?>

<?php echo form_close();?>

</div>

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>
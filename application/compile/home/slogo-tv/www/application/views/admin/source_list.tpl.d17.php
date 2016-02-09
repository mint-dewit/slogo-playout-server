<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
'';// checking for modification in file:/home/slogo-tv/www/application/views/admin/layout.tpl
if (!("1449001427" == filemtime('/home/slogo-tv/www/application/views/admin/layout.tpl'))) { ob_end_clean(); return false; };?><html>
<head>
	<title>Adminsysteem - RTV Slogo</title>

	<link rel="icon" type="imge/png" href="<?php echo site_url();?>resources/icon.png">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,400italic" rel="stylesheet" type="text/css">
	<link href="<?php echo site_url();?>resources/admin_style.css" rel="stylesheet" type="text/css">
	<script>
	var unique_id = 0;
	$(document).ready(function(){
		$('#new_source').click(function(){
			var value1 = $('input[name=new_source]').val();
			var value2;
			if ($('input[name=new_source_audio]').prop('checked')) {
				value2 = 'checked="checked"';
			}
			var value3 = $('input[name=new_source_dur]').val();
			var selected = $('select[name=new_source_host] option:selected').val();
			$('#sources').append('<span id="new'+unique_id+'" class="source">\
						<a href="#" class="remove_source" id="new'+unique_id+'"><img style="width:10px;" src="/resources/cross-icon.png"></a>\
						<input type="text" name="sources[new]['+unique_id+'][file]" value="'+value1+'" class="hidden_input"> \
						<input type="checkbox" name="sources[new]['+unique_id+'][audio]" value="true" '+value2+'">Audio \
						<input type="text" name="sources[new]['+unique_id+'][duration]" value="'+value3+'" class="hidden_input">\
						<select name="sources[new]['+unique_id+'][host]" class="hidden_input">\
							<option value="google_drive">Google Drive</option>\
							<option value="local">Lokaal</option>\
							<option value="live">Live</option>\
						</select>\
					</span><br />');
			$('#sources #new'+unique_id+' select').val(selected);
			unique_id = unique_id + 1;
			$('input[name=new_source]').val('');
			$('input[name=new_source_audio').prop('çhecked',false);
			$('input[name=new_source_dur]').val('');
		});

		$('.remove_source').on('click',function(){
			var id = $(this).attr('id');
			$('#'+id+'.source').remove();
			$.get('<?php echo site_url();?>admin/sources/delete?id='+id);
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

<label style="float:left; width:140px;">Sources:</label>
	<div style="float: left;"><div id="sources">
		<?php $this->scope["hosts"]["google_drive"]="Google Drive"?>

		<?php $this->scope["hosts"]["local"]="Lokaal"?>

		<?php $this->scope["hosts"]["live"]="Live"?>

		<?php 
$_fh0_data = (isset($this->scope["sources"]) ? $this->scope["sources"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['source'])
	{
/* -- foreach start output */
?>
		<span id="<?php echo $this->scope["source"]["source_id"];?>" class="source">
			<a href="#" class="remove_source" id="<?php echo $this->scope["source"]["source_id"];?>"><img style="width:10px;" src="/resources/cross-icon.png"></a>
			<?php echo form_input('sources['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][file]', ''.(isset($this->scope["source"]["source"]) ? $this->scope["source"]["source"]:null).'', 'class="hidden_input"');?> 
			<?php echo form_checkbox('sources['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][audio]', 'true', (isset($this->scope["source"]["audio"]) ? $this->scope["source"]["audio"]:null));?>Audio 
			<?php echo form_input('sources['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][duration]', (isset($this->scope["source"]["duration"]) ? $this->scope["source"]["duration"]:null), 'class="hidden_input"');?>

			<?php echo form_dropdown('sources['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][host]', (isset($this->scope["hosts"]) ? $this->scope["hosts"] : null), (isset($this->scope["source"]["host"]) ? $this->scope["source"]["host"]:null), 'class="hidden_input"');?>

		</span>
		<br />
		<?php 
/* -- foreach end output */
	}
}?></div>
		<a href="#" id="new_source"><img style="width:10px;" src="/resources/tick-icon.png"></a>
		<?php echo form_input('new_source');?>

		<?php echo form_checkbox('new_source_audio', 'true');?>Audio
		<?php echo form_input('new_source_dur');?>

		<?php echo form_dropdown('new_source_host', (isset($this->scope["hosts"]) ? $this->scope["hosts"] : null));?><br />
	</div>
<div class="clear"></div>

<?php echo form_submit('Opslaan', 'Opslaan');?>

<?php echo form_close();?>

</div>

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>
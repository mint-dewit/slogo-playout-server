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
	<script>
	$(document).ready(function(){
		var unique_id = 0

		$('#new_time').click(function(){
			var value = $('input[name=new_time]').val();
			$('#times').append('<a href="#" class="remove_time" id="new'+unique_id+'">\
				<img style="width:10px;" src="/resources/cross-icon.png"></a>\
				<input type="text" name="times[new]['+unique_id+']" value="'+value+'" class="hidden_input">\
				<br />')
			unique_id = unique_id + 1;
			$('input[name=new_time]').val('');
		});

		$('.remove_time').click(function(){
			var id = $(this).attr('id');
			$('#'+id+'.time').remove();
			$.get('<?php echo site_url();?>admin/programmering/delete?type=time&id='+id);
		});

		$('#new_period').click(function(){
			var value1 = $('input[name=new_period_start]').val();
			var value2 = $('input[name=new_period_end]').val();
			$('#periods').append('<span class="period" id="new'+unique_id+'"">\
							<a href="#" class="remove_period" id="new'+unique_id+'"><img style="width:10px;" src="/resources/cross-icon.png"></a>\
							<input type="text" name="periods[new]['+unique_id+'][start]" value="'+value1+'" class="hidden_input"> - \
							<input type="text" name="periods[new]['+unique_id+'][end]" value="'+value2+'" class="hidden_input">\
							<br>\
						</span>')
			unique_id = unique_id + 1;
			$('input[name=new_period_start]').val('');
			$('input[name=new_period_end]').val('');
		});

		$('.remove_period').click(function(){
			var id = $(this).attr('id');
			$('#'+id+'.period').remove();
			$.get('<?php echo site_url();?>admin/programmering/delete?type=period&id='+id);
		});


		$('#new_source').click(function(){
			var value1 = $('input[name=new_source]').val();
			var value2;
			if ($('input[name=new_source_audio]').prop('checked')) {
				value2 = 'checked="checked"';
			}
			var value3 = $('input[name=new_source_dur]').val();
			$('#sources').append('<span id="new'+unique_id+'" class="source">\
						<a href="#" class="remove_period" id="new'+unique_id+'"><img style="width:10px;" src="/resources/cross-icon.png"></a>\
						<input type="text" name="sources[new]['+unique_id+'][file]" value="'+value1+'" class="hidden_input"> \
						<input type="checkbox" name="sources[new]['+unique_id+'][audio]" value="true" '+value2+'">Audio \
						<input type="text" name="sources[new]['+unique_id+'][duration]" value="'+value3+'" class="hidden_input">\
					</span>')
			unique_id = unique_id + 1;
			$('input[name=new_source]').val('');
			$('input[name=new_source_audio').prop('çhecked',false);
			$('input[name=new_source_dur]').val('');
		});

		$('.remove_source').click(function(){
			var id = $(this).attr('id');
			$('#'+id+'.source').remove();
			$.get('<?php echo site_url();?>admin/programmering/delete?type=source&id='+id);
		});
	})
</script>
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

<div class="title"><?php echo $this->scope["programme_data"]["Naam"];?> >> Afleveringen</div>
<div class="cards-wrapper">
<?php 
$_fh3_data = (isset($this->scope["programme_data"]["episodes"]) ? $this->scope["programme_data"]["episodes"]:null);
if ($this->isTraversable($_fh3_data) == true)
{
	foreach ($_fh3_data as $this->scope['episode'])
	{
/* -- foreach start output */
?>
	<div class="card">
		<div class="top-bar">
			<span>#</span>
			<input type="number" name="number" value="<?php echo $this->scope["episode"]["episode_number"];?>" id="input_number" placeholder="?">
			<?php echo form_input('title', ''.(isset($this->scope["episode"]["episode_title"]) ? $this->scope["episode"]["episode_title"]:null).'', 'id="input_title" placeholder="Naam..."');?>

		</div>
		<div class="body">
			<label style="float:left; width:140px;">Dagen:</label>
				<?php echo form_checkbox('days[0]', '', (isset($this->scope["episode"]["days"]["0"]) ? $this->scope["episode"]["days"]["0"]:null));?>Zondag 
				<?php echo form_checkbox('days[1]', '', (isset($this->scope["episode"]["days"]["1"]) ? $this->scope["episode"]["days"]["1"]:null));?>Maandag 
				<?php echo form_checkbox('days[2]', '', (isset($this->scope["episode"]["days"]["2"]) ? $this->scope["episode"]["days"]["2"]:null));?>Dinsdag 
				<?php echo form_checkbox('days[3]', '', (isset($this->scope["episode"]["days"]["3"]) ? $this->scope["episode"]["days"]["3"]:null));?>Woensdag 
				<?php echo form_checkbox('days[4]', '', (isset($this->scope["episode"]["days"]["4"]) ? $this->scope["episode"]["days"]["4"]:null));?>Donderdag 
				<?php echo form_checkbox('days[5]', '', (isset($this->scope["episode"]["days"]["5"]) ? $this->scope["episode"]["days"]["5"]:null));?>Vrijdag 
				<?php echo form_checkbox('days[6]', '', (isset($this->scope["episode"]["days"]["6"]) ? $this->scope["episode"]["days"]["6"]:null));?>Zaterdag<br />
			<label style="float:left; width:140px;">Tijden:</label>
				<div style="float: left;">
					<div id="times">
						<?php 
$_fh0_data = (isset($this->scope["episode"]["times"]) ? $this->scope["episode"]["times"]:null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['time'])
	{
/* -- foreach start output */
?><span id="<?php echo $this->scope["time"]["id"];?>" class="time">
							<a href="#" class="remove_time" id="<?php echo $this->scope["time"]["id"];?>"><img style="width:10px;" src="/resources/cross-icon.png"></a><?php echo form_input('times['.(isset($this->scope["time"]["id"]) ? $this->scope["time"]["id"]:null).']', ''.(isset($this->scope["time"]["time"]) ? $this->scope["time"]["time"]:null).'', 'class="hidden_input"');?><br />
						</span><?php 
/* -- foreach end output */
	}
}?>

					</div>
					<a href="#" id="new_time"><img style="width:10px;" src="/resources/tick-icon.png"></a><?php echo form_input('new_time', '', 'new_input');?><br />
				</div>
			<div class="clear"></div>
			<label style="float:left; width:140px;">Periodes:</label>
				<div style="float: left;">
					<?php 
$_fh1_data = (isset($this->scope["episode"]["periods"]) ? $this->scope["episode"]["periods"]:null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['period'])
	{
/* -- foreach start output */
?><div id="periods">
						<span class="period" id="<?php echo $this->scope["period"]["id"];?>">
							<a href="#" class="remove_period" id="<?php echo $this->scope["period"]["id"];?>"><img style="width:10px;" src="/resources/cross-icon.png"></a>
							<?php echo form_input('periods['.(isset($this->scope["period"]["id"]) ? $this->scope["period"]["id"]:null).'][start]', ''.(isset($this->scope["period"]["period_start"]) ? $this->scope["period"]["period_start"]:null).'', 'class="hidden_input"');?> - 
							<?php echo form_input('periods['.(isset($this->scope["period"]["id"]) ? $this->scope["period"]["id"]:null).'][end]', ''.(isset($this->scope["period"]["period_end"]) ? $this->scope["period"]["period_end"]:null).'', 'class="hidden_input"');?>

							<br />
						</span>
					</div><?php 
/* -- foreach end output */
	}
}?>

					<a href="#" id="new_period"><img style="width:10px;" src="/resources/tick-icon.png"></a><?php echo form_input('new_period_start');?> - <?php echo form_input('new_period_end');?><br />
				</div>
			<div class="clear"></div>
			<label style="float:left; width:140px;">Sources:</label>
				<div style="float: left;">
					<?php 
$_fh2_data = (isset($this->scope["episode"]["sources"]) ? $this->scope["episode"]["sources"]:null);
if ($this->isTraversable($_fh2_data) == true)
{
	foreach ($_fh2_data as $this->scope['source'])
	{
/* -- foreach start output */
?><div id="sources">
					<span id="<?php echo $this->scope["source"]["source_id"];?>" class="source">
						<a href="#" class="remove_source" id="<?php echo $this->scope["source"]["source_id"];?>"><img style="width:10px;" src="/resources/cross-icon.png"></a>
						<?php echo form_input('sources['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][file]', ''.(isset($this->scope["source"]["source"]) ? $this->scope["source"]["source"]:null).'', 'class="hidden_input"');?> 
						<?php echo form_checkbox('sources['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][audio]', 'true', (isset($this->scope["source"]["audio"]) ? $this->scope["source"]["audio"]:null));?>Audio 
						<?php echo form_input('sources['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][duration]', (isset($this->scope["source"]["duration"]) ? $this->scope["source"]["duration"]:null), 'class="hidden_input"');?>

					</span>
					<br />
					</div><?php 
/* -- foreach end output */
	}
}?>

					<a href="#" id="new_source"><img style="width:10px;" src="/resources/tick-icon.png"></a>
					<?php echo form_input('new_source');?>

					<?php echo form_checkbox('new_source_audio', 'true');?>Audio
					<?php echo form_input('new_source_dur');?><br />
				</div>
			<div class="clear"></div>
		</div>
	</div>
<?php 
/* -- foreach end output */
	}
}?>

</div>
<div class="clear" style="height:25px;"></div>
<?php echo form_submit('Opslaan', 'Opslaan');?>

<?php echo form_close();?>


</div>

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>
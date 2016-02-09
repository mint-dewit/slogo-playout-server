<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
'';// checking for modification in file:/home/slogo-tv/www/application/views/admin/music_edit/../layout.tpl
if (!("1441815428" == filemtime('/home/slogo-tv/www/application/views/admin/music_edit/../layout.tpl'))) { ob_end_clean(); return false; };?><html>
<head>
	<title>Nieuw item toevoegen - RTV Slogo</title>

	<link rel="icon" type="imge/png" href="<?php echo site_url();?>resources/icon.png">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,400italic" rel="stylesheet" type="text/css">
	<link href="<?php echo site_url();?>resources/admin_style.css" rel="stylesheet" type="text/css">
	<script>
	$(document).ready(function(){
		var unique_id = 0

		$('#new_time').click(function(){
			var value1 = $('input[name=new_time_start]').val();
			var value2 = $('input[name=new_time_end]').val();
			$('#times').append('<span class="time" id="new'+unique_id+'"">\
							<a href="#" class="remove_time" id="new'+unique_id+'"><img style="width:10px;" src="/resources/cross-icon.png"></a>\
							<input type="text" name="times[new]['+unique_id+'][start]" value="'+value1+'" class="hidden_input"> - \
							<input type="text" name="times[new]['+unique_id+'][end]" value="'+value2+'" class="hidden_input">\
							<br>\
						</span>');
			unique_id = unique_id + 1;
			$('input[name=new_time_start]').val('');
			$('input[name=new_time_end]').val('');
		});

		$('.remove_time').click(function(){
			var id = $(this).attr('id');
			$('#'+id+'.time').remove();
		});

		$('#new_period').click(function(){
			var value1 = $('input[name=new_period_start]').val();
			var value2 = $('input[name=new_period_end]').val();
			$('#periods').append('<span class="period" id="new'+unique_id+'"">\
							<a href="#" class="remove_period" id="new'+unique_id+'"><img style="width:10px;" src="/resources/cross-icon.png"></a>\
							<input type="text" name="periods[new]['+unique_id+'][start]" value="'+value1+'" class="hidden_input"> - \
							<input type="text" name="periods[new]['+unique_id+'][end]" value="'+value2+'" class="hidden_input">\
							<br>\
						</span>');
			unique_id = unique_id + 1;
			$('input[name=new_period_start]').val('');
			$('input[name=new_period_end]').val('');
		});

		$('.remove_period').click(function(){
			var id = $(this).attr('id');
			$('#'+id+'.period').remove();
		});

		$('#add_field').click(function(e){
			e.preventDefault();
			$('#fields').append('<input type="text" name="sources[new]['+unique_id+']" value="" style="width: 500px;"><br />');
			unique_id = unique_id +1;
		});
	})
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

	<label style="float:left; width:140px;">Naam afspeellijst:</label>
		<?php echo form_input('name');?><br />
	<label style="float:left; width:140px;">Dagen:</label>
		<?php echo form_checkbox('days[0]', '');?>Zondag 
		<?php echo form_checkbox('days[1]', '');?>Maandag 
		<?php echo form_checkbox('days[2]', '');?>Dinsdag 
		<?php echo form_checkbox('days[3]', '');?>Woensdag 
		<?php echo form_checkbox('days[4]', '');?>Donderdag 
		<?php echo form_checkbox('days[5]', '');?>Vrijdag 
		<?php echo form_checkbox('days[6]', '');?>Zaterdag<br />
	<label style="float:left; width:140px;">Tijden:</label>
		<div style="float: left;">
			<div id="times"></div>
			<a href="#" id="new_time"><img style="width:10px;" src="/resources/tick-icon.png"></a><?php echo form_input('new_time_start');?> - <?php echo form_input('new_time_end');?><br />
		</div>
	<div class="clear"></div>
	<label style="float:left; width:140px;">Periodes:</label>
		<div style="float: left;">
			<div id="periods"></div>
			<a href="#" id="new_period"><img style="width:10px;" src="/resources/tick-icon.png"></a><?php echo form_input('new_period_start');?> - <?php echo form_input('new_period_end');?><br />
		</div>
	<div class="clear"></div>

	<label style="float:left; width:140px;">Tracks:</label>
		<div style="float:left;">
			<div id="fields"></div><br />
			<a href="#" id="add_field">Voeg nummer toe</a>
		</div>
	<div class="clear" style="height:20px;"></div>
	<?php echo form_submit('save', 'Opslaan');?>

<?php echo form_close();?>

</div>

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>
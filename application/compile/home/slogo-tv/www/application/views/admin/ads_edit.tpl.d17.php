<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
'';// checking for modification in file:/home/slogo-tv/www/application/views/admin/layout.tpl
if (!("1449001427" == filemtime('/home/slogo-tv/www/application/views/admin/layout.tpl'))) { ob_end_clean(); return false; };?><html>
<head>
	<title>Reclameblok bewerken - RTV Slogo</title>

	<link rel="icon" type="imge/png" href="<?php echo site_url();?>resources/icon.png">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,400italic" rel="stylesheet" type="text/css">
	<link href="<?php echo site_url();?>resources/admin_style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
	$(document).ready(function(){
		var unique_id = 0;

		$('#list').sortable({
			axis:"y"
		});
		$('input[name=order]').val($('#list').sortable('serialize'));

		$('#new').click(function(){
			$('#list').append('<li id="blok_new'+unique_id+'"><input type="text" name="source[new]['+unique_id+'][source]" value="" style="width:400px;" placeholder="folder/bestand" /><input type="text" name="source[new]['+unique_id+'][dur]" value="" placeholder="00:00:00" /><input type="checkbox" name="source[15][days][0]" value="">Z \
				<input type="checkbox" name="source[new]['+unique_id+'][days][1]" value="">M \
				<input type="checkbox" name="source[new]['+unique_id+'][days][2]" value="">D\
				<input type="checkbox" name="source[new]['+unique_id+'][days][3]" value="">W\
				<input type="checkbox" name="source[new]['+unique_id+'][days][4]" value="">D\
				<input type="checkbox" name="source[new]['+unique_id+'][days][5]" value="">V\
				<input type="checkbox" name="source[new]['+unique_id+'][days][6]" value="">Z <a href="#" class="delete" id="new'+unique_id+'">x</a></li>');
			unique_id = unique_id +1;
		});

		$('#list').on('sortstop',function(){
			$('input[name=order]').val($('#list').sortable('serialize'));
		});

		$('input[type=submit]').click(function(e){
			$('input[name=order]').val($('#list').sortable('serialize'));
		});

		$(document).on('click','.delete',function(e){
			e.preventDefault();
			$.get('<?php echo site_url();?>admin/ads/delete?id='+$(this).attr('id'));
			$(this).parent().remove();
		})
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
<h2>Reclameblok bewerken</h2>
<?php echo form_open();?>

<div>
	<?php echo form_hidden('order');?>

	<ul id="list">
	<?php 
$_fh0_data = (isset($this->scope["sources"]) ? $this->scope["sources"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['source'])
	{
/* -- foreach start output */
?>
		<li id="blok_<?php echo $this->scope["source"]["source_id"];?>">
			<?php echo form_input('source['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][source]', (isset($this->scope["source"]["source"]) ? $this->scope["source"]["source"]:null), 'style="width:400px;" placeholder="folder/bestand"');?>

			<?php echo form_input('source['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][dur]', (isset($this->scope["source"]["dur"]) ? $this->scope["source"]["dur"]:null), 'placeholder="00:00:00"');?>

			<?php echo form_checkbox('source['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][days][0]', '', (isset($this->scope["source"]["days"]["0"]) ? $this->scope["source"]["days"]["0"]:null));?>Z 
			<?php echo form_checkbox('source['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][days][1]', '', (isset($this->scope["source"]["days"]["1"]) ? $this->scope["source"]["days"]["1"]:null));?>M 
			<?php echo form_checkbox('source['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][days][2]', '', (isset($this->scope["source"]["days"]["2"]) ? $this->scope["source"]["days"]["2"]:null));?>D
			<?php echo form_checkbox('source['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][days][3]', '', (isset($this->scope["source"]["days"]["3"]) ? $this->scope["source"]["days"]["3"]:null));?>W
			<?php echo form_checkbox('source['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][days][4]', '', (isset($this->scope["source"]["days"]["4"]) ? $this->scope["source"]["days"]["4"]:null));?>D
			<?php echo form_checkbox('source['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][days][5]', '', (isset($this->scope["source"]["days"]["5"]) ? $this->scope["source"]["days"]["5"]:null));?>V
			<?php echo form_checkbox('source['.(isset($this->scope["source"]["source_id"]) ? $this->scope["source"]["source_id"]:null).'][days][6]', '', (isset($this->scope["source"]["days"]["6"]) ? $this->scope["source"]["days"]["6"]:null));?>Z 
			<a href="#" class="delete" id="<?php echo $this->scope["source"]["source_id"];?>">x</a>
		</li>
	<?php 
/* -- foreach end output */
	}
}?>

	</ul>
</div>
<?php echo form_submit('opslaan', 'Opslaan');?>

<?php echo form_close();?>

<button id="new">Nieuw bestand toevoegen</button>
</div>

</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>
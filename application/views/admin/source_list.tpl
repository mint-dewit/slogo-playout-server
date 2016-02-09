{extends "layout.tpl"}

{block "header"}
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
			$.get('{site_url()}admin/sources/delete?id='+id);
		});
	});
</script>
{/block}

{block "content"}
{form_open()}
<label style="float:left; width:140px;">Sources:</label>
	<div style="float: left;"><div id="sources">
		{$hosts.google_drive = "Google Drive"}
		{$hosts.local = "Lokaal"}
		{$hosts.live = "Live"}
		{foreach $sources source}
		<span id="{$source.source_id}" class="source">
			<a href="#" class="remove_source" id="{$source.source_id}"><img style="width:10px;" src="/resources/cross-icon.png"></a>
			{form_input('sources[$source.source_id][file]','$source.source','class="hidden_input"')} 
			{form_checkbox('sources[$source.source_id][audio]','true',$source.audio)}Audio 
			{form_input('sources[$source.source_id][duration]',$source.duration,'class="hidden_input"')}
			{form_dropdown('sources[$source.source_id][host]',$hosts,$source.host,'class="hidden_input"')}
		</span>
		<br />
		{/foreach}</div>
		<a href="#" id="new_source"><img style="width:10px;" src="/resources/tick-icon.png"></a>
		{form_input('new_source')}
		{form_checkbox('new_source_audio','true')}Audio
		{form_input('new_source_dur')}
		{form_dropdown('new_source_host',$hosts)}<br />
	</div>
<div class="clear"></div>

{form_submit('Opslaan','Opslaan')}
{form_close()}
{/block}
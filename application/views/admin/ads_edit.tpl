{extends "layout.tpl"}

{block "title"}Reclameblok bewerken{/block}

{block "header"}
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
			$.get('{site_url()}admin/ads/delete?id='+$(this).attr('id'));
			$(this).parent().remove();
		})
	});
</script>
{/block}

{block "content"}
<h2>Reclameblok bewerken</h2>
{form_open()}
<div>
	{form_hidden('order')}
	<ul id="list">
	{foreach $sources source}
		<li id="blok_{$source.source_id}">
			{form_input('source[$source.source_id][source]',$source.source,'style="width:400px;" placeholder="folder/bestand"')}
			{form_input(source[$source.source_id][dur],$source.dur,'placeholder="00:00:00"')}
			{form_checkbox('source[$source.source_id][days][0]','',$source.days.0)}Z 
			{form_checkbox('source[$source.source_id][days][1]','',$source.days.1)}M 
			{form_checkbox('source[$source.source_id][days][2]','',$source.days.2)}D
			{form_checkbox('source[$source.source_id][days][3]','',$source.days.3)}W
			{form_checkbox('source[$source.source_id][days][4]','',$source.days.4)}D
			{form_checkbox('source[$source.source_id][days][5]','',$source.days.5)}V
			{form_checkbox('source[$source.source_id][days][6]','',$source.days.6)}Z 
			<a href="#" class="delete" id="{$source.source_id}">x</a>
		</li>
	{/foreach}
	</ul>
</div>
{form_submit('opslaan','Opslaan')}
{form_close()}
<button id="new">Nieuw bestand toevoegen</button>
{/block}
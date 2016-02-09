{extends "../layout.tpl"}

{block "title"}{$livestream.name}{/block}

{block "header"}
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
			$.get('{site_url()}music/delete?type=livestream_time&id='+id);
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
			$.get('{site_url()}music/delete?type=livestream_period&id='+id);
		});
	})
</script>
{/block}

{block "content"}
{form_open()}
	<label style="float:left; width:140px;">Naam afspeellijst:</label>
		{form_input('name',$livestream.name)}<br />
	<label style="float:left; width:140px;">URL livestream:</label>
		{form_input('source',$livestream.source,'style="width:500px;"')}<br />
	<label style="float:left; width:140px;">Dagen:</label>
		{form_checkbox('days[0]','',$livestream.days.0)}Zondag 
		{form_checkbox('days[1]','',$livestream.days.1)}Maandag 
		{form_checkbox('days[2]','',$livestream.days.2)}Dinsdag 
		{form_checkbox('days[3]','',$livestream.days.3)}Woensdag 
		{form_checkbox('days[4]','',$livestream.days.4)}Donderdag 
		{form_checkbox('days[5]','',$livestream.days.5)}Vrijdag 
		{form_checkbox('days[6]','',$livestream.days.6)}Zaterdag<br />
	<label style="float:left; width:140px;">Tijden:</label>
		<div style="float: left;">
			<div id="times">
				{foreach $livestream.times time}<span id="{$time.time_id}" class="time">
					<a href="#" class="remove_time" id="{$time.time_id}"><img style="width:10px;" src="/resources/cross-icon.png"></a>{form_input('times[$time.time_id][start]','$time.start','class="hidden_input"')} - {form_input('times[$time.time_id][end]','$time.end','class="hidden_input"')}<br />
				</span>{/foreach}
			</div>
			<a href="#" id="new_time"><img style="width:10px;" src="/resources/tick-icon.png"></a>{form_input('new_time_start')} - {form_input('new_time_end')}<br />
		</div>
	<div class="clear"></div>
	<label style="float:left; width:140px;">Periodes:</label>
		<div style="float: left;">
			<div id="periods">
				{foreach $livestream.periods period}
					<span class="period" id="{$period.period_id}">
						<a href="#" class="remove_period" id="{$period.period_id}"><img style="width:10px;" src="/resources/cross-icon.png"></a>
						{form_input('periods[$period.period_id][start]','$period.start','class="hidden_input"')} - 
						{form_input('periods[$period.period_id][end]','$period.end','class="hidden_input"')}
						<br />
					</span>
				{/foreach}
			</div>
			<a href="#" id="new_period"><img style="width:10px;" src="/resources/tick-icon.png"></a>{form_input('new_period_start')} - {form_input('new_period_end')}<br />
		</div>
	<div class="clear" style="height:20px;"></div>

	{form_submit('save','Opslaan')}
	<button type="button"><a href="{site_url()}music/delete?type=livestream&id={$livestream.livestream_id}&redirect=music">Verwijderen</button>
{form_close()}
{/block}
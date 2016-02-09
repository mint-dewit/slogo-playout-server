{extends "../layout.tpl"}

{block "title"}Nieuw livestream toevoegen{/block}

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
	})
</script>
{/block}

{block "content"}
{form_open()}
	<label style="float:left; width:140px;">Naam afspeellijst:</label>
		{form_input('name')}<br />
	<label style="float:left; width:140px;">URL livestream:</label>
		{form_input('source')}<br />
	<label style="float:left; width:140px;">Dagen:</label>
		{form_checkbox('days[0]','')}Zondag 
		{form_checkbox('days[1]','')}Maandag 
		{form_checkbox('days[2]','')}Dinsdag 
		{form_checkbox('days[3]','')}Woensdag 
		{form_checkbox('days[4]','')}Donderdag 
		{form_checkbox('days[5]','')}Vrijdag 
		{form_checkbox('days[6]','')}Zaterdag<br />
	<label style="float:left; width:140px;">Tijden:</label>
		<div style="float: left;">
			<div id="times"></div>
			<a href="#" id="new_time"><img style="width:10px;" src="/resources/tick-icon.png"></a>{form_input('new_time_start')} - {form_input('new_time_end')}<br />
		</div>
	<div class="clear"></div>
	<label style="float:left; width:140px;">Periodes:</label>
		<div style="float: left;">
			<div id="periods"></div>
			<a href="#" id="new_period"><img style="width:10px;" src="/resources/tick-icon.png"></a>{form_input('new_period_start')} - {form_input('new_period_end')}<br />
		</div>
	<div class="clear" style="height:20px;"></div>

	{form_submit('save','Opslaan')}
{form_close()}
{/block}
{extends "../layout.tpl"}

{block "title"}Nieuw item toevoegen{/block}

{block "header"}
<script>
	$(document).ready(function(){
		var unique_id = 0;
		var cur_template = {$count = 0}{foreach $templates i v}{if $count == 0}{$i} {/if}{$count+=1}{/foreach};

		$('#add_field').click(function(e){
			e.preventDefault();
			$('#fields').append('<input type="text" name="fields['+unique_id+'][index]" value="">: <input type="text" name="fields['+unique_id+'][value]" value=""><br />');
			unique_id = unique_id +1;
		});

		$('select[name=template]').change(function(e){
			{literal}
			$('#'+cur_template+'.template_values').css({'display':'none'});
			cur_template = $('select[name=template] option:selected').attr('value');
			$('#'+cur_template+'.template_values').css({'display':'block'});
			{/literal}
		});
	});
</script>
{/block}

{block "content"}
{form_open()}
	<label style="float:left; width:140px;">Titel:</label>{form_input('title')}<br />
	<label style="float:left; width:140px">Lengte (in sec):</label><input type="number" name="dur" value="" placeholder="?"><br />
	<label style="float:left; width:140px;">Periode:</label>{form_input('period_start','','placeholder="0000-00-00 00:00:00"')} - {form_input('period_end','','placeholder="0000-00-00 00:00:00"')}<br />
	<label style="float:left; width:140px;">Template:</label>{form_dropdown('template',$templates)}<br />
	<div class="clear" style="height:20px;"></div>
	<label style="float:left; width:140px;">Gegevens:</label><br />
	{foreach $templates_keys i template}
	<div class='template_values' id='{$template.id}' {if $i != 0}style="display:none"{/if}>
		{foreach $template.keys key}
		<label style="float:left; width:140px;">{$key.key_name}:</label>{form_input('values[$template.id][$key.key_id]')}<br />
		{/foreach}
	</div>
	{/foreach}
	<div class="clear" style="height:20px;"></div>
	{form_submit('save','Opslaan')}
{form_close()}
{/block}
{extends "../layout.tpl"}

{block "title"}Nieuwe template toevoegen{/block}

{block "header"}
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
			$.get('{site_url()}admin/templates/delete?type=key&id='+id);
			$('#'+id+'.key').remove();
		});
	});
</script>
{/block}

{block "content"}
{form_open()}
	<label style="float:left; width:140px;">Titel:</label>{form_input('title',$template.title)}<br />
	<label style="float:left; width:140px;">Kleur:</label>
	<div style="float: left;">
		<div style="float: left;">
        {$colors[1] = '7a0026'}
        {$colors[2] = 'ed145b'}
        {$colors[3] = 'f26c4f'}
        {$colors[4] = 'fbaf5d'}
        {$colors[5] = 'fff799'}
        {$colors[6] = '82ca9c'}
        {$colors[7] = '7accc8'}
        {$colors[8] = '6dcff6'}
        {$colors[9] = '2e3192'}
        {$colors[10] = '92278f'}
        {$i = 0}{foreach $colors color}{if $color === $template['color']}{$radio = TRUE}{else}{$radio = FALSE}{/if}
        {form_radio('color',$color,$radio,'id="department-color-$color" style="float: left;"')}<label for="department-color-{$color}"><div style="position: relative; float: left; width: 14px; height: 14px; margin: 0px 10px; border-radius: 3px; background-color: #{$color};"></div></label>
        {if $i === 0}{$i = 1}{else}{$i = 0}<br />{/if}{/foreach}
        </div>
    </div>
	<div class="clear" style="height:20px;"></div>
	<label style="float:left; width:140px;">Invoervelden:</label><br />
	<div id="fields">
		{foreach $template.keys key}
			{if $key.WYSIWYG == 0}{$WYSIWYG = false}{else}{$WYSIWYG = true}{/if}
			<span class="key" id="{$key.key_id}">
				<a href="#" class="remove_key" id="{$key.key_id}"><img style="width:10px;" src="/resources/cross-icon.png"></a>
				<input type="text" name="fields[{$key.key_id}][key_name]" value="{$key.key_name}"> WYSIWYG: {form_checkbox('fields[$key.key_id][WYSIWYG]','1',$WYSIWYG)}
			<br /></span>
		{/foreach}
	</div>
	<a href="#" id="add_field">Voeg veld toe</a>
	<div class="clear" style="height:20px;"></div>
	{form_submit('save','Opslaan')}
	<button type="button"><a href="{site_url()}admin/templates">Terug</button>
	<button type="button"><a href="{site_url()}admin/templates/delete?type=template&id={$template.id}&redirect=admin/templates">Verwijderen</button>
{form_close()}
{/block}
{extends "../layout.tpl"}

{block "title"}{$programme_data.Naam}{/block}

{block "header"}
<script>
	$(document).ready(function(){
		var unique_id = 0
		var sourcelist = '<select name="sources[]">{foreach $sourcelist i v}<option value="{$i}">{$v}</option>{/foreach}</select>';

		$('#new_time').click(function(){
			var value = $('input[name=new_time]').val();
			$('#times').append('<a href="#" class="remove_time" id="new'+unique_id+'">\
				<img style="width:10px;" src="/resources/cross-icon.png"></a>\
				<input type="text" name="times[new]['+unique_id+']" value="'+value+'" class="hidden_input">\
				<br />')
			unique_id = unique_id + 1;
			$('input[name=new_time]').val('');
		});

		$(document).on("click",'.remove_time',function(){
			var id = $(this).attr('id');
			$('#'+id+'.time').remove();
			$.get('{site_url()}admin/programmering/delete?type=time&id='+id);
		});

		$('#new_period').click(function(){
			var value1 = $('input[name=new_period_start]').val();
			var value2 = $('input[name=new_period_end]').val();
			$('#periods').append('<span class="period" id="new'+unique_id+'"">\
							<a href="#" class="remove_period" id="new'+unique_id+'"><img style="width:10px;" src="/resources/cross-icon.png"></a>\
							<input type="text" name="periods[new]['+unique_id+'][start]" value="'+value1+'" class="hidden_input"> - \
							<input type="text" name="periods[new]['+unique_id+'][end]" value="'+value2+'" class="hidden_input">\
							<br>\
						</span><br />');
			unique_id = unique_id + 1;
			$('input[name=new_period_start]').val('');
			$('input[name=new_period_end]').val('');
		});

		$(document).on('click','.remove_period',function(){
			var id = $(this).attr('id');
			$('#'+id+'.period').remove();
			$.get('{site_url()}admin/programmering/delete?type=period&id='+id);
		});

		$('#add_new_source').on('click',function(e){
			e.preventDefault();
			var source = $('select[name=new_source] option:selected').val();
			$('#sources').append('<li id="new'+unique_id+'" order="vid_new_'+unique_id+'" class="source">\
						<a href="#" class="remove_source" id="new'+unique_id+'"><img style="width:10px;" src="/resources/cross-icon.png"></a>\
						'+sourcelist+'\
						<br /></li>');
			$('#sources #new'+unique_id+' select').val(source);
			unique_id = unique_id + 1;
		});

		$('#sources').sortable({
			axis: "y"
		});

		// ***************************************** SCHEDULED TEMPLATES AS SOURCES *****************************************//
		var templates = [];
		var new_templates = [];
		var editing = 0;
		var editing_new = false;

		{foreach $programme_data.episodes.0.sources source}
		{if empty($source.source_id)}
		templates[{$source.link_id}] = {
			template_id : {$source.template_id},
			title : "{$source.title}",
			dur : "{$source.dur}",
			keys : []
		}
		{foreach $source.keys key}
			templates[{$source.link_id}]['keys'][{$key.key}] = "{$key.value}";
		{/foreach}
		{/if}
		{/foreach}
		console.log(templates)

		$('#add_new_html').click(function(){
			$('.popup .popup-content p select[name=html_template]').val($('select[name=new_html] option:selected').val());
			$('.popup .popup-content .template_values').css('display','none');
			$('.popup .popup-content #'+$('select[name=new_html] option:selected').val()).css('display','block');
			$('.popup-wrap').toggle();
		});

		$('.popup-bg').click(function(){
			$('.popup-wrap').toggle();
		})
		$('.popup-close').click(function(e){
			$('.popup-wrap').toggle();
			e.preventDefault();
		})

		$(document).on('change','select[name=html_template]',function(){
			$('.popup .popup-content .template_values').css('display','none');
			$('.popup .popup-content #'+$('select[name=html_template] option:selected').val()).toggle();
		});

		$(document).on('click','#save_newtemplate',function(){
			{literal}
			var container = {};
			container['template_id'] = $('.popup .popup-content p select[name=html_template] option:selected').val();
			container['title'] = $('.popup .popup-content input[name=edit_value_title]').val();
			container['dur'] = $('.popup .popup-content input[name=edit_value_dur]').val();
			container['keys'] = {};
			$('.popup .popup-content #'+container['template_id']+' input').each(function(i,v) {
				container['keys'][$(this).attr('name')] = $(this).val();
			});
			new_templates[unique_id] = container;
			$('#sources').append('<li id="'+unique_id+'" order="html_new_'+unique_id+'" class="newhtml">\
						<a href="#" class="remove_newhtml" id="'+unique_id+'"><img style="width:17px;" src="/resources/cross-icon.png"></a>\
						<a href="#" class="edit_newhtml" id="'+unique_id+'" data-title="Template bewerken"><img style="width:17px;" src="/resources/edit-circled.svg"></a>\
						<select name="html_template" disabled>\
							{/literal}{foreach $templatelist tmplt_id template}<option value="{$tmplt_id}">{$template}</option>\
							{/foreach}{literal}\
						</select>\
						<br /></li>');
			$('#sources #'+unique_id+' select').val(container['template_id']);

			{/literal}

			unique_id = unique_id +1;
			$('.popup-wrap').toggle();
			$('.popup-content input').val('');
		});

		$(document).on('click','.edit_newhtml',function(){
			$('.popup .popup-content #save_newtemplate').attr('id','save_template');
			var edit_id = $(this).attr('id');
			editing = edit_id;
			editing_new = true;
			$('.popup .popup-content p select[name=html_template]').val(new_templates[edit_id]['template_id']);
			$('.popup .popup-content .template_values').css('display','none');
			$('.popup .popup-content #'+new_templates[edit_id]['template_id']).css('display','block');
			$('.popup .popup-content input[name=edit_value_title]').val(new_templates[edit_id]['title']);
			$('.popup .popup-content input[name=edit_value_dur]').val(new_templates[edit_id]['dur']);
			$.each(new_templates[edit_id]['keys'],function(i,v){
				$('.popup .popup-content #'+new_templates[edit_id]['template_id']+' input[name='+i+']').val(v);
			});
			$('.popup-wrap').toggle();
		});

		$(document).on('click','.edit_html',function(){
			$('.popup .popup-content #save_newtemplate').attr('id','save_template');
			var edit_id = $(this).attr('id');
			editing = edit_id;
			editing_new = false;
			$('.popup .popup-content p select[name=html_template]').val(templates[edit_id]['template_id']);
			$('.popup .popup-content .template_values').css('display','none');
			$('.popup .popup-content #'+templates[edit_id]['template_id']).css('display','block');
			$('.popup .popup-content input[name=edit_value_title]').val(templates[edit_id]['title']);
			$('.popup .popup-content input[name=edit_value_dur]').val(templates[edit_id]['dur']);
			$.each(templates[edit_id]['keys'],function(i,v){
				$('.popup .popup-content #'+templates[edit_id]['template_id']+' input[name='+i+']').val(v);
			});
			$('.popup-wrap').toggle();
		});

		$(document).on('click','#save_template',function(){
			{literal}
			if (editing_new) {
				new_templates[editing]['template_id'] = $('.popup .popup-content p select[name=html_template] option:selected').val();
				new_templates[editing]['title'] = $('.popup .popup-content input[name=edit_value_title]').val();
				new_templates[editing]['dur'] = $('.popup .popup-content input[name=edit_value_dur]').val();
				new_templates[editing]['keys'] = {};
				$.each($('.popup .popup-content #'+new_templates[editing]['template_id']+' input'),function(i,v) {
					new_templates[editing]['keys'][$(this).attr('name')] = $(this).val();
				});
				$('#'+editing+'.newhtml').children('select[name=html_template]').val(new_templates[editing]['template_id']);
			} else {
				templates[editing]['template_id'] = $('.popup .popup-content p select[name=html_template] option:selected').val();
				templates[editing]['title'] = $('.popup .popup-content input[name=edit_value_title]').val();
				templates[editing]['dur'] = $('.popup .popup-content input[name=edit_value_dur]').val();
				templates[editing]['keys'] = {};
				$.each($('.popup .popup-content #'+templates[editing]['template_id']+' input'),function(i,v) {
					templates[editing]['keys'][$(this).attr('name')] = $(this).val();
				});
				$('#'+editing+'.html').children('select[name=html_template]').val(templates[editing]['template_id']);
			}

			editing = 0;
			editing_new = false;
			$('.popup-wrap').toggle();
			$('.popup .popup-content #save_template').attr('id','save_newtemplate');
            {/literal}
		});

		// ***************************************** PROCESSING USER INPUT *****************************************//
		$('input[name=Opslaan]').click(function(e){
			e.preventDefault();
			$('#content').prepend('Opslaan...<br />');
			var form = new FormData();
			form.append("number", $('input[name=number]').val());
			form.append("title", $('input[name=title]').val());
			$('input[name=days]').each(function(i,v){
				form.append("days["+i+"]", v.checked);
			})
			$('input[name^=periods]').each(function(i,v){
				form.append($(v).attr('name'), $(v).val());
			});
			$('input[name^=times]').each(function(i,v){
				form.append($(v).attr('name'), $(v).val());
			});
			{literal}var sorted = $('#sources').sortable("toArray",{attribute:"order"});{/literal}
			for (var i = 0; i < sorted.length; i++) {
				var parts = sorted[i].split(/_/g);
				if (parts[0] == 'html') {
					if (parts[1] == 'new') {
						form.append("sources[html][new]["+parts[2]+"][template_id]", new_templates[parts[2]]['template_id']);
						form.append("sources[html][new]["+parts[2]+"][title]", new_templates[parts[2]]['title']);
						form.append("sources[html][new]["+parts[2]+"][dur]", new_templates[parts[2]]['dur']);
						var keys = new_templates[parts[2]]['keys'];
						$.each(keys,function(i,v){
							form.append("sources[html][new]["+parts[2]+"][keys]["+i+"]",v);
						});
						form.append("sources[html][new]["+parts[2]+"][order]", i);
					} else if (parts[1] == 'old') {
						form.append("sources[html]["+parts[2]+"][template_id]", templates[parts[2]]['template_id']);
						form.append("sources[html]["+parts[2]+"][title]", templates[parts[2]]['title']);
						form.append("sources[html]["+parts[2]+"][dur]", templates[parts[2]]['dur']);
						var keys = templates[parts[2]]['keys'];
						$.each(keys,function(i,v){
							if (typeof v !== 'undefined') form.append("sources[html]["+parts[2]+"][keys]["+i+"]",v);
						});
						form.append("sources[html]["+parts[2]+"][order]", i);
					}
				} else if (parts[0] == 'vid') {
					if (parts[1] == 'new') {
						form.append("sources[videos][new]["+parts[2]+"][id]", $('#sources #new'+parts[2]+' select').val());
						form.append("sources[videos][new]["+parts[2]+"][order]", i);
					} else if (parts[1] == 'old') {
						form.append("sources[videos]["+parts[2]+"][id]", $('#sources #'+parts[2]+' select').val());
						form.append("sources[videos]["+parts[2]+"][order]", i);
					}
				}
			};

			var request = new XMLHttpRequest();
			request.open("POST", "http://text-tv.rtvslogo.nl/admin/programmering/{$programme_data.programme_id}/episode/new");
			request.send(form);
			request.onreadystatechange=function()
			  {
			  if (request.readyState==4 && request.status==200)
			    {
			    location.reload();
			    }
			  }
		})

		$(document).on("click",'.remove_source',function(e){
			var id = $(this).attr('id');
			$('.source#'+id).remove();
			$.get('{site_url()}admin/programmering/delete?type=source&id='+id);
		});

		$(document).on("click",'.remove_html',function(e){
			var id = $(this).attr('id');
			$('.html#'+id).remove();
			$.get('{site_url()}admin/programmering/delete?type=html&id='+id);
		});

		$(document).on("click",'.remove_newhtml',function(e){
			var id = $(this).attr('id');
			$('.newhtml#'+id).remove();
		});
	})
</script>

<style>
	
</style>
{/block}

{block "content"}
<div class="popup-wrap">
    <div class="popup-bg"></div>
    <div class="popup" style="width: 100%; height: 100%; margin-top: 0px;">
        <div class="popup-head">
        	<h3>HTML template invoegen</h3>
        	<a href="#" class="popup-close"><img src="http://mijnkms.nl/img/iconen/Verwijderen.png"></a>
        </div>
        <div class="popup-content">
        	<p>
			<select name="html_template">
				{foreach $templatelist tmplt_id template}<option value="{$tmplt_id}">{$template}</option>
				{/foreach}
			</select>
			<br/><label style="float:left; width:140px;">Titel:</label>{form_input('edit_value_title')}<br />
			<label style="float:left; width:140px;">Duratie:</label>{form_input('edit_value_dur')}<br />
			{foreach $templates_keys i template}
			<div class="template_values" id="{$template.id}" {if $item.template != $template.id}style="display:none"{/if}>
				{foreach $template.keys key}
				<label style="float:left; width:140px;">{$key.key_name}:</label>{form_input('$key.key_id',$values[$key.key_id])}<br />
				{/foreach}
			</div>
			{/foreach}
			<br/><button id="save_newtemplate">Opslaan</button></p>
        </div>
    </div>
</div>

{form_open(current_url())}
<div id="edit_html">
<div class="background"></div>
</div>
<div class="title">{$programme_data.Naam} >> Nieuwe aflevering</div>
<div class="cards-wrapper">
	<div class="card">
		<div class="top-bar">
			<span>#</span>
			<input type="number" name="number" value="" id="input_number" placeholder="?">
			{form_input('title','','id="input_title" placeholder="Naam..."')}
		</div>
		<div class="body">
			<label style="float:left; width:140px;">Dagen:</label>
				{form_checkbox('days','',$episode.days.0)}Zondag 
				{form_checkbox('days','',$episode.days.1)}Maandag 
				{form_checkbox('days','',$episode.days.2)}Dinsdag 
				{form_checkbox('days','',$episode.days.3)}Woensdag 
				{form_checkbox('days','',$episode.days.4)}Donderdag 
				{form_checkbox('days','',$episode.days.5)}Vrijdag 
				{form_checkbox('days','',$episode.days.6)}Zaterdag<br />
			<label style="float:left; width:140px;">Tijden:</label>
				<div style="float: left;">
					<div id="times">
					</div>
					<a href="#" id="new_time"><img style="width:10px;" src="/resources/tick-icon.png"></a>{form_input('new_time','','new_input')}<br />
				</div>
			<div class="clear"></div>
			<label style="float:left; width:140px;">Periodes:</label>
				<div style="float: left;"><div id="periods"></div>
					<a href="#" id="new_period"><img style="width:10px;" src="/resources/tick-icon.png"></a>{form_input('new_period_start')} - {form_input('new_period_end')}<br />
				</div>
			<div class="clear"></div>
			<label style="float:left; width:140px;">Sources:</label>
				<div style="float: left;"><ul id="sources">
					</ul>
					{form_dropdown('new_source',$sourcelist)} <button type="button"><a href="#" id="add_new_source">Toevoegen</a></button><br />
					{form_dropdown('new_html',$templatelist)} <button type="button"><a href="#" id="add_new_html">Toevoegen</a></button><br />
				</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div class="clear" style="height:25px;"></div>
{form_submit('Opslaan','Opslaan')}
<button type="button"><a href="{site_url()}admin/programmering/edit/{$programme_data.programme_id}">Terug</a></button>
{form_close()}

{/block}
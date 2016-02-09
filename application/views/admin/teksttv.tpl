{extends "layout.tpl"}

{block "title"}Teksttv{/block}

{block "header"}
<script>
	$(document).ready(function(){
		$('#list').sortable({
			axis: "y"
		});


		$( "#list" ).on( "sortstop", function( event, ui ) { 
			$.get('{site_url()}admin/teksttv/update_list?' + $( '#list' ).sortable( 'serialize'));
		} );
	});
</script>
{/block}

{block "content"}
<div class="header">
	<span>Teksttv</span>
</div>
<div class="clear"></div>

<div style="position:relative;">
	{foreach $templates template}
	<div class="legenda-item">
		<div class="colorpart" style="background:#{$template.color}"></div>
		<div style="float:left;margin-right:40px;">{$template.title}</div>
	</div>
	{/foreach}
</div>
<div class="clear" style="height:10px;"></div>

<div class="list-content">
	<div class="listhead item">
		<span style="margin-left: 17px;">Playlist</span>
	</div>
	<ul id="list">
	{foreach $playlist item}
		<li id="order_{$item.id}"><a href="{site_url()}admin/teksttv/playlist/{$item.id}"><div class="item">
			<div style="width:7px; height:40px; float:left; background:#{$item.color};"></div>
			<span style="margin-left: 10px;">{$item.title}</span>
		</div></a></li>
	{/foreach}
	</ul>
</div>
<div class="clear" style="height:10px;"></div>
<button type="button"><a href="{site_url()}admin/teksttv/playlist/new">Item toevoegen</a></button>
{/block}
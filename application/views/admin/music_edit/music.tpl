{extends "../layout.tpl"}

{block "title"}Muziek beheren{/block}

{block "content"}
<div style="position:inline-block; width:48%; margin-right:2%; float:left;">
	<div class="header">
		<span>Afspeellijsten</span>
	</div>
	<div class="clear"></div>

	<div class="list-content">
		<div class="listhead item">
			<span style="margin-left: 17px;">Naam</span>
		</div>
		{foreach $playlists playlist}
			<a href="{site_url()}admin/music/playlist/{$playlist.playlist_id}"><div class="item">
				<span style="margin-left: 10px;">{$playlist.name}</span>
			</div></a>
		{/foreach}
	</div>
	<div class="clear" style="height:10px;"></div>
	<button type="button"><a href="{site_url()}admin/music/playlist/new">Afspeellijst toevoegen</a></button>
</div>

<div style="position:inline-block; width:48%; margin-right:2%; float:left;">
	<div class="header">
		<span>Livestreams</span>
	</div>
	<div class="clear"></div>

	<div class="list-content">
		<div class="listhead item">
			<span style="margin-left: 17px;">Naam</span>
		</div>
		{foreach $streams stream}
			<a href="{site_url()}admin/music/livestream/{$stream.livestream_id}"><div class="item">
				<span style="margin-left: 10px;">{$stream.name}</span>
			</div></a>
		{/foreach}
	</div>
	<div class="clear" style="height:10px;"></div>
	<button type="button"><a href="{site_url()}admin/music/livestream/new">Livestream toevoegen</a></button>
</div>
{/block}
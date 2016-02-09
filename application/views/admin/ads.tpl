{extends "layout.tpl"}

{block "title"}Reclames beheren{/block}

{block "header"}
<style>
.cards-wrapper {
	list-style-type: none;
	margin: 0;
	padding: 0;
}
</style>
{/block}

{block "content"}
5x reclame per uur van max 2:24 minuten<br />
geen reclame onder video uitzendingen...<br />
<br />

<div class="list-content">
	<div class="listhead item"><span style="margin-left:10px">Reclameblokken</div>
	<a href="{site_url()}admin/ads/edit/0"><div class="item">
			<span style="margin-left:10px">Reclameblok 1</span>
	</div></a>
	<a href="{site_url()}admin/ads/edit/1"><div class="item">
			<span style="margin-left:10px">Reclameblok 2</span>
	</div></a>
	<a href="{site_url()}admin/ads/edit/2"><div class="item">
			<span style="margin-left:10px">Reclameblok 3</span>
	</div></a>
	<a href="{site_url()}admin/ads/edit/3"><div class="item">
			<span style="margin-left:10px">Reclameblok 4</span>
	</div></a>
	<a href="{site_url()}admin/ads/edit/4"><div class="item">
			<span style="margin-left:10px">Reclameblok 5</span>
	</div></a>
</div>
<div class="clear" style="height:10px;"></div>
{/block}
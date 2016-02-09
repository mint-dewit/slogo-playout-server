{extends "layout.tpl"}

{block "title"}Programmering bewerken{/block}

{block "content"}
<div class="header">
	<span>Programma's</span>
</div>
<div class="clear"></div>

<div style="position:relative;">
	{foreach $categories category}
	<div class="legenda-item">
		<div class="colorpart" style="background:#{$category.color}"></div>
		<div style="float:left;margin-right:40px;">{$category.name}</div>
	</div>
	{/foreach}
</div>
<div class="clear" style="height:10px;"></div>

<div class="list-content">
	<div class="listhead item">
		<span style="margin-left: 17px;">Naam</span>
	</div>
	{foreach $programmas programma}
		<a href="{site_url()}admin/programmering/edit/{$programma.programme_id}"><div class="item">
			<div style="width:7px; height:40px; float:left; background:#{$programma.color};"></div>
			<span style="margin-left: 10px;">{$programma.Naam}</span>
		</div></a>
	{/foreach}
</div>
<div class="clear" style="height:10px;"></div>
<button type="button"><a href="{site_url()}admin/programmering/edit/new">Programma toevoegen</a></button>
{/block}
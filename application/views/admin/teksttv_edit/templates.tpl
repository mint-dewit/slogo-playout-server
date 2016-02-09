{extends "../layout.tpl"}

{block "title"}Templates{/block}

{block "content"}
<div class="header">
	<span>Templates</span>
</div>
<div class="clear"></div>

<div class="list-content">
	<div class="listhead item">
		<span style="margin-left: 17px;">Naam</span>
	</div>
	{foreach $templates template}
		<a href="{site_url()}admin/templates/edit/{$template.id}"><div class="item">
			<span style="margin-left: 10px;">{$template.title}</span>
		</div></a>
	{/foreach}
</div>
<div class="clear" style="height:10px;"></div>
<button type="button"><a href="{site_url()}admin/templates/edit/new">Template toevoegen</a></button>
{/block}
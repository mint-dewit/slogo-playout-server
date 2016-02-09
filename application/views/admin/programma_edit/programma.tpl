{extends "../layout.tpl"}

{block "title"}{$programme_data.Naam}{/block}

{block "content"}

{form_open(current_url())}
{form_input('name',$programme_data.Naam,'id="programma-naam" placeholder="Programmanaam"')}
<div class="line" style="height:2px;"></div>
<label>Prioriteit:</label>{form_input('priority',$programme_data.Priority)}<br />
<label>Categorie:</label>{form_dropdown('category',$categories,$programme_data.category)}
<div class="clear" style="height:10px;"></div>
{form_submit('Opslaan','Opslaan')}<button type="button"><a href="{site_url()}admin/programmering/delete?type=programma&redirect=admin/programmering&id={$programme_data.programme_id}">Verwijder programma</a></button>
{form_close()}
<div class="clear" style="height:10px;"></div>

<div class="title">Afleveringen</div>
<div class="cards-wrapper">
{foreach $programme_data.episodes episode}
	<a href="{site_url()}admin/programmering/{$programme_data.programme_id}/episode/{$episode.episode_id}"><div class="card">
		<div class="top-bar">
			<span>#</span>
			<span id="input_number">{$episode.episode_number}</span>
			<span id="input_title">{$episode.episode_title}</span>
		</div>
	</div></a>
{/foreach}
</div>
<div class="clear" style="height:10px;"></div>
<button type="button"><a href="{site_url()}admin/programmering/{$programme_data.programme_id}/episode/new">Aflevering toevoegen</a></button>

{/block}
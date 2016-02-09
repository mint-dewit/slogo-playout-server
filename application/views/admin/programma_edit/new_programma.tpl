{extends "../layout.tpl"}

{block "title"}Nieuw programma maken{/block}

{block "content"}

{form_open(current_url())}
{form_input('name','','id="programma-naam" placeholder="Programmanaam"')}
<div class="line" style="height:2px;"></div>
<label>Prioriteit:</label>{form_input('priority','')}<br />
<label>Categorie:</label>{form_dropdown('category',$categories)}
<div class="clear" style="height:10px;"></div>
{form_submit('Opslaan','Opslaan')}
{form_close()}

{/block}
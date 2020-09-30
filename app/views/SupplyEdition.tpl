{extends file="main.tpl"}

{block name=content}

<div class="bottom-margin">
<form action="{$conf->action_root}supplySave" method="post" class="pure-form pure-form-aligned">
	<fieldset>
		<legend>Edycja przedmiotu</legend>
		<div class="pure-control-group">
            <label for="name">Nazwa produktu</label>
            <input id="name" type="text" placeholder="" name="name" value="{$form->name}">
        </div>
		<div class="pure-control-group">
            <label for="surname">ilosc</label>
            <input id="surname" type="text" placeholder="" name="ilosc" value="{$form->ammount}">
        </div>
		<div class="pure-control-group">
            <label for="birthdate">cena</label>
            <input id="birthdate" type="text" placeholder="" name="cena" value="{$form->price}">
        </div>
		<div class="pure-controls">
			<input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
			<a class="pure-button button-secondary" href="{$conf->action_root}supplyNew">Powrót</a>
		</div>
	</fieldset>
    <input type="hidden" name="id" value="{$form->id}">
</form>	
</div>

{/block}
{include file='messages.tpl'}
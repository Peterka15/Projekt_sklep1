{extends file="main.tpl"}

{block name=content}
<form action="{$conf->action_url}login" method="post"  class="pure-form pure-form-aligned bottom-margin">
	<legend>Logowanie do systemu</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="login">login: </label>
			<input id="login" type="text" name="login"/>
		</div>
        <div class="pure-control-group">
			<label for="password">hasło: </label>
			<input id="password" type="text" name="password" /><br />
		</div>
		<div class="pure-controls">
                    <b><a href="{$conf->action_root}supplyEdit">Odzyskiwanie hasła</a></b>
			<input type="submit" value="zaloguj" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	

{include file='messages.tpl'}

{/block}
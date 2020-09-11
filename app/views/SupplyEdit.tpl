{extends file="main.tpl"}

{block name=content}
 <div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="{$conf->action_url}logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: {$user->login}, rola: {$user->role}</span>
</div>
    
    
    <legend>Magazyn</legend>
	<fieldset>
        <div class="pure-control-group">               

<table>
  <tr>
    <th>Nazwa Produktu</th>
    <th>Ilość</th>
    <th>Cena za sztukę</th>
  </tr>
  <tr>
    <td><label for="Nazwa">ilosc: </label>
    <td><label for="Ilosc">ilosc: </label></td>
    <td><label for="Cena">cena: </label></td>
  </tr>
</table>
                   
	


{include file='messages.tpl'}

{/block}

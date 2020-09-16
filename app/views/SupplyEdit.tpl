{extends file="main.tpl"}

{block name=content}

 <div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="{$conf->action_url}logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: {$login} rola: {$rola}  </span>
</div>





<legend>Magazyn</legend>
<div class="bottom-margin">
</div>	

<table id="tab_people" class="pure-table pure-table-bordered">
<thead>
	<tr>
	 {if $rola == 'Admin'}	<th>id produktu</th> {/if}
		<th>nazwa</th>
		<th>cena</th>
		<th>ilosc</th>
          
	</tr>
</thead>
<tbody>
{foreach $supply as $s}
{strip}
	<tr>
            <td> </td>
         {if $rola == 'Admin'}<td>{$s["idProduktu"]}</td>{/if}
		<td>{$s["nazwa"]}</td>
		<td>{$s["cena"]}</td>
		<td>{$s["ilosc"]}</td>
         
		{if $rola == 'Admin'}
		<td>
                    
			<a class="button-small pure-button button-secondary" href="{$conf->action_url}supplyEdit/{$s['idProduktu']}">Edytuj</a>
			&nbsp;
			<a class="button-small pure-button button-warning" href="{$conf->action_url}supplyDelete/{$s['idProduktu']}">Usuń</a>
		</td>
		{/if}
	</tr>
{/strip}
{/foreach}
</tbody>
</table>

  



{if $rola == 'Admin'}
<div class="bottom-margin">
<form action="{$conf->action_root}supplySave" method="post" class="pure-form pure-form-aligned">
	<fieldset>
		<legend>Dane produktu</legend>
		<div class="pure-control-group">
            <label for="name">Nazwa produktu </label>
            <input id="name" type="text" placeholder="" name="name" value="{$form->name}">
        </div>
		<div class="pure-control-group">
            <label for="ilosc">ilość dostępnych sztuk</label>
            <input id="ilosc" type="text" placeholder="" name="ilosc" value="{$form->ammount}">
        </div>
		<div class="pure-control-group">
                    <label for="cena">cena</label>
            <input id="cena" type="text" placeholder="" name="cena" value="{$form->price}">
        </div>
		<div class="pure-controls">
			<input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
		</div>
	</fieldset>
    <input type="hidden" name="id" value="{$form->id}">
</form>	
</div>
{/if}

{/block}

	


{include file='messages.tpl'}



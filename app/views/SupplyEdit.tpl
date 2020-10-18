{extends file="main.tpl"}



{block name=content}
<script>
    {literal}
    let KOSZYK = [];
    let USER_ID = {/literal}{$user_id}{literal};

    $(document).ready(function () {
        getCart(USER_ID, (dane) => {
            KOSZYK = dane;

            renderTable(dane);
            return dane;
        });
    });

    function renderTable(dane) {
        let rows = dane.map((rekord) => {
            return `<tr>
                        <td>${rekord.nazwa}</td>
                        <td>${rekord.cena}</td>
                        <td>${rekord.ilosc}</td>
                        <td>
                            <button onclick='zmien_ilosc(1, ${rekord.produkt_id})'>+1</button>
                            <button onclick='zmien_ilosc(-1, ${rekord.produkt_id})'>-1</button>
                        </td>
                    </tr>`;
        });

        $("#koszyk-hook").html(rows);
    }

    function zmien_ilosc(zmiana, id_produktu) {
        let index = KOSZYK.findIndex((rekord) => (rekord.produkt_id === id_produktu));
        let max = parseInt($("#produkt_" + id_produktu).text());

        let docelowaIlosc = KOSZYK[index].ilosc + zmiana;

        if (docelowaIlosc > max) {
            return;
        }

        if (docelowaIlosc <= 0) {
            KOSZYK.splice(index, 1);
        } else {
            KOSZYK[index].ilosc = docelowaIlosc;
        }

        postCart(USER_ID, KOSZYK, () => {
            getCart(USER_ID, (dane) => renderTable(dane));
        }, true);
    }

    {/literal}
</script>


<div class="pure-menu pure-menu-horizontal bottom-margin">
    <a href="{$conf->action_url}logout" class="pure-menu-heading pure-menu-link">wyloguj</a>
    <span style="float:right;">użytkownik: {$login} rola: {$rola}  id: {$user_id}</span>
</div>
<legend>Magazyn</legend>
<div class="bottom-margin">
</div>
{if $rola =='User'}
    <a href="{$conf->action_url}showOrder" class="pure-menu-heading pure-menu-link">Twoje wcześniejsze zamówienia</a>
{/if}
{if $rola =='Admin'}<a href="{$conf->action_url}showOrder" class="pure-menu-heading pure-menu-link">Zamówienia</a>{/if}
<form id="search-form" class="pure-form pure-form-stacked"
action="{$conf->action_url}supplySearch" >
    <legend>Opcje wyszukiwania</legend>
    <fieldset>
        <input type="text" placeholder="Nazwa produktu" name="sf_search" value="{$wyszukiwanie}"/><br/>
        <button type="submit" class="pure-button pure-button-primary">Filtruj</button>
    </fieldset>
</form>
    <table id="tab_supply" class="pure-table pure-table-bordered" border="1">
        <thead>
        <tr>
            {if $rola == 'Admin'}
                <th>id produktu</th>
            {/if}
            <th>nazwa</th>
            <th>cena</th>
            <th>dostępna ilość</th>
            {if $rola == 'User'}
                <th>Zakupy</th>
            {/if}
            {if $rola == 'Admin'}
                <th>Archiwalny</th>
                <th>Opcje</th>
            {/if}
        </tr>
        </thead>
        <tbody>
        {foreach $supply as $s}
            {if $rola == 'Admin' || $s["zarchiwizowany"]== 0 }

                {strip}
                    <tr>

                        {if $rola == 'Admin'}
                            <td>{$s["idProduktu"]}</td>{/if}
                        <td>{$s["nazwa"]}</td>
                        <td>{$s["cena"]}</td>
                        <td id="produkt_{$s["idProduktu"]}">{$s["ilosc"]}</td>
                        {if $rola == 'Admin'}
                            <td>{$s["zarchiwizowany"]}</td>
                        {/if}
                        <td>
                            <button onclick="{literal}postCart({/literal}{$user_id}{literal}, [{'produkt_id': {/literal}{$s['idProduktu']}{literal}, 'ilosc': 1}], () => {getCart({/literal}{$user_id}{literal}, (dane) => {KOSZYK = dane; renderTable(KOSZYK)})}){/literal}">
                                Dodaj do koszyka
                            </button>

                            {if $rola == 'Admin'}
                                <a class="button-small pure-button button-secondary"
                                   href="{$conf->action_url}supplyEdit/{$s['idProduktu']}">Edytuj</a>
                                &nbsp;
                                <a class="button-small pure-button button-warning"
                                   href="{$conf->action_url}supplyDelete/{$s['idProduktu']}">Archiwizuj</a>
                            {/if}
                        </td>


                    </tr>
                {/strip}
            {/if}
        {/foreach}

        </tbody>

    </table>

    <div>
        {for $foo=0 to $pagesAmount-1}
            <a href="./supplyNew?sf_search={$wyszukiwanie}&page={$foo}">Strona {$foo + 1}</a>
        {/for}
    </div>

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

    <legend>Koszyk</legend>
    <table id="tab_supply" class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>Nazwa</th>
            <th>Cena</th>
            <th>Ilosc</th>
            <th>Akcje</th>
        </tr>
        </thead>

        <tbody id="koszyk-hook">

        </tbody>
    </table>
    <a href="{$conf->action_url}getOrder" class="pure-menu-heading pure-menu-link">Zamów zawartość koszyka</a>
    {/block}






    {include file='messages.tpl'}



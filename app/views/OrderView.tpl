{extends file="main.tpl"}

{block name=content}
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <a href="{$conf->action_url}logout" class="pure-menu-heading pure-menu-link">wyloguj</a>
        <span style="float:right;">użytkownik: {$login} rola: {$rola}  id: {$user_id}</span>
    </head>
    <body>
    <legend>Zamówienia</legend>
    <div class="bottom-margin">
    </div>
    <table id="tab_supply" class="pure-table pure-table-bordered">
        <thead>
            <tr>

                <th>id zamowienia</th>
                <th>data zamowienia</th>
                    {if $rola == 'Admin'}
                    <th>id produktu</th>
                    {/if}
                <th>nazwa przedmiotu</th>
                <th>cena</th>
                <th>zamówiona ilość</th>
                    {if $rola == 'Admin'}
                    <th>Imię zamawiającego</th>
                    <th>Nazwisko zamawiającego</th>
                    {/if}

            </tr>
        </thead>
        <tbody>
            {foreach $records as $r}
                {strip}

                    <tr>
                        <td>{$r["idZamowienia"]}</td>
                        <td>{$r["data"]}</td>
                        {if $rola == 'Admin'}
                            <td>{$r["idProduktu"]}</td>
                        {/if}
                        <td>{$r["nazwa"]}</td>
                        <td>{$r["cena"]}</td>
                        <td>{$r["ilosc"]}</td>
                        {if $rola == 'Admin'}
                            <td>{$r["imie"]}</td>
                            <td>{$r["nazwisko"]}</td>
                        {/if}
                    </tr>

                </tbody>
            {/strip}
        {/foreach}
    </body>
{/block}

{include file='messages.tpl'}
<?php
/* Smarty version 3.1.34-dev-7, created on 2020-10-19 01:07:18
  from 'E:\xampp\htdocs\Projekt_sklep1\app\views\SupplyEdit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f8ccaa6a7fe99_89081480',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9640832a154ed5725d3d9796b6a9fa2f3002d7d0' => 
    array (
      0 => 'E:\\xampp\\htdocs\\Projekt_sklep1\\app\\views\\SupplyEdit.tpl',
      1 => 1603062438,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_5f8ccaa6a7fe99_89081480 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3792034185f8ccaa6a282b6_33275975', 'content');
?>







    <?php $_smarty_tpl->_subTemplateRender('file:messages.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'content'} */
class Block_3792034185f8ccaa6a282b6_33275975 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_3792034185f8ccaa6a282b6_33275975',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
    
    let KOSZYK = [];
    let USER_ID = <?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
;

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

    
<?php echo '</script'; ?>
>


<div class="pure-menu pure-menu-horizontal bottom-margin">
    <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
logout" class="pure-menu-heading pure-menu-link">wyloguj</a>
    <span style="float:right;">użytkownik: <?php echo $_smarty_tpl->tpl_vars['login']->value;?>
 rola: <?php echo $_smarty_tpl->tpl_vars['rola']->value;?>
  id: <?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
</span>
</div>
<legend>Magazyn</legend>
<div class="bottom-margin">
</div>
<?php if ($_smarty_tpl->tpl_vars['rola']->value == 'User') {?>
    <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
showOrder" class="pure-menu-heading pure-menu-link">Twoje wcześniejsze zamówienia</a>
<?php }
if ($_smarty_tpl->tpl_vars['rola']->value == 'Admin') {?><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
showOrder" class="pure-menu-heading pure-menu-link">Zamówienia</a><?php }?>
<form id="search-form" class="pure-form pure-form-stacked"
action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
supplySearch" >
    <legend>Opcje wyszukiwania</legend>
    <fieldset>
        <input type="text" placeholder="Nazwa produktu" name="sf_search" value="<?php echo $_smarty_tpl->tpl_vars['wyszukiwanie']->value;?>
"/><br/>
        <button type="submit" class="pure-button pure-button-primary">Filtruj</button>
    </fieldset>
</form>
    <table id="tab_supply" class="pure-table pure-table-bordered" border="1">
        <thead>
        <tr>
            <?php if ($_smarty_tpl->tpl_vars['rola']->value == 'Admin') {?>
                <th>id produktu</th>
            <?php }?>
            <th>nazwa</th>
            <th>cena</th>
            <th>dostępna ilość</th>
            <?php if ($_smarty_tpl->tpl_vars['rola']->value == 'User') {?>
                <th>Zakupy</th>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['rola']->value == 'Admin') {?>
                <th>Archiwalny</th>
                <th>Opcje</th>
            <?php }?>
        </tr>
        </thead>
        <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['supply']->value, 's');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['s']->value) {
?>
            <?php if ($_smarty_tpl->tpl_vars['rola']->value == 'Admin' || $_smarty_tpl->tpl_vars['s']->value["zarchiwizowany"] == 0) {?>

                <tr><?php if ($_smarty_tpl->tpl_vars['rola']->value == 'Admin') {?><td><?php echo $_smarty_tpl->tpl_vars['s']->value["idProduktu"];?>
</td><?php }?><td><?php echo $_smarty_tpl->tpl_vars['s']->value["nazwa"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['s']->value["cena"];?>
</td><td id="produkt_<?php echo $_smarty_tpl->tpl_vars['s']->value["idProduktu"];?>
"><?php echo $_smarty_tpl->tpl_vars['s']->value["ilosc"];?>
</td><?php if ($_smarty_tpl->tpl_vars['rola']->value == 'Admin') {?><td><?php echo $_smarty_tpl->tpl_vars['s']->value["zarchiwizowany"];?>
</td><?php }?><td><button onclick="postCart(<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
, [{'produkt_id': <?php echo $_smarty_tpl->tpl_vars['s']->value['idProduktu'];?>
, 'ilosc': 1}], () => {getCart(<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
, (dane) => {KOSZYK = dane; renderTable(KOSZYK)})})">Dodaj do koszyka</button><?php if ($_smarty_tpl->tpl_vars['rola']->value == 'Admin') {?><a class="button-small pure-button button-secondary" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
supplyEdit/<?php echo $_smarty_tpl->tpl_vars['s']->value['idProduktu'];?>
">Edytuj</a>&nbsp;<a class="button-small pure-button button-warning" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
supplyDelete/<?php echo $_smarty_tpl->tpl_vars['s']->value['idProduktu'];?>
">Archiwizuj</a><?php }?></td></tr>
            <?php }?>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

        </tbody>

    </table>

    <div>
        <?php
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? $_smarty_tpl->tpl_vars['pagesAmount']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['pagesAmount']->value-1)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = 0, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration === 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration === $_smarty_tpl->tpl_vars['foo']->total;?>
            <a href="./supplyNew?sf_search=<?php echo $_smarty_tpl->tpl_vars['wyszukiwanie']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
">Strona <?php echo $_smarty_tpl->tpl_vars['foo']->value+1;?>
</a>
        <?php }
}
?>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['rola']->value == 'Admin') {?>
        <div class="bottom-margin">
            <form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
supplySave" method="post" class="pure-form pure-form-aligned">
                <fieldset>
                    <legend>Dane produktu</legend>
                    <div class="pure-control-group">
                        <label for="name">Nazwa produktu </label>
                        <input id="name" type="text" placeholder="" name="name" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->name;?>
">
                    </div>
                    <div class="pure-control-group">
                        <label for="ilosc">ilość dostępnych sztuk</label>
                        <input id="ilosc" type="text" placeholder="" name="ilosc" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->ammount;?>
">
                    </div>
                    <div class="pure-control-group">
                        <label for="cena">cena</label>
                        <input id="cena" type="text" placeholder="" name="cena" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->price;?>
">
                    </div>
                    <div class="pure-controls">
                        <input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
                    </div>
                </fieldset>
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->id;?>
">
            </form>
        </div>
    <?php }?>

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
    <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
getOrder" class="pure-menu-heading pure-menu-link">Zamów zawartość koszyka</a>
    <?php
}
}
/* {/block 'content'} */
}

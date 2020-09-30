<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-30 22:34:00
  from 'E:\xampp\htdocs\Projekt_sklep1\app\views\OrderView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f74ebb83b05a7_95084254',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a079030655eed56b216df9dc25581aa64e3a061' => 
    array (
      0 => 'E:\\xampp\\htdocs\\Projekt_sklep1\\app\\views\\OrderView.tpl',
      1 => 1601497678,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_5f74ebb83b05a7_95084254 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3002255185f74ebb8392b56_20479899', 'content');
?>


<?php $_smarty_tpl->_subTemplateRender('file:messages.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'content'} */
class Block_3002255185f74ebb8392b56_20479899 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_3002255185f74ebb8392b56_20479899',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
logout" class="pure-menu-heading pure-menu-link">wyloguj</a>
        <span style="float:right;">użytkownik: <?php echo $_smarty_tpl->tpl_vars['login']->value;?>
 rola: <?php echo $_smarty_tpl->tpl_vars['rola']->value;?>
  id: <?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
</span>
        
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
                    <?php if ($_smarty_tpl->tpl_vars['rola']->value == 'Admin') {?>
                    <th>id produktu</th>
                    <?php }?>
                <th>nazwa przedmiotu</th>
                <th>cena</th>
                <th>zamówiona ilość</th>
                    <?php if ($_smarty_tpl->tpl_vars['rola']->value == 'Admin') {?>
                    <th>Imię zamawiającego</th>
                    <th>Nazwisko zamawiającego</th>
                    <?php }?>

            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['records']->value, 'r');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['r']->value) {
?>
                <tr><td><?php echo $_smarty_tpl->tpl_vars['r']->value["idZamowienia"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['r']->value["data"];?>
</td><?php if ($_smarty_tpl->tpl_vars['rola']->value == 'Admin') {?><td><?php echo $_smarty_tpl->tpl_vars['r']->value["idProduktu"];?>
</td><?php }?><td><?php echo $_smarty_tpl->tpl_vars['r']->value["nazwa"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['r']->value["cena"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['r']->value["ilosc"];?>
</td><?php if ($_smarty_tpl->tpl_vars['rola']->value == 'Admin') {?><td><?php echo $_smarty_tpl->tpl_vars['r']->value["imie"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['r']->value["nazwisko"];?>
</td><?php }?></tr></tbody>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
supplyNew" class="pure-menu-heading pure-menu-link">Powrót</a>
    </body>
    
<?php
}
}
/* {/block 'content'} */
}

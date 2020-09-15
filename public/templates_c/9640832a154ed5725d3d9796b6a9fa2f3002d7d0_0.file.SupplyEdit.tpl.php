<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-16 01:48:32
  from 'E:\xampp\htdocs\Projekt_sklep1\app\views\SupplyEdit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f6152d0844097_35461640',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9640832a154ed5725d3d9796b6a9fa2f3002d7d0' => 
    array (
      0 => 'E:\\xampp\\htdocs\\Projekt_sklep1\\app\\views\\SupplyEdit.tpl',
      1 => 1600212023,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_5f6152d0844097_35461640 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13673501845f6152d081ccc1_92415363', 'content');
?>


	


<?php $_smarty_tpl->_subTemplateRender('file:messages.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'content'} */
class Block_13673501845f6152d081ccc1_92415363 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_13673501845f6152d081ccc1_92415363',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


 <div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: <?php echo $_smarty_tpl->tpl_vars['login']->value;?>
</span>
</div>





<legend>Magazyn</legend>
<div class="bottom-margin">
</div>	

<table id="tab_people" class="pure-table pure-table-bordered">
<thead>
	<tr>
		<th>id produktu</th>
		<th>nazwa</th>
		<th>cena</th>
		<th>ilosc</th>
	</tr>
</thead>
<tbody>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['supply']->value, 's');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['s']->value) {
?>
<tr><td> </td><td><?php echo $_smarty_tpl->tpl_vars['s']->value["idProduktu"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['s']->value["nazwa"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['s']->value["cena"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['s']->value["ilosc"];?>
</td><td><a class="button-small pure-button button-secondary" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
supplyEdit/<?php echo $_smarty_tpl->tpl_vars['s']->value['idProduktu'];?>
">Edytuj</a>&nbsp;<a class="button-small pure-button button-warning" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
supplyDelete/<?php echo $_smarty_tpl->tpl_vars['s']->value['idProduktu'];?>
">Usuń</a></td></tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</tbody>
</table>

  




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
			<a class="pure-button button-secondary" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
">Powrót</a>
		</div>
	</fieldset>
    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->id;?>
">
</form>	
</div>

<?php
}
}
/* {/block 'content'} */
}

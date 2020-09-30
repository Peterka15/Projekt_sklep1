<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-30 04:28:49
  from 'E:\xampp\htdocs\Projekt_sklep1\app\views\SupplyEdition.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f73ed61379985_31908652',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf3d95f14071cb75cc81a57fd10224ff0aa1650a' => 
    array (
      0 => 'E:\\xampp\\htdocs\\Projekt_sklep1\\app\\views\\SupplyEdition.tpl',
      1 => 1601432679,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_5f73ed61379985_31908652 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15646332065f73ed6136f669_64485988', 'content');
?>

<?php $_smarty_tpl->_subTemplateRender('file:messages.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'content'} */
class Block_15646332065f73ed6136f669_64485988 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_15646332065f73ed6136f669_64485988',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="bottom-margin">
<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
supplySave" method="post" class="pure-form pure-form-aligned">
	<fieldset>
		<legend>Edycja przedmiotu</legend>
		<div class="pure-control-group">
            <label for="name">Nazwa produktu</label>
            <input id="name" type="text" placeholder="" name="name" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->name;?>
">
        </div>
		<div class="pure-control-group">
            <label for="surname">ilosc</label>
            <input id="surname" type="text" placeholder="" name="ilosc" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->ammount;?>
">
        </div>
		<div class="pure-control-group">
            <label for="birthdate">cena</label>
            <input id="birthdate" type="text" placeholder="" name="cena" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->price;?>
">
        </div>
		<div class="pure-controls">
			<input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
			<a class="pure-button button-secondary" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
supplyNew">Powrót</a>
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

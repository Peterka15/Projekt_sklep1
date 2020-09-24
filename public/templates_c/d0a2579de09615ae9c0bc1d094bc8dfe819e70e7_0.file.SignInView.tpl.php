<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-23 23:38:03
  from 'E:\xampp\htdocs\Projekt_sklep1\app\views\SignInView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f6bc03b4b6970_49858976',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0a2579de09615ae9c0bc1d094bc8dfe819e70e7' => 
    array (
      0 => 'E:\\xampp\\htdocs\\Projekt_sklep1\\app\\views\\SignInView.tpl',
      1 => 1600897059,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_5f6bc03b4b6970_49858976 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9296949615f6bc03b4a4db5_90420791', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'content'} */
class Block_9296949615f6bc03b4a4db5_90420791 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_9296949615f6bc03b4a4db5_90420791',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
login" method="post"  class="pure-form pure-form-aligned bottom-margin">
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
			<input type="submit" value="zaloguj" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	

<?php $_smarty_tpl->_subTemplateRender('file:messages.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php
}
}
/* {/block 'content'} */
}

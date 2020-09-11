<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-11 17:18:09
  from 'C:\localhost\Projekt_sklep1\app\views\SignInView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f5b95316b7d98_01645846',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e69b632ceb915f71b00e222d20f771117a4d1b36' => 
    array (
      0 => 'C:\\localhost\\Projekt_sklep1\\app\\views\\SignInView.tpl',
      1 => 1599837265,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_5f5b95316b7d98_01645846 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9864733805f5b95316b1df4_69968302', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'content'} */
class Block_9864733805f5b95316b1df4_69968302 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_9864733805f5b95316b1df4_69968302',
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
                    <b><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
supplyEdit">Odzyskiwanie hasła</a></b>
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

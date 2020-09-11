<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-11 17:34:50
  from 'C:\localhost\Projekt_sklep1\app\views\templates\messages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f5b991a1c9d69_82857609',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd4afb867f9523f038440bbadb2e00d99125c48a9' => 
    array (
      0 => 'C:\\localhost\\Projekt_sklep1\\app\\views\\templates\\messages.tpl',
      1 => 1599838482,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f5b991a1c9d69_82857609 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['msgs']->value->isError()) {?>
				<h4>Wystąpiły błędy: </h4>
				<ol class="err">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getMessage(!'index'), 'err');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['err']->value) {
?>
					<li><?php echo $_smarty_tpl->tpl_vars['err']->value;?>
</li>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</ol>
				<?php }?>

								<?php if ($_smarty_tpl->tpl_vars['msgs']->value->isInfo()) {?>
				<h4>Informacje: </h4>
				<ol class="inf">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getInfos(), 'inf');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['inf']->value) {
?>
					<li><?php echo $_smarty_tpl->tpl_vars['inf']->value;?>
</li>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</ol>
				<?php }
}
}

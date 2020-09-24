<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-23 23:23:34
  from 'E:\xampp\htdocs\Projekt_sklep1\app\views\templates\main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f6bbcd6ecb2d8_22421815',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b24f0327dfdf65e7ac96d39e98927e692c0dbd58' => 
    array (
      0 => 'E:\\xampp\\htdocs\\Projekt_sklep1\\app\\views\\templates\\main.tpl',
      1 => 1600810641,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f6bbcd6ecb2d8_22421815 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!doctype html>
<html lang="pl">
<head>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['page_title']->value)===null||$tmp==='' ? "Tytuł domyślny" : $tmp);?>
</title>
        <?php echo '<script'; ?>
 src="assets/js/jquery.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/jquery.scrolly.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/jquery.dropotron.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/jquery.scrollex.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/browser.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/breakpoints.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/util.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/main.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/api.js"><?php echo '</script'; ?>
>
	<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	
</head>
<body class="is-preload">
	<div id="page-wrapper">

		

		<!-- Main -->
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5483179425f6bbcd6eca171_62358520', "content");
?>

		

		<!-- Footer -->
		<footer id="footer">
			
			<ul class="copyright">
				<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
			</ul>
		</footer>

		

		<!-- Scripts -->
		

	</body>
	</html><?php }
/* {block "content"} */
class Block_5483179425f6bbcd6eca171_62358520 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_5483179425f6bbcd6eca171_62358520',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "content"} */
}

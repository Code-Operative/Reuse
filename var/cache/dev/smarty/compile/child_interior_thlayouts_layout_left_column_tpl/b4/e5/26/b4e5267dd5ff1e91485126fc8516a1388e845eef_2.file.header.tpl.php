<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-28 11:01:55
  from '/home/codeoperativeco/public_html/themes/interior_th/templates/_partials/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60b0bf938a2fa9_97209849',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4e5267dd5ff1e91485126fc8516a1388e845eef' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/interior_th/templates/_partials/header.tpl',
      1 => 1619255004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b0bf938a2fa9_97209849 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_59206255660b0bf93894ab0_73100797', 'header_banner');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_190581997060b0bf93895982_58448562', 'header_nav');
?>

<?php if ((Module::isInstalled('ps_currencyselector') && Module::isEnabled('ps_currencyselector')) || (Module::isInstalled('ps_languageselector') && Module::isEnabled('ps_languageselector')) || (Module::isInstalled('ps_contactinfo') && Module::isEnabled('ps_contactinfo')) || (Module::isInstalled('ps_searchbar') && Module::isEnabled('ps_searchbar')) || (Module::isInstalled('ps_customersignin') && Module::isEnabled('ps_customersignin'))) {?>
<div class="mobile-nav hidden-lg-up">
    <?php if (Module::isInstalled('ps_currencyselector') && Module::isEnabled('ps_currencyselector')) {?>
      <div id="_mobile_currency_selector" class="toggle-link"></div>
    <?php }?>
    <?php if (Module::isInstalled('ps_languageselector') && Module::isEnabled('ps_languageselector')) {?>
      <div id="_mobile_language_selector" class="toggle-link"></div>
    <?php }?>
    <?php if (Module::isInstalled('ps_contactinfo') && Module::isEnabled('ps_contactinfo')) {?>
    <div id="_mobile_contact_link" class="toggle-link"></div>
    <?php }?>
    <?php if (Module::isInstalled('ps_searchbar') && Module::isEnabled('ps_searchbar')) {?>
    <div id="_mobile_search_bar" class="toggle-link"></div>
    <?php }?>
    <?php if (Module::isInstalled('ps_customersignin') && Module::isEnabled('ps_customersignin')) {?>
    <div id="_mobile_user_info" class="toggle-link"></div>
    <?php }?>
</div>
<?php }
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_38398307660b0bf938a0443_60284421', 'header_top');
?>

<?php }
/* {block 'header_banner'} */
class Block_59206255660b0bf93894ab0_73100797 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_banner' => 
  array (
    0 => 'Block_59206255660b0bf93894ab0_73100797',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div class="header-banner">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayBanner'),$_smarty_tpl ) );?>

  </div>
<?php
}
}
/* {/block 'header_banner'} */
/* {block 'header_nav'} */
class Block_190581997060b0bf93895982_58448562 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_nav' => 
  array (
    0 => 'Block_190581997060b0bf93895982_58448562',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <nav class="header-nav">
    <div class="container">
        <div class="row inner-wrapper">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav1'),$_smarty_tpl ) );?>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav2'),$_smarty_tpl ) );?>

          <div class="hidden-lg-up mobile">
            <div id="menu-icon">
              <i class="material-icons d-inline">&#xE5D2;</i>
            </div>
            <div class="top-logo" id="_mobile_logo"></div>
            <?php if (Module::isInstalled('ps_shoppingcart') && Module::isEnabled('ps_shoppingcart')) {?>
            <div id="_mobile_cart"></div>
            <?php }?>
          </div>
        </div>
    </div>
  </nav>
<?php
}
}
/* {/block 'header_nav'} */
/* {block 'header_top'} */
class Block_38398307660b0bf938a0443_60284421 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_top' => 
  array (
    0 => 'Block_38398307660b0bf938a0443_60284421',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div class="header-top">
    <div class="container">
       <div class="row inner-wrapper">
        <div id="_desktop_logo" class="col-md-2 hidden-md-down">
          <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
">
            <img class="logo img-responsive" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['logo'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
          </a>
        </div>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayTop'),$_smarty_tpl ) );?>

      </div>
      <div id="mobile_top_menu_wrapper" class="row hidden-lg-up">
        <div id="_mobile_link_block"></div>
        <div class="js-top-menu mobile" id="_mobile_top_menu"></div>
      </div>
    </div>
  </div>
  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNavFullWidth'),$_smarty_tpl ) );?>

<?php
}
}
/* {/block 'header_top'} */
}
<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-10 13:58:57
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/menus.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60992e11d63615_26714350',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15113e27a32646027183466e35d4eb51b041b3ae' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/menus.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60992e11d63615_26714350 (Smarty_Internal_Template $_smarty_tpl) {
?><div id='kb-seller-account-menus' class="kb-block lftcolrightpad">
    <?php if (count($_smarty_tpl->tpl_vars['menus']->value) > 0) {?>
    <div id="kb-account-accordian" class="kb-account-accordian"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Seller Account Menu','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><i class="icon-plus"></i></div>
    <div id="kb-s-account-mlist">
        <ul class="kb-menu-block">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menus']->value, 'menu');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->value) {
?>
                <a title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['title'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['href'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                <li class="kb-menu-list-item <?php if ($_smarty_tpl->tpl_vars['menu']->value['active'] == true) {?>kb-active-menuitem<?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['menu']->value['css_class'])) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['css_class'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>">
                    
                        <i class="kb-material-icons"><?php echo $_smarty_tpl->tpl_vars['menu']->value['icon_class'];?>
</i><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['label'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 
                        <?php if ($_smarty_tpl->tpl_vars['menu']->value['badge'] != false) {?>
                            <span class="kb-menu-badge"><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['menu']->value['badge']), ENT_QUOTES, 'UTF-8');?>
</span>
                        <?php }?>
                       
                </li>
                </a> 
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayKbSellerAccountMenu",'m'=>$_GET['module'],'c'=>$_GET['controller']),$_smarty_tpl ) );?>

            <li id="kb_otherfeature_menu" class="kb-menu-list-item collapsible-otherfeature-menu">
                <a title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Other Features','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" href="javascript:void(0)">
                    <i class="kb-material-icons">&#xe23e;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Other Features','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                </a>
                <div class="kb-smenu-accordian-symbol kbexpand"><i class="kb-material-icons">&#xe145;</i></div>
                <ul style="display:none;">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayKbSellerOfeatureMenu",'m'=>$_GET['module'],'c'=>$_GET['controller']),$_smarty_tpl ) );?>

                </ul>
            </li>
        </ul>
    </div>
    <?php }?>
</div>
<?php }
}

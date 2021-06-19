<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-28 11:01:55
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/hook/display_nav1.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60b0bf938d6fc7_99382035',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa5c50c31c934bbd7ac6a3e68652626a9d15544b' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/hook/display_nav1.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b0bf938d6fc7_99382035 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['kb_displaynav1_links']->value) && count($_smarty_tpl->tpl_vars['kb_displaynav1_links']->value) > 0) {?>
    <style>
        #_desktop_contact_link, #kb_displaynav1_links_container{
            display: inline-table;
        }
        
        .display_nav1_link{
            display: table-cell;
            padding: 0 5px;
        }
    </style>
    <div id="kb_displaynav1_links_container">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_displaynav1_links']->value, 'sl');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sl']->value) {
?>
            <div class="display_nav1_link">
            <?php if (isset($_smarty_tpl->tpl_vars['sl']->value['confirm'])) {?>
                <a href="javascript:void(0)" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sl']->value['title'], ENT_QUOTES, 'UTF-8');?>
" rel="nofollow" onclick="if(confirm('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sl']->value['confirm']['message'], ENT_QUOTES, 'UTF-8');?>
')){ location.href= '<?php echo $_smarty_tpl->tpl_vars['sl']->value['href'];?>
' }">
                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sl']->value['label'], ENT_QUOTES, 'UTF-8');?>

                </a> 

            <?php } else { ?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['sl']->value['href'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sl']->value['title'], ENT_QUOTES, 'UTF-8');?>
" rel="nofollow">
                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sl']->value['label'], ENT_QUOTES, 'UTF-8');?>

                </a> 

            <?php }?>
            </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>    
    </div>
<?php }
if (isset($_smarty_tpl->tpl_vars['cart_url']->value) && $_smarty_tpl->tpl_vars['cart_url']->value != '') {?>
    <input type="hidden" id="allow_free_shipping" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['allow_free_shipping']->value, ENT_QUOTES, 'UTF-8');?>
"/>
    <input type="hidden" id="cart_rule_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart_url']->value, ENT_QUOTES, 'UTF-8');?>
"/>
<?php }
}
}

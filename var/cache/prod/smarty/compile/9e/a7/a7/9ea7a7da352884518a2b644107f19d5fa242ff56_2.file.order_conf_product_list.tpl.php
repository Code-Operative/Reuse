<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:52:30
  from '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/front/emails/order_conf_product_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6036925ebc0a30_41714137',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ea7a7da352884518a2b644107f19d5fa242ff56' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/front/emails/order_conf_product_list.tpl',
      1 => 1613588115,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6036925ebc0a30_41714137 (Smarty_Internal_Template $_smarty_tpl) {
?><font size="2" face="Open-sans, sans-serif" color="#555454">
    <table class="table table-recap" bgcolor="#ffffff" style="width:100%;border-collapse:collapse"><!-- Title -->
        <thead>
            <tr>
                <th style="border:1px solid #D6D4D4;background-color:#fbfbfb;font-family:Arial;color:#333;font-size:13px;padding:10px"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reference','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</th>
                <th style="border:1px solid #D6D4D4;background-color:#fbfbfb;font-family:Arial;color:#333;font-size:13px;padding:10px"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</th>
                <th style="border:1px solid #D6D4D4;background-color:#fbfbfb;font-family:Arial;color:#333;font-size:13px;padding:10px"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit price','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</th>
                <th style="border:1px solid #D6D4D4;background-color:#fbfbfb;font-family:Arial;color:#333;font-size:13px;padding:10px"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</th>
                <th style="border:1px solid #D6D4D4;background-color:#fbfbfb;font-family:Arial;color:#333;font-size:13px;padding:10px"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total price','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_html_vars']->value['products'], 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
                <tr>
                    <td style="border:1px solid #D6D4D4;">
                        <table class="table">
                            <tr>
                                <td width="10">&nbsp;</td>
                                <td>
                                    <font size="2" face="Open-sans, sans-serif" color="#555454">
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['reference'], ENT_QUOTES, 'UTF-8');?>

                                    </font>
                                </td>
                                <td width="10">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td style="border:1px solid #D6D4D4;">
                        <table class="table">
                            <tr>
                                <td width="10">&nbsp;</td>
                                <td>
                                    <font size="2" face="Open-sans, sans-serif" color="#555454">
                                        <strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
</strong>
                                    </font>
                                </td>
                                <td width="10">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td style="border:1px solid #D6D4D4;">
                        <table class="table">
                            <tr>
                                <td width="10">&nbsp;</td>
                                <td align="right">
                                    <font size="2" face="Open-sans, sans-serif" color="#555454">
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['unit_price'], ENT_QUOTES, 'UTF-8');?>

                                    </font>
                                </td>
                                <td width="10">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td style="border:1px solid #D6D4D4;">
                        <table class="table">
                            <tr>
                                <td width="10">&nbsp;</td>
                                <td align="right">
                                    <font size="2" face="Open-sans, sans-serif" color="#555454">
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['quantity'], ENT_QUOTES, 'UTF-8');?>

                                    </font>
                                </td>
                                <td width="10">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td style="border:1px solid #D6D4D4;">
                        <table class="table">
                            <tr>
                                <td width="10">&nbsp;</td>
                                <td align="right">
                                    <font size="2" face="Open-sans, sans-serif" color="#555454">
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price'], ENT_QUOTES, 'UTF-8');?>

                                    </font>
                                </td>
                                <td width="10">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['customization'], 'customization');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['customization']->value) {
?>
                    <tr>
                    <td colspan="2" style="border:1px solid #D6D4D4;">
                        <table class="table">
                            <tr>
                                <td width="10">&nbsp;</td>
                                <td>
                                    <font size="2" face="Open-sans, sans-serif" color="#555454">
                                        <strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
</strong><br>
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customization']->value['customization_text'], ENT_QUOTES, 'UTF-8');?>

                                    </font>
                                </td>
                                <td width="10">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td style="border:1px solid #D6D4D4;">
                        <table class="table">
                            <tr>
                                <td width="10">&nbsp;</td>
                                <td align="right">
                                    <font size="2" face="Open-sans, sans-serif" color="#555454">
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['unit_price'], ENT_QUOTES, 'UTF-8');?>

                                    </font>
                                </td>
                                <td width="10">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td style="border:1px solid #D6D4D4;">
                        <table class="table">
                            <tr>
                                <td width="10">&nbsp;</td>
                                <td align="right">
                                    <font size="2" face="Open-sans, sans-serif" color="#555454">
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customization']->value['customization_quantity'], ENT_QUOTES, 'UTF-8');?>

                                    </font>
                                </td>
                                <td width="10">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td style="border:1px solid #D6D4D4;">
                        <table class="table">
                            <tr>
                                <td width="10">&nbsp;</td>
                                <td align="right">
                                    <font size="2" face="Open-sans, sans-serif" color="#555454">
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customization']->value['quantity'], ENT_QUOTES, 'UTF-8');?>

                                    </font>
                                </td>
                                <td width="10">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <tr class="conf_body">
                <td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;color:#333;padding:7px 0">
                    <table class="table" style="width:100%;border-collapse:collapse">
                        <tr>
                            <td width="10" style="color:#333;padding:0">&nbsp;</td>
                            <td align="right" style="color:#333;padding:0">
                                <font size="2" face="Open-sans, sans-serif" color="#555454">
                                    <strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total paid','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</strong>
                                </font>
                            </td>
                            <td width="10" style="color:#333;padding:0">&nbsp;</td>
                        </tr>
                    </table>
                </td>
                <td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;color:#333;padding:7px 0">
                    <table class="table" style="width:100%;border-collapse:collapse">
                        <tr>
                            <td width="10" style="color:#333;padding:0">&nbsp;</td>
                            <td align="right" style="color:#333;padding:0">
                                <font size="4" face="Open-sans, sans-serif" color="#555454">
                                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_html_vars']->value['total_paid'], ENT_QUOTES, 'UTF-8');?>

                                </font>
                            </td>
                            <td width="10" style="color:#333;padding:0">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</font>
<?php }
}

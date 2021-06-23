<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 20:57:48
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/helper/list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608b0fbcbe9e50_06390763',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '59147e3471c7882ea35cb20648b390dc8b11e310' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/helper/list.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608b0fbcbe9e50_06390763 (Smarty_Internal_Template $_smarty_tpl) {
if (is_array($_smarty_tpl->tpl_vars['table_content']->value) && count($_smarty_tpl->tpl_vars['table_content']->value) > 0) {?>
<div class="kb-panel">
    <div id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['table_id']->value, ENT_QUOTES, 'UTF-8');?>
-panel-body" class='kb-panel-table-body' style="overflow-x:auto; overflow-y:hidden; position:relative;">
        <table class="kb-table-list">
            <thead>
                <tr class="heading-row">
                    <?php if ($_smarty_tpl->tpl_vars['table_enable_multiaction']->value) {?>
                        <th class="kb-tcenter" width="60px">
                            <input type="checkbox" class="kb_list_row_checkbox"  onclick="multiactionCheck(this);"/>
                        </th>   
                    <?php }?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['table_header']->value, 'kb_tb_h');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['kb_tb_h']->value) {
?>
                        <th <?php if (isset($_smarty_tpl->tpl_vars['kb_tb_h']->value['width'])) {?>width="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['kb_tb_h']->value['width']), ENT_QUOTES, 'UTF-8');?>
px"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kb_tb_h']->value['label'], ENT_QUOTES, 'UTF-8');?>
</th>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </tr>
            </thead>
            <tbody id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['table_id']->value, ENT_QUOTES, 'UTF-8');?>
_body">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['table_content']->value, 'row', false, 'product_id');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_id']->value => $_smarty_tpl->tpl_vars['row']->value) {
?>
                <tr>
                    <?php if ($_smarty_tpl->tpl_vars['table_enable_multiaction']->value) {?>
                        <td class="kb-tcenter">
                            <input type="checkbox" class="kb_list_row_checkbox" name="row_item_id[]" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['product_id']->value), ENT_QUOTES, 'UTF-8');?>
" title="" />
                        </td>
                    <?php }?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['row']->value, 'cell');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cell']->value) {
?>
                        <td 
                            class="<?php if (isset($_smarty_tpl->tpl_vars['cell']->value['class'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['class'], ENT_QUOTES, 'UTF-8');
}?> <?php if (isset($_smarty_tpl->tpl_vars['cell']->value['align'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['align'], ENT_QUOTES, 'UTF-8');
}?>"
                        >
                            <?php if (isset($_smarty_tpl->tpl_vars['cell']->value['input'])) {?>
                                <?php if ($_smarty_tpl->tpl_vars['cell']->value['input']['type'] == 'checkbox') {?>
                                    
                                <?php } elseif ($_smarty_tpl->tpl_vars['cell']->value['input']['type'] == 'radio') {?>
                                    <input type="radio" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['input']['name'], ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['value'], ENT_QUOTES, 'UTF-8');?>
" <?php if (isset($_smarty_tpl->tpl_vars['cell']->value['input']['title'])) {?>title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['input']['title'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> />
                                <?php } elseif ($_smarty_tpl->tpl_vars['cell']->value['input']['type'] == 'text') {?>
                                    <input type="text" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['input']['name'], ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['value'], ENT_QUOTES, 'UTF-8');?>
" <?php if (isset($_smarty_tpl->tpl_vars['cell']->value['input']['title'])) {?>title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['input']['title'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> />
                                <?php } elseif ($_smarty_tpl->tpl_vars['cell']->value['input']['type'] == 'textarea') {?>
                                    <textarea name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['input']['name'], ENT_QUOTES, 'UTF-8');?>
" <?php if (isset($_smarty_tpl->tpl_vars['cell']->value['input']['title'])) {?>title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['input']['title'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['cell']->value['value'];?>
</textarea>
                                <?php } elseif ($_smarty_tpl->tpl_vars['cell']->value['input']['type'] == 'action') {?>
                                    <?php if (isset($_smarty_tpl->tpl_vars['cell']->value['actions']) && count($_smarty_tpl->tpl_vars['cell']->value['actions']) > 0) {?>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cell']->value['actions'], 'action');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['action']->value) {
?>
                                            <?php if (isset($_smarty_tpl->tpl_vars['action']->value['type']) && $_smarty_tpl->tpl_vars['action']->value['type'] == 'delete') {?>
                                                <a 
                                                    class="kb_list_action <?php if (isset($_smarty_tpl->tpl_vars['action']->value['class']) && $_smarty_tpl->tpl_vars['action']->value['class'] != '') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['class'], ENT_QUOTES, 'UTF-8');
}?>" 
                                                    href="javascript:void(0)"
                                                    data-href="<?php if (isset($_smarty_tpl->tpl_vars['action']->value['href'])) {
echo $_smarty_tpl->tpl_vars['action']->value['href'];
} else {
}?>"  
                                                    title="<?php if (isset($_smarty_tpl->tpl_vars['action']->value['title'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['title'], ENT_QUOTES, 'UTF-8');
}?>" 
                                                    onclick="actionDeleteConfirmation(this);" 
                                                    <?php if (isset($_smarty_tpl->tpl_vars['action']->value['target']) && $_smarty_tpl->tpl_vars['action']->value['target'] != '') {?>target="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['target'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                                ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a> 
                                            <?php } elseif (isset($_smarty_tpl->tpl_vars['action']->value['type']) && $_smarty_tpl->tpl_vars['action']->value['type'] == 'edit') {?>
                                                <a 
                                                    class="kb_list_action <?php if (isset($_smarty_tpl->tpl_vars['action']->value['class']) && $_smarty_tpl->tpl_vars['action']->value['class'] != '') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['class'], ENT_QUOTES, 'UTF-8');
}?>" 
                                                    href="<?php if (isset($_smarty_tpl->tpl_vars['action']->value['href'])) {
echo $_smarty_tpl->tpl_vars['action']->value['href'];
} else { ?>javascript:void(0)<?php }?>" 
                                                    title="<?php if (isset($_smarty_tpl->tpl_vars['action']->value['title'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['title'], ENT_QUOTES, 'UTF-8');
}?>" 
                                                    <?php if (isset($_smarty_tpl->tpl_vars['action']->value['function'])) {?>onclick="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['function'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                                    <?php if (isset($_smarty_tpl->tpl_vars['action']->value['target']) && $_smarty_tpl->tpl_vars['action']->value['target'] != '') {?>target="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['target'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                                ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>  
                                            <?php } elseif (isset($_smarty_tpl->tpl_vars['action']->value['type']) && $_smarty_tpl->tpl_vars['action']->value['type'] == 'view') {?>
                                                <a 
                                                    class="kb_list_action <?php if (isset($_smarty_tpl->tpl_vars['action']->value['class']) && $_smarty_tpl->tpl_vars['action']->value['class'] != '') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['class'], ENT_QUOTES, 'UTF-8');
}?>" 
                                                    href="<?php if (isset($_smarty_tpl->tpl_vars['action']->value['href'])) {
echo $_smarty_tpl->tpl_vars['action']->value['href'];
} else { ?>javascript:void(0)<?php }?>" 
                                                    title="<?php if (isset($_smarty_tpl->tpl_vars['action']->value['title'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['title'], ENT_QUOTES, 'UTF-8');
}?>"
                                                    <?php if (isset($_smarty_tpl->tpl_vars['action']->value['function'])) {?>onclick="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['function'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                                    <?php if (isset($_smarty_tpl->tpl_vars['action']->value['target']) && $_smarty_tpl->tpl_vars['action']->value['target'] != '') {?>target="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['target'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                                ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>  
                                            <?php } elseif (isset($_smarty_tpl->tpl_vars['action']->value['type']) && $_smarty_tpl->tpl_vars['action']->value['type'] == 'extra') {?>
                                                <a 
                                                    class="kb_list_action <?php if (isset($_smarty_tpl->tpl_vars['action']->value['class']) && $_smarty_tpl->tpl_vars['action']->value['class'] != '') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['class'], ENT_QUOTES, 'UTF-8');
}?>" 
                                                    href="<?php if (isset($_smarty_tpl->tpl_vars['action']->value['href'])) {
echo $_smarty_tpl->tpl_vars['action']->value['href'];
} else { ?>javascript:void(0)<?php }?>" 
                                                    title="<?php if (isset($_smarty_tpl->tpl_vars['action']->value['title'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['title'], ENT_QUOTES, 'UTF-8');
}?>"
                                                    <?php if (isset($_smarty_tpl->tpl_vars['action']->value['function'])) {?>onclick="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['function'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                                    <?php if (isset($_smarty_tpl->tpl_vars['action']->value['target']) && $_smarty_tpl->tpl_vars['action']->value['target'] != '') {?>target="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['target'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                                ><?php if (isset($_smarty_tpl->tpl_vars['action']->value['label'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['label'], ENT_QUOTES, 'UTF-8');
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Extra','mod'=>'kbmarketplace'),$_smarty_tpl ) );
}?></a> 
                                            <?php }?>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    <?php } else { ?>
                                        --
                                    <?php }?>
                                <?php }?>
                                                            <?php } elseif (isset($_smarty_tpl->tpl_vars['cell']->value['image'])) {?>
                                <?php if ($_smarty_tpl->tpl_vars['cell']->value['value'] != '') {?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['cell']->value['value'];?>
" style="height:75px;width:75px;"/>                                <?php } else { ?>

                                <?php }?>                            
                                                            
                            <?php } elseif (isset($_smarty_tpl->tpl_vars['cell']->value['link'])) {?>
                                <a 
                                    href="<?php if (isset($_smarty_tpl->tpl_vars['cell']->value['link']['href'])) {
echo $_smarty_tpl->tpl_vars['cell']->value['link']['href'];
} else { ?>javascript:void(0)<?php }?>" 
                                    title="<?php if (isset($_smarty_tpl->tpl_vars['cell']->value['link']['title'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['link']['title'], ENT_QUOTES, 'UTF-8');
}?>"
                                    <?php if (isset($_smarty_tpl->tpl_vars['cell']->value['link']['function'])) {?>onclick="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['link']['function'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                    <?php if (isset($_smarty_tpl->tpl_vars['cell']->value['link']['target']) && $_smarty_tpl->tpl_vars['cell']->value['link']['target'] != '') {?>target="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cell']->value['link']['target'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                ><?php echo $_smarty_tpl->tpl_vars['cell']->value['value'];?>
</a> 
                                <?php } elseif (isset($_smarty_tpl->tpl_vars['cell']->value['actions'])) {?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cell']->value['actions'], 'action');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['action']->value) {
?>
                                        <a href='<?php if (isset($_smarty_tpl->tpl_vars['action']->value['href'])) {
echo $_smarty_tpl->tpl_vars['action']->value['href'];
} else { ?>javascript:void(0)<?php }?>'
                                            title="<?php if (isset($_smarty_tpl->tpl_vars['action']->value['title'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['title'], ENT_QUOTES, 'UTF-8');
}?>" 
                                            <?php if (isset($_smarty_tpl->tpl_vars['action']->value['function'])) {?>onclick="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['function'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                            <?php if (isset($_smarty_tpl->tpl_vars['action']->value['target']) && $_smarty_tpl->tpl_vars['action']->value['target'] != '') {?>target="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value['target'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                            class='btn btn-default kb-multiaction-link'><i class='kb-material-icons kb-multiaction-icon' ><?php if (isset($_smarty_tpl->tpl_vars['action']->value['icon-class'])) {
echo $_smarty_tpl->tpl_vars['action']->value['icon-class'];
}?></i>
                                        </a>  
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    
                            <?php } else { ?>
                                <?php echo $_smarty_tpl->tpl_vars['cell']->value['value'];?>
   
                            <?php }?>
                        </td>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>
        <div class="kb-paginator-block">
            <?php if ($_smarty_tpl->tpl_vars['kb_pagination']->value) {?>
                <?php echo $_smarty_tpl->tpl_vars['kb_pagination']->value;?>
  
            <?php }?>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <img id="kb-list-loader" src="<?php echo $_smarty_tpl->tpl_vars['kb_image_path']->value;?>
loader128.gif" /> 
    </div>
</div>
<?php } else { ?>
    <div class="kb-panel">
        <div class="kbalert kbalert-warning" style="display: block; margin:0;">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'List is empty','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

        </div>
    </div>
<?php }?>
<style>
    .kb-multiaction-link {
        border: none !important;
        padding: 2px 6px !important;
    }
</style>
<?php }
}

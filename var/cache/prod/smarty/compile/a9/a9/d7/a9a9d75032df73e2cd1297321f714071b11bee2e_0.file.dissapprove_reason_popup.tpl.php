<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:50:17
  from '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/admin/dissapprove_reason_popup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_603691d95765e7_67284777',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9a9d75032df73e2cd1297321f714071b11bee2e' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/admin/dissapprove_reason_popup.tpl',
      1 => 1613588115,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603691d95765e7_67284777 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="marketplace-reason-modal" class="bootstrap" style='display:none; width:400px'>
    <div class="panel form-horizontal">
        <div id='kb-reason-error'></div>
        <div class="panel-heading">
                <i class="icon-comment"></i> <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['pop_heading']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

        </div>
        <div class="panel-heading">
            
            <form id='kb-reason-form' method='post' action=''>
                <div class="form-group">
                    <div class="col-lg-12">
                        <textarea class="form-control" id="marketplace_reason_comment" name="marketplace_reason_comment" rows="5"></textarea>
                        <span class="help-block"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['min_length_msg']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-success" onclick='actionDissapprove()'><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['pop_action_label']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</button>
                    </div>
                </div>    
            </form>
            
        </div>
    </div>
</div>
<?php echo '<script'; ?>
 type='text/javascript'>
    var reason_min_length = <?php echo intval($_smarty_tpl->tpl_vars['reson_min_length']->value);?>

    var reason_min_length_msg = "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reason_min_length_error']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
";
    var empty_field_error = "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['empty_field_error']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
";
<?php echo '</script'; ?>
>
<?php }
}

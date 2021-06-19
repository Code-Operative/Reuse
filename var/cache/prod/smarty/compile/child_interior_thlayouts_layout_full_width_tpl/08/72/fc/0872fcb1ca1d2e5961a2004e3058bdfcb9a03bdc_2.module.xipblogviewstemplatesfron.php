<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-17 23:05:18
  from 'module:xipblogviewstemplatesfron' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60cbc71e280717_06702702',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0872fcb1ca1d2e5961a2004e3058bdfcb9a03bdc' => 
    array (
      0 => 'module:xipblogviewstemplatesfron',
      1 => 1619255004,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60cbc71e280717_06702702 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="comment_respond clearfix m_bottom_50" id="respond">
    <h3 class="comment_reply_title" id="reply-title">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Leave a reply','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>

        <small>
            <a href="/wp_showcase/wp-supershot/?p=38#respond" id="cancel-comment-reply-link" rel="nofollow" style="display:none;">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel reply','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>

            </a>
        </small>
    </h3>
    <form class="comment_form" action="" method="post" id="xipblogs_commentfrom" role="form" data-toggle="validator">
    	<div class="form-group xipblogs_message"></div>
    	<div class="form-group xipblog_name_parent">
    	  <label for="xipblog_name"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your name:','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
</label>
    	  <input type="text"  id="xipblog_name" name="xipblog_name" class="form-control xipblog_name" required>
    	</div>
    	<div class="form-group xipblog_email_parent">
    	  <label for="xipblog_email"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your Email:','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
</label>
    	  <input type="email"  id="xipblog_email" name="xipblog_email" class="form-control xipblog_email" required>
    	</div>
    	<div class="form-group xipblog_website_parent">
    	  <label for="xipblog_website"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Website Url:','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
</label>
    	  <input type="url"  id="xipblog_website" name="xipblog_website" class="form-control xipblog_website">
    	</div>
    	<div class="form-group xipblog_subject_parent">
    	  <label for="xipblog_subject"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Subject:','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
</label>
    	  <input type="text"  id="xipblog_subject" name="xipblog_subject" class="form-control xipblog_subject" required>
    	</div>
    	<div class="form-group xipblog_content_parent">
    	  <label for="xipblog_content"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Comment:','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
</label>
    	  <textarea rows="15" cols="" id="xipblog_content" name="xipblog_content" class="form-control xipblog_content" required></textarea>
    	</div>
    	<input type="hidden" class="xipblog_id_parent" id="xipblog_id_parent" name="xipblog_id_parent" value="0">
    	<input type="hidden" class="xipblog_id_post" id="xipblog_id_post" name="xipblog_id_post" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblogpost']->value['id_xipposts'], ENT_QUOTES, 'UTF-8');?>
">
    	<input type="submit" class="btn btn-default pull-left xipblog_submit_btn" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send comment','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
">
    </form>
</div>
<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['xipblog_js'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['xipblog_js'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'xipblog_js'))) {
throw new SmartyException('block tag \'xipblog_js\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('xipblog_js', array('name'=>"single_comment_form"));
$_block_repeat=true;
echo $_block_plugin1->xipblog_js(array('name'=>"single_comment_form"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo '<script'; ?>
 type="text/javascript">
// disabled
var successMessage = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Successfully comment added','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
";
var errorMessage = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Something wrong! please try again','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
";
var waitText = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please wait...','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
";
var submitButton = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send comment','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
";
$('.xipblog_submit_btn').on("click",function(e) {
	e.preventDefault();
	if(!$(this).hasClass("disabled")){
		var data = new Object();
		$('[id^="xipblog_"]').each(function()
		{
			id = $(this).prop("id").replace("xipblog_", "");
			id = $(this).prop("id").replace("xipblog_", "");
			data[id] = $(this).val();
		});
		function logErrprMessage(element, index, array) {
		  $('.xipblogs_message').append('<span class="xipblogs_error">'+errorMessage+'</span>');
		}
		function xipremove() {
		  $('.xipblogs_error').remove();
		  $('.xipblogs_success').remove();
		}
		function logSuccessMessage(element, index, array) {
		  $('.xipblogs_message').append('<span class="xipblogs_success alert alert-success">'+successMessage+'</span>');
		}
		$.ajax({
			url: xprt_base_dir + 'modules/xipblog/ajax.php',
			data: data,
			type:'post',
			dataType: 'json',
			beforeSend: function(){
				xipremove();
				$(".xipblog_submit_btn").val(waitText);
				$(".xipblog_submit_btn").addClass("disabled");
			},
			complete: function(){
				$(".xipblog_submit_btn").val(submitButton);
				$(".xipblog_submit_btn").removeClass("disabled");
			},
			success: function(data){
				xipremove();
				if(typeof data.success != 'undefined'){
					data.success.forEach(logSuccessMessage);
				}
				if(typeof data.error != 'undefined'){
					data.error.forEach(logErrprMessage);
				}
			},
			error: function(data){
				xipremove();
				$('.xipblogs_message').append('<span class="error">'+errorMessage+'</span>');
			},
		});	
	}
});
<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin1->xipblog_js(array('name'=>"single_comment_form"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

<?php }
}

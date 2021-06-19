<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-18 02:15:52
  from '/home/codeoperativeco/public_html/modules/postcodecheck/views/templates/front/postcodecheck.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60cbf3c8c37285_70642744',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2ad7fb2554fd274e73e709dece3edea0663ec2b' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/postcodecheck/views/templates/front/postcodecheck.tpl',
      1 => 1621403190,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60cbf3c8c37285_70642744 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="postcodecheck" data-postcodecheck-controller-url="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['postcodecheck_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
">
	<span class="postcode-label">Postcode</span>
	<div class="postcode-container clearfix">
		<div class="">
			<div class="postcode-input">
				<input type="hidden" id="seller_id1" name="seller_id1" value="">
				<input type="hidden" id="product_id" name="product_id" value="">
				<input
					class="postcode-input input-group form-control"
					type="text"
					id="postcode-input"
					name="postcode"
					placeholder="Please enter your full postcode here e.g. NE13 4JK"
					aria-label="Postcode"
					value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['postcode_string']->value, ENT_QUOTES, 'UTF-8');?>
"
					pattern="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['regExPostCode']->value, ENT_QUOTES, 'UTF-8');?>
"
					>
			</div>
		</div>
		<div class="product-actions">
			<button
				class="postcode-button btn btn-warning"
				id="postcode-button"
				type="submit"
				>
			Check Postcode
			</button>
		</div>
		<div class"" type="hidde" id="postcodecheck_result"></div>
		<div class="postcode-message-container">
			<img id="postcode_img" class="postcode_img"></img>
			<div id="postcode_message" class="postcode_message"></div>
		</div>
	</div>
</div>
<?php }
}

<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-28 21:17:47
  from '/home/codeoperativeco/public_html/modules/postcodecheck/views/templates/front/collectiononly.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6089c2eb0d4244_98828811',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '015b34f2f9a9abb55bb66ab6175b604c2f9248e8' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/postcodecheck/views/templates/front/collectiononly.tpl',
      1 => 1619254988,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6089c2eb0d4244_98828811 (Smarty_Internal_Template $_smarty_tpl) {
?><div>
  <div class="collection-only-text"> This item is for collection only </div>
  <button
    class="postcode-button btn btn-warning"
    id="check-collection-distance-button"
    >
  Check distance to collect.
  </button>
</div>

<div style="display: none;" id="postcodecheck" data-postcodecheck-controller-url="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['postcodecheck_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
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
		<div class"" hidden id="postcodecheck_result">
		</div>
	</div>
</div><?php }
}

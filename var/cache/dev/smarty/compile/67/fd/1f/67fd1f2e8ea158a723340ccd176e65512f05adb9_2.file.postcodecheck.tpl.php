<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-20 10:15:24
  from '/home/codeoperativeco/prestaoperative/modules/postcodecheck/views/templates/hook/postcodecheck.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6055cb3ce99191_83839640',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '67fd1f2e8ea158a723340ccd176e65512f05adb9' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/modules/postcodecheck/views/templates/hook/postcodecheck.tpl',
      1 => 1616235282,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6055cb3ce99191_83839640 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Trigger/Open The Modal -->
<button id="myBtn">Open Modal</button>

<!-- The Modal -->
<div id="myModalPostCode" class="modal-postcode">

  <!-- Modal content -->
  <div class="modal-postcode-content">
    <span class="close">&times;</span>
    <div id="postcodecheck" data-postcodecheck-controller-url="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['postcodecheck_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
">
      <form method="post" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['postcodecheck_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
">
        <input type="hidden" name="controller" value="">
        <input type="hidden" id="seller_id1" name="seller_id1" value="">
        <input type="text" name="buyer_postcode" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['postcode_string']->value, ENT_QUOTES, 'UTF-8');?>
">
        <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['my_module_message']->value, ENT_QUOTES, 'UTF-8');?>
</p>
        <button type="submit">
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Block mymodule -->
<div id="mymodule_block_home" class="block">
  <div class="block_content">
    <p>My response: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['my_module_message']->value, ENT_QUOTES, 'UTF-8');?>

    </p>
    <!--<ul>
      <li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['my_module_link']->value, ENT_QUOTES, 'UTF-8');?>
" title="Click this link">Click me!</a></li>
    </ul>-->
  </div>
</div>
<!--/Block mymodule --><?php }
}

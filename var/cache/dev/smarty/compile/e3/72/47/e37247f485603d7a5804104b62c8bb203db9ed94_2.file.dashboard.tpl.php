<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-02 14:20:46
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608ea72e06eb17_33204094',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e37247f485603d7a5804104b62c8bb203db9ed94' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/dashboard.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608ea72e06eb17_33204094 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
    var kb_total_revenue_label = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Revenue','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    var kb_seller_revenue_label = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your Revenue','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    var kb_admin_revenue_label = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Admin Revenue','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    var kb_total_order_label = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Orders','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    var kb_product_sold_label = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product Sold','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
<?php echo '</script'; ?>
>
<div class="kb-block kb-panel">
    <div class="kb-content">
        <div class="kb-content-header">
            <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Dashboard','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h1>
            <div class="clearfix"></div>
        </div>
        <div class='outer-border'>
            <ul class='summary-list-group'>
                <li class='summary-box blue-summary'>
                    <div class="summary-single-box">
                        <div class="mo_kpi_content big">
                                <i class="big kb-material-icons">&#xe263;</i>
                                <span class="big-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Sale','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                <span class="big-value"><?php echo htmlspecialchars(Tools::displayPrice($_smarty_tpl->tpl_vars['total_revenue']->value), ENT_QUOTES, 'UTF-8');?>
</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li class='summary-box purple-summary'>
                    <div class="summary-single-box">
                        <div class="mo_kpi_content big">
                                <i class="big kb-material-icons">&#xe048;</i>
                                <span class="big-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Earning','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                <span class="big-value"><?php echo htmlspecialchars(Tools::displayPrice($_smarty_tpl->tpl_vars['total_earning']->value), ENT_QUOTES, 'UTF-8');?>
</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li class='summary-box green-summary'>
                    <div class="summary-single-box">
                        <div class="mo_kpi_content big">
                                <i class="big kb-material-icons">&#xe8d0;</i>
                                <span class="big-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Orders','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                <span class="big-value"><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['total_orders']->value), ENT_QUOTES, 'UTF-8');?>
</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li class='summary-box yellow-summary'>
                    <div class="summary-single-box">
                        <div class="mo_kpi_content big">
                                <i class="big kb-material-icons">&#xe54c;</i>
                                <span class="big-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Products Sold','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                <span class="big-value"><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['total_sold_products']->value), ENT_QUOTES, 'UTF-8');?>
</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </li>
            </ul>
        </div>
        <div class="kb-vspacer5"></div>
        <div class="kb-panel outer-border">
            <?php echo '<script'; ?>
 type="text/javascript">
                var kb_graph_revenue_label = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your Revenue','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
                var kb_graph_orders_label = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Orders','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
                var kb_graph_products_label = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Products Sold','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
            <?php echo '</script'; ?>
>
            <div class='kb-panel-header kb-sale-stat-tab'>
                <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sales Statistics','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h1>
                <span class="link" style="display:none;">
                    <select name="sales_statistics_type" onchange="displaySalesGraph(this)">
                        <option value="last_7_days"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last 7 Days','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <option value="week"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This Week','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <option value="month"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This Month','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <option value="year"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This Year','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                    </select>
                </span>
                <div class='clearfix'></div>
            </div>
            <div id="kb_seller_sales_graph_container" class='kb-panel-body kb-content'>
                <div class="loader128"></div>
                <div class="kb_graph_area" style="width:100%;">
                    <div id="kb_graph_legend_holder" class="kb_graph_legend_container"></div>
                    <div id="kb_seller_sales_graph" style="width:100%; height:300px" class="kb_graph_container"></div>
                </div>
            </div>
        </div>
        <div class="kb-vspacer5"></div>
        <div class="kb-panel outer-border">
            <div data-toggle="comaprison-panel-body" class='kb-panel-header kb-panel-header-tab'>
                <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sales Comparison','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h1>
                <div  class='kb-accordian-symbol kbexpand'></div>
                <div class='clearfix'></div>
            </div>
            <div id="comaprison-panel-body" class='kb-panel-body'>
                <ul class="tbl-list-group">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sale_variation_report']->value, 'report');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['report']->value) {
?>
                        <li class="tbl-list">
                            <table class="dh-tbl-smmry">
                                <thead>
                                    <tr>
                                        <th colspan="3"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['title'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Orders','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</td>
                                        <td class="kb-tright"><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['report']->value['data']['order']['current']), ENT_QUOTES, 'UTF-8');?>
</td>
                                        <td class="kb-tright">
                                            <div class="kb-analysis-popper">
                                                <?php if ($_smarty_tpl->tpl_vars['report']->value['data']['order']['diff'] < 0) {?>
                                                    <span class="kb-negative-sign">▼ <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['data']['order']['diff_percent'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
%</span>
                                                <?php } elseif ($_smarty_tpl->tpl_vars['report']->value['data']['order']['diff'] > 0) {?>
                                                    <span class="kb-positive-sign">▲ <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['data']['order']['diff_percent'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
%</span>
                                                <?php } else { ?>
                                                    <span class=""><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['data']['order']['diff_percent'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
%</span>
                                                <?php }?>
                                                <div class="kb-popper-info">
                                                    <b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['curent_title'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
: </b><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['report']->value['data']['order']['current']), ENT_QUOTES, 'UTF-8');?>
<br>
                                                    <b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['prev_title'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
: </b><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['report']->value['data']['order']['previous']), ENT_QUOTES, 'UTF-8');?>

                                                </div>    
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Earning','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</td>
                                        <td class="kb-tright"><?php echo htmlspecialchars(Tools::displayPrice($_smarty_tpl->tpl_vars['report']->value['data']['revenue']['current']), ENT_QUOTES, 'UTF-8');?>
</td>
                                        <td class="kb-tright">
                                            <div class="kb-analysis-popper">
                                                <?php if ($_smarty_tpl->tpl_vars['report']->value['data']['revenue']['diff'] < 0) {?>
                                                    <span class="kb-negative-sign">▼ <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['data']['revenue']['diff_percent'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
%</span>
                                                <?php } elseif ($_smarty_tpl->tpl_vars['report']->value['data']['revenue']['diff'] > 0) {?>
                                                    <span class="kb-positive-sign">▲ <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['data']['revenue']['diff_percent'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
%</span>
                                                <?php } else { ?>
                                                    <span class=""><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['data']['revenue']['diff_percent'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
%</span>
                                                <?php }?>
                                                <div class="kb-popper-info">
                                                    <b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['curent_title'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
: </b><?php echo htmlspecialchars(Tools::displayPrice($_smarty_tpl->tpl_vars['report']->value['data']['revenue']['current']), ENT_QUOTES, 'UTF-8');?>
<br>
                                                    <b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['prev_title'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
: </b><?php echo htmlspecialchars(Tools::displayPrice($_smarty_tpl->tpl_vars['report']->value['data']['revenue']['previous']), ENT_QUOTES, 'UTF-8');?>

                                                </div>    
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product Sold','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</td>
                                        <td class="kb-tright"><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['report']->value['data']['ordered_qty']['current']), ENT_QUOTES, 'UTF-8');?>
</td>
                                        <td class="kb-tright">
                                            <div class="kb-analysis-popper">
                                                <?php if ($_smarty_tpl->tpl_vars['report']->value['data']['ordered_qty']['diff'] < 0) {?>
                                                    <span class="kb-negative-sign">▼ <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['data']['ordered_qty']['diff_percent'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
%</span>
                                                <?php } elseif ($_smarty_tpl->tpl_vars['report']->value['data']['ordered_qty']['diff'] > 0) {?>
                                                    <span class="kb-positive-sign">▲ <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['data']['ordered_qty']['diff_percent'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
%</span>
                                                <?php } else { ?>
                                                    <span class=""><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['data']['ordered_qty']['diff_percent'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
%</span>
                                                <?php }?>
                                                <div class="kb-popper-info">
                                                    <b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['curent_title'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
: </b><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['report']->value['data']['ordered_qty']['current']), ENT_QUOTES, 'UTF-8');?>
<br>
                                                    <b><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['report']->value['prev_title'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
: </b><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['report']->value['data']['ordered_qty']['previous']), ENT_QUOTES, 'UTF-8');?>

                                                </div>    
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </li>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>    
            </div>
        </div>
        <div class="kb-vspacer5"></div>
        <div class="kb-panel outer-border">
            <div data-toggle="orderlist-panel-body" class='kb-panel-header kb-panel-header-tab'>
                <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last 10 Orders','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h1>
                <div data-toggle="orderlist-panel-body" class='kb-accordian-symbol kbexpand'></div>
                <span class='link'><a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('kbmarketplace','order',array(),(bool)Configuration::get('PS_SSL_ENABLED')),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View All','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a></span>
                <div class='clearfix'></div>
            </div>
            <div id="orderlist-panel-body" class='kb-panel-body' style="overflow-x:auto;">
                <table class="kb-table-list">
                    <thead>
                        <tr class="heading-row">
                            <th width="100"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reference','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</th>
                            <th width="90"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order Date','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</th>
                            <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customer Name','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</th>
                            <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customer Email','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</th>
                            <th width="50"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Qty','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</th>
                            <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</th>
                            <th width="80"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order Total','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($_smarty_tpl->tpl_vars['orders']->value) > 0) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['orders']->value, 'order');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['order']->value) {
?>
                                <tr>                        
                                    <td class="kb-tright"><a target="_blank" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['view_link'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click to view order','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['reference'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</a></td>
                                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['order']->value['order_date'],'full'=>0),$_smarty_tpl ) );?>
</td>
                                    <td><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['customer_name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</td>
                                    <td><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['email'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</td>
                                    <td class="kb-tright"><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['order']->value['qty']), ENT_QUOTES, 'UTF-8');?>
</td>
                                    <td><?php if (count($_smarty_tpl->tpl_vars['order']->value['status'])) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['status']['name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?></td>
                                    <td class="kb-tright"><?php echo htmlspecialchars(Tools::displayPrice($_smarty_tpl->tpl_vars['order']->value['total']), ENT_QUOTES, 'UTF-8');?>
</td>
                                </tr>        
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php } else { ?>
                            <tr><td colspan="7" class="kb-tcenter kb-empty-table"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There are no order found','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</td></tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayKbMarketPlaceSellerDashboard"),$_smarty_tpl ) );?>

    </div>
</div>
<?php }
}

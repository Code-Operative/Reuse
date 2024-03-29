<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* __string_template__22d0d4853593d225d3ec44f9eaee806737d619fe40d8a33b91a3542340d41ebf */
class __TwigTemplate_b476d32b657f266d89459c4589be4167361aa1c0cd6f689c689fdad6c2f1d818 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'extra_stylesheets' => [$this, 'block_extra_stylesheets'],
            'content_header' => [$this, 'block_content_header'],
            'content' => [$this, 'block_content'],
            'content_footer' => [$this, 'block_content_footer'],
            'sidebar_right' => [$this, 'block_sidebar_right'],
            'javascripts' => [$this, 'block_javascripts'],
            'extra_javascripts' => [$this, 'block_extra_javascripts'],
            'translate_javascripts' => [$this, 'block_translate_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"gb\">
<head>
  <meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
<meta name=\"robots\" content=\"NOFOLLOW, NOINDEX\">

<link rel=\"icon\" type=\"image/x-icon\" href=\"/img/favicon.ico\" />
<link rel=\"apple-touch-icon\" href=\"/img/app_icon.png\" />

<title>Customers • The Reuse Network</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminCustomerPreferences';
    var iso_user = 'gb';
    var lang_is_rtl = '0';
    var full_language_code = 'en-gb';
    var full_cldr_language_code = 'en-GB';
    var country_iso_code = 'GB';
    var _PS_VERSION_ = '1.7.7.1';
    var roundMode = 2;
    var youEditFieldFor = '';
        var new_order_msg = 'A new order has been placed in your shop.';
    var order_number_msg = 'Order number: ';
    var total_msg = 'Total ';
    var from_msg = 'From: ';
    var see_order_msg = 'View this order';
    var new_customer_msg = 'A new customer has registered in your shop.';
    var customer_name_msg = 'Customer name: ';
    var new_msg = 'A new message was posted on your shop.';
    var see_msg = 'Read this message';
    var token = '8c2f1e26c329ed1eb2fc1c4c4bb0f0db';
    var token_admin_orders = '8873a66ac09f9fd41b264b413bbe0bc2';
    var token_admin_customers = 'f1412b2cb7874c67487c17870eb0c732';
    var token_admin_customer_threads = '7cb3adbc6c5b38a0fceb9563b2dfe996';
    var currentIndex = 'index.php?controller=AdminCustomerPreferences';
    var employee_token = '103eab1bce4b12bd4b4815698be7dc09';
    var choose_language_translate = 'Choose language:';
    var default_language = '2';
    var admin_modules_link = '/admin4047wicsx/index.php/improve/modules/catalog/recommended?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs';
    var admin_notification_get_link = '/admin4047wicsx/index.php/common/notifications?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs';
    var admin_notification_push_link = '/admin4047wicsx/index.php/common/notifications/ack?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs';
    var tab_modules_list = '';
    var update_success_msg = 'Update successful';
    var errorLogin = 'PrestaShop was unable to log in to Addons. Please check your credentials and your Internet connection.';
    var search_product_msg = 'Search for a product';
  </script>

      <link href=\"/admin4047wicsx/themes/new-theme/public/theme.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/js/jquery/plugins/chosen/jquery.chosen.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/js/jquery/plugins/fancybox/jquery.fancybox.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/fancyboxthumb/views/css/admin.css\" rel=\"stylesheet\" type=\"text/css\"/>
  
  <script type=\"text/javascript\">
var baseAdminDir = \"\\/admin4047wicsx\\/\";
var baseDir = \"\\/\";
var changeFormLanguageUrl = \"\\/admin4047wicsx\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\";
var currency = {\"iso_code\":\"GBP\",\"sign\":\"\\u00a3\",\"name\":\"British Pound\",\"format\":null};
var currency_specifications = {\"symbol\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"currencyCode\":\"GBP\",\"currencySymbol\":\"\\u00a3\",\"numberSymbols\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"\\u00a4#,##0.00\",\"negativePattern\":\"-\\u00a4#,##0.00\",\"maxFractionDigits\":2,\"minFractionDigits\":2,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var host_mode = false;
var number_specifications = {\"symbol\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"numberSymbols\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.###\",\"negativePattern\":\"-#,##0.###\",\"maxFractionDigits\":3,\"minFractionDigits\":0,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var prestashop = {\"debug\":false};
var show_new_customers = \"1\";
var show_new_messages = false;
var show_new_orders = \"1\";
</script>
<script type=\"text/javascript\" src=\"/admin4047wicsx/themes/new-theme/public/main.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/js/jquery/plugins/jquery.chosen.js\"></script>
<script type=\"text/javascript\" src=\"/js/jquery/plugins/fancybox/jquery.fancybox.js\"></script>
<script type=\"text/javascript\" src=\"/js/admin.js?v=1.7.7.1\"></script>
<script type=\"text/javascript\" src=\"/admin4047wicsx/themes/new-theme/public/cldr.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/js/tools.js?v=1.7.7.1\"></script>
<script type=\"text/javascript\" src=\"/admin4047wicsx/public/bundle.js\"></script>

  

";
        // line 78
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('extra_stylesheets', $context, $blocks);
        echo "</head>

<body
  class=\"lang-gb admincustomerpreferences\"
  data-base-url=\"/admin4047wicsx/index.php\"  data-token=\"eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=6366eb4673b4baa44b7d8241d6f053a2\"></a>
      <span id=\"shop_version\">1.7.7.1</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Quick Access
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item\"
         href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=0ecdeaee13d7a11ee5578dd1c125ec15\"
                 data-item=\"Catalog evaluation\"
      >Catalog evaluation</a>
          <a class=\"dropdown-item\"
         href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php/improve/modules/manage?token=40482f155a785d44caebccef5c46964b\"
                 data-item=\"Installed modules\"
      >Installed modules</a>
          <a class=\"dropdown-item\"
         href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php/sell/catalog/categories/new?token=40482f155a785d44caebccef5c46964b\"
                 data-item=\"New category\"
      >New category</a>
          <a class=\"dropdown-item\"
         href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php/sell/catalog/products/new?token=40482f155a785d44caebccef5c46964b\"
                 data-item=\"New product\"
      >New product</a>
          <a class=\"dropdown-item\"
         href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=2ccbc7abd05f0b519ed44b35bf1a61df\"
                 data-item=\"New voucher\"
      >New voucher</a>
          <a class=\"dropdown-item\"
         href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminOrders&amp;token=8873a66ac09f9fd41b264b413bbe0bc2\"
                 data-item=\"Orders\"
      >Orders</a>
        <div class=\"dropdown-divider\"></div>
          <a
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"124\"
        data-icon=\"icon-AdminParentCustomerPreferences\"
        data-method=\"add\"
        data-url=\"index.php/configure/shop/customer-preferences\"
        data-post-link=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminQuickAccesses&token=52f0c2cdd711b663030666e45409c043\"
        data-prompt-text=\"Please name this shortcut:\"
        data-link=\"Customers - List\"
      >
        <i class=\"material-icons\">add_circle</i>
        Add current page to Quick Access
      </a>
        <a class=\"dropdown-item\" href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminQuickAccesses&token=52f0c2cdd711b663030666e45409c043\">
      <i class=\"material-icons\">settings</i>
      Manage your quick accesses
    </a>
  </div>
</div>
      </div>
      <div class=\"component\" id=\"header-search-container\">
        <form id=\"header_search\"
      class=\"bo_search_form dropdown-form js-dropdown-form collapsed\"
      method=\"post\"
      action=\"/admin4047wicsx/index.php?controller=AdminSearch&amp;token=90b1fe20ea53217a7a3a1d0d6615ac01\"
      role=\"search\">
  <input type=\"hidden\" name=\"bo_search_type\" id=\"bo_search_type\" class=\"js-search-type\" />
    <div class=\"input-group\">
    <input type=\"text\" class=\"form-control js-form-search\" id=\"bo_query\" name=\"bo_query\" value=\"\" placeholder=\"Search (e.g.: product reference, customer name…) d='Admin.Navigation.Header'\">
    <div class=\"input-group-append\">
      <button type=\"button\" class=\"btn btn-outline-secondary dropdown-toggle js-dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
        Everywhere
      </button>
      <div class=\"dropdown-menu js-items-list\">
        <a class=\"dropdown-item\" data-item=\"Everywhere\" href=\"#\" data-value=\"0\" data-placeholder=\"What are you looking for?\" data-icon=\"icon-search\"><i class=\"material-icons\">search</i> Everywhere</a>
        <div class=\"dropdown-divider\"></div>
        <a class=\"dropdown-item\" data-item=\"Catalog\" href=\"#\" data-value=\"1\" data-placeholder=\"Product name, reference, etc.\" data-icon=\"icon-book\"><i class=\"material-icons\">store_mall_directory</i> Catalog</a>
        <a class=\"dropdown-item\" data-item=\"Customers by name\" href=\"#\" data-value=\"2\" data-placeholder=\"Name\" data-icon=\"icon-group\"><i class=\"material-icons\">group</i> Customers by name</a>
        <a class=\"dropdown-item\" data-item=\"Customers by IP address\" href=\"#\" data-value=\"6\" data-placeholder=\"123.45.67.89\" data-icon=\"icon-desktop\"><i class=\"material-icons\">desktop_mac</i> Customers by IP address</a>
        <a class=\"dropdown-item\" data-item=\"Orders\" href=\"#\" data-value=\"3\" data-placeholder=\"Order ID\" data-icon=\"icon-credit-card\"><i class=\"material-icons\">shopping_basket</i> Orders</a>
        <a class=\"dropdown-item\" data-item=\"Invoices\" href=\"#\" data-value=\"4\" data-placeholder=\"Invoice number\" data-icon=\"icon-book\"><i class=\"material-icons\">book</i> Invoices</a>
        <a class=\"dropdown-item\" data-item=\"Carts\" href=\"#\" data-value=\"5\" data-placeholder=\"Cart ID\" data-icon=\"icon-shopping-cart\"><i class=\"material-icons\">shopping_cart</i> Carts</a>
        <a class=\"dropdown-item\" data-item=\"Modules\" href=\"#\" data-value=\"7\" data-placeholder=\"Module name\" data-icon=\"icon-puzzle-piece\"><i class=\"material-icons\">extension</i> Modules</a>
      </div>
      <button class=\"btn btn-primary\" type=\"submit\"><span class=\"d-none\">SEARCH</span><i class=\"material-icons\">search</i></button>
    </div>
  </div>
</form>

<script type=\"text/javascript\">
 \$(document).ready(function(){
    \$('#bo_query').one('click', function() {
    \$(this).closest('form').removeClass('collapsed');
  });
});
</script>
      </div>

      
      
      <div class=\"component\" id=\"header-shop-list-container\">
          <div class=\"shop-list\">
    <a class=\"link\" id=\"header_shopname\" href=\"http://reusenetwork.code-operative.co.uk/\" target= \"_blank\">
      <i class=\"material-icons\">visibility</i>
      View my shop
    </a>
  </div>
      </div>

              <div class=\"component header-right-component\" id=\"header-notifications-container\">
          <div id=\"notif\" class=\"notification-center dropdown dropdown-clickable\">
  <button class=\"btn notification js-notification dropdown-toggle\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">notifications_none</i>
    <span id=\"notifications-total\" class=\"count hide\">0</span>
  </button>
  <div class=\"dropdown-menu dropdown-menu-right js-notifs_dropdown\">
    <div class=\"notifications\">
      <ul class=\"nav nav-tabs\" role=\"tablist\">
                          <li class=\"nav-item\">
            <a
              class=\"nav-link active\"
              id=\"orders-tab\"
              data-toggle=\"tab\"
              data-type=\"order\"
              href=\"#orders-notifications\"
              role=\"tab\"
            >
              Orders<span id=\"_nb_new_orders_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"customers-tab\"
              data-toggle=\"tab\"
              data-type=\"customer\"
              href=\"#customers-notifications\"
              role=\"tab\"
            >
              Customers<span id=\"_nb_new_customers_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"messages-tab\"
              data-toggle=\"tab\"
              data-type=\"customer_message\"
              href=\"#messages-notifications\"
              role=\"tab\"
            >
              Messages<span id=\"_nb_new_messages_\"></span>
            </a>
          </li>
                        </ul>

      <!-- Tab panes -->
      <div class=\"tab-content\">
                          <div class=\"tab-pane active empty\" id=\"orders-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              No new order for now :(<br>
              How about some seasonal discounts?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"customers-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              No new customer for now :(<br>
              Are you active on social media these days?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"messages-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              No new message for now.<br>
              Seems like all your customers are happy :)
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                        </div>
    </div>
  </div>
</div>

  <script type=\"text/html\" id=\"order-notification-template\">
    <a class=\"notif\" href='order_url'>
      #_id_order_ -
      from <strong>_customer_name_</strong> (_iso_code_)_carrier_
      <strong class=\"float-sm-right\">_total_paid_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"customer-notification-template\">
    <a class=\"notif\" href='customer_url'>
      #_id_customer_ - <strong>_customer_name_</strong>_company_ - registered <strong>_date_add_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"message-notification-template\">
    <a class=\"notif\" href='message_url'>
    <span class=\"message-notification-status _status_\">
      <i class=\"material-icons\">fiber_manual_record</i> _status_
    </span>
      - <strong>_customer_name_</strong> (_company_) - <i class=\"material-icons\">access_time</i> _date_add_
    </a>
  </script>
        </div>
      
      <div class=\"component\" id=\"header-employee-container\">
        <div class=\"dropdown employee-dropdown\">
  <div class=\"rounded-circle person\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">account_circle</i>
  </div>
  <div class=\"dropdown-menu dropdown-menu-right\">
    <div class=\"employee-wrapper-avatar\">
      
      <span class=\"employee_avatar\"><img class=\"avatar rounded-circle\" src=\"http://profile.prestashop.com/contact%40code-operative.co.uk.jpg\" /></span>
      <span class=\"employee_profile\">Welcome back Code</span>
      <a class=\"dropdown-item employee-link profile-link\" href=\"/admin4047wicsx/index.php/configure/advanced/employees/1/edit?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\">
      <i class=\"material-icons\">settings</i>
      Your profile
    </a>
    </div>
    
    <p class=\"divider\"></p>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/resources/documentations?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=resources-en&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">book</i> Resources</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/training?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=training-en&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">school</i> Training</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/experts?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=expert-en&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">person_pin_circle</i> Find an Expert</a>
    <a class=\"dropdown-item\" href=\"https://addons.prestashop.com?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=addons-en&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">extension</i> PrestaShop Marketplace</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/contact?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=help-center-en&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">help</i> Help Center</a>
    <p class=\"divider\"></p>
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminLogin&amp;logout=1&amp;token=408e14be7e4ee1dc2ab1edd8e15c7d12\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Sign out</span>
    </a>
  </div>
</div>
      </div>
          </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/admin4047wicsx/index.php/configure/advanced/employees/toggle-navigation?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\">
    <i class=\"material-icons\">chevron_left</i>
    <i class=\"material-icons\">chevron_left</i>
  </span>

  <div class=\"nav-bar-overflow\">
    <ul class=\"main-menu\">
              
                    
                    
          
            <li class=\"link-levelone \" data-submenu=\"1\" id=\"tab-AdminDashboard\">
              <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=6366eb4673b4baa44b7d8241d6f053a2\" class=\"link\" >
                <i class=\"material-icons\">trending_up</i> <span>Dashboard</span>
              </a>
            </li>

          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Sell</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/admin4047wicsx/index.php/sell/orders/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\">
                      <i class=\"material-icons mi-shopping_basket\">shopping_basket</i>
                      <span>
                      Orders
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-3\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"4\" id=\"subtab-AdminOrders\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"5\" id=\"subtab-AdminInvoices\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/invoices/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Invoices
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/credit-slips/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Credit Notes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/delivery-slips/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Delivery Slips
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarts&amp;token=8d3655bd5c1505eb97e4190ada75d9c8\" class=\"link\"> Shopping Carts
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/admin4047wicsx/index.php/sell/catalog/products?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\">
                      <i class=\"material-icons mi-store\">store</i>
                      <span>
                      Catalog
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-9\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"10\" id=\"subtab-AdminProducts\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/products?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/categories?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/monitoring/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Monitoring
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminAttributesGroups&amp;token=5e86e5b79c34575d35bd6390978954ec\" class=\"link\"> Attributes &amp; Features
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/brands/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Brands &amp; Suppliers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/admin4047wicsx/index.php/sell/attachments/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Files
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCartRules&amp;token=2ccbc7abd05f0b519ed44b35bf1a61df\" class=\"link\"> Discounts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/admin4047wicsx/index.php/sell/stocks/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Stocks
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/admin4047wicsx/index.php/sell/customers/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\">
                      <i class=\"material-icons mi-account_circle\">account_circle</i>
                      <span>
                      Customers
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-24\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"25\" id=\"subtab-AdminCustomers\">
                                <a href=\"/admin4047wicsx/index.php/sell/customers/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Customers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                                <a href=\"/admin4047wicsx/index.php/sell/addresses/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Addresses
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCustomerThreads&amp;token=7cb3adbc6c5b38a0fceb9563b2dfe996\" class=\"link\">
                      <i class=\"material-icons mi-chat\">chat</i>
                      <span>
                      Customer Service
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-28\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"29\" id=\"subtab-AdminCustomerThreads\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCustomerThreads&amp;token=7cb3adbc6c5b38a0fceb9563b2dfe996\" class=\"link\"> Customer Service
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/admin4047wicsx/index.php/sell/customer-service/order-messages/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Order Messages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminReturn&amp;token=0e0975ead57f8cae760c680a95f11ac0\" class=\"link\"> Merchandise Returns
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                    <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminStats&amp;token=0ecdeaee13d7a11ee5578dd1c125ec15\" class=\"link\">
                      <i class=\"material-icons mi-assessment\">assessment</i>
                      <span>
                      Stats
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"266\" id=\"subtab-KBMPMainTab\">
                    <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMarketPlaceSetting&amp;token=ddc1ff1c5d47e3a06f535f550ea3670d\" class=\"link\">
                      <i class=\"material-icons mi-store\">store</i>
                      <span>
                      Knowband Marketplace
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-266\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"267\" id=\"subtab-AdminKbMarketPlaceSetting\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMarketPlaceSetting&amp;token=ddc1ff1c5d47e3a06f535f550ea3670d\" class=\"link\"> Settings
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"269\" id=\"subtab-AdminKbMpCustomFields\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMpCustomFields&amp;token=b2a57acec2a2f2a22b3efed4780583df\" class=\"link\"> Profile form Custom Fields
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"270\" id=\"subtab-AdminKbSellerList\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerList&amp;token=028c0ea7ac76ef4ab37f5a6e1791dc06\" class=\"link\"> Sellers List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"271\" id=\"subtab-AdminKbSellerApprovalList\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerApprovalList&amp;token=6ac4287871a0d5482046aaa50939785e\" class=\"link\"> Seller Account Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"272\" id=\"subtab-AdminKbProductApprovalList\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbProductApprovalList&amp;token=02047b42750c8c440f533c161b9f708b\" class=\"link\"> Product Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"273\" id=\"subtab-AdminKbProductList\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbProductList&amp;token=4064cc103a5b08889af977caee7a30c9\" class=\"link\"> Seller Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"274\" id=\"subtab-AdminKbCategoryWiseCommission\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbCategoryWiseCommission&amp;token=58a6a9a5422aab983ffbf1309696f0e0\" class=\"link\"> Category Wise Commission Rules
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"276\" id=\"subtab-AdminKbOrderList\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbOrderList&amp;token=eaa9cc0b856ca76c29f06d1652f5cb8e\" class=\"link\"> Seller Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"277\" id=\"subtab-AdminKbadminOrderList\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbadminOrderList&amp;token=9a94b017a200a9ac6d1cb3299b2ef622\" class=\"link\"> Admin Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"278\" id=\"subtab-AdminKbSProductReview\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSProductReview&amp;token=7081b2f4dd7b3b153d70159fbb2a926e\" class=\"link\"> Product Reviews
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"279\" id=\"subtab-AdminKbSellerReviewApproval\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerReviewApproval&amp;token=71c98c5c23907f7388a9463980bdeaa2\" class=\"link\"> Seller Reviews Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"280\" id=\"subtab-AdminKbSellerReviewList\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerReviewList&amp;token=c8e3ffc556370ae69003f13e7fe065a5\" class=\"link\"> Seller Reviews
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"281\" id=\"subtab-AdminKbSellerCRequest\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerCRequest&amp;token=18b0e1d7f675554baabfb6757d7b93ba\" class=\"link\"> Seller Category Request List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"282\" id=\"subtab-AdminKbSellerShipping\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerShipping&amp;token=85993d59c0d0c48c4e779a7bad2f364f\" class=\"link\"> Seller Shippings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"283\" id=\"subtab-AdminKbSellerShippingMethod\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerShippingMethod&amp;token=e6ec913d6a7619372ca46512bb753075\" class=\"link\"> Seller Shipping Method
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"284\" id=\"subtab-AdminKbCommission\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbCommission&amp;token=1dde87cab43da4935eab5c30b33115dc\" class=\"link\"> Admin Commissions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"285\" id=\"subtab-AdminKbSellerTransPayoutRequest\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerTransPayoutRequest&amp;token=bbc8a95c31b9f3727229b46792532249\" class=\"link\"> Transactions Payout Request
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"286\" id=\"subtab-AdminKbSellerTrans\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerTrans&amp;token=38b370810390c4c39fad509e2fdc2773\" class=\"link\"> Seller Transactions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"287\" id=\"subtab-AdminKbSellerCloseShopRequest\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerCloseShopRequest&amp;token=cf9153856938ac6af8cca32f0c32b30a\" class=\"link\"> Seller Shop Close Request
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"288\" id=\"subtab-AdminKbGDPRRequest\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbGDPRRequest&amp;token=6b4f886abb6524500d5d0cbcf70029e9\" class=\"link\"> GDPR Requests
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"289\" id=\"subtab-AdminKbMembershipPlanSetting\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMembershipPlanSetting&amp;token=3a4ec2dc6c774b802c12ed138fc23509\" class=\"link\"> MemberShip Plan General Setting
                                </a>
                              </li>

                                                                                                                                                                                              
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"292\" id=\"subtab-AdminKbMembershipPlans\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMembershipPlans&amp;token=bc16bcdbea462e4e7f48e2622d64fe45\" class=\"link\"> MemberShip Plans
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"293\" id=\"subtab-AdminKbMembershipSellerPlans\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMembershipSellerPlans&amp;token=d739aebde52415e2ee4c87db736e0e55\" class=\"link\"> Seller Membership Plans
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"295\" id=\"subtab-AdminKbEmail\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbEmail&amp;token=f08cdf632ae68114b118ada4fa0cd2c5\" class=\"link\"> Email Templates
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                                            
          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"42\" id=\"tab-IMPROVE\">
                <span class=\"title\">Improve</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"43\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/admin4047wicsx/index.php/improve/modules/manage?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Modules
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-43\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"44\" id=\"subtab-AdminModulesSf\">
                                <a href=\"/admin4047wicsx/index.php/improve/modules/manage?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Module Manager
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"48\" id=\"subtab-AdminParentModulesCatalog\">
                                <a href=\"/admin4047wicsx/index.php/modules/addons/modules/catalog?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Module Catalog
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"52\" id=\"subtab-AdminParentThemes\">
                    <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\">
                      <i class=\"material-icons mi-desktop_mac\">desktop_mac</i>
                      <span>
                      Design
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-52\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"126\" id=\"subtab-AdminThemesParent\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Theme &amp; Logo
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"137\" id=\"subtab-AdminPsMboTheme\">
                                <a href=\"/admin4047wicsx/index.php/modules/addons/themes/catalog?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Theme Catalog
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"55\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/mail_theme/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Email Theme
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"57\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/cms-pages/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Pages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"58\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/modules/positions/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Positions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"59\" id=\"subtab-AdminImages\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminImages&amp;token=57dd9e8cdd92d6a8b0c1de5acee9d4e8\" class=\"link\"> Image Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"125\" id=\"subtab-AdminLinkWidget\">
                                <a href=\"/admin4047wicsx/index.php/modules/link-widget/list?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Link Widget
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"60\" id=\"subtab-AdminParentShipping\">
                    <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarriers&amp;token=8ad25c1429d3b3b17a013bf7117fc5ab\" class=\"link\">
                      <i class=\"material-icons mi-local_shipping\">local_shipping</i>
                      <span>
                      Shipping
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-60\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"61\" id=\"subtab-AdminCarriers\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarriers&amp;token=8ad25c1429d3b3b17a013bf7117fc5ab\" class=\"link\"> Carriers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"62\" id=\"subtab-AdminShipping\">
                                <a href=\"/admin4047wicsx/index.php/improve/shipping/preferences?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"63\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/admin4047wicsx/index.php/improve/payment/payment_methods?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\">
                      <i class=\"material-icons mi-payment\">payment</i>
                      <span>
                      Payment
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-63\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"64\" id=\"subtab-AdminPayment\">
                                <a href=\"/admin4047wicsx/index.php/improve/payment/payment_methods?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Payment Methods
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"65\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/admin4047wicsx/index.php/improve/payment/preferences?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"66\" id=\"subtab-AdminInternational\">
                    <a href=\"/admin4047wicsx/index.php/improve/international/localization/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\">
                      <i class=\"material-icons mi-language\">language</i>
                      <span>
                      International
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-66\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"67\" id=\"subtab-AdminParentLocalization\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/localization/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Localization
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"72\" id=\"subtab-AdminParentCountries\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminZones&amp;token=9d7b8c2d86bb0a47b9631c0014524e9a\" class=\"link\"> Locations
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"76\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/taxes/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> VAT
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"79\" id=\"subtab-AdminTranslations\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/translations/settings?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Translations
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"131\" id=\"subtab-AdminEmarketing\">
                    <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminEmarketing&amp;token=f8e645f763b57cdd5f645f269ec2c134\" class=\"link\">
                      <i class=\"material-icons mi-track_changes\">track_changes</i>
                      <span>
                      Advertising
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title -active\" data-submenu=\"80\" id=\"tab-CONFIGURE\">
                <span class=\"title\">Configure</span>
            </li>

                              
                  
                                                      
                                                          
                  <li class=\"link-levelone has_submenu -active open ul-open\" data-submenu=\"81\" id=\"subtab-ShopParameters\">
                    <a href=\"/admin4047wicsx/index.php/configure/shop/preferences/preferences?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\">
                      <i class=\"material-icons mi-settings\">settings</i>
                      <span>
                      Shop Parameters
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_up
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-81\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"82\" id=\"subtab-AdminParentPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/preferences/preferences?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> General
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"85\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/order-preferences/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Order Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"88\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/product-preferences/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Product Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo -active\" data-submenu=\"89\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/customer-preferences/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Customer Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"93\" id=\"subtab-AdminParentStores\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/contacts/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> CMS page
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"96\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/seo-urls/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Traffic &amp; SEO
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"100\" id=\"subtab-AdminParentSearchConf\">
                                <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminSearchConf&amp;token=5f4679296e56b2e61cf8cbcda6281409\" class=\"link\"> Search
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"103\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/admin4047wicsx/index.php/configure/advanced/system-information/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\">
                      <i class=\"material-icons mi-settings_applications\">settings_applications</i>
                      <span>
                      Advanced Parameters
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-103\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"104\" id=\"subtab-AdminInformation\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/system-information/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Information
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"105\" id=\"subtab-AdminPerformance\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/performance/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Performance
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"106\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/administration/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Administration
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"107\" id=\"subtab-AdminEmails\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/emails/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> E-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"108\" id=\"subtab-AdminImport\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/import/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Import
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"109\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/employees/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Team
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"113\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/sql-requests/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Database
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"116\" id=\"subtab-AdminLogs\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/logs/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Logs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"117\" id=\"subtab-AdminWebservice\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/webservice-keys/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" class=\"link\"> Webservice
                                </a>
                              </li>

                                                                                                                                                                                          </ul>
                                        </li>
                              
          
                  </ul>
  </div>
  
</nav>

<div id=\"main-div\">
          
<div class=\"header-toolbar d-print-none\">
  <div class=\"container-fluid\">

    
      <nav aria-label=\"Breadcrumb\">
        <ol class=\"breadcrumb\">
                      <li class=\"breadcrumb-item\">Customer Settings</li>
          
                      <li class=\"breadcrumb-item active\">
              <a href=\"/admin4047wicsx/index.php/configure/shop/customer-preferences/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" aria-current=\"page\">Customers</a>
            </li>
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"title\">
            Customers          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                        
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Help\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"/admin4047wicsx/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop.com%252Fgb%252Fdoc%252FAdminCustomerPreferences%253Fversion%253D1.7.7.1%2526country%253Dgb/Help?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\"
                   id=\"product_form_open_help\"
                >
                  Help
                </a>
                                    </div>
        </div>
      
    </div>
  </div>

  
      <div class=\"page-head-tabs\" id=\"head_tabs\">
      <ul class=\"nav nav-pills\">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <li class=\"nav-item\">
                    <a href=\"/admin4047wicsx/index.php/configure/shop/customer-preferences/?_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs\" id=\"subtab-AdminCustomerPreferences\" class=\"nav-link tab active current\" data-submenu=\"90\">
                      Customers
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminGroups&token=10746449e6447496adf51899282f055f\" id=\"subtab-AdminGroups\" class=\"nav-link tab \" data-submenu=\"91\">
                      Groups
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminGenders&token=b5d7b92691d471de961ddf5e826c306e\" id=\"subtab-AdminGenders\" class=\"nav-link tab \" data-submenu=\"92\">
                      Titles
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                                                                                                                                                                                                                                                                                                                                                              </ul>
    </div>
    <script>
  if (undefined !== mbo) {
    mbo.initialize({
      translations: {
        'Recommended Modules and Services': 'Recommended Modules and Services',
        'Close': 'Close',
      },
      recommendedModulesUrl: '/admin4047wicsx/index.php/modules/addons/modules/recommended?tabClassName=AdminCustomerPreferences&_token=eTg1F6ZjqBtrLVE8XLprH2DtJJWFW9GVCRd0nJFTAGs',
      shouldAttachRecommendedModulesAfterContent: 0,
      shouldAttachRecommendedModulesButton: 1,
      shouldUseLegacyTheme: 0,
    });
  }
</script>

</div>
      
      <div class=\"content-div  with-tabs\">

        

                                                        
        <div class=\"row \">
          <div class=\"col-sm-12\">
            <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>


  ";
        // line 1314
        $this->displayBlock('content_header', $context, $blocks);
        // line 1315
        echo "                 ";
        $this->displayBlock('content', $context, $blocks);
        // line 1316
        echo "                 ";
        $this->displayBlock('content_footer', $context, $blocks);
        // line 1317
        echo "                 ";
        $this->displayBlock('sidebar_right', $context, $blocks);
        // line 1318
        echo "
            
          </div>
        </div>

      </div>
    </div>

  <div id=\"non-responsive\" class=\"js-non-responsive\">
  <h1>Oh no!</h1>
  <p class=\"mt-3\">
    The mobile version of this page is not available yet.
  </p>
  <p class=\"mt-2\">
    Please use a desktop computer to access this page, until is adapted to mobile.
  </p>
  <p class=\"mt-2\">
    Thank you.
  </p>
  <a href=\"http://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=6366eb4673b4baa44b7d8241d6f053a2\" class=\"btn btn-primary py-1 mt-3\">
    <i class=\"material-icons\">arrow_back</i>
    Back
  </a>
</div>
  <div class=\"mobile-layer\"></div>

      <div id=\"footer\" class=\"bootstrap\">
    
</div>
  

      <div class=\"bootstrap\">
      <div class=\"modal fade\" id=\"modal_addons_connect\" tabindex=\"-1\">
\t<div class=\"modal-dialog modal-md\">
\t\t<div class=\"modal-content\">
\t\t\t\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
\t\t\t\t<h4 class=\"modal-title\"><i class=\"icon-puzzle-piece\"></i> <a target=\"_blank\" href=\"https://addons.prestashop.com/?utm_source=back-office&utm_medium=modules&utm_campaign=back-office-GB&utm_content=download\">PrestaShop Addons</a></h4>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"modal-body\">
\t\t\t\t\t\t<!--start addons login-->
\t\t\t<form id=\"addons_login_form\" method=\"post\" >
\t\t\t\t<div>
\t\t\t\t\t<a href=\"https://addons.prestashop.com/gb/login?email=contact%40code-operative.co.uk&amp;firstname=Code&amp;lastname=Operative&amp;website=http%3A%2F%2Freusenetwork.code-operative.co.uk%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-GB&amp;utm_content=download#createnow\"><img class=\"img-responsive center-block\" src=\"/admin4047wicsx/themes/default/img/prestashop-addons-logo.png\" alt=\"Logo PrestaShop Addons\"/></a>
\t\t\t\t\t<h3 class=\"text-center\">Connect your shop to PrestaShop's marketplace in order to automatically import all your Addons purchases.</h3>
\t\t\t\t\t<hr />
\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<h4>Don't have an account?</h4>
\t\t\t\t\t\t<p class='text-justify'>Discover the Power of PrestaShop Addons! Explore the PrestaShop Official Marketplace and find over 3 500 innovative modules and themes that optimize conversion rates, increase traffic, build customer loyalty and maximize your productivity</p>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<h4>Connect to PrestaShop Addons</h4>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<div class=\"input-group-prepend\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-text\"><i class=\"icon-user\"></i></span>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<input id=\"username_addons\" name=\"username_addons\" type=\"text\" value=\"\" autocomplete=\"off\" class=\"form-control ac_input\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<div class=\"input-group-prepend\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-text\"><i class=\"icon-key\"></i></span>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<input id=\"password_addons\" name=\"password_addons\" type=\"password\" value=\"\" autocomplete=\"off\" class=\"form-control ac_input\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<a class=\"btn btn-link float-right _blank\" href=\"//addons.prestashop.com/gb/forgot-your-password\">I forgot my password</a>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"row row-padding-top\">
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<a class=\"btn btn-default btn-block btn-lg _blank\" href=\"https://addons.prestashop.com/gb/login?email=contact%40code-operative.co.uk&amp;firstname=Code&amp;lastname=Operative&amp;website=http%3A%2F%2Freusenetwork.code-operative.co.uk%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-GB&amp;utm_content=download#createnow\">
\t\t\t\t\t\t\t\tCreate an Account
\t\t\t\t\t\t\t\t<i class=\"icon-external-link\"></i>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<button id=\"addons_login_button\" class=\"btn btn-primary btn-block btn-lg\" type=\"submit\">
\t\t\t\t\t\t\t\t<i class=\"icon-unlock\"></i> Sign in
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div id=\"addons_loading\" class=\"help-block\"></div>

\t\t\t</form>
\t\t\t<!--end addons login-->
\t\t\t</div>


\t\t\t\t\t</div>
\t</div>
</div>

    </div>
  
";
        // line 1425
        $this->displayBlock('javascripts', $context, $blocks);
        $this->displayBlock('extra_javascripts', $context, $blocks);
        $this->displayBlock('translate_javascripts', $context, $blocks);
        echo "</body>
</html>";
    }

    // line 78
    public function block_stylesheets($context, array $blocks = [])
    {
    }

    public function block_extra_stylesheets($context, array $blocks = [])
    {
    }

    // line 1314
    public function block_content_header($context, array $blocks = [])
    {
    }

    // line 1315
    public function block_content($context, array $blocks = [])
    {
    }

    // line 1316
    public function block_content_footer($context, array $blocks = [])
    {
    }

    // line 1317
    public function block_sidebar_right($context, array $blocks = [])
    {
    }

    // line 1425
    public function block_javascripts($context, array $blocks = [])
    {
    }

    public function block_extra_javascripts($context, array $blocks = [])
    {
    }

    public function block_translate_javascripts($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "__string_template__22d0d4853593d225d3ec44f9eaee806737d619fe40d8a33b91a3542340d41ebf";
    }

    public function getDebugInfo()
    {
        return array (  1515 => 1425,  1510 => 1317,  1505 => 1316,  1500 => 1315,  1495 => 1314,  1486 => 78,  1478 => 1425,  1369 => 1318,  1366 => 1317,  1363 => 1316,  1360 => 1315,  1358 => 1314,  118 => 78,  39 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__22d0d4853593d225d3ec44f9eaee806737d619fe40d8a33b91a3542340d41ebf", "");
    }
}

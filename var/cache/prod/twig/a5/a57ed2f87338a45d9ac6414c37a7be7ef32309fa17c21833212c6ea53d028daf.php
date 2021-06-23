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

/* __string_template__9f461e48f43819661dcc20d2a354aa83dbf09651af0c1da4d2a7fbcc204a8077 */
class __TwigTemplate_c19c94d4ee706145fd057eec3032f76fd4d37d948ddc2f9137431839ffcba61f extends \Twig\Template
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

<title>SEO & URLs • Reuse Home</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminMeta';
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
    var token = 'aafb6115b903d545e429c118433e1292';
    var token_admin_orders = 'd3b6d7cbeff802ee921ad2ed6abf85b9';
    var token_admin_customers = 'c31584fe44a0d1fd89f6b90e457fc02c';
    var token_admin_customer_threads = '89dae766c324afcf99db14a47a905715';
    var currentIndex = 'index.php?controller=AdminMeta';
    var employee_token = '46e7b7541231c3c7e821da8b21cb8964';
    var choose_language_translate = 'Choose language:';
    var default_language = '2';
    var admin_modules_link = '/admin4047wicsx/index.php/improve/modules/catalog/recommended?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk';
    var admin_notification_get_link = '/admin4047wicsx/index.php/common/notifications?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk';
    var admin_notification_push_link = '/admin4047wicsx/index.php/common/notifications/ack?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk';
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
var changeFormLanguageUrl = \"\\/admin4047wicsx\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\";
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
<script type=\"text/javascript\" src=\"/modules/cssmodule/dh42.js\"></script>
<script type=\"text/javascript\" src=\"/modules/ps_googleanalytics/views/js/GoogleAnalyticActionLib.js\"></script>

  
<script type=\"text/javascript\">
\t(window.gaDevIds=window.gaDevIds||[]).push('d6YPbH');
\t(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
\t(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
\tm=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
\t})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'G-SC8VZYTW6X', 'auto');
                    ga('set', 'anonymizeIp', true);
                ga('send', 'pageview');
    
    ga('require', 'ec');
</script>


    
    <script type=\"text/javascript\">
        ga('send', 'pageview');
    </script>
    


";
        // line 101
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('extra_stylesheets', $context, $blocks);
        echo "</head>

<body
  class=\"lang-gb adminmeta\"
  data-base-url=\"/admin4047wicsx/index.php\"  data-token=\"HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=74889eac61431399db083d3e1528cd07\"></a>
      <span id=\"shop_version\">1.7.7.1</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Quick Access
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=c24cead82cd5fe9dbed46e6e8bc9296e\"
                 data-item=\"Catalog evaluation\"
      >Catalog evaluation</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php/improve/modules/manage?token=c0ad415a56dbef61a7013902f770f3fa\"
                 data-item=\"Installed modules\"
      >Installed modules</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php/sell/catalog/categories/new?token=c0ad415a56dbef61a7013902f770f3fa\"
                 data-item=\"New category\"
      >New category</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php/sell/catalog/products/new?token=c0ad415a56dbef61a7013902f770f3fa\"
                 data-item=\"New product\"
      >New product</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=c927993614e30a37827b0007e3281620\"
                 data-item=\"New voucher\"
      >New voucher</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminOrders&amp;token=d3b6d7cbeff802ee921ad2ed6abf85b9\"
                 data-item=\"Orders\"
      >Orders</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminModules&amp;&amp;configure=xipblog&amp;token=1f0b651551affe740853049d0060fd7d\"
                 data-item=\"XipBlog Settings\"
      >XipBlog Settings</a>
        <div class=\"dropdown-divider\"></div>
          <a
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"128\"
        data-icon=\"icon-AdminParentMeta\"
        data-method=\"add\"
        data-url=\"index.php/configure/shop/seo-urls\"
        data-post-link=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminQuickAccesses&token=f010f4c3c130608474dd2c7d1063a639\"
        data-prompt-text=\"Please name this shortcut:\"
        data-link=\"SEO &amp; URLs - List\"
      >
        <i class=\"material-icons\">add_circle</i>
        Add current page to Quick Access
      </a>
        <a class=\"dropdown-item\" href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminQuickAccesses&token=f010f4c3c130608474dd2c7d1063a639\">
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
      action=\"/admin4047wicsx/index.php?controller=AdminSearch&amp;token=64399d3300cde81b9e19ce1191f3c614\"
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
              Have you considered selling on marketplaces?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"messages-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              No new message for now.<br>
              No news is good news, isn't it?
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
      
      <span class=\"employee_avatar\"><img class=\"avatar rounded-circle\" src=\"https://profile.prestashop.com/contact%40code-operative.co.uk.jpg\" /></span>
      <span class=\"employee_profile\">Welcome back Melissa</span>
      <a class=\"dropdown-item employee-link profile-link\" href=\"/admin4047wicsx/index.php/configure/advanced/employees/3/edit?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\">
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
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminLogin&amp;logout=1&amp;token=c1706a8d5677832643e8d169911462b4\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Sign out</span>
    </a>
  </div>
</div>
      </div>
          </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/admin4047wicsx/index.php/configure/advanced/employees/toggle-navigation?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\">
    <i class=\"material-icons\">chevron_left</i>
    <i class=\"material-icons\">chevron_left</i>
  </span>

  <div class=\"nav-bar-overflow\">
    <ul class=\"main-menu\">
              
                    
                    
          
            <li class=\"link-levelone \" data-submenu=\"1\" id=\"tab-AdminDashboard\">
              <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=74889eac61431399db083d3e1528cd07\" class=\"link\" >
                <i class=\"material-icons\">trending_up</i> <span>Dashboard</span>
              </a>
            </li>

          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Sell</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/admin4047wicsx/index.php/sell/orders/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/orders/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"5\" id=\"subtab-AdminInvoices\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/invoices/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Invoices
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/credit-slips/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Credit Notes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/delivery-slips/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Delivery Slips
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarts&amp;token=0091c6985b8f0385428938a8fb339804\" class=\"link\"> Shopping Carts
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/admin4047wicsx/index.php/sell/catalog/products?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/products?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/categories?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/monitoring/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Monitoring
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminAttributesGroups&amp;token=c69f84c675c6bf75aa9e2d8c353756a6\" class=\"link\"> Attributes &amp; Features
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/brands/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Brands &amp; Suppliers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/admin4047wicsx/index.php/sell/attachments/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Files
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCartRules&amp;token=c927993614e30a37827b0007e3281620\" class=\"link\"> Discounts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/admin4047wicsx/index.php/sell/stocks/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Stocks
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/admin4047wicsx/index.php/sell/customers/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/customers/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Customers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                                <a href=\"/admin4047wicsx/index.php/sell/addresses/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Addresses
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCustomerThreads&amp;token=89dae766c324afcf99db14a47a905715\" class=\"link\">
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
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCustomerThreads&amp;token=89dae766c324afcf99db14a47a905715\" class=\"link\"> Customer Service
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/admin4047wicsx/index.php/sell/customer-service/order-messages/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Order Messages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminReturn&amp;token=45dcac3b709800c03f6e90e4af25458a\" class=\"link\"> Merchandise Returns
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminStats&amp;token=c24cead82cd5fe9dbed46e6e8bc9296e\" class=\"link\">
                      <i class=\"material-icons mi-assessment\">assessment</i>
                      <span>
                      Stats
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                                                            
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"919\" id=\"subtab-KBMPMainTab\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMarketPlaceSetting&amp;token=8dd00078f0b2fe3778a3435511665cd7\" class=\"link\">
                      <i class=\"material-icons mi-store\">store</i>
                      <span>
                      Knowband Marketplace
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-919\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"920\" id=\"subtab-AdminKbMarketPlaceSetting\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMarketPlaceSetting&amp;token=8dd00078f0b2fe3778a3435511665cd7\" class=\"link\"> Settings
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"922\" id=\"subtab-AdminKbMpCustomFields\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMpCustomFields&amp;token=6a32df99b47649bfac7c6adff1356df2\" class=\"link\"> Profile form Custom Fields
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"923\" id=\"subtab-AdminKbSellerList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerList&amp;token=38401e98c9e69ef8396c57ae4fad2e2f\" class=\"link\"> Sellers List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"924\" id=\"subtab-AdminKbSellerApprovalList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerApprovalList&amp;token=9512c7f3d502cd8f7116289e504c2e9b\" class=\"link\"> Seller Account Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"925\" id=\"subtab-AdminKbProductApprovalList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbProductApprovalList&amp;token=cb3d49f119a8d7f0e87ff1e9793b2211\" class=\"link\"> Product Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"926\" id=\"subtab-AdminKbProductList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbProductList&amp;token=178e903dd2588fba549bd57f9c5f2e16\" class=\"link\"> Seller Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"927\" id=\"subtab-AdminKbCategoryWiseCommission\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbCategoryWiseCommission&amp;token=bfcda8c58d9e51329e2f7b9d0d1d96f9\" class=\"link\"> Category Wise Commission Rules
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"929\" id=\"subtab-AdminKbOrderList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbOrderList&amp;token=1569fd578c3e53da9193b9d7f8f44be6\" class=\"link\"> Seller Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"930\" id=\"subtab-AdminKbadminOrderList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbadminOrderList&amp;token=5017deb7e4a34a5b1a01bf9d709a9b1a\" class=\"link\"> Admin Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"931\" id=\"subtab-AdminKbSProductReview\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSProductReview&amp;token=f72ab38b1ef0053f936ddc92b11e3b29\" class=\"link\"> Product Reviews
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"932\" id=\"subtab-AdminKbSellerReviewApproval\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerReviewApproval&amp;token=1bb463aa79b286a32c9c05407a84bbe0\" class=\"link\"> Seller Reviews Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"933\" id=\"subtab-AdminKbSellerReviewList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerReviewList&amp;token=07863361fed48735ec989bbcccf16fef\" class=\"link\"> Seller Reviews
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"934\" id=\"subtab-AdminKbSellerCRequest\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerCRequest&amp;token=d554dcc2c3ab01c32a31500baea86686\" class=\"link\"> Seller Category Request List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"935\" id=\"subtab-AdminKbSellerShipping\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerShipping&amp;token=04bd454b9df0a42530d1adde2927e0e1\" class=\"link\"> Seller Shippings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"936\" id=\"subtab-AdminKbSellerShippingMethod\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerShippingMethod&amp;token=7f62165640f05e2dea79be29527114c7\" class=\"link\"> Seller Shipping Method
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"937\" id=\"subtab-AdminKbCommission\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbCommission&amp;token=c2b4700092b9d0548eaf279b7089d94e\" class=\"link\"> Admin Commissions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"938\" id=\"subtab-AdminKbSellerTransPayoutRequest\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerTransPayoutRequest&amp;token=bda9757411510025046a866f5fa1344e\" class=\"link\"> Transactions Payout Request
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"939\" id=\"subtab-AdminKbSellerTrans\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerTrans&amp;token=3faced2cb1c96a5e9abb4bd35f147984\" class=\"link\"> Seller Transactions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"940\" id=\"subtab-AdminKbSellerCloseShopRequest\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerCloseShopRequest&amp;token=b3337ebda64be8890756f9a483e294e5\" class=\"link\"> Seller Shop Close Request
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"941\" id=\"subtab-AdminKbGDPRRequest\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbGDPRRequest&amp;token=2a529e083ee5f752f0effbe86237a729\" class=\"link\"> GDPR Requests
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"942\" id=\"subtab-AdminKbMembershipPlanSetting\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMembershipPlanSetting&amp;token=b720e9f304a2e0fb64a6169bfc54d4aa\" class=\"link\"> MemberShip Plan General Setting
                                </a>
                              </li>

                                                                                                                                                                                              
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"945\" id=\"subtab-AdminKbMembershipPlans\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMembershipPlans&amp;token=6c5ae3c89e115d9480204d64e6b4ffa4\" class=\"link\"> MemberShip Plans
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"946\" id=\"subtab-AdminKbMembershipSellerPlans\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMembershipSellerPlans&amp;token=fb7d3c7504f1f0e067126dc945c3ee37\" class=\"link\"> Seller Membership Plans
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"948\" id=\"subtab-AdminKbEmail\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbEmail&amp;token=21ae391dbf289c6c189d2910f81c55d5\" class=\"link\"> Email Templates
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"42\" id=\"tab-IMPROVE\">
                <span class=\"title\">Improve</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"43\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/admin4047wicsx/index.php/improve/modules/manage?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/modules/manage?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Module Manager
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"48\" id=\"subtab-AdminParentModulesCatalog\">
                                <a href=\"/admin4047wicsx/index.php/modules/addons/modules/catalog?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Module Catalog
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"52\" id=\"subtab-AdminParentThemes\">
                    <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Theme &amp; Logo
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"137\" id=\"subtab-AdminPsMboTheme\">
                                <a href=\"/admin4047wicsx/index.php/modules/addons/themes/catalog?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Theme Catalog
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"55\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/mail_theme/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Email Theme
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"57\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/cms-pages/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Pages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"58\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/modules/positions/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Positions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"59\" id=\"subtab-AdminImages\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminImages&amp;token=3a0d07995cd4be5ac4ce8dc4f4439c89\" class=\"link\"> Image Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"125\" id=\"subtab-AdminLinkWidget\">
                                <a href=\"/admin4047wicsx/index.php/modules/link-widget/list?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Link Widget
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"60\" id=\"subtab-AdminParentShipping\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarriers&amp;token=fd8e7b683d6a66e310fe7dffa82d1b5b\" class=\"link\">
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
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarriers&amp;token=fd8e7b683d6a66e310fe7dffa82d1b5b\" class=\"link\"> Carriers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"62\" id=\"subtab-AdminShipping\">
                                <a href=\"/admin4047wicsx/index.php/improve/shipping/preferences?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"63\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/admin4047wicsx/index.php/improve/payment/payment_methods?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/payment/payment_methods?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Payment Methods
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"65\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/admin4047wicsx/index.php/improve/payment/preferences?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"66\" id=\"subtab-AdminInternational\">
                    <a href=\"/admin4047wicsx/index.php/improve/international/localization/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/international/localization/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Localization
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"72\" id=\"subtab-AdminParentCountries\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminZones&amp;token=aaeb9bfd1794dbb9997c5fa17ccc1659\" class=\"link\"> Locations
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"76\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/taxes/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> VAT
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"79\" id=\"subtab-AdminTranslations\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/translations/settings?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Translations
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"131\" id=\"subtab-AdminEmarketing\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminEmarketing&amp;token=2309fb610fd6264523f88272e87f610c\" class=\"link\">
                      <i class=\"material-icons mi-track_changes\">track_changes</i>
                      <span>
                      Advertising
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"366\" id=\"subtab-Adminxprtblogdashboard\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxippost&amp;token=d15488c82782996ae3d90033964a5107\" class=\"link\">
                      <i class=\"material-icons mi-\"></i>
                      <span>
                      Xpert Blog
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-366\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"367\" id=\"subtab-Adminxippost\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxippost&amp;token=d15488c82782996ae3d90033964a5107\" class=\"link\"> Blog Posts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"368\" id=\"subtab-Adminxipcategory\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxipcategory&amp;token=d8ae4cbfb539205f175bd9c17b1be7d9\" class=\"link\"> Blog Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"369\" id=\"subtab-Adminxipcomment\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxipcomment&amp;token=ec97f77e318742cec9434d07e8a31cbc\" class=\"link\"> Blog Comments
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"370\" id=\"subtab-Adminxipimagetype\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxipimagetype&amp;token=4a314c9bf806ae0cb64c15f1363393b9\" class=\"link\"> Blog Image Type
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title -active\" data-submenu=\"80\" id=\"tab-CONFIGURE\">
                <span class=\"title\">Configure</span>
            </li>

                              
                  
                                                      
                                                          
                  <li class=\"link-levelone has_submenu -active open ul-open\" data-submenu=\"81\" id=\"subtab-ShopParameters\">
                    <a href=\"/admin4047wicsx/index.php/configure/shop/preferences/preferences?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/configure/shop/preferences/preferences?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> General
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"85\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/order-preferences/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Order Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"88\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/product-preferences/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Product Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"89\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/customer-preferences/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Customer Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"93\" id=\"subtab-AdminParentStores\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/contacts/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> CMS page
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo -active\" data-submenu=\"96\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/seo-urls/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Traffic &amp; SEO
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"100\" id=\"subtab-AdminParentSearchConf\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminSearchConf&amp;token=f4854ef3988e7fc88f288fec82cae47e\" class=\"link\"> Search
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"103\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/admin4047wicsx/index.php/configure/advanced/system-information/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/system-information/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Information
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"105\" id=\"subtab-AdminPerformance\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/performance/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Performance
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"106\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/administration/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Administration
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"107\" id=\"subtab-AdminEmails\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/emails/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> E-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"108\" id=\"subtab-AdminImport\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/import/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Import
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"109\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/employees/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Team
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"113\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/sql-requests/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Database
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"116\" id=\"subtab-AdminLogs\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/logs/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Logs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"117\" id=\"subtab-AdminWebservice\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/webservice-keys/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" class=\"link\"> Webservice
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
                      <li class=\"breadcrumb-item\">Traffic &amp; SEO</li>
          
                      <li class=\"breadcrumb-item active\">
              <a href=\"/admin4047wicsx/index.php/configure/shop/seo-urls/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" aria-current=\"page\">SEO &amp; URLs</a>
            </li>
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"title\">
            SEO &amp; URLs          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                                                          <a
                  class=\"btn btn-primary  pointer\"                  id=\"page-header-desc-configuration-add\"
                  href=\"/admin4047wicsx/index.php/configure/shop/seo-urls/new?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\"                  title=\"Add a new page\"                >
                  <i class=\"material-icons\">add_circle_outline</i>                  Add a new page
                </a>
                                      
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Help\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"/admin4047wicsx/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop.com%252Fgb%252Fdoc%252FAdminMeta%253Fversion%253D1.7.7.1%2526country%253Dgb/Help?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\"
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
                    <a href=\"/admin4047wicsx/index.php/configure/shop/seo-urls/?_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk\" id=\"subtab-AdminMeta\" class=\"nav-link tab active current\" data-submenu=\"97\">
                      SEO & URLs
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminSearchEngines&token=68fb3660c3faa29d794583e06f9d7a50\" id=\"subtab-AdminSearchEngines\" class=\"nav-link tab \" data-submenu=\"98\">
                      Search Engines
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminReferrers&token=1e53f25cd838b806c61887096f09b02d\" id=\"subtab-AdminReferrers\" class=\"nav-link tab \" data-submenu=\"99\">
                      Referrers
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
      recommendedModulesUrl: '/admin4047wicsx/index.php/modules/addons/modules/recommended?tabClassName=AdminMeta&_token=HlKVL2iZgsQQOdl6nmLlqW1hnciz6S2RrADpbMw01pk',
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
        // line 1395
        $this->displayBlock('content_header', $context, $blocks);
        // line 1396
        echo "                 ";
        $this->displayBlock('content', $context, $blocks);
        // line 1397
        echo "                 ";
        $this->displayBlock('content_footer', $context, $blocks);
        // line 1398
        echo "                 ";
        $this->displayBlock('sidebar_right', $context, $blocks);
        // line 1399
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
  <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=74889eac61431399db083d3e1528cd07\" class=\"btn btn-primary py-1 mt-3\">
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
\t\t\t\t\t<a href=\"https://addons.prestashop.com/gb/login?email=contact%40code-operative.co.uk&amp;firstname=Melissa&amp;lastname=McNab&amp;website=http%3A%2F%2Freusenetwork.code-operative.co.uk%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-GB&amp;utm_content=download#createnow\"><img class=\"img-responsive center-block\" src=\"/admin4047wicsx/themes/default/img/prestashop-addons-logo.png\" alt=\"Logo PrestaShop Addons\"/></a>
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
\t\t\t\t\t\t\t<a class=\"btn btn-default btn-block btn-lg _blank\" href=\"https://addons.prestashop.com/gb/login?email=contact%40code-operative.co.uk&amp;firstname=Melissa&amp;lastname=McNab&amp;website=http%3A%2F%2Freusenetwork.code-operative.co.uk%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-GB&amp;utm_content=download#createnow\">
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
        // line 1506
        $this->displayBlock('javascripts', $context, $blocks);
        $this->displayBlock('extra_javascripts', $context, $blocks);
        $this->displayBlock('translate_javascripts', $context, $blocks);
        echo "</body>
</html>";
    }

    // line 101
    public function block_stylesheets($context, array $blocks = [])
    {
    }

    public function block_extra_stylesheets($context, array $blocks = [])
    {
    }

    // line 1395
    public function block_content_header($context, array $blocks = [])
    {
    }

    // line 1396
    public function block_content($context, array $blocks = [])
    {
    }

    // line 1397
    public function block_content_footer($context, array $blocks = [])
    {
    }

    // line 1398
    public function block_sidebar_right($context, array $blocks = [])
    {
    }

    // line 1506
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
        return "__string_template__9f461e48f43819661dcc20d2a354aa83dbf09651af0c1da4d2a7fbcc204a8077";
    }

    public function getDebugInfo()
    {
        return array (  1596 => 1506,  1591 => 1398,  1586 => 1397,  1581 => 1396,  1576 => 1395,  1567 => 101,  1559 => 1506,  1450 => 1399,  1447 => 1398,  1444 => 1397,  1441 => 1396,  1439 => 1395,  141 => 101,  39 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__9f461e48f43819661dcc20d2a354aa83dbf09651af0c1da4d2a7fbcc204a8077", "");
    }
}
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

/* __string_template__59135f3130184f07b8b52ef4e9d3bdd41924fd3493080808943782bd29e73220 */
class __TwigTemplate_1e789c318335c5d3681868d93efa1ba9dcdfe3c026a07c28394192a33dfbf73f extends \Twig\Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "__string_template__59135f3130184f07b8b52ef4e9d3bdd41924fd3493080808943782bd29e73220"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "__string_template__59135f3130184f07b8b52ef4e9d3bdd41924fd3493080808943782bd29e73220"));

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

<title>E-mail • The Reuse Network</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminEmails';
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
    var token = '5462207cdbbfc6beb0a107427c5cf7f2';
    var token_admin_orders = '8873a66ac09f9fd41b264b413bbe0bc2';
    var token_admin_customers = 'f1412b2cb7874c67487c17870eb0c732';
    var token_admin_customer_threads = '7cb3adbc6c5b38a0fceb9563b2dfe996';
    var currentIndex = 'index.php?controller=AdminEmails';
    var employee_token = '103eab1bce4b12bd4b4815698be7dc09';
    var choose_language_translate = 'Choose language:';
    var default_language = '2';
    var admin_modules_link = '/admin4047wicsx/index.php/improve/modules/catalog/recommended?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k';
    var admin_notification_get_link = '/admin4047wicsx/index.php/common/notifications?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k';
    var admin_notification_push_link = '/admin4047wicsx/index.php/common/notifications/ack?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k';
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
var changeFormLanguageUrl = \"\\/admin4047wicsx\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\";
var currency = {\"iso_code\":\"GBP\",\"sign\":\"\\u00a3\",\"name\":\"British Pound\",\"format\":null};
var currency_specifications = {\"symbol\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"currencyCode\":\"GBP\",\"currencySymbol\":\"\\u00a3\",\"numberSymbols\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"\\u00a4#,##0.00\",\"negativePattern\":\"-\\u00a4#,##0.00\",\"maxFractionDigits\":2,\"minFractionDigits\":2,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var host_mode = false;
var number_specifications = {\"symbol\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"numberSymbols\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.###\",\"negativePattern\":\"-#,##0.###\",\"maxFractionDigits\":3,\"minFractionDigits\":0,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var prestashop = {\"debug\":true};
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

  

";
        // line 79
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('extra_stylesheets', $context, $blocks);
        echo "</head>

<body
  class=\"lang-gb adminemails\"
  data-base-url=\"/admin4047wicsx/index.php\"  data-token=\"b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=6366eb4673b4baa44b7d8241d6f053a2\"></a>
      <span id=\"shop_version\">1.7.7.1</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Quick Access
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=0ecdeaee13d7a11ee5578dd1c125ec15\"
                 data-item=\"Catalog evaluation\"
      >Catalog evaluation</a>
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php/improve/modules/manage?token=40482f155a785d44caebccef5c46964b\"
                 data-item=\"Installed modules\"
      >Installed modules</a>
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php/sell/catalog/categories/new?token=40482f155a785d44caebccef5c46964b\"
                 data-item=\"New category\"
      >New category</a>
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php/sell/catalog/products/new?token=40482f155a785d44caebccef5c46964b\"
                 data-item=\"New product\"
      >New product</a>
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=2ccbc7abd05f0b519ed44b35bf1a61df\"
                 data-item=\"New voucher\"
      >New voucher</a>
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminOrders&amp;token=8873a66ac09f9fd41b264b413bbe0bc2\"
                 data-item=\"Orders\"
      >Orders</a>
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?https://reusenetwork.code-operative.co.uk/?controller=AdminModules&amp;&amp;configure=xipblog&amp;token=a4e67c88fc0a637c6c050ee9989a436b\"
                 data-item=\"XipBlog Settings\"
      >XipBlog Settings</a>
        <div class=\"dropdown-divider\"></div>
          <a
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"175\"
        data-icon=\"icon-AdminAdvancedParameters\"
        data-method=\"add\"
        data-url=\"index.php/configure/advanced/emails/?-HjamXaZTHFUNC0gWLUmZCx8k\"
        data-post-link=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminQuickAccesses&token=52f0c2cdd711b663030666e45409c043\"
        data-prompt-text=\"Please name this shortcut:\"
        data-link=\"E-mail - List\"
      >
        <i class=\"material-icons\">add_circle</i>
        Add current page to Quick Access
      </a>
        <a class=\"dropdown-item\" href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminQuickAccesses&token=52f0c2cdd711b663030666e45409c043\">
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

              <div class=\"component hide-mobile-sm\" id=\"header-debug-mode-container\">
          <a class=\"link shop-state\"
             id=\"debug-mode\"
             data-toggle=\"pstooltip\"
             data-placement=\"bottom\"
             data-html=\"true\"
             title=\"<p class='text-left'><strong>Your shop is in debug mode.</strong></p><p class='text-left'>All the PHP errors and messages are displayed. When you no longer need it, <strong>turn off</strong> this mode.</p>\"
             href=\"/admin4047wicsx/index.php/configure/advanced/performance/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\"
          >
            <i class=\"material-icons\">bug_report</i>
            <span>Debug mode</span>
          </a>
        </div>
      
      
      <div class=\"component\" id=\"header-shop-list-container\">
          <div class=\"shop-list\">
    <a class=\"link\" id=\"header_shopname\" href=\"http://reuse-home.org.uk/\" target= \"_blank\">
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
              Did you check your conversion rate lately?
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
      
      <span class=\"employee_avatar\"><img class=\"avatar rounded-circle\" src=\"https://profile.prestashop.com/info%40reuse-home.org.uk.jpg\" /></span>
      <span class=\"employee_profile\">Welcome back Reuse</span>
      <a class=\"dropdown-item employee-link profile-link\" href=\"/admin4047wicsx/index.php/configure/advanced/employees/1/edit?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\">
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
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminLogin&amp;logout=1&amp;token=408e14be7e4ee1dc2ab1edd8e15c7d12\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Sign out</span>
    </a>
  </div>
</div>
      </div>
          </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/admin4047wicsx/index.php/configure/advanced/employees/toggle-navigation?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\">
    <i class=\"material-icons\">chevron_left</i>
    <i class=\"material-icons\">chevron_left</i>
  </span>

  <div class=\"nav-bar-overflow\">
    <ul class=\"main-menu\">
              
                    
                    
          
            <li class=\"link-levelone \" data-submenu=\"1\" id=\"tab-AdminDashboard\">
              <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=6366eb4673b4baa44b7d8241d6f053a2\" class=\"link\" >
                <i class=\"material-icons\">trending_up</i> <span>Dashboard</span>
              </a>
            </li>

          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Sell</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/admin4047wicsx/index.php/sell/orders/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/orders/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"5\" id=\"subtab-AdminInvoices\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/invoices/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Invoices
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/credit-slips/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Credit Notes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/delivery-slips/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Delivery Slips
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCarts&amp;token=8d3655bd5c1505eb97e4190ada75d9c8\" class=\"link\"> Shopping Carts
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/admin4047wicsx/index.php/sell/catalog/products?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/products?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/categories?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/monitoring/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Monitoring
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminAttributesGroups&amp;token=5e86e5b79c34575d35bd6390978954ec\" class=\"link\"> Attributes &amp; Features
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/brands/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Brands &amp; Suppliers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/admin4047wicsx/index.php/sell/attachments/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Files
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCartRules&amp;token=2ccbc7abd05f0b519ed44b35bf1a61df\" class=\"link\"> Discounts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/admin4047wicsx/index.php/sell/stocks/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Stocks
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/admin4047wicsx/index.php/sell/customers/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/customers/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Customers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                                <a href=\"/admin4047wicsx/index.php/sell/addresses/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Addresses
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCustomerThreads&amp;token=7cb3adbc6c5b38a0fceb9563b2dfe996\" class=\"link\">
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
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCustomerThreads&amp;token=7cb3adbc6c5b38a0fceb9563b2dfe996\" class=\"link\"> Customer Service
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/admin4047wicsx/index.php/sell/customer-service/order-messages/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Order Messages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminReturn&amp;token=0e0975ead57f8cae760c680a95f11ac0\" class=\"link\"> Merchandise Returns
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                    <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminStats&amp;token=0ecdeaee13d7a11ee5578dd1c125ec15\" class=\"link\">
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
                    <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbMarketPlaceSetting&amp;token=773e0ab11ca1b2c4fda2014c3c1314da\" class=\"link\">
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
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbMarketPlaceSetting&amp;token=773e0ab11ca1b2c4fda2014c3c1314da\" class=\"link\"> Settings
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"922\" id=\"subtab-AdminKbMpCustomFields\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbMpCustomFields&amp;token=5ca625e17a7229770b9855c4e322ecdc\" class=\"link\"> Profile form Custom Fields
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"923\" id=\"subtab-AdminKbSellerList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerList&amp;token=43e2881bb79f0d398fb3a9b38e02a6fd\" class=\"link\"> Sellers List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"924\" id=\"subtab-AdminKbSellerApprovalList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerApprovalList&amp;token=2f84cda1ede823c335d919e9b581dd81\" class=\"link\"> Seller Account Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"925\" id=\"subtab-AdminKbProductApprovalList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbProductApprovalList&amp;token=35aae066373598b604343806051fbc79\" class=\"link\"> Product Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"926\" id=\"subtab-AdminKbProductList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbProductList&amp;token=6bd247c6430d3ddab6b759d5df671f1f\" class=\"link\"> Seller Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"927\" id=\"subtab-AdminKbCategoryWiseCommission\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbCategoryWiseCommission&amp;token=9b481baebb6a44fc465e8feb931c7f3e\" class=\"link\"> Category Wise Commission Rules
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"929\" id=\"subtab-AdminKbOrderList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbOrderList&amp;token=c49654fc3d05307f7216a75ded024729\" class=\"link\"> Seller Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"930\" id=\"subtab-AdminKbadminOrderList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbadminOrderList&amp;token=669a30df31586ddb7b1f92474d38c54a\" class=\"link\"> Admin Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"931\" id=\"subtab-AdminKbSProductReview\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSProductReview&amp;token=25c35640adb96584a78524925b2be065\" class=\"link\"> Product Reviews
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"932\" id=\"subtab-AdminKbSellerReviewApproval\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerReviewApproval&amp;token=363ce04ba91ab27986856d468b9c908d\" class=\"link\"> Seller Reviews Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"933\" id=\"subtab-AdminKbSellerReviewList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerReviewList&amp;token=7f3b20a5b1a92a9697f1e4882154ae64\" class=\"link\"> Seller Reviews
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"934\" id=\"subtab-AdminKbSellerCRequest\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerCRequest&amp;token=8eefd5ce5fed5a7caf376929009f3d25\" class=\"link\"> Seller Category Request List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"935\" id=\"subtab-AdminKbSellerShipping\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerShipping&amp;token=b3e0f4fe5b3e7a06753f9c7b1ea83b10\" class=\"link\"> Seller Shippings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"936\" id=\"subtab-AdminKbSellerShippingMethod\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerShippingMethod&amp;token=0acfc45e920d5944befffac9b0997ef0\" class=\"link\"> Seller Shipping Method
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"937\" id=\"subtab-AdminKbCommission\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbCommission&amp;token=ac2a92237a0030ceb373b7fd978cf85c\" class=\"link\"> Admin Commissions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"938\" id=\"subtab-AdminKbSellerTransPayoutRequest\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerTransPayoutRequest&amp;token=29477b104aa154a53ba6e5e20867a7c8\" class=\"link\"> Transactions Payout Request
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"939\" id=\"subtab-AdminKbSellerTrans\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerTrans&amp;token=bae90f4febc86a32d482918aa8c30536\" class=\"link\"> Seller Transactions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"940\" id=\"subtab-AdminKbSellerCloseShopRequest\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerCloseShopRequest&amp;token=d0c5bc40970e322b55844072909bc764\" class=\"link\"> Seller Shop Close Request
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"941\" id=\"subtab-AdminKbGDPRRequest\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbGDPRRequest&amp;token=22f35fb4ae09d382df793eb11006dec3\" class=\"link\"> GDPR Requests
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"942\" id=\"subtab-AdminKbMembershipPlanSetting\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbMembershipPlanSetting&amp;token=84f825c0d9b2f7790e2adf81c3b0abdc\" class=\"link\"> MemberShip Plan General Setting
                                </a>
                              </li>

                                                                                                                                                                                              
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"945\" id=\"subtab-AdminKbMembershipPlans\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbMembershipPlans&amp;token=f2faaf10da5d605bdec3c9bb38991fc7\" class=\"link\"> MemberShip Plans
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"946\" id=\"subtab-AdminKbMembershipSellerPlans\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbMembershipSellerPlans&amp;token=240eaa8d234b0f246a33f2f41b5afa3f\" class=\"link\"> Seller Membership Plans
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"948\" id=\"subtab-AdminKbEmail\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbEmail&amp;token=7b8aa2580547a75ef6dda41c4b15d201\" class=\"link\"> Email Templates
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"42\" id=\"tab-IMPROVE\">
                <span class=\"title\">Improve</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"43\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/admin4047wicsx/index.php/improve/modules/manage?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/modules/manage?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Module Manager
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"48\" id=\"subtab-AdminParentModulesCatalog\">
                                <a href=\"/admin4047wicsx/index.php/modules/addons/modules/catalog?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Module Catalog
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"52\" id=\"subtab-AdminParentThemes\">
                    <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Theme &amp; Logo
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"137\" id=\"subtab-AdminPsMboTheme\">
                                <a href=\"/admin4047wicsx/index.php/modules/addons/themes/catalog?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Theme Catalog
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"55\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/mail_theme/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Email Theme
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"57\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/cms-pages/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Pages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"58\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/modules/positions/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Positions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"59\" id=\"subtab-AdminImages\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminImages&amp;token=57dd9e8cdd92d6a8b0c1de5acee9d4e8\" class=\"link\"> Image Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"125\" id=\"subtab-AdminLinkWidget\">
                                <a href=\"/admin4047wicsx/index.php/modules/link-widget/list?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Link Widget
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"60\" id=\"subtab-AdminParentShipping\">
                    <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCarriers&amp;token=8ad25c1429d3b3b17a013bf7117fc5ab\" class=\"link\">
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
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCarriers&amp;token=8ad25c1429d3b3b17a013bf7117fc5ab\" class=\"link\"> Carriers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"62\" id=\"subtab-AdminShipping\">
                                <a href=\"/admin4047wicsx/index.php/improve/shipping/preferences?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"63\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/admin4047wicsx/index.php/improve/payment/payment_methods?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/payment/payment_methods?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Payment Methods
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"65\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/admin4047wicsx/index.php/improve/payment/preferences?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"66\" id=\"subtab-AdminInternational\">
                    <a href=\"/admin4047wicsx/index.php/improve/international/localization/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/international/localization/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Localization
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"72\" id=\"subtab-AdminParentCountries\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminZones&amp;token=9d7b8c2d86bb0a47b9631c0014524e9a\" class=\"link\"> Locations
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"76\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/taxes/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> VAT
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"79\" id=\"subtab-AdminTranslations\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/translations/settings?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Translations
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"131\" id=\"subtab-AdminEmarketing\">
                    <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminEmarketing&amp;token=f8e645f763b57cdd5f645f269ec2c134\" class=\"link\">
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
                    <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=Adminxippost&amp;token=8ed3d66738d2326f5e6434961ebb4d85\" class=\"link\">
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
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=Adminxippost&amp;token=8ed3d66738d2326f5e6434961ebb4d85\" class=\"link\"> Blog Posts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"368\" id=\"subtab-Adminxipcategory\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=Adminxipcategory&amp;token=f9e65172fdc8edd525f8ba287bf69131\" class=\"link\"> Blog Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"369\" id=\"subtab-Adminxipcomment\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=Adminxipcomment&amp;token=9b07c137df89f733310244ff63d4a319\" class=\"link\"> Blog Comments
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"370\" id=\"subtab-Adminxipimagetype\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=Adminxipimagetype&amp;token=6cb01c116b492078189752e10714af3e\" class=\"link\"> Blog Image Type
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title -active\" data-submenu=\"80\" id=\"tab-CONFIGURE\">
                <span class=\"title\">Configure</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"81\" id=\"subtab-ShopParameters\">
                    <a href=\"/admin4047wicsx/index.php/configure/shop/preferences/preferences?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
                      <i class=\"material-icons mi-settings\">settings</i>
                      <span>
                      Shop Parameters
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-81\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"82\" id=\"subtab-AdminParentPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/preferences/preferences?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> General
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"85\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/order-preferences/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Order Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"88\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/product-preferences/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Product Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"89\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/customer-preferences/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Customer Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"93\" id=\"subtab-AdminParentStores\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/contacts/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> CMS page
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"96\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/seo-urls/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Traffic &amp; SEO
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"100\" id=\"subtab-AdminParentSearchConf\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminSearchConf&amp;token=5f4679296e56b2e61cf8cbcda6281409\" class=\"link\"> Search
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                                                          
                  <li class=\"link-levelone has_submenu -active open ul-open\" data-submenu=\"103\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/admin4047wicsx/index.php/configure/advanced/system-information/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
                      <i class=\"material-icons mi-settings_applications\">settings_applications</i>
                      <span>
                      Advanced Parameters
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_up
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-103\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"104\" id=\"subtab-AdminInformation\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/system-information/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Information
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"105\" id=\"subtab-AdminPerformance\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/performance/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Performance
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"106\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/administration/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Administration
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo -active\" data-submenu=\"107\" id=\"subtab-AdminEmails\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/emails/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> E-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"108\" id=\"subtab-AdminImport\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/import/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Import
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"109\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/employees/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Team
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"113\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/sql-requests/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Database
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"116\" id=\"subtab-AdminLogs\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/logs/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Logs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"117\" id=\"subtab-AdminWebservice\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/webservice-keys/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Webservice
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
                      <li class=\"breadcrumb-item\">Advanced Parameters</li>
          
                      <li class=\"breadcrumb-item active\">
              <a href=\"/admin4047wicsx/index.php/configure/advanced/emails/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" aria-current=\"page\">E-mail</a>
            </li>
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"title\">
            E-mail          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                        
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Help\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"/admin4047wicsx/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop.com%252Fgb%252Fdoc%252FAdminEmails%253Fversion%253D1.7.7.1%2526country%253Dgb/Help?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\"
                   id=\"product_form_open_help\"
                >
                  Help
                </a>
                                    </div>
        </div>
      
    </div>
  </div>

  
    <!-- begin /home/codeoperativeco/public_html/modules/ps_mbo/views/templates/hook/recommended-modules.tpl -->
<script>
  if (undefined !== mbo) {
    mbo.initialize({
      translations: {
        'Recommended Modules and Services': 'Recommended Modules and Services',
        'Close': 'Close',
      },
      recommendedModulesUrl: '/admin4047wicsx/index.php/modules/addons/modules/recommended?tabClassName=AdminEmails&_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k',
      shouldAttachRecommendedModulesAfterContent: 0,
      shouldAttachRecommendedModulesButton: 1,
      shouldUseLegacyTheme: 0,
    });
  }
</script>
<!-- end /home/codeoperativeco/public_html/modules/ps_mbo/views/templates/hook/recommended-modules.tpl -->
</div>
      
      <div class=\"content-div  \">

        

                                                        
        <div class=\"row \">
          <div class=\"col-sm-12\">
            <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>


  ";
        // line 1354
        $this->displayBlock('content_header', $context, $blocks);
        // line 1355
        echo "                 ";
        $this->displayBlock('content', $context, $blocks);
        // line 1356
        echo "                 ";
        $this->displayBlock('content_footer', $context, $blocks);
        // line 1357
        echo "                 ";
        $this->displayBlock('sidebar_right', $context, $blocks);
        // line 1358
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
  <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=6366eb4673b4baa44b7d8241d6f053a2\" class=\"btn btn-primary py-1 mt-3\">
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
\t\t\t\t\t<a href=\"https://addons.prestashop.com/gb/login?email=info%40reuse-home.org.uk&amp;firstname=Reuse&amp;lastname=Home&amp;website=http%3A%2F%2Freuse-home.org.uk%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-GB&amp;utm_content=download#createnow\"><img class=\"img-responsive center-block\" src=\"/admin4047wicsx/themes/default/img/prestashop-addons-logo.png\" alt=\"Logo PrestaShop Addons\"/></a>
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
\t\t\t\t\t\t\t<a class=\"btn btn-default btn-block btn-lg _blank\" href=\"https://addons.prestashop.com/gb/login?email=info%40reuse-home.org.uk&amp;firstname=Reuse&amp;lastname=Home&amp;website=http%3A%2F%2Freuse-home.org.uk%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-GB&amp;utm_content=download#createnow\">
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
        // line 1465
        $this->displayBlock('javascripts', $context, $blocks);
        $this->displayBlock('extra_javascripts', $context, $blocks);
        $this->displayBlock('translate_javascripts', $context, $blocks);
        echo "</body>
</html>";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 79
    public function block_stylesheets($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function block_extra_stylesheets($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_stylesheets"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 1354
    public function block_content_header($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_header"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_header"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 1355
    public function block_content($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 1356
    public function block_content_footer($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_footer"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_footer"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 1357
    public function block_sidebar_right($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sidebar_right"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sidebar_right"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 1465
    public function block_javascripts($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function block_extra_javascripts($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_javascripts"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function block_translate_javascripts($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "translate_javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "translate_javascripts"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "__string_template__59135f3130184f07b8b52ef4e9d3bdd41924fd3493080808943782bd29e73220";
    }

    public function getDebugInfo()
    {
        return array (  1639 => 1465,  1622 => 1357,  1605 => 1356,  1588 => 1355,  1571 => 1354,  1538 => 79,  1524 => 1465,  1415 => 1358,  1412 => 1357,  1409 => 1356,  1406 => 1355,  1404 => 1354,  125 => 79,  45 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"gb\">
<head>
  <meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
<meta name=\"robots\" content=\"NOFOLLOW, NOINDEX\">

<link rel=\"icon\" type=\"image/x-icon\" href=\"/img/favicon.ico\" />
<link rel=\"apple-touch-icon\" href=\"/img/app_icon.png\" />

<title>E-mail • The Reuse Network</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminEmails';
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
    var token = '5462207cdbbfc6beb0a107427c5cf7f2';
    var token_admin_orders = '8873a66ac09f9fd41b264b413bbe0bc2';
    var token_admin_customers = 'f1412b2cb7874c67487c17870eb0c732';
    var token_admin_customer_threads = '7cb3adbc6c5b38a0fceb9563b2dfe996';
    var currentIndex = 'index.php?controller=AdminEmails';
    var employee_token = '103eab1bce4b12bd4b4815698be7dc09';
    var choose_language_translate = 'Choose language:';
    var default_language = '2';
    var admin_modules_link = '/admin4047wicsx/index.php/improve/modules/catalog/recommended?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k';
    var admin_notification_get_link = '/admin4047wicsx/index.php/common/notifications?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k';
    var admin_notification_push_link = '/admin4047wicsx/index.php/common/notifications/ack?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k';
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
var changeFormLanguageUrl = \"\\/admin4047wicsx\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\";
var currency = {\"iso_code\":\"GBP\",\"sign\":\"\\u00a3\",\"name\":\"British Pound\",\"format\":null};
var currency_specifications = {\"symbol\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"currencyCode\":\"GBP\",\"currencySymbol\":\"\\u00a3\",\"numberSymbols\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"\\u00a4#,##0.00\",\"negativePattern\":\"-\\u00a4#,##0.00\",\"maxFractionDigits\":2,\"minFractionDigits\":2,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var host_mode = false;
var number_specifications = {\"symbol\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"numberSymbols\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.###\",\"negativePattern\":\"-#,##0.###\",\"maxFractionDigits\":3,\"minFractionDigits\":0,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var prestashop = {\"debug\":true};
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

  

{% block stylesheets %}{% endblock %}{% block extra_stylesheets %}{% endblock %}</head>

<body
  class=\"lang-gb adminemails\"
  data-base-url=\"/admin4047wicsx/index.php\"  data-token=\"b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=6366eb4673b4baa44b7d8241d6f053a2\"></a>
      <span id=\"shop_version\">1.7.7.1</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Quick Access
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=0ecdeaee13d7a11ee5578dd1c125ec15\"
                 data-item=\"Catalog evaluation\"
      >Catalog evaluation</a>
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php/improve/modules/manage?token=40482f155a785d44caebccef5c46964b\"
                 data-item=\"Installed modules\"
      >Installed modules</a>
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php/sell/catalog/categories/new?token=40482f155a785d44caebccef5c46964b\"
                 data-item=\"New category\"
      >New category</a>
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php/sell/catalog/products/new?token=40482f155a785d44caebccef5c46964b\"
                 data-item=\"New product\"
      >New product</a>
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=2ccbc7abd05f0b519ed44b35bf1a61df\"
                 data-item=\"New voucher\"
      >New voucher</a>
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminOrders&amp;token=8873a66ac09f9fd41b264b413bbe0bc2\"
                 data-item=\"Orders\"
      >Orders</a>
          <a class=\"dropdown-item\"
         href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?https://reusenetwork.code-operative.co.uk/?controller=AdminModules&amp;&amp;configure=xipblog&amp;token=a4e67c88fc0a637c6c050ee9989a436b\"
                 data-item=\"XipBlog Settings\"
      >XipBlog Settings</a>
        <div class=\"dropdown-divider\"></div>
          <a
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"175\"
        data-icon=\"icon-AdminAdvancedParameters\"
        data-method=\"add\"
        data-url=\"index.php/configure/advanced/emails/?-HjamXaZTHFUNC0gWLUmZCx8k\"
        data-post-link=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminQuickAccesses&token=52f0c2cdd711b663030666e45409c043\"
        data-prompt-text=\"Please name this shortcut:\"
        data-link=\"E-mail - List\"
      >
        <i class=\"material-icons\">add_circle</i>
        Add current page to Quick Access
      </a>
        <a class=\"dropdown-item\" href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminQuickAccesses&token=52f0c2cdd711b663030666e45409c043\">
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

              <div class=\"component hide-mobile-sm\" id=\"header-debug-mode-container\">
          <a class=\"link shop-state\"
             id=\"debug-mode\"
             data-toggle=\"pstooltip\"
             data-placement=\"bottom\"
             data-html=\"true\"
             title=\"<p class='text-left'><strong>Your shop is in debug mode.</strong></p><p class='text-left'>All the PHP errors and messages are displayed. When you no longer need it, <strong>turn off</strong> this mode.</p>\"
             href=\"/admin4047wicsx/index.php/configure/advanced/performance/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\"
          >
            <i class=\"material-icons\">bug_report</i>
            <span>Debug mode</span>
          </a>
        </div>
      
      
      <div class=\"component\" id=\"header-shop-list-container\">
          <div class=\"shop-list\">
    <a class=\"link\" id=\"header_shopname\" href=\"http://reuse-home.org.uk/\" target= \"_blank\">
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
              Did you check your conversion rate lately?
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
      
      <span class=\"employee_avatar\"><img class=\"avatar rounded-circle\" src=\"https://profile.prestashop.com/info%40reuse-home.org.uk.jpg\" /></span>
      <span class=\"employee_profile\">Welcome back Reuse</span>
      <a class=\"dropdown-item employee-link profile-link\" href=\"/admin4047wicsx/index.php/configure/advanced/employees/1/edit?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\">
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
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminLogin&amp;logout=1&amp;token=408e14be7e4ee1dc2ab1edd8e15c7d12\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Sign out</span>
    </a>
  </div>
</div>
      </div>
          </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/admin4047wicsx/index.php/configure/advanced/employees/toggle-navigation?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\">
    <i class=\"material-icons\">chevron_left</i>
    <i class=\"material-icons\">chevron_left</i>
  </span>

  <div class=\"nav-bar-overflow\">
    <ul class=\"main-menu\">
              
                    
                    
          
            <li class=\"link-levelone \" data-submenu=\"1\" id=\"tab-AdminDashboard\">
              <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=6366eb4673b4baa44b7d8241d6f053a2\" class=\"link\" >
                <i class=\"material-icons\">trending_up</i> <span>Dashboard</span>
              </a>
            </li>

          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Sell</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/admin4047wicsx/index.php/sell/orders/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/orders/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"5\" id=\"subtab-AdminInvoices\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/invoices/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Invoices
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/credit-slips/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Credit Notes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/delivery-slips/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Delivery Slips
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCarts&amp;token=8d3655bd5c1505eb97e4190ada75d9c8\" class=\"link\"> Shopping Carts
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/admin4047wicsx/index.php/sell/catalog/products?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/products?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/categories?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/monitoring/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Monitoring
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminAttributesGroups&amp;token=5e86e5b79c34575d35bd6390978954ec\" class=\"link\"> Attributes &amp; Features
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/brands/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Brands &amp; Suppliers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/admin4047wicsx/index.php/sell/attachments/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Files
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCartRules&amp;token=2ccbc7abd05f0b519ed44b35bf1a61df\" class=\"link\"> Discounts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/admin4047wicsx/index.php/sell/stocks/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Stocks
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/admin4047wicsx/index.php/sell/customers/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/customers/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Customers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                                <a href=\"/admin4047wicsx/index.php/sell/addresses/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Addresses
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCustomerThreads&amp;token=7cb3adbc6c5b38a0fceb9563b2dfe996\" class=\"link\">
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
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCustomerThreads&amp;token=7cb3adbc6c5b38a0fceb9563b2dfe996\" class=\"link\"> Customer Service
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/admin4047wicsx/index.php/sell/customer-service/order-messages/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Order Messages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminReturn&amp;token=0e0975ead57f8cae760c680a95f11ac0\" class=\"link\"> Merchandise Returns
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                    <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminStats&amp;token=0ecdeaee13d7a11ee5578dd1c125ec15\" class=\"link\">
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
                    <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbMarketPlaceSetting&amp;token=773e0ab11ca1b2c4fda2014c3c1314da\" class=\"link\">
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
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbMarketPlaceSetting&amp;token=773e0ab11ca1b2c4fda2014c3c1314da\" class=\"link\"> Settings
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"922\" id=\"subtab-AdminKbMpCustomFields\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbMpCustomFields&amp;token=5ca625e17a7229770b9855c4e322ecdc\" class=\"link\"> Profile form Custom Fields
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"923\" id=\"subtab-AdminKbSellerList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerList&amp;token=43e2881bb79f0d398fb3a9b38e02a6fd\" class=\"link\"> Sellers List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"924\" id=\"subtab-AdminKbSellerApprovalList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerApprovalList&amp;token=2f84cda1ede823c335d919e9b581dd81\" class=\"link\"> Seller Account Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"925\" id=\"subtab-AdminKbProductApprovalList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbProductApprovalList&amp;token=35aae066373598b604343806051fbc79\" class=\"link\"> Product Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"926\" id=\"subtab-AdminKbProductList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbProductList&amp;token=6bd247c6430d3ddab6b759d5df671f1f\" class=\"link\"> Seller Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"927\" id=\"subtab-AdminKbCategoryWiseCommission\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbCategoryWiseCommission&amp;token=9b481baebb6a44fc465e8feb931c7f3e\" class=\"link\"> Category Wise Commission Rules
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"929\" id=\"subtab-AdminKbOrderList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbOrderList&amp;token=c49654fc3d05307f7216a75ded024729\" class=\"link\"> Seller Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"930\" id=\"subtab-AdminKbadminOrderList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbadminOrderList&amp;token=669a30df31586ddb7b1f92474d38c54a\" class=\"link\"> Admin Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"931\" id=\"subtab-AdminKbSProductReview\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSProductReview&amp;token=25c35640adb96584a78524925b2be065\" class=\"link\"> Product Reviews
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"932\" id=\"subtab-AdminKbSellerReviewApproval\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerReviewApproval&amp;token=363ce04ba91ab27986856d468b9c908d\" class=\"link\"> Seller Reviews Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"933\" id=\"subtab-AdminKbSellerReviewList\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerReviewList&amp;token=7f3b20a5b1a92a9697f1e4882154ae64\" class=\"link\"> Seller Reviews
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"934\" id=\"subtab-AdminKbSellerCRequest\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerCRequest&amp;token=8eefd5ce5fed5a7caf376929009f3d25\" class=\"link\"> Seller Category Request List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"935\" id=\"subtab-AdminKbSellerShipping\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerShipping&amp;token=b3e0f4fe5b3e7a06753f9c7b1ea83b10\" class=\"link\"> Seller Shippings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"936\" id=\"subtab-AdminKbSellerShippingMethod\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerShippingMethod&amp;token=0acfc45e920d5944befffac9b0997ef0\" class=\"link\"> Seller Shipping Method
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"937\" id=\"subtab-AdminKbCommission\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbCommission&amp;token=ac2a92237a0030ceb373b7fd978cf85c\" class=\"link\"> Admin Commissions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"938\" id=\"subtab-AdminKbSellerTransPayoutRequest\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerTransPayoutRequest&amp;token=29477b104aa154a53ba6e5e20867a7c8\" class=\"link\"> Transactions Payout Request
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"939\" id=\"subtab-AdminKbSellerTrans\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerTrans&amp;token=bae90f4febc86a32d482918aa8c30536\" class=\"link\"> Seller Transactions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"940\" id=\"subtab-AdminKbSellerCloseShopRequest\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbSellerCloseShopRequest&amp;token=d0c5bc40970e322b55844072909bc764\" class=\"link\"> Seller Shop Close Request
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"941\" id=\"subtab-AdminKbGDPRRequest\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbGDPRRequest&amp;token=22f35fb4ae09d382df793eb11006dec3\" class=\"link\"> GDPR Requests
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"942\" id=\"subtab-AdminKbMembershipPlanSetting\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbMembershipPlanSetting&amp;token=84f825c0d9b2f7790e2adf81c3b0abdc\" class=\"link\"> MemberShip Plan General Setting
                                </a>
                              </li>

                                                                                                                                                                                              
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"945\" id=\"subtab-AdminKbMembershipPlans\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbMembershipPlans&amp;token=f2faaf10da5d605bdec3c9bb38991fc7\" class=\"link\"> MemberShip Plans
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"946\" id=\"subtab-AdminKbMembershipSellerPlans\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbMembershipSellerPlans&amp;token=240eaa8d234b0f246a33f2f41b5afa3f\" class=\"link\"> Seller Membership Plans
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"948\" id=\"subtab-AdminKbEmail\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminKbEmail&amp;token=7b8aa2580547a75ef6dda41c4b15d201\" class=\"link\"> Email Templates
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"42\" id=\"tab-IMPROVE\">
                <span class=\"title\">Improve</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"43\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/admin4047wicsx/index.php/improve/modules/manage?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/modules/manage?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Module Manager
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"48\" id=\"subtab-AdminParentModulesCatalog\">
                                <a href=\"/admin4047wicsx/index.php/modules/addons/modules/catalog?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Module Catalog
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"52\" id=\"subtab-AdminParentThemes\">
                    <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Theme &amp; Logo
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"137\" id=\"subtab-AdminPsMboTheme\">
                                <a href=\"/admin4047wicsx/index.php/modules/addons/themes/catalog?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Theme Catalog
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"55\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/mail_theme/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Email Theme
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"57\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/cms-pages/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Pages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"58\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/modules/positions/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Positions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"59\" id=\"subtab-AdminImages\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminImages&amp;token=57dd9e8cdd92d6a8b0c1de5acee9d4e8\" class=\"link\"> Image Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"125\" id=\"subtab-AdminLinkWidget\">
                                <a href=\"/admin4047wicsx/index.php/modules/link-widget/list?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Link Widget
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"60\" id=\"subtab-AdminParentShipping\">
                    <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCarriers&amp;token=8ad25c1429d3b3b17a013bf7117fc5ab\" class=\"link\">
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
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminCarriers&amp;token=8ad25c1429d3b3b17a013bf7117fc5ab\" class=\"link\"> Carriers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"62\" id=\"subtab-AdminShipping\">
                                <a href=\"/admin4047wicsx/index.php/improve/shipping/preferences?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"63\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/admin4047wicsx/index.php/improve/payment/payment_methods?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/payment/payment_methods?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Payment Methods
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"65\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/admin4047wicsx/index.php/improve/payment/preferences?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"66\" id=\"subtab-AdminInternational\">
                    <a href=\"/admin4047wicsx/index.php/improve/international/localization/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/international/localization/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Localization
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"72\" id=\"subtab-AdminParentCountries\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminZones&amp;token=9d7b8c2d86bb0a47b9631c0014524e9a\" class=\"link\"> Locations
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"76\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/taxes/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> VAT
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"79\" id=\"subtab-AdminTranslations\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/translations/settings?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Translations
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"131\" id=\"subtab-AdminEmarketing\">
                    <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminEmarketing&amp;token=f8e645f763b57cdd5f645f269ec2c134\" class=\"link\">
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
                    <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=Adminxippost&amp;token=8ed3d66738d2326f5e6434961ebb4d85\" class=\"link\">
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
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=Adminxippost&amp;token=8ed3d66738d2326f5e6434961ebb4d85\" class=\"link\"> Blog Posts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"368\" id=\"subtab-Adminxipcategory\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=Adminxipcategory&amp;token=f9e65172fdc8edd525f8ba287bf69131\" class=\"link\"> Blog Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"369\" id=\"subtab-Adminxipcomment\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=Adminxipcomment&amp;token=9b07c137df89f733310244ff63d4a319\" class=\"link\"> Blog Comments
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"370\" id=\"subtab-Adminxipimagetype\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=Adminxipimagetype&amp;token=6cb01c116b492078189752e10714af3e\" class=\"link\"> Blog Image Type
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title -active\" data-submenu=\"80\" id=\"tab-CONFIGURE\">
                <span class=\"title\">Configure</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"81\" id=\"subtab-ShopParameters\">
                    <a href=\"/admin4047wicsx/index.php/configure/shop/preferences/preferences?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
                      <i class=\"material-icons mi-settings\">settings</i>
                      <span>
                      Shop Parameters
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-81\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"82\" id=\"subtab-AdminParentPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/preferences/preferences?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> General
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"85\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/order-preferences/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Order Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"88\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/product-preferences/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Product Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"89\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/customer-preferences/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Customer Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"93\" id=\"subtab-AdminParentStores\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/contacts/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> CMS page
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"96\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/seo-urls/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Traffic &amp; SEO
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"100\" id=\"subtab-AdminParentSearchConf\">
                                <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminSearchConf&amp;token=5f4679296e56b2e61cf8cbcda6281409\" class=\"link\"> Search
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                                                          
                  <li class=\"link-levelone has_submenu -active open ul-open\" data-submenu=\"103\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/admin4047wicsx/index.php/configure/advanced/system-information/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\">
                      <i class=\"material-icons mi-settings_applications\">settings_applications</i>
                      <span>
                      Advanced Parameters
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_up
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-103\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"104\" id=\"subtab-AdminInformation\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/system-information/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Information
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"105\" id=\"subtab-AdminPerformance\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/performance/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Performance
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"106\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/administration/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Administration
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo -active\" data-submenu=\"107\" id=\"subtab-AdminEmails\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/emails/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> E-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"108\" id=\"subtab-AdminImport\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/import/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Import
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"109\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/employees/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Team
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"113\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/sql-requests/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Database
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"116\" id=\"subtab-AdminLogs\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/logs/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Logs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"117\" id=\"subtab-AdminWebservice\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/webservice-keys/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" class=\"link\"> Webservice
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
                      <li class=\"breadcrumb-item\">Advanced Parameters</li>
          
                      <li class=\"breadcrumb-item active\">
              <a href=\"/admin4047wicsx/index.php/configure/advanced/emails/?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\" aria-current=\"page\">E-mail</a>
            </li>
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"title\">
            E-mail          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                        
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Help\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"/admin4047wicsx/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop.com%252Fgb%252Fdoc%252FAdminEmails%253Fversion%253D1.7.7.1%2526country%253Dgb/Help?_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k\"
                   id=\"product_form_open_help\"
                >
                  Help
                </a>
                                    </div>
        </div>
      
    </div>
  </div>

  
    <!-- begin /home/codeoperativeco/public_html/modules/ps_mbo/views/templates/hook/recommended-modules.tpl -->
<script>
  if (undefined !== mbo) {
    mbo.initialize({
      translations: {
        'Recommended Modules and Services': 'Recommended Modules and Services',
        'Close': 'Close',
      },
      recommendedModulesUrl: '/admin4047wicsx/index.php/modules/addons/modules/recommended?tabClassName=AdminEmails&_token=b3K0uiJ1Fqv9ld1ap7-HjamXaZTHFUNC0gWLUmZCx8k',
      shouldAttachRecommendedModulesAfterContent: 0,
      shouldAttachRecommendedModulesButton: 1,
      shouldUseLegacyTheme: 0,
    });
  }
</script>
<!-- end /home/codeoperativeco/public_html/modules/ps_mbo/views/templates/hook/recommended-modules.tpl -->
</div>
      
      <div class=\"content-div  \">

        

                                                        
        <div class=\"row \">
          <div class=\"col-sm-12\">
            <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>


  {% block content_header %}{% endblock %}
                 {% block content %}{% endblock %}
                 {% block content_footer %}{% endblock %}
                 {% block sidebar_right %}{% endblock %}

            
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
  <a href=\"https://reuse-home.org.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=6366eb4673b4baa44b7d8241d6f053a2\" class=\"btn btn-primary py-1 mt-3\">
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
\t\t\t\t\t<a href=\"https://addons.prestashop.com/gb/login?email=info%40reuse-home.org.uk&amp;firstname=Reuse&amp;lastname=Home&amp;website=http%3A%2F%2Freuse-home.org.uk%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-GB&amp;utm_content=download#createnow\"><img class=\"img-responsive center-block\" src=\"/admin4047wicsx/themes/default/img/prestashop-addons-logo.png\" alt=\"Logo PrestaShop Addons\"/></a>
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
\t\t\t\t\t\t\t<a class=\"btn btn-default btn-block btn-lg _blank\" href=\"https://addons.prestashop.com/gb/login?email=info%40reuse-home.org.uk&amp;firstname=Reuse&amp;lastname=Home&amp;website=http%3A%2F%2Freuse-home.org.uk%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-GB&amp;utm_content=download#createnow\">
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
  
{% block javascripts %}{% endblock %}{% block extra_javascripts %}{% endblock %}{% block translate_javascripts %}{% endblock %}</body>
</html>", "__string_template__59135f3130184f07b8b52ef4e9d3bdd41924fd3493080808943782bd29e73220", "");
    }
}

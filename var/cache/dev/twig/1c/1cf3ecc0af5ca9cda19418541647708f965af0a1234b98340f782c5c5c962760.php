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

/* __string_template__35544a965a8926564cee8e27e1d547e602bd44562ed81468da2fc65f461a3860 */
class __TwigTemplate_88e7e8ee1008698db97e2c74ad87ae0a9364d1e2b76ed1130849a76412c646c0 extends \Twig\Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "__string_template__35544a965a8926564cee8e27e1d547e602bd44562ed81468da2fc65f461a3860"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "__string_template__35544a965a8926564cee8e27e1d547e602bd44562ed81468da2fc65f461a3860"));

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

<title>Theme & Logo > Theme • The Reuse Network</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminThemes';
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
    var token = 'e7f496052e8af77a0b0448640d094768';
    var token_admin_orders = '595d86803a5ec9fbff499e43abceaa0e';
    var token_admin_customers = '6f889804f1886310c20b93b3a6611301';
    var token_admin_customer_threads = 'd2e67a2def8c4b8fdeeea31b06397f5e';
    var currentIndex = 'index.php?controller=AdminThemes';
    var employee_token = 'cc6a72694e2e1e0e6afaf6240ae34c12';
    var choose_language_translate = 'Choose language:';
    var default_language = '2';
    var admin_modules_link = '/admin4047wicsx/index.php/improve/modules/catalog/recommended?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8';
    var admin_notification_get_link = '/admin4047wicsx/index.php/common/notifications?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8';
    var admin_notification_push_link = '/admin4047wicsx/index.php/common/notifications/ack?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8';
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
var changeFormLanguageUrl = \"\\/admin4047wicsx\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\";
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

  <!-- Trigger/Open The Modal -->
<button id=\"myBtn\">Open Modal</button>

<!-- The Modal -->
<div id=\"myModalPostCode\" class=\"modal-postcode\">

  <!-- Modal content -->
  <div class=\"modal-postcode-content\">
    <span class=\"close\">&times;</span>
    <div id=\"postcodecheck\" data-postcodecheck-controller-url=\"\">
      <form method=\"post\" action=\"\">
        <input type=\"hidden\" name=\"controller\" value=\"\">
        <input type=\"hidden\" id=\"seller_id1\" name=\"seller_id1\" value=\"\">
        <input type=\"text\" name=\"buyer_postcode\" value=\"\">
        <p></p>
        <button type=\"submit\">
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Block mymodule -->
<div id=\"mymodule_block_home\" class=\"block\">
  <div class=\"block_content\">
    <p>My response: 
    </p>
    <!--<ul>
      <li><a href=\"\" title=\"Click this link\">Click me!</a></li>
    </ul>-->
  </div>
</div>
<!--/Block mymodule -->

";
        // line 111
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('extra_stylesheets', $context, $blocks);
        echo "</head>

<body
  class=\"lang-gb adminthemes\"
  data-base-url=\"/admin4047wicsx/index.php\"  data-token=\"FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=9320ac86cae2202e5b1050ac1d0bda6e\"></a>
      <span id=\"shop_version\">1.7.7.1</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Quick Access
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=30fa98105bbef7d8cd507e10115d8a68\"
                 data-item=\"Catalog evaluation\"
      >Catalog evaluation</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php/improve/modules/manage?token=6d356977de1e1609e6792c9446cda683\"
                 data-item=\"Installed modules\"
      >Installed modules</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php/sell/catalog/categories/new?token=6d356977de1e1609e6792c9446cda683\"
                 data-item=\"New category\"
      >New category</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php/sell/catalog/products/new?token=6d356977de1e1609e6792c9446cda683\"
                 data-item=\"New product\"
      >New product</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=57010115663e96573cd39f85d3e8e852\"
                 data-item=\"New voucher\"
      >New voucher</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminOrders&amp;token=595d86803a5ec9fbff499e43abceaa0e\"
                 data-item=\"Orders\"
      >Orders</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminModules&amp;&amp;configure=xipblog&amp;token=428770f9ab6f926dc1656343e3eb090f\"
                 data-item=\"XipBlog Settings\"
      >XipBlog Settings</a>
        <div class=\"dropdown-divider\"></div>
          <a
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"52\"
        data-icon=\"icon-AdminThemesParent\"
        data-method=\"add\"
        data-url=\"index.php/improve/design/themes\"
        data-post-link=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminQuickAccesses&token=368d9b4068cb578c3e2d2cd67f11264e\"
        data-prompt-text=\"Please name this shortcut:\"
        data-link=\"Theme &amp; Logo - List\"
      >
        <i class=\"material-icons\">add_circle</i>
        Add current page to Quick Access
      </a>
        <a class=\"dropdown-item\" href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminQuickAccesses&token=368d9b4068cb578c3e2d2cd67f11264e\">
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
      action=\"/admin4047wicsx/index.php?controller=AdminSearch&amp;token=2284e76f252e6030ac80e8796708cd1f\"
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
             href=\"/admin4047wicsx/index.php/configure/advanced/performance/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\"
          >
            <i class=\"material-icons\">bug_report</i>
            <span>Debug mode</span>
          </a>
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
              Have you checked your <strong><a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarts&action=filterOnlyAbandonedCarts&token=9e65625881f44c0ccd27a4d11cc4b2b6\">abandoned carts</a></strong>?<br>Your next order could be hiding there!
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"customers-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              No new customer for now :(<br>
              Have you sent any acquisition email lately?
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
      
      <span class=\"employee_avatar\"><img class=\"avatar rounded-circle\" src=\"https://profile.prestashop.com/noelia.gale1%40gmail.com.jpg\" /></span>
      <span class=\"employee_profile\">Welcome back Knowband</span>
      <a class=\"dropdown-item employee-link profile-link\" href=\"/admin4047wicsx/index.php/configure/advanced/employees/2/edit?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\">
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
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminLogin&amp;logout=1&amp;token=12828fb4bb06d8b8e7ae560b4ab6361f\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Sign out</span>
    </a>
  </div>
</div>
      </div>
          </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/admin4047wicsx/index.php/configure/advanced/employees/toggle-navigation?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\">
    <i class=\"material-icons\">chevron_left</i>
    <i class=\"material-icons\">chevron_left</i>
  </span>

  <div class=\"nav-bar-overflow\">
    <ul class=\"main-menu\">
              
                    
                    
          
            <li class=\"link-levelone \" data-submenu=\"1\" id=\"tab-AdminDashboard\">
              <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=9320ac86cae2202e5b1050ac1d0bda6e\" class=\"link\" >
                <i class=\"material-icons\">trending_up</i> <span>Dashboard</span>
              </a>
            </li>

          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Sell</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/admin4047wicsx/index.php/sell/orders/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/orders/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"5\" id=\"subtab-AdminInvoices\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/invoices/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Invoices
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/credit-slips/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Credit Notes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/delivery-slips/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Delivery Slips
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarts&amp;token=9e65625881f44c0ccd27a4d11cc4b2b6\" class=\"link\"> Shopping Carts
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/admin4047wicsx/index.php/sell/catalog/products?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/products?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/categories?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/monitoring/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Monitoring
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminAttributesGroups&amp;token=336a0383ca9738bab84db76c8ca9efb4\" class=\"link\"> Attributes &amp; Features
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/brands/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Brands &amp; Suppliers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/admin4047wicsx/index.php/sell/attachments/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Files
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCartRules&amp;token=57010115663e96573cd39f85d3e8e852\" class=\"link\"> Discounts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/admin4047wicsx/index.php/sell/stocks/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Stocks
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/admin4047wicsx/index.php/sell/customers/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/customers/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Customers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                                <a href=\"/admin4047wicsx/index.php/sell/addresses/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Addresses
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCustomerThreads&amp;token=d2e67a2def8c4b8fdeeea31b06397f5e\" class=\"link\">
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
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCustomerThreads&amp;token=d2e67a2def8c4b8fdeeea31b06397f5e\" class=\"link\"> Customer Service
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/admin4047wicsx/index.php/sell/customer-service/order-messages/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Order Messages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminReturn&amp;token=d2c3712c22439bb598540b72487fd5f4\" class=\"link\"> Merchandise Returns
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminStats&amp;token=30fa98105bbef7d8cd507e10115d8a68\" class=\"link\">
                      <i class=\"material-icons mi-assessment\">assessment</i>
                      <span>
                      Stats
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                                                            
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"336\" id=\"subtab-KBMPMainTab\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMarketPlaceSetting&amp;token=2d9aad8c0d1c8f60fa85180531924326\" class=\"link\">
                      <i class=\"material-icons mi-store\">store</i>
                      <span>
                      Knowband Marketplace
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-336\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"337\" id=\"subtab-AdminKbMarketPlaceSetting\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMarketPlaceSetting&amp;token=2d9aad8c0d1c8f60fa85180531924326\" class=\"link\"> Settings
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"339\" id=\"subtab-AdminKbMpCustomFields\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMpCustomFields&amp;token=959ffdb9bd500655bb10084c1812ffd6\" class=\"link\"> Profile form Custom Fields
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"340\" id=\"subtab-AdminKbSellerList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerList&amp;token=3720724f5784edb50b7884d977dd0bbe\" class=\"link\"> Sellers List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"341\" id=\"subtab-AdminKbSellerApprovalList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerApprovalList&amp;token=d41b9057b31a86325d87af8b77001c90\" class=\"link\"> Seller Account Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"342\" id=\"subtab-AdminKbProductApprovalList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbProductApprovalList&amp;token=015143d3b0cc0a20b8a116f2a5133015\" class=\"link\"> Product Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"343\" id=\"subtab-AdminKbProductList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbProductList&amp;token=84f286a2e0fc37dedc0670e7f3acaf63\" class=\"link\"> Seller Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"344\" id=\"subtab-AdminKbCategoryWiseCommission\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbCategoryWiseCommission&amp;token=641a93c915afbcb49a762c2c2de0d257\" class=\"link\"> Category Wise Commission Rules
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"346\" id=\"subtab-AdminKbOrderList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbOrderList&amp;token=8ed5c9d4e8f43f24aaf600c1b399aa28\" class=\"link\"> Seller Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"347\" id=\"subtab-AdminKbadminOrderList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbadminOrderList&amp;token=afd1a4e6fccdc0f7d4fc4d837074e8ac\" class=\"link\"> Admin Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"348\" id=\"subtab-AdminKbSProductReview\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSProductReview&amp;token=3ecfae318716e06e5d803c8372297bcd\" class=\"link\"> Product Reviews
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"349\" id=\"subtab-AdminKbSellerReviewApproval\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerReviewApproval&amp;token=cc1ec5e280ce5f6003c1c3d6bbee16fd\" class=\"link\"> Seller Reviews Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"350\" id=\"subtab-AdminKbSellerReviewList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerReviewList&amp;token=8f0e1c07e77c92549d52a6d07b2c6b02\" class=\"link\"> Seller Reviews
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"351\" id=\"subtab-AdminKbSellerCRequest\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerCRequest&amp;token=9b25af16e5f8874afd9f9ad90717f6b9\" class=\"link\"> Seller Category Request List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"352\" id=\"subtab-AdminKbSellerShipping\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerShipping&amp;token=a0ebc735b444cff31d2dece4b3e50c38\" class=\"link\"> Seller Shippings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"353\" id=\"subtab-AdminKbSellerShippingMethod\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerShippingMethod&amp;token=85d92b74b48b38a585c59213d6e4ec2c\" class=\"link\"> Seller Shipping Method
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"354\" id=\"subtab-AdminKbCommission\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbCommission&amp;token=a21ecf01258a472dc0a6e736a043869b\" class=\"link\"> Admin Commissions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"355\" id=\"subtab-AdminKbSellerTransPayoutRequest\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerTransPayoutRequest&amp;token=ec1af0941e8f2f47273161503114696b\" class=\"link\"> Transactions Payout Request
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"356\" id=\"subtab-AdminKbSellerTrans\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerTrans&amp;token=95c300809b8b92635430bf6acce667f6\" class=\"link\"> Seller Transactions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"357\" id=\"subtab-AdminKbSellerCloseShopRequest\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerCloseShopRequest&amp;token=84e667562b5486e3b053e9466c5cc1ed\" class=\"link\"> Seller Shop Close Request
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"358\" id=\"subtab-AdminKbGDPRRequest\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbGDPRRequest&amp;token=8fc75b3c833812a965cfb29daf84f72f\" class=\"link\"> GDPR Requests
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"359\" id=\"subtab-AdminKbMembershipPlanSetting\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMembershipPlanSetting&amp;token=67bf855a4d07fa9aa5a55a00ee22dbab\" class=\"link\"> MemberShip Plan General Setting
                                </a>
                              </li>

                                                                                                                                                                                              
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"362\" id=\"subtab-AdminKbMembershipPlans\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMembershipPlans&amp;token=33a17b97227a61a6c0fd4446dbfc5290\" class=\"link\"> MemberShip Plans
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"363\" id=\"subtab-AdminKbMembershipSellerPlans\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMembershipSellerPlans&amp;token=9467011df3d4164c7daa03eb9cbe355e\" class=\"link\"> Seller Membership Plans
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"365\" id=\"subtab-AdminKbEmail\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbEmail&amp;token=58c8a3ed69917a12108db2f1b49fa8a3\" class=\"link\"> Email Templates
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title -active\" data-submenu=\"42\" id=\"tab-IMPROVE\">
                <span class=\"title\">Improve</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"43\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/admin4047wicsx/index.php/improve/modules/manage?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/modules/manage?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Module Manager
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"48\" id=\"subtab-AdminParentModulesCatalog\">
                                <a href=\"/admin4047wicsx/index.php/modules/addons/modules/catalog?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Module Catalog
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                                                          
                  <li class=\"link-levelone has_submenu -active open ul-open\" data-submenu=\"52\" id=\"subtab-AdminParentThemes\">
                    <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
                      <i class=\"material-icons mi-desktop_mac\">desktop_mac</i>
                      <span>
                      Design
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_up
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-52\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo -active\" data-submenu=\"126\" id=\"subtab-AdminThemesParent\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Theme &amp; Logo
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"137\" id=\"subtab-AdminPsMboTheme\">
                                <a href=\"/admin4047wicsx/index.php/modules/addons/themes/catalog?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Theme Catalog
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"55\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/mail_theme/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Email Theme
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"57\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/cms-pages/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Pages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"58\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/modules/positions/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Positions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"59\" id=\"subtab-AdminImages\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminImages&amp;token=8ac7759664b284ac368bfa155e16bcba\" class=\"link\"> Image Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"125\" id=\"subtab-AdminLinkWidget\">
                                <a href=\"/admin4047wicsx/index.php/modules/link-widget/list?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Link Widget
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"60\" id=\"subtab-AdminParentShipping\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarriers&amp;token=71cf72df56d610ca30ca56724335af9c\" class=\"link\">
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
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarriers&amp;token=71cf72df56d610ca30ca56724335af9c\" class=\"link\"> Carriers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"62\" id=\"subtab-AdminShipping\">
                                <a href=\"/admin4047wicsx/index.php/improve/shipping/preferences?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"63\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/admin4047wicsx/index.php/improve/payment/payment_methods?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/payment/payment_methods?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Payment Methods
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"65\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/admin4047wicsx/index.php/improve/payment/preferences?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"66\" id=\"subtab-AdminInternational\">
                    <a href=\"/admin4047wicsx/index.php/improve/international/localization/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/international/localization/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Localization
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"72\" id=\"subtab-AdminParentCountries\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminZones&amp;token=7fae3b89bcc56bd6650d26cbf1257920\" class=\"link\"> Locations
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"76\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/taxes/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> VAT
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"79\" id=\"subtab-AdminTranslations\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/translations/settings?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Translations
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"131\" id=\"subtab-AdminEmarketing\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminEmarketing&amp;token=09b55512d3861a51deed03076e23d3ee\" class=\"link\">
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
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxippost&amp;token=c2ce0cdc7d174aa943980948a75bfac2\" class=\"link\">
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
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxippost&amp;token=c2ce0cdc7d174aa943980948a75bfac2\" class=\"link\"> Blog Posts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"368\" id=\"subtab-Adminxipcategory\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxipcategory&amp;token=0481e5ac4abdfc2decd15ac8adbc4a6b\" class=\"link\"> Blog Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"369\" id=\"subtab-Adminxipcomment\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxipcomment&amp;token=06a036d5bfca8898a44b5ce5dcb1dc77\" class=\"link\"> Blog Comments
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"370\" id=\"subtab-Adminxipimagetype\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxipimagetype&amp;token=ec971858e173077299a370ce65f293cf\" class=\"link\"> Blog Image Type
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"80\" id=\"tab-CONFIGURE\">
                <span class=\"title\">Configure</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"81\" id=\"subtab-ShopParameters\">
                    <a href=\"/admin4047wicsx/index.php/configure/shop/preferences/preferences?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/configure/shop/preferences/preferences?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> General
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"85\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/order-preferences/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Order Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"88\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/product-preferences/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Product Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"89\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/customer-preferences/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Customer Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"93\" id=\"subtab-AdminParentStores\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/contacts/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> CMS page
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"96\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/seo-urls/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Traffic &amp; SEO
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"100\" id=\"subtab-AdminParentSearchConf\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminSearchConf&amp;token=5bc34915d95773a4c9735de2e5c63142\" class=\"link\"> Search
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"103\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/admin4047wicsx/index.php/configure/advanced/system-information/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/system-information/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Information
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"105\" id=\"subtab-AdminPerformance\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/performance/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Performance
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"106\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/administration/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Administration
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"107\" id=\"subtab-AdminEmails\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/emails/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> E-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"108\" id=\"subtab-AdminImport\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/import/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Import
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"109\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/employees/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Team
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"113\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/sql-requests/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Database
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"116\" id=\"subtab-AdminLogs\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/logs/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Logs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"117\" id=\"subtab-AdminWebservice\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/webservice-keys/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Webservice
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
                      <li class=\"breadcrumb-item\">Theme &amp; Logo</li>
          
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"title\">
            Theme &amp; Logo &gt; Theme          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                                                          <a
                  class=\"btn btn-primary  pointer\"                  id=\"page-header-desc-configuration-add\"
                  href=\"/admin4047wicsx/index.php/improve/design/themes/import?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\"                  title=\"Add new theme\"                >
                  <i class=\"material-icons\">add</i>                  Add new theme
                </a>
                                                                        <a
                  class=\"btn btn-primary  pointer\"                  id=\"page-header-desc-configuration-export\"
                  href=\"/admin4047wicsx/index.php/improve/design/themes/export?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\"                  title=\"Export current theme\"                >
                  <i class=\"material-icons\">cloud_download</i>                  Export current theme
                </a>
                                      
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Help\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"/admin4047wicsx/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop.com%252Fgb%252Fdoc%252FAdminThemes%253Fversion%253D1.7.7.1%2526country%253Dgb/Help?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\"
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
                    <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" id=\"subtab-AdminThemes\" class=\"nav-link tab active current\" data-submenu=\"53\">
                      Theme & Logo
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminPsThemeCustoConfiguration&token=a25c635fd114310caeb27c29b2d4455b\" id=\"subtab-AdminPsThemeCustoConfiguration\" class=\"nav-link tab \" data-submenu=\"127\">
                      Pages Configuration
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminPsThemeCustoAdvanced&token=0b3b9fffe37852ba5e10ab030995363a\" id=\"subtab-AdminPsThemeCustoAdvanced\" class=\"nav-link tab \" data-submenu=\"128\">
                      Advanced Customization
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  </ul>
    </div>
    <!-- begin /home/codeoperativeco/prestaoperative/modules/ps_mbo/views/templates/hook/recommended-modules.tpl -->
<script>
  if (undefined !== mbo) {
    mbo.initialize({
      translations: {
        'Recommended Modules and Services': 'Recommended Modules and Services',
        'Close': 'Close',
      },
      recommendedModulesUrl: '/admin4047wicsx/index.php/modules/addons/modules/recommended?tabClassName=AdminThemes&_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8',
      shouldAttachRecommendedModulesAfterContent: 0,
      shouldAttachRecommendedModulesButton: 1,
      shouldUseLegacyTheme: 0,
    });
  }
</script>
<!-- end /home/codeoperativeco/prestaoperative/modules/ps_mbo/views/templates/hook/recommended-modules.tpl -->
</div>
      
      <div class=\"content-div  with-tabs\">

        

                                                        
        <div class=\"row \">
          <div class=\"col-sm-12\">
            <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>


  ";
        // line 1421
        $this->displayBlock('content_header', $context, $blocks);
        // line 1422
        echo "                 ";
        $this->displayBlock('content', $context, $blocks);
        // line 1423
        echo "                 ";
        $this->displayBlock('content_footer', $context, $blocks);
        // line 1424
        echo "                 ";
        $this->displayBlock('sidebar_right', $context, $blocks);
        // line 1425
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
  <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=9320ac86cae2202e5b1050ac1d0bda6e\" class=\"btn btn-primary py-1 mt-3\">
    <i class=\"material-icons\">arrow_back</i>
    Back
  </a>
</div>
  <div class=\"mobile-layer\"></div>

      <div id=\"footer\" class=\"bootstrap\">
    
</div>
  
  <div class=\"bootstrap\">
\t<div id=\"error-modal\" class=\"modal fade\">
\t\t<div class=\"modal-dialog\">
\t\t\t<div class=\"alert alert-danger clearfix\">
\t\t\t\t\t\t\t\t\tNotice on line 33 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Undefined index: postcodecheck_controller_url<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 33 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Trying to get property &#039;value&#039; of non-object<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 35 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Undefined index: postcodecheck_controller_url<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 35 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Trying to get property &#039;value&#039; of non-object<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 39 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Undefined index: postcode_string<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 39 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Trying to get property &#039;value&#039; of non-object<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 41 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Undefined index: my_module_message<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 41 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Trying to get property &#039;value&#039; of non-object<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 53 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Undefined index: my_module_message<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 53 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Trying to get property &#039;value&#039; of non-object<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 57 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Undefined index: my_module_link<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 57 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Trying to get property &#039;value&#039; of non-object<br /><br />
\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-default float-right\" data-dismiss=\"modal\"><i class=\"icon-remove\"></i> Close</button>
\t\t\t</div>
\t\t</div>
\t</div>
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
\t\t\t\t\t<a href=\"https://addons.prestashop.com/gb/login?email=noelia.gale1%40gmail.com&amp;firstname=Knowband&amp;lastname=Support&amp;website=http%3A%2F%2Freusenetwork.code-operative.co.uk%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-GB&amp;utm_content=download#createnow\"><img class=\"img-responsive center-block\" src=\"/admin4047wicsx/themes/default/img/prestashop-addons-logo.png\" alt=\"Logo PrestaShop Addons\"/></a>
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
\t\t\t\t\t\t\t<a class=\"btn btn-default btn-block btn-lg _blank\" href=\"https://addons.prestashop.com/gb/login?email=noelia.gale1%40gmail.com&amp;firstname=Knowband&amp;lastname=Support&amp;website=http%3A%2F%2Freusenetwork.code-operative.co.uk%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-GB&amp;utm_content=download#createnow\">
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
        // line 1565
        $this->displayBlock('javascripts', $context, $blocks);
        $this->displayBlock('extra_javascripts', $context, $blocks);
        $this->displayBlock('translate_javascripts', $context, $blocks);
        echo "</body>
</html>";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 111
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

    // line 1421
    public function block_content_header($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_header"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_header"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 1422
    public function block_content($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 1423
    public function block_content_footer($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_footer"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content_footer"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 1424
    public function block_sidebar_right($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sidebar_right"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "sidebar_right"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 1565
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
        return "__string_template__35544a965a8926564cee8e27e1d547e602bd44562ed81468da2fc65f461a3860";
    }

    public function getDebugInfo()
    {
        return array (  1739 => 1565,  1722 => 1424,  1705 => 1423,  1688 => 1422,  1671 => 1421,  1638 => 111,  1624 => 1565,  1482 => 1425,  1479 => 1424,  1476 => 1423,  1473 => 1422,  1471 => 1421,  157 => 111,  45 => 1,);
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

<title>Theme & Logo > Theme • The Reuse Network</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminThemes';
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
    var token = 'e7f496052e8af77a0b0448640d094768';
    var token_admin_orders = '595d86803a5ec9fbff499e43abceaa0e';
    var token_admin_customers = '6f889804f1886310c20b93b3a6611301';
    var token_admin_customer_threads = 'd2e67a2def8c4b8fdeeea31b06397f5e';
    var currentIndex = 'index.php?controller=AdminThemes';
    var employee_token = 'cc6a72694e2e1e0e6afaf6240ae34c12';
    var choose_language_translate = 'Choose language:';
    var default_language = '2';
    var admin_modules_link = '/admin4047wicsx/index.php/improve/modules/catalog/recommended?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8';
    var admin_notification_get_link = '/admin4047wicsx/index.php/common/notifications?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8';
    var admin_notification_push_link = '/admin4047wicsx/index.php/common/notifications/ack?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8';
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
var changeFormLanguageUrl = \"\\/admin4047wicsx\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\";
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

  <!-- Trigger/Open The Modal -->
<button id=\"myBtn\">Open Modal</button>

<!-- The Modal -->
<div id=\"myModalPostCode\" class=\"modal-postcode\">

  <!-- Modal content -->
  <div class=\"modal-postcode-content\">
    <span class=\"close\">&times;</span>
    <div id=\"postcodecheck\" data-postcodecheck-controller-url=\"\">
      <form method=\"post\" action=\"\">
        <input type=\"hidden\" name=\"controller\" value=\"\">
        <input type=\"hidden\" id=\"seller_id1\" name=\"seller_id1\" value=\"\">
        <input type=\"text\" name=\"buyer_postcode\" value=\"\">
        <p></p>
        <button type=\"submit\">
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Block mymodule -->
<div id=\"mymodule_block_home\" class=\"block\">
  <div class=\"block_content\">
    <p>My response: 
    </p>
    <!--<ul>
      <li><a href=\"\" title=\"Click this link\">Click me!</a></li>
    </ul>-->
  </div>
</div>
<!--/Block mymodule -->

{% block stylesheets %}{% endblock %}{% block extra_stylesheets %}{% endblock %}</head>

<body
  class=\"lang-gb adminthemes\"
  data-base-url=\"/admin4047wicsx/index.php\"  data-token=\"FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=9320ac86cae2202e5b1050ac1d0bda6e\"></a>
      <span id=\"shop_version\">1.7.7.1</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Quick Access
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=30fa98105bbef7d8cd507e10115d8a68\"
                 data-item=\"Catalog evaluation\"
      >Catalog evaluation</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php/improve/modules/manage?token=6d356977de1e1609e6792c9446cda683\"
                 data-item=\"Installed modules\"
      >Installed modules</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php/sell/catalog/categories/new?token=6d356977de1e1609e6792c9446cda683\"
                 data-item=\"New category\"
      >New category</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php/sell/catalog/products/new?token=6d356977de1e1609e6792c9446cda683\"
                 data-item=\"New product\"
      >New product</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=57010115663e96573cd39f85d3e8e852\"
                 data-item=\"New voucher\"
      >New voucher</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminOrders&amp;token=595d86803a5ec9fbff499e43abceaa0e\"
                 data-item=\"Orders\"
      >Orders</a>
          <a class=\"dropdown-item\"
         href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminModules&amp;&amp;configure=xipblog&amp;token=428770f9ab6f926dc1656343e3eb090f\"
                 data-item=\"XipBlog Settings\"
      >XipBlog Settings</a>
        <div class=\"dropdown-divider\"></div>
          <a
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"52\"
        data-icon=\"icon-AdminThemesParent\"
        data-method=\"add\"
        data-url=\"index.php/improve/design/themes\"
        data-post-link=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminQuickAccesses&token=368d9b4068cb578c3e2d2cd67f11264e\"
        data-prompt-text=\"Please name this shortcut:\"
        data-link=\"Theme &amp; Logo - List\"
      >
        <i class=\"material-icons\">add_circle</i>
        Add current page to Quick Access
      </a>
        <a class=\"dropdown-item\" href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminQuickAccesses&token=368d9b4068cb578c3e2d2cd67f11264e\">
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
      action=\"/admin4047wicsx/index.php?controller=AdminSearch&amp;token=2284e76f252e6030ac80e8796708cd1f\"
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
             href=\"/admin4047wicsx/index.php/configure/advanced/performance/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\"
          >
            <i class=\"material-icons\">bug_report</i>
            <span>Debug mode</span>
          </a>
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
              Have you checked your <strong><a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarts&action=filterOnlyAbandonedCarts&token=9e65625881f44c0ccd27a4d11cc4b2b6\">abandoned carts</a></strong>?<br>Your next order could be hiding there!
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"customers-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              No new customer for now :(<br>
              Have you sent any acquisition email lately?
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
      
      <span class=\"employee_avatar\"><img class=\"avatar rounded-circle\" src=\"https://profile.prestashop.com/noelia.gale1%40gmail.com.jpg\" /></span>
      <span class=\"employee_profile\">Welcome back Knowband</span>
      <a class=\"dropdown-item employee-link profile-link\" href=\"/admin4047wicsx/index.php/configure/advanced/employees/2/edit?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\">
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
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminLogin&amp;logout=1&amp;token=12828fb4bb06d8b8e7ae560b4ab6361f\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Sign out</span>
    </a>
  </div>
</div>
      </div>
          </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/admin4047wicsx/index.php/configure/advanced/employees/toggle-navigation?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\">
    <i class=\"material-icons\">chevron_left</i>
    <i class=\"material-icons\">chevron_left</i>
  </span>

  <div class=\"nav-bar-overflow\">
    <ul class=\"main-menu\">
              
                    
                    
          
            <li class=\"link-levelone \" data-submenu=\"1\" id=\"tab-AdminDashboard\">
              <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=9320ac86cae2202e5b1050ac1d0bda6e\" class=\"link\" >
                <i class=\"material-icons\">trending_up</i> <span>Dashboard</span>
              </a>
            </li>

          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Sell</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/admin4047wicsx/index.php/sell/orders/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/orders/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"5\" id=\"subtab-AdminInvoices\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/invoices/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Invoices
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/credit-slips/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Credit Notes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/admin4047wicsx/index.php/sell/orders/delivery-slips/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Delivery Slips
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarts&amp;token=9e65625881f44c0ccd27a4d11cc4b2b6\" class=\"link\"> Shopping Carts
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/admin4047wicsx/index.php/sell/catalog/products?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/products?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/categories?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/monitoring/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Monitoring
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminAttributesGroups&amp;token=336a0383ca9738bab84db76c8ca9efb4\" class=\"link\"> Attributes &amp; Features
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/admin4047wicsx/index.php/sell/catalog/brands/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Brands &amp; Suppliers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/admin4047wicsx/index.php/sell/attachments/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Files
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCartRules&amp;token=57010115663e96573cd39f85d3e8e852\" class=\"link\"> Discounts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/admin4047wicsx/index.php/sell/stocks/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Stocks
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/admin4047wicsx/index.php/sell/customers/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/sell/customers/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Customers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                                <a href=\"/admin4047wicsx/index.php/sell/addresses/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Addresses
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCustomerThreads&amp;token=d2e67a2def8c4b8fdeeea31b06397f5e\" class=\"link\">
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
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCustomerThreads&amp;token=d2e67a2def8c4b8fdeeea31b06397f5e\" class=\"link\"> Customer Service
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/admin4047wicsx/index.php/sell/customer-service/order-messages/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Order Messages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminReturn&amp;token=d2c3712c22439bb598540b72487fd5f4\" class=\"link\"> Merchandise Returns
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminStats&amp;token=30fa98105bbef7d8cd507e10115d8a68\" class=\"link\">
                      <i class=\"material-icons mi-assessment\">assessment</i>
                      <span>
                      Stats
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                                                            
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"336\" id=\"subtab-KBMPMainTab\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMarketPlaceSetting&amp;token=2d9aad8c0d1c8f60fa85180531924326\" class=\"link\">
                      <i class=\"material-icons mi-store\">store</i>
                      <span>
                      Knowband Marketplace
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-336\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"337\" id=\"subtab-AdminKbMarketPlaceSetting\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMarketPlaceSetting&amp;token=2d9aad8c0d1c8f60fa85180531924326\" class=\"link\"> Settings
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"339\" id=\"subtab-AdminKbMpCustomFields\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMpCustomFields&amp;token=959ffdb9bd500655bb10084c1812ffd6\" class=\"link\"> Profile form Custom Fields
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"340\" id=\"subtab-AdminKbSellerList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerList&amp;token=3720724f5784edb50b7884d977dd0bbe\" class=\"link\"> Sellers List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"341\" id=\"subtab-AdminKbSellerApprovalList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerApprovalList&amp;token=d41b9057b31a86325d87af8b77001c90\" class=\"link\"> Seller Account Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"342\" id=\"subtab-AdminKbProductApprovalList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbProductApprovalList&amp;token=015143d3b0cc0a20b8a116f2a5133015\" class=\"link\"> Product Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"343\" id=\"subtab-AdminKbProductList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbProductList&amp;token=84f286a2e0fc37dedc0670e7f3acaf63\" class=\"link\"> Seller Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"344\" id=\"subtab-AdminKbCategoryWiseCommission\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbCategoryWiseCommission&amp;token=641a93c915afbcb49a762c2c2de0d257\" class=\"link\"> Category Wise Commission Rules
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"346\" id=\"subtab-AdminKbOrderList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbOrderList&amp;token=8ed5c9d4e8f43f24aaf600c1b399aa28\" class=\"link\"> Seller Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"347\" id=\"subtab-AdminKbadminOrderList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbadminOrderList&amp;token=afd1a4e6fccdc0f7d4fc4d837074e8ac\" class=\"link\"> Admin Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"348\" id=\"subtab-AdminKbSProductReview\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSProductReview&amp;token=3ecfae318716e06e5d803c8372297bcd\" class=\"link\"> Product Reviews
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"349\" id=\"subtab-AdminKbSellerReviewApproval\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerReviewApproval&amp;token=cc1ec5e280ce5f6003c1c3d6bbee16fd\" class=\"link\"> Seller Reviews Approval List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"350\" id=\"subtab-AdminKbSellerReviewList\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerReviewList&amp;token=8f0e1c07e77c92549d52a6d07b2c6b02\" class=\"link\"> Seller Reviews
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"351\" id=\"subtab-AdminKbSellerCRequest\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerCRequest&amp;token=9b25af16e5f8874afd9f9ad90717f6b9\" class=\"link\"> Seller Category Request List
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"352\" id=\"subtab-AdminKbSellerShipping\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerShipping&amp;token=a0ebc735b444cff31d2dece4b3e50c38\" class=\"link\"> Seller Shippings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"353\" id=\"subtab-AdminKbSellerShippingMethod\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerShippingMethod&amp;token=85d92b74b48b38a585c59213d6e4ec2c\" class=\"link\"> Seller Shipping Method
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"354\" id=\"subtab-AdminKbCommission\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbCommission&amp;token=a21ecf01258a472dc0a6e736a043869b\" class=\"link\"> Admin Commissions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"355\" id=\"subtab-AdminKbSellerTransPayoutRequest\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerTransPayoutRequest&amp;token=ec1af0941e8f2f47273161503114696b\" class=\"link\"> Transactions Payout Request
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"356\" id=\"subtab-AdminKbSellerTrans\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerTrans&amp;token=95c300809b8b92635430bf6acce667f6\" class=\"link\"> Seller Transactions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"357\" id=\"subtab-AdminKbSellerCloseShopRequest\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbSellerCloseShopRequest&amp;token=84e667562b5486e3b053e9466c5cc1ed\" class=\"link\"> Seller Shop Close Request
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"358\" id=\"subtab-AdminKbGDPRRequest\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbGDPRRequest&amp;token=8fc75b3c833812a965cfb29daf84f72f\" class=\"link\"> GDPR Requests
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"359\" id=\"subtab-AdminKbMembershipPlanSetting\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMembershipPlanSetting&amp;token=67bf855a4d07fa9aa5a55a00ee22dbab\" class=\"link\"> MemberShip Plan General Setting
                                </a>
                              </li>

                                                                                                                                                                                              
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"362\" id=\"subtab-AdminKbMembershipPlans\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMembershipPlans&amp;token=33a17b97227a61a6c0fd4446dbfc5290\" class=\"link\"> MemberShip Plans
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"363\" id=\"subtab-AdminKbMembershipSellerPlans\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbMembershipSellerPlans&amp;token=9467011df3d4164c7daa03eb9cbe355e\" class=\"link\"> Seller Membership Plans
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"365\" id=\"subtab-AdminKbEmail\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminKbEmail&amp;token=58c8a3ed69917a12108db2f1b49fa8a3\" class=\"link\"> Email Templates
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title -active\" data-submenu=\"42\" id=\"tab-IMPROVE\">
                <span class=\"title\">Improve</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"43\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/admin4047wicsx/index.php/improve/modules/manage?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/modules/manage?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Module Manager
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"48\" id=\"subtab-AdminParentModulesCatalog\">
                                <a href=\"/admin4047wicsx/index.php/modules/addons/modules/catalog?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Module Catalog
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                                                          
                  <li class=\"link-levelone has_submenu -active open ul-open\" data-submenu=\"52\" id=\"subtab-AdminParentThemes\">
                    <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
                      <i class=\"material-icons mi-desktop_mac\">desktop_mac</i>
                      <span>
                      Design
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_up
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-52\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo -active\" data-submenu=\"126\" id=\"subtab-AdminThemesParent\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Theme &amp; Logo
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"137\" id=\"subtab-AdminPsMboTheme\">
                                <a href=\"/admin4047wicsx/index.php/modules/addons/themes/catalog?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Theme Catalog
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"55\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/mail_theme/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Email Theme
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"57\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/cms-pages/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Pages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"58\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/admin4047wicsx/index.php/improve/design/modules/positions/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Positions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"59\" id=\"subtab-AdminImages\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminImages&amp;token=8ac7759664b284ac368bfa155e16bcba\" class=\"link\"> Image Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"125\" id=\"subtab-AdminLinkWidget\">
                                <a href=\"/admin4047wicsx/index.php/modules/link-widget/list?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Link Widget
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"60\" id=\"subtab-AdminParentShipping\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarriers&amp;token=71cf72df56d610ca30ca56724335af9c\" class=\"link\">
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
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminCarriers&amp;token=71cf72df56d610ca30ca56724335af9c\" class=\"link\"> Carriers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"62\" id=\"subtab-AdminShipping\">
                                <a href=\"/admin4047wicsx/index.php/improve/shipping/preferences?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"63\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/admin4047wicsx/index.php/improve/payment/payment_methods?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/payment/payment_methods?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Payment Methods
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"65\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/admin4047wicsx/index.php/improve/payment/preferences?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"66\" id=\"subtab-AdminInternational\">
                    <a href=\"/admin4047wicsx/index.php/improve/international/localization/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/improve/international/localization/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Localization
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"72\" id=\"subtab-AdminParentCountries\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminZones&amp;token=7fae3b89bcc56bd6650d26cbf1257920\" class=\"link\"> Locations
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"76\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/taxes/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> VAT
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"79\" id=\"subtab-AdminTranslations\">
                                <a href=\"/admin4047wicsx/index.php/improve/international/translations/settings?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Translations
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"131\" id=\"subtab-AdminEmarketing\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminEmarketing&amp;token=09b55512d3861a51deed03076e23d3ee\" class=\"link\">
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
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxippost&amp;token=c2ce0cdc7d174aa943980948a75bfac2\" class=\"link\">
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
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxippost&amp;token=c2ce0cdc7d174aa943980948a75bfac2\" class=\"link\"> Blog Posts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"368\" id=\"subtab-Adminxipcategory\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxipcategory&amp;token=0481e5ac4abdfc2decd15ac8adbc4a6b\" class=\"link\"> Blog Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"369\" id=\"subtab-Adminxipcomment\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxipcomment&amp;token=06a036d5bfca8898a44b5ce5dcb1dc77\" class=\"link\"> Blog Comments
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"370\" id=\"subtab-Adminxipimagetype\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=Adminxipimagetype&amp;token=ec971858e173077299a370ce65f293cf\" class=\"link\"> Blog Image Type
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title \" data-submenu=\"80\" id=\"tab-CONFIGURE\">
                <span class=\"title\">Configure</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"81\" id=\"subtab-ShopParameters\">
                    <a href=\"/admin4047wicsx/index.php/configure/shop/preferences/preferences?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/configure/shop/preferences/preferences?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> General
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"85\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/order-preferences/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Order Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"88\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/product-preferences/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Product Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"89\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/customer-preferences/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Customer Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"93\" id=\"subtab-AdminParentStores\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/contacts/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> CMS page
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"96\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/admin4047wicsx/index.php/configure/shop/seo-urls/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Traffic &amp; SEO
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"100\" id=\"subtab-AdminParentSearchConf\">
                                <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminSearchConf&amp;token=5bc34915d95773a4c9735de2e5c63142\" class=\"link\"> Search
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"103\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/admin4047wicsx/index.php/configure/advanced/system-information/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\">
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
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/system-information/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Information
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"105\" id=\"subtab-AdminPerformance\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/performance/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Performance
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"106\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/administration/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Administration
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"107\" id=\"subtab-AdminEmails\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/emails/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> E-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"108\" id=\"subtab-AdminImport\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/import/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Import
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"109\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/employees/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Team
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"113\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/sql-requests/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Database
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"116\" id=\"subtab-AdminLogs\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/logs/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Logs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo \" data-submenu=\"117\" id=\"subtab-AdminWebservice\">
                                <a href=\"/admin4047wicsx/index.php/configure/advanced/webservice-keys/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" class=\"link\"> Webservice
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
                      <li class=\"breadcrumb-item\">Theme &amp; Logo</li>
          
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"title\">
            Theme &amp; Logo &gt; Theme          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                                                          <a
                  class=\"btn btn-primary  pointer\"                  id=\"page-header-desc-configuration-add\"
                  href=\"/admin4047wicsx/index.php/improve/design/themes/import?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\"                  title=\"Add new theme\"                >
                  <i class=\"material-icons\">add</i>                  Add new theme
                </a>
                                                                        <a
                  class=\"btn btn-primary  pointer\"                  id=\"page-header-desc-configuration-export\"
                  href=\"/admin4047wicsx/index.php/improve/design/themes/export?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\"                  title=\"Export current theme\"                >
                  <i class=\"material-icons\">cloud_download</i>                  Export current theme
                </a>
                                      
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Help\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"/admin4047wicsx/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop.com%252Fgb%252Fdoc%252FAdminThemes%253Fversion%253D1.7.7.1%2526country%253Dgb/Help?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\"
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
                    <a href=\"/admin4047wicsx/index.php/improve/design/themes/?_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8\" id=\"subtab-AdminThemes\" class=\"nav-link tab active current\" data-submenu=\"53\">
                      Theme & Logo
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminPsThemeCustoConfiguration&token=a25c635fd114310caeb27c29b2d4455b\" id=\"subtab-AdminPsThemeCustoConfiguration\" class=\"nav-link tab \" data-submenu=\"127\">
                      Pages Configuration
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminPsThemeCustoAdvanced&token=0b3b9fffe37852ba5e10ab030995363a\" id=\"subtab-AdminPsThemeCustoAdvanced\" class=\"nav-link tab \" data-submenu=\"128\">
                      Advanced Customization
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  </ul>
    </div>
    <!-- begin /home/codeoperativeco/prestaoperative/modules/ps_mbo/views/templates/hook/recommended-modules.tpl -->
<script>
  if (undefined !== mbo) {
    mbo.initialize({
      translations: {
        'Recommended Modules and Services': 'Recommended Modules and Services',
        'Close': 'Close',
      },
      recommendedModulesUrl: '/admin4047wicsx/index.php/modules/addons/modules/recommended?tabClassName=AdminThemes&_token=FRSbnizP8hm9w0xubEumxJt9nQUKeX1N_B_96U9uCw8',
      shouldAttachRecommendedModulesAfterContent: 0,
      shouldAttachRecommendedModulesButton: 1,
      shouldUseLegacyTheme: 0,
    });
  }
</script>
<!-- end /home/codeoperativeco/prestaoperative/modules/ps_mbo/views/templates/hook/recommended-modules.tpl -->
</div>
      
      <div class=\"content-div  with-tabs\">

        

                                                        
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
  <a href=\"https://reusenetwork.code-operative.co.uk/admin4047wicsx/index.php?controller=AdminDashboard&amp;token=9320ac86cae2202e5b1050ac1d0bda6e\" class=\"btn btn-primary py-1 mt-3\">
    <i class=\"material-icons\">arrow_back</i>
    Back
  </a>
</div>
  <div class=\"mobile-layer\"></div>

      <div id=\"footer\" class=\"bootstrap\">
    
</div>
  
  <div class=\"bootstrap\">
\t<div id=\"error-modal\" class=\"modal fade\">
\t\t<div class=\"modal-dialog\">
\t\t\t<div class=\"alert alert-danger clearfix\">
\t\t\t\t\t\t\t\t\tNotice on line 33 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Undefined index: postcodecheck_controller_url<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 33 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Trying to get property &#039;value&#039; of non-object<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 35 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Undefined index: postcodecheck_controller_url<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 35 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Trying to get property &#039;value&#039; of non-object<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 39 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Undefined index: postcode_string<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 39 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Trying to get property &#039;value&#039; of non-object<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 41 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Undefined index: my_module_message<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 41 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Trying to get property &#039;value&#039; of non-object<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 53 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Undefined index: my_module_message<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 53 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Trying to get property &#039;value&#039; of non-object<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 57 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Undefined index: my_module_link<br /><br />
\t\t\t\t\t\t\t\t\tNotice on line 57 in file /home/codeoperativeco/prestaoperative/var/cache/dev/smarty/compile/10/d2/a0/10d2a06a222ca9a8af2f03a080f872d17b120226_0.file.postcodecheck.tpl.php<br />
\t\t\t\t\t[8] Trying to get property &#039;value&#039; of non-object<br /><br />
\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-default float-right\" data-dismiss=\"modal\"><i class=\"icon-remove\"></i> Close</button>
\t\t\t</div>
\t\t</div>
\t</div>
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
\t\t\t\t\t<a href=\"https://addons.prestashop.com/gb/login?email=noelia.gale1%40gmail.com&amp;firstname=Knowband&amp;lastname=Support&amp;website=http%3A%2F%2Freusenetwork.code-operative.co.uk%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-GB&amp;utm_content=download#createnow\"><img class=\"img-responsive center-block\" src=\"/admin4047wicsx/themes/default/img/prestashop-addons-logo.png\" alt=\"Logo PrestaShop Addons\"/></a>
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
\t\t\t\t\t\t\t<a class=\"btn btn-default btn-block btn-lg _blank\" href=\"https://addons.prestashop.com/gb/login?email=noelia.gale1%40gmail.com&amp;firstname=Knowband&amp;lastname=Support&amp;website=http%3A%2F%2Freusenetwork.code-operative.co.uk%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-GB&amp;utm_content=download#createnow\">
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
</html>", "__string_template__35544a965a8926564cee8e27e1d547e602bd44562ed81468da2fc65f461a3860", "");
    }
}

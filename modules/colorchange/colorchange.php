<?php
/**
 * 2007-2014 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * No redistribute in other sites, or copy.
 *
 * @author    RSI <rsi_2004@>
 * @copyright 2007-2017 RSI
 * @license   RSI
 */

class Colorchange extends Module
{
    public function __construct()
    {
        $this->name = 'colorchange';
        $this->module_key = '87ff021027afb6fca84abb85f8b875a1';
        if (_PS_VERSION_ > "1.4.0.0") {
            $this->tab = 'administration';
            $this->author = 'RSI';
            $this->need_instance = 1;
        }
        if (_PS_VERSION_ < "1.4.0.0") {
            $this->tab = 'Tools';
            $this->author = 'RSI';
            $this->need_instance = 1;
        }
        if (_PS_VERSION_ > '1.6.0.0') {
            $this->tab = 'administration';
            $this->author = 'RSI';
            $this->bootstrap = true;
        }
                /*$this->currencies = true;
        $this->currencies_mode = 'checkbox';*/
        $this->version = '1.0.0';
        if (_PS_VERSION_ < '1.5') {
            require(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php');
        }


        parent::__construct();

        $this->displayName = $this->l('Color change');
        $this->description = $this->l('Change color of the theme');
        $path = dirname(__FILE__);
        if (strpos(__FILE__, 'Module.php') !== false) {
            $path .= '/../modules/'.$this->name;
        }
    }

    public function install()
    {
        if (!parent::install() or !$this->registerHook('header') or !$this->registerHook(
            'top'
        ) or !$this->registerHook('leftColumn')
        ) {
            return false;
        }

        if (!Configuration::updateValue(
            'CHANGECOLOR_B','#dcc285'
            
        ) && Configuratison::updateValue(
            'CHANGECOLOR_B',
            '#dcc285'
        )
        ) {
            return false;
        }
        if (!Configuration::updateValue(
            'CHANGECOLOR_B1','#ffffff'
            
        ) && Configuration::updateValue(
            'CHANGECOLOR_B1',
            '#ffffff'
        )
        ) {
            return false;
        }
        if (!Configuration::updateValue(
            'CHANGECOLOR_B2','#222222'
            
        ) && Configuration::updateValue(
            'CHANGECOLOR_B2',
            '#222222'
        )
        ) {
            return false;
        }
        if (!Configuration::updateValue(
            'CHANGECOLOR_W','#ffffff'
            
        ) && Configuration::updateValue(
            'CHANGECOLOR_W',
            '#ffffff'
        )
        ) {
            return false;
        }
        if (!Configuration::updateValue(
            'CHANGECOLOR_B3',''
            
        ) && Configuration::updateValue(
            'CHANGECOLOR_B3',
            ''
        )
        ) {
            return false;
        }
        if (!Configuration::updateValue(
            'CHANGECOLOR_L',''
            
        ) && Configuration::updateValue(
            'CHANGECOLOR_L',
            ''
        )
        ) {
            return false;
        }
        if (!Configuration::updateValue(
            'CHANGECOLOR_C',''
            
        ) && Configuration::updateValue(
            'CHANGECOLOR_C',
            ''
        )
        ) {
            return false;
        }
        if (!Configuration::updateValue(
            'CHANGECOLOR_CA',''
            
        ) && Configuration::updateValue(
            'CHANGECOLOR_CA',
            ''
        )
        ) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()) {
            return false;
        }
        $deleteall = Db::getInstance()
              ->ExecuteS('SELECT * FROM `'._DB_PREFIX_.'configuration` WHERE name LIKE \'%CHANGECOLOR%\'');
        while ($reg = mysql_fetch_array($deleteall)) {
            Db::getInstance()
              ->ExecuteS(
                  'DELETE FROM `'._DB_PREFIX_.'configuration` WHERE id_configuration = '.$reg['id_configuration']
              );
        }
        return true;
    }

  public function getContent()
    {
        $errors = '';
        if (_PS_VERSION_ < '1.5.0.0') {

  
        } else {
            return $this->_displayInfo().$this->renderForm().$this->_displayAdds();
        }
    }
 

    private function _displayInfo()
    {
        return $this->display(
            __FILE__,
            'views/templates/hook/infos.tpl'
        );
    }

    public function postProcess()
    {
        $errors = '';
        $output = '';
        if (Tools::isSubmit('submitUpdate')) {
       
      


            Configuration::updateValue('CHANGECOLOR_B', Tools::getValue('b'));
            Configuration::updateValue('CHANGECOLOR_B1', Tools::getValue('b1'));
            Configuration::updateValue('CHANGECOLOR_B2', Tools::getValue('b2'));
            Configuration::updateValue('CHANGECOLOR_B3', Tools::getValue('b3'));
            Configuration::updateValue('CHANGECOLOR_L', Tools::getValue('l'));
            Configuration::updateValue('CHANGECOLOR_C', Tools::getValue('c'));
            Configuration::updateValue('CHANGECOLOR_W', Tools::getValue('w'));
            Configuration::updateValue('CHANGECOLOR_F', Tools::getValue('f'));
            Configuration::updateValue('CHANGECOLOR_H', Tools::getValue('h'));
            Configuration::updateValue('CHANGECOLOR_P', Tools::getValue('p'));
            Configuration::updateValue('CHANGECOLOR_PP', Tools::getValue('pp'));
            Configuration::updateValue('CHANGECOLOR_CA', Tools::getValue('ca'));
            Configuration::updateValue('CHANGECOLOR_N', Tools::getValue('n'));

            //$this->Writecss($textsize2, $shadow, $color3, $color1);
            $output .= $this->displayConfirmation($this->l('Settings updated').'<br/>');
  @chmod(
                '../modules/colorchange/views/css/'.((_PS_VERSION_ > '1.5.0.0') ? $this->context->shop->id : '').'ch.css',
                0777
            );
            $xml2 = fopen(
                '../modules/colorchange/views/css/'.((_PS_VERSION_ > '1.5.0.0') ?
                    $this->context->shop->id : '').'ch.css',
                'w'
            );
    
            fwrite(
                $xml2,
                '
                /*Theme color first*/
                body a:hover, body .dropdown:hover .expand-more, body .owl-nav > div, body.page-my-account #content .links a:hover i, body .nav.nav-tabs_alternative .nav-item .nav-link.active, body .nav.nav-tabs_alternative .nav-item .nav-link:hover, body .contact-rich .block .icon,  body #product_comments_block_tab .comment_author_infos strong, body .dropdown-item:focus, body .dropdown-item:hover, body #_desktop_top_menu .top-menu[data-depth="1"] > li a:hover, body .header-slide .htmlcontent__html h2, body .home-banner .htmlcontent__title-one, body .general .blog_post .read_more, body .post-category .blog_post .read_more, body .post_meta i, body .htmlcontent-tabs li.active a, body .htmlcontent-tabs li a.active, .htmlcontent-tabs li a:hover, body .htmlcontent-tabs li a:hover, body .block-contact li:before, body .htmlcontent__item.tab-pane ul li:before, body .display-view .view-item.active, body .display-view .view-item:hover, body .pagination .current a, body .list .quick-view:hover, body .list .link-view:hover,body  .list .addToWishlist:hover, body .block_newsletter .form-control:focus, body .home-tabs .tab-pane ul li:before, body .header-slide .caption-description h2, body #_mobile_search_bar .search-bar .search-bar__text:focus, body .language-selector select:hover, body .language-selector select:focus, body .currency-selector select:hover, body .currency-selector select:focus, body .star-content .star-on, body .star-content .star-hover, body .block-promo .promo-code-button, body .product-line-info .value, body .breadcrumb li:last-child a, body .rte a, body .custom-checkbox a {
                        color: '.Tools::getValue('b').';
                    }
                body .cart-header .cart-products-count,
                body .btn-to-top, body .btn-to-top:hover, body .btn-to-top:active, body .nav.nav-inline .nav-link.active, body .nav.nav-inline .nav-link:hover, body .block_newsletter .submit, body .dropdown-menu > a:hover, body .dropdown-menu li > a:hover, body .general .blog_post .slick-prev:hover, body .general .blog_post .slick-next:hover, body .post-category .blog_post .slick-prev:hover, body .post-category .blog_post .slick-next:hover, body a.post_thumbnail:before, body #_mobile_search_bar .search-bar .search-bar__btn, body .addresses-footer a, body .address-footer a, body .product-cover .zoom-in, #products .page-not-found .search-bar__btn, #pagenotfound .page-not-found .search-bar__btn, #products .page-not-found .search-bar__btn:hover, #pagenotfound .page-not-found .search-bar__btn:hover, body .slick-slider .slick-prev:hover, body .slick-slider .slick-next:hover, body .show .select-title i, body .ui-slider.ui-slider-horizontal .ui-slider-handle, body .ui-slider.ui-slider-horizontal .ui-slider-handle:hover, body .ui-slider.ui-slider-horizontal .ui-slider-handle.ui-state-active {
                    background-color: '.Tools::getValue('b').';
                }
                body .btn.btn_skine-two, body .btn-primary.btn_skine-two, body .btn-secondary.btn_skine-two, body .btn-tertiary.btn_skine-two, body .btn.btn_skine-two:hover, body .btn-primary.btn_skine-two:hover, body .btn-secondary.btn_skine-two:hover, body .btn-tertiary.btn_skine-two:hover, body .btn.btn_skine-two:active, body .btn-primary.btn_skine-two:active, body .btn-secondary.btn_skine-two:active, body .btn-tertiary.btn_skine-two:active, body .grid .add-cart:active, body .grid .add-cart:hover, body .grid .quick-view:active, body .grid .link-view:active, body .grid .addToWishlist:active, body .grid .quick-view:hover, body .grid .link-view:hover, body .grid .addToWishlist:hover, body .list .quick-view:hover i, body .list .link-view:hover i, body .list .addToWishlist:hover i, body .list .quick-view:active i, body .list .link-view:active i, body .list .addToWishlist:active i, body btn.btn_skine-four:hover, body .btn-primary.btn_skine-four:hover, body .btn-secondary.btn_skine-four:hover, body .btn-tertiary.btn_skine-four:hover, body btn.btn_skine-four:active, body .btn-primary.btn_skine-four:active, body .btn-secondary.btn_skine-four:active, body .btn-tertiary.btn_skine-four:active, body #_mobile_search_bar .search-bar .search-bar__btn, body #product-comments-list-pagination li:hover span:not(.current), body #product-comments-list-pagination li.active span {
                    background-color: '.Tools::getValue('b').';
                    border-color: '.Tools::getValue('b').';
                }
                body .owl-nav > div:hover, body .owl-controls .owl-dot, body .form-control:focus, body .block_newsletter .form-control:focus, body .product-variants-item .input-color:checked + span, body .product-variants-item .input-color:hover + span, body .product-variants-item .input-radio:checked + span, body .product-variants-item .input-radio:hover + span, body .nav.nav-inline .nav-link.active, body .product-images > .thumb-container > .thumb.selected, body .product-images > .thumb-container > .thumb:hover, body .checkout-step .address-item.selected, body #header.fixed-top.hide-bar, body .header-slide .htmlcontent__html, body .header-slide .htmlcontent__html:before, body .header-slide .htmlcontent__html:after, body .nav.nav-tabs_alternative .nav-item .nav-link.active, body .nav.nav-tabs_alternative .nav-item .nav-link:hover, body .header-slide .caption-description, body .header-slide .caption-description:before, body .header-slide .caption-description:after, #products .page-not-found .search-bar__text:hover, #pagenotfound .page-not-found .search-bar__text:hover, body .show .select-title, body .block-promo .promo-input:focus, body select:focus {
                    border-color: '.Tools::getValue('b').';
                }
                body .bootstrap-touchspin .btn.btn-touchspin:hover, body .bootstrap-touchspin .btn.btn-touchspin:active {
                    border-color: '.Tools::getValue('b').';
                    background-color: '.Tools::getValue('b').';
                }
                body .owl-nav > div:hover{
                    -webkit-box-shadow: inset 0 0 0 30px '.Tools::getValue('b').';
                    box-shadow: inset 0 0 0 30px '.Tools::getValue('b').';
                }
                body .owl-controls .owl-dot:hover, body .owl-controls .owl-dot.active{
                    -webkit-box-shadow: inset 0 0 0 6px '.Tools::getValue('b').';
                    box-shadow: inset 0 0 0 6px '.Tools::getValue('b').';
                 }
                @media (min-width: 576px) {
                    body .nav.nav-tabs .nav-item .nav-link:hover, body .nav.nav-tabs .nav-item .nav-link.active {
                        color: '.Tools::getValue('b').';
                    }
                }
                @media (min-width: 992px) {
                    body .header-nav [class^="material-"], body .header-nav [class*=" material-"], body .header-nav [class^="font-"], body .header-nav [class*=" font-"], body .search-bar .search-bar__text:focus {
                        color: '.Tools::getValue('b').';
                    }
                }
                @media (max-width: 991px) {
                    body .header_user_info__toggle-btn {
                        background-color: '.Tools::getValue('b').';
                    }
                    #products .page-not-found .search-bar__btn, #pagenotfound .page-not-found .search-bar__btn {
                        border-color: '.Tools::getValue('b').';
                    }
                }
                @media (max-width: 575px) {
                    body .nav.nav-tabs .nav-item .nav-link:hover, body .nav.nav-tabs .nav-item .nav-link.active {
                        background-color: '.Tools::getValue('b').';
                    }
                }
                /*Buttons/tabs text color(Theme color first)*/
                body .cart-header .cart-products-count, body .dropdown-menu > a:hover, body .dropdown-menu li > a:hover, body .btn-to-top, body .btn-to-top:hover, body .btn-to-top:active, body .owl-nav > div:hover, body .btn.btn_skine-two, body .btn-primary.btn_skine-two, body .btn-secondary.btn_skine-two, body .btn-tertiary.btn_skine-two, body .btn.btn_skine-two:hover, body .btn-primary.btn_skine-two:hover, body .btn-secondary.btn_skine-two:hover, body .btn-tertiary.btn_skine-two:hover, body .btn.btn_skine-two:active, body .btn-primary.btn_skine-two:active, body .btn-secondary.btn_skine-two:active, body .btn-tertiary.btn_skine-two:active, body .grid .add-cart:active, body .grid .add-cart:hover, body .grid .quick-view:active, body .grid .link-view:active, body .grid .addToWishlist:active, body .grid .quick-view:hover, body .grid .link-view:hover, body .grid .addToWishlist:hover, body .list .quick-view:hover i, body .list .link-view:hover i, body .list .addToWishlist:hover i, body .list .quick-view:active i, body .list .link-view:active i, body .list .addToWishlist:active , body btn.btn_skine-four:hover, body .btn-primary.btn_skine-four:hover, body .btn-secondary.btn_skine-four:hover, body .btn-tertiary.btn_skine-four:hover, body btn.btn_skine-four:active, body .btn-primary.btn_skine-four:active, body .btn-secondary.btn_skine-four:active, body .btn-tertiary.btn_skine-four:active, body .slick-slider .slick-prev:hover, body .slick-slider .slick-next:hover, body .block_newsletter .submit, body .show .select-title i, body #product-comments-list-pagination li:hover span:not(.current), body #product-comments-list-pagination li.active span, body .nav.nav-inline .nav-link.active, body .nav.nav-inline .nav-link:hover, body .bootstrap-touchspin .btn.btn-touchspin:hover, body .bootstrap-touchspin .btn.btn-touchspin:active {
                    color: '.Tools::getValue('b1').';
                }
                @media (max-width: 575px) {
                    body .nav.nav-tabs .nav-item .nav-link:hover, body .nav.nav-tabs .nav-item .nav-link.active {
                        color: '.Tools::getValue('b1').';
                    }
                }
                /*Theme color second*/
                body .fancybox-skin .fancybox-close:hover, body .custom-checkbox input[type="checkbox"]:checked + span, body .dropdown-menu, body .modal .close:hover, body .bootstrap-touchspin .btn.btn-touchspin, body .addresses-footer a:hover, body .address-footer a:hover, body .addresses-footer a:active, body .address-footer a:active, body .checkout-step .step-title, body .product-cover .zoom-in:hover, body .product-features > dl.data-sheet dt.name {
                     background-color: '.Tools::getValue('b2').';
                }
                body .btn, body .btn-primary, body .btn-secondary, body .btn-tertiary, body .page-footer a {
                    border-color: '.Tools::getValue('b2').';
                    color: '.Tools::getValue('b2').';
                }
                body .btn:hover, body .btn-primary:hover, body .btn-secondary:hover, body .btn-tertiary:hover, 
                body .btn:active, body .btn-primary:active, body .btn-secondary:active, body .btn-tertiary:active, body .wishlist-btn:hover, body .wishlist-btn:active, body .social-sharing li a:hover, body .social-sharing li a:active, body .page-footer a:hover, body .page-footer a:active {
                    border-color: '.Tools::getValue('b2').';
                    background-color: '.Tools::getValue('b2').';
                }
                body .btn.btn_skine-four, body .btn-primary.btn_skine-four, body .btn-secondary.btn_skine-four, body .btn-tertiary.btn_skine-four, body .btn:active, body .btn-primary:active, body .btn-secondary:active, body .btn-tertiary:active {
                    background-color: '.Tools::getValue('b2').';
                    border-color: '.Tools::getValue('b2').';
                }
                body .custom-radio input[type="radio"]:checked + span, body .custom-checkbox input[type="checkbox"]:checked + span, body .bootstrap-touchspin .btn.btn-touchspin {
                    border-color: '.Tools::getValue('b2').';
                }
                body .custom-radio input[type="radio"]:checked + span {
                    -webkit-box-shadow: inset 0 0 0 6px '.Tools::getValue('b2').';
                    box-shadow: inset 0 0 0 6px '.Tools::getValue('b2').';
                }
                @media (max-width: 991px){
                    body #mobile_top_menu_wrapper, body .btn-toggle-mobile, body .btn-toggle-mobile:hover, body .cart-header > .inner-wrapper i {
                        background-color: '.Tools::getValue('b2').';
                    }
                }
                /*Buttons/tabs text color(Theme color second)*/
                body .btn:hover, body .btn-primary:hover, body .btn-secondary:hover, body .btn-tertiary:hover, body .btn:active, body .btn-primary:active, body .btn-secondary:active, body .btn-tertiary:active, body .modal .close:hover, body .dropdown-menu > a, body .dropdown-menu li > a, body .checkout-step .step-title, body .bootstrap-touchspin .btn.btn-touchspin, body .product-features > dl.data-sheet dt.name,  body .wishlist-btn:hover, body .wishlist-btn:active, body .social-sharing li a:hover, body .social-sharing li a:active, body .fancybox-skin .fancybox-close:hover {
                    color: '.Tools::getValue('w').';
                }
                /*header bg*/
                @media (min-width: 992px) {
                    body .header-nav, body #_desktop_top_menu .top-menu .sub-menu {
                        background-color: '.Tools::getValue('b3').';
                    }
                }
                /*header text color*/
                @media (min-width: 992px){
                    body .header-nav, body .language-selector, body .currency-selector, body .top-menu[data-depth="1"] > li a, body .top-menu[data-depth="2"] {
                        color: '.Tools::getValue('l').';
                    }
                }
                @media (min-width: 1200px){
                    body .header_user_info a:not(:last-child){
                        border-color: '.Tools::getValue('l').';
                    }
                }
                /*Footer background*/
                body #footer .footer-container, body #footer .footer-two {
                    background-color: '.Tools::getValue('c').';
                }
                /*Footer text color*/
                body #footer .footer-container, body .payment-logos li, body .block-social h3, body .block-social a, body .links h3, body .links .h3 {
                    color: '.Tools::getValue('ca').';
                }
                body .block_newsletter .form-control {
                    border-color: '.Tools::getValue('ca').';
                    color: '.Tools::getValue('ca').';
                }
    ');
    
            if (!$errors) {
                return $output;
            }
        }
    }

    public function getConfigFieldsValues()
    {
    
    return array(
            'b' => Tools::getValue('b', Configuration::get('CHANGECOLOR_B')),
            'b1' => Tools::getValue('b1', Configuration::get('CHANGECOLOR_B1')),
            'b2' => Tools::getValue('b2', Configuration::get('CHANGECOLOR_B2')),
            'b3' => Tools::getValue('b3', Configuration::get('CHANGECOLOR_B3')),
            'l' => Tools::getValue('l', Configuration::get('CHANGECOLOR_L')),
            'c' => Tools::getValue('c', Configuration::get('CHANGECOLOR_C')),
            'w' => Tools::getValue('w', Configuration::get('CHANGECOLOR_W')),
            'f' => Tools::getValue('f', Configuration::get('CHANGECOLOR_F')),
            'h' => Tools::getValue('h', Configuration::get('CHANGECOLOR_H')),
            'p' => Tools::getValue('p', Configuration::get('CHANGECOLOR_P')),
            'pp' => Tools::getValue('pp', Configuration::get('CHANGECOLOR_PP')),
            'ca' => Tools::getValue('ca', Configuration::get('CHANGECOLOR_CA')),
            'n' => Tools::getValue('n', Configuration::get('CHANGECOLOR_N')),

        );
    }

    public function renderForm()
    {
        $this->postProcess();
     
        $token = Tools::getAdminTokenLite('AdminModules');
        $back = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name.'&token='.$token;
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Configuration'),
                    'icon' => 'icon-image'
                ),
                'input' => array(

                    
                    array(
                        'type' => 'color',
                        'label' => $this->l('Theme color first'),
                        'name' => 'b',

                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Buttons/tabs text color(On bg Theme color first)'),
                        'name' => 'b1',

                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Theme color second'),
                        'name' => 'b2',

                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Buttons/tabs text color(On bg Theme color second)'),
                        'name' => 'w',

                    ),
 array(
                        'type' => 'color',
                        'label' => $this->l('Header background'),
                        'name' => 'b3',

                    ),
 array(
                        'type' => 'color',
                        'label' => $this->l('Header text color'),
                        'name' => 'l',

                    ),
                    
                    
 array(
                        'type' => 'color',
                        'label' => $this->l('Foooter background'),
                        'name' => 'c',

                    ),
 array(
                        'type' => 'color',
                        'label' => $this->l('Footer text color'),
                        'name' => 'ca',

                    ),
/* array(
                        'type' => 'color',
                        'label' => $this->l('Home slide first'),
                        'name' => 'w',

                    ),
 array(
                        'type' => 'color',
                        'label' => $this->l('Home slide second'),
                        'name' => 'h',

                    ),
 array(
                        'type' => 'color',
                        'label' => $this->l('Home slide third'),
                        'name' => 'n',

                    ),*/
/* array(
                        'type' => 'color',
                        'label' => $this->l('Footer color'),
                        'name' => 'f',

                    ),
 array(
                        'type' => 'color',
                        'label' => $this->l('Prices color'),
                        'name' => 'p',

                    ),
 array(
                        'type' => 'color',
                        'label' => $this->l('Products block color'),
                        'name' => 'pp',

                    ),*/

                    /*                    array(
                        'type' => 'textarea',
                        'label' => $this->l('Mercadopago promociones'),
                        'name' => 'title2',
                        'lang' => true,
                        'desc' => $this->l('You can put text, images, links'),
                        'cols' => 80,
                        'rows' => 8,
                        'autoload_rte' => true,
                        'class' => 'rte',
                    ),
                                            array(
                        'type' => 'textarea',
                        'label' => $this->l('Decidir promociones'),
                        'name' => 'title3',
                        'lang' => true,
                        'desc' => $this->l('You can put text, images, links'),
                        'cols' => 80,
                        'rows' => 8,
                        'autoload_rte' => true,
                        'class' => 'rte',
                    ),
                                            array(
                        'type' => 'textarea',
                        'label' => $this->l('Bank promociones'),
                        'name' => 'title4',
                        'lang' => true,
                        'desc' => $this->l('You can put text, images, links'),
                        'cols' => 80,
                        'rows' => 8,
                        'autoload_rte' => true,
                        'class' => 'rte',
                    ),*/
                ),

                'buttons' => array(
                    'cancelBlock' => array(
                        'title' => $this->l('Cancel'),
                        'href' => $back,
                        'icon' => 'process-icon-cancel'
                    )
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )

            ),
        );
        $helper = new HelperForm();
        $helper->show_toolbar = true;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get(
            'PS_BO_ALLOW_EMPLOYEE_FORM_LANG'
        ) : 0;
        $this->fields_form = array();
        $helper->module = $this;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitUpdate';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );
        return $helper->generateForm(array($fields_form));
    }

    private function _displayAdds()
    {
        $this->context->smarty->assign(
            array(
                'psversion' => _PS_VERSION_
            )
        );
        return $this->display(
            __FILE__,
            'views/templates/hook/adds.tpl'
        );
    }

  

    public function hookTop($params)
    {
      /*  $titlelw = Configuration::get('PROMOCIONES_TITLE',$this->context->language->id);

        $psversion = _PS_VERSION_;
        $this->context->smarty->assign(
            array(
                'titlelw' => $titlelw,
                'default_lang' => (int)$this->context->language->id,
                'id_lang' => $this->context->language->id
            )
        );
      
            return $this->display(
                __FILE__,
                'views/templates/front/legalwarning.tpl'
            );
     */
        
    }

    public function hookHeader()
    {
         $this->context->controller->registerStylesheet(
                'modules-color',
                'modules/'.$this->name.'/views/css/'.((_PS_VERSION_ > '1.5.0.0') ?
                    $this->context->shop->id : '').'ch.css',
                array('position' => 'top', 'priority' => 159)
            );
       
       /* $redirectlw = Configuration::get('LEGALWARNING_TWITTERU');
        $stylelw = Configuration::get('LEGALWARNING_HOOK');
        $facebookuhc = Configuration::get('LEGALWARNING_FACEBOOKU');
        $top = Configuration::get('LEGALWARNING_TOP');
        $llang = Configuration::get('LEGALWARNING_LANG');
        $widthlw = Configuration::get('LEGALWARNING_WIDTH');
        $heightlw = Configuration::get('LEGALWARNING_HEIGHT');
        $psversion = _PS_VERSION_;
        $languageshc = Language::getLanguage($this->context->language->id);
        $lang = Tools::strtolower(Language::getIsoById($this->context->language->id));
        $lang2 = Language::getLanguage($this->context->language->id);
    
        /*  Tools::addCSS(($this->_path).'assets/css/styles.css', 'all');*/
      /*  $this->context->smarty->assign(
            array(
                'redirectlw' => $redirectlw,
                'lang' => $lang,
                'llang' => $llang,
                'widthlw' => $widthlw,
                'heightlw' => $heightlw,
                'fullurl' => (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
                'topas' => $top,
                'stylelw' => $stylelw,
                'psversion' => $psversion,
 
                'lang2' => $lang2,
                'facebookuhc' => $facebookuhc
            )
        );

        return $this->display(
            __FILE__,
            'views/templates/front/legalwarning-header.tpl'
        );*/
    }
}

<?php
/**
* 2007-2020 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2020 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class BlockManufactureri extends Module
{
    public function __construct()
    {
        $this->name = 'blockmanufactureri';
        if (_PS_VERSION_ > "1.4.0.0" && _PS_VERSION_ < "1.5.0.0") {
            $this->tab = 'front_office_features';
            $this->author = 'Prestahero';
            $this->need_instance = 1;
        } elseif (_PS_VERSION_ > "1.5.0.0") {
            $this->tab = 'front_office_features';
            $this->author = 'Prestahero';
        } else {
            $this->tab = 'front_office_features';
        }
        $this->version = '1.0.0';
        if (_PS_VERSION_ > '1.6.0.0') {
            $this->bootstrap = true;
        }
        parent::__construct();

        $this->displayName = $this->l('Manufacturers on home page');
        $this->description = $this->l('Displays a block of manufacturers');
    }

    public function install()
    {
        Configuration::updateValue('MANUFACTURERI_DISPLAY_TEXT', true);
        Configuration::updateValue('MANUFACTURERI_DISPLAY_TEXT_NB', 15);
        Configuration::updateValue('MANUFACTURERI_WIDTHMI', "50");
        Configuration::updateValue('MANUFACTURERI_DISPLAY_FORM', true);
        $this->fillMultilangValues();
        if (_PS_VERSION_ < "1.5.0.0") {
            Configuration::updateValue('MANUFACTURERI_NUMBER', "small");
        } else {
            Configuration::updateValue('MANUFACTURERI_NUMBER', "small");
        }
        return parent::install() && $this->registerHook('displayHome') && $this->registerHook('displayHeader');
    }

    public function fillMultilangValues()
    {
        $languages = Language::getLanguages(false);
        foreach ($this->getMultilangFields(false) as $name => $data) {
            foreach ($languages as $lang) {
                $key = Tools::strtoupper('BLOCKMANUFACTURERI_'.$name).'_'.$lang['id_lang'];
                $value = html_entity_decode($data[1]);
                Configuration::updateGlobalValue($key, $value);
            }
        }
        return true;
    }

    private function updateLanguageField($field_name)
    {
        $lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
        $field = array($lang_default => Tools::getValue('blockmanufactureri_'.$field_name.'_'.$lang_default));
        $this->context->controller->getLanguages();
        foreach ($this->context->controller->_languages as $lang) {
            if ($lang['id_lang'] == $lang_default) {
                continue;
            }

            $field_value = Tools::getValue('blockmanufactureri_'.$field_name.'_'.(int)$lang['id_lang']);
            if (!empty($field_value)) {
                $field[(int)$lang['id_lang']] = $field_value;
            } else {
                $field[(int)$lang['id_lang']] = $field[$lang_default];
            }
        }
        foreach ($this->context->controller->_languages as $lang) {
            Configuration::updateValue('BLOCKMANUFACTURERI_'.Tools::strtoupper($field_name).'_'.(int)$lang['id_lang'], $field[(int)$lang['id_lang']]);
        }
    }

    public function getContent()
    {
        $errors = '';
        if (_PS_VERSION_ < '1.6.0.0') {
            $output = '<h2>'.$this->displayName.'</h2>';
            if (Tools::isSubmit('submitBlockManufactureris')) {
                $text_list = (int)(Tools::getValue('text_list'));
                $text_nb = (int)(Tools::getValue('text_nb'));
                $form_list = (int)(Tools::getValue('form_list'));
                if ($text_list && !Validate::isUnsignedInt($text_nb)) {
                    $errors[] = $this->l('Invalid number of elements');
                } elseif (!$text_list && !$form_list) {
                    $errors[] = $this->l('Please activate at least one system list');
                } else {
                    Configuration::updateValue('MANUFACTURERI_DISPLAY_TEXT', $text_list);
                    Configuration::updateValue('MANUFACTURERI_DISPLAY_TEXT_NB', $text_nb);
                    Configuration::updateValue('MANUFACTURERI_DISPLAY_FORM', $form_list);
                }
                if (isset($errors) && count($errors)) {
                    $output .= $this->displayError(implode('<br />', $errors));
                } else {
                    $output .= $this->displayConfirmation($this->l('Settings updated'));
                }
                foreach ($this->getMultilangFields() as $field_name) {
                    $this->updateLanguageField($field_name);
                }
            }
            return $output.$this->displayForm();
        } else {
            foreach ($this->getMultilangFields() as $field_name) {
                $this->updateLanguageField($field_name);
            }
            return $this->postProcess().$this->renderForm();
        }
    }

    public function getMultilangFields($only_keys = true)
    {
        $fields = array(
            'category_name' => array(
                $this->l('Title of manufacturers block'),
                'Our partners',
            ),
            'description_name' => array(
                $this->l('Description of manufacturers block'),
                'Vee bottom through the back half keeps those turns really smooth through rail to rail transitions',
            ),
        );
        return $only_keys ? array_keys($fields) : $fields;
    }

    public function hookDisplayHome($params)
    {
        $params;
        if (_PS_VERSION_ >  "1.7.0.0") {
            $this->smarty->assign(array(
            'manufacturers' => Manufacturer::getManufacturers(),
            'psversion' => _PS_VERSION_,
            'widthmi' =>  Configuration::get('MANUFACTURERI_WIDTHMI'),
            'text_list' => Configuration::get('MANUFACTURERI_DISPLAY_TEXT'),
            'text_list_nb' => Configuration::get('MANUFACTURERI_DISPLAY_TEXT_NB'),
            'form_list' => Configuration::get('MANUFACTURERI_DISPLAY_FORM'),
            'display_link_manufacturer' => Configuration::get('PS_DISPLAY_SUPPLIERS'),
            ));
            $multilang_array = array();
            foreach ($this->getMultilangFields() as $field_name) {
                $key = 'blockmanufactureri_'.$field_name;
                $multilang_array[$key] = Configuration::get(Tools::strtoupper($key.'_'.$this->context->language->id));
            }
            $this->smarty->assign($multilang_array);
        }
        if (_PS_VERSION_ > "1.5.0.0" && _PS_VERSION_ < "1.7.0.0") {
            $this->smarty->assign(array(
            'manufacturers' => Manufacturer::getManufacturers(),
            'psversion' => _PS_VERSION_,
            'widthmi' =>  Configuration::get('MANUFACTURERI_WIDTHMI'),
            'text_list' => Configuration::get('MANUFACTURERI_DISPLAY_TEXT'),
            'text_list_nb' => Configuration::get('MANUFACTURERI_DISPLAY_TEXT_NB'),
            'form_list' => Configuration::get('MANUFACTURERI_DISPLAY_FORM'),
            'mitype' => Configuration::get('MANUFACTURERI_NUMBER'),
            'display_link_manufacturer' => Configuration::get('PS_DISPLAY_SUPPLIERS'),
            ));
        }
        if (_PS_VERSION_ < "1.5.0.0") {
            $this->smarty->assign(array(
            'manufacturers' => Manufacturer::getManufacturers(),
            'psversion' => _PS_VERSION_,
            'widthmi' =>  Configuration::get('MANUFACTURERI_WIDTHMI'),
            'text_list' => Configuration::get('MANUFACTURERI_DISPLAY_TEXT'),
            'text_list_nb' => Configuration::get('MANUFACTURERI_DISPLAY_TEXT_NB'),
            'form_list' => Configuration::get('MANUFACTURERI_DISPLAY_FORM'),
                'mitype' => Configuration::get('MANUFACTURERI_NUMBER'),
            'display_link_manufacturer' => Configuration::get('PS_DISPLAY_SUPPLIERS'),
            ));
        }
        return $this->display(__FILE__, 'blockmanufactureri.tpl');
    }
    public function postProcess()
    {
        $errors = '';
        $output = '';
        $errors;
        if (Tools::isSubmit('submitCoolshare')) {
            if ($text_list = Tools::getValue('text_list')) {
                Configuration::updateValue('MANUFACTURERI_DISPLAY_TEXT', $text_list);
            } elseif (Shop::getContext() == Shop::CONTEXT_SHOP || Shop::getContext() == Shop::CONTEXT_GROUP) {
                Configuration::deleteFromContext('MANUFACTURERI_DISPLAY_TEXT');
            }

            if ($text_nb = Tools::getValue('text_nb')) {
                Configuration::updateValue('MANUFACTURERI_DISPLAY_TEXT_NB', $text_nb);
            } elseif (Shop::getContext() == Shop::CONTEXT_SHOP || Shop::getContext() == Shop::CONTEXT_GROUP) {
                Configuration::deleteFromContext('MANUFACTURERI_DISPLAY_TEXT_NB');
            }

            if ($form_list = Tools::getValue('form_list')) {
                Configuration::updateValue('MANUFACTURERI_DISPLAY_FORM', $form_list);
            } elseif (Shop::getContext() == Shop::CONTEXT_SHOP || Shop::getContext() == Shop::CONTEXT_GROUP) {
                Configuration::deleteFromContext('MANUFACTURERI_DISPLAY_FORM');
            }
                
            if ($number = Tools::getValue('number')) {
                Configuration::updateValue('MANUFACTURERI_NUMBER', $number);
            } elseif (Shop::getContext() == Shop::CONTEXT_SHOP || Shop::getContext() == Shop::CONTEXT_GROUP) {
                Configuration::deleteFromContext('MANUFACTURERI_NUMBER');
            }
                    
            /*  if ($layout = Tools::getValue('layout'))
            Configuration::updateValue('PS_DISPLAY_SUPPLIERS', $layout);
            elseif (Shop::getContext() == Shop::CONTEXT_SHOP || Shop::getContext() == Shop::CONTEXT_GROUP)
            Configuration::deleteFromContext('PS_DISPLAY_SUPPLIERS');*/


            $output .= $this->displayConfirmation($this->l('Settings updated.').'<br/>');

            //if (!$errors)
            return $output;
        }
    }

    public function getConfigFieldsValues()
    {
        $fields_values = array(
            'widthmi' => Tools::getValue('widthmi', Configuration::get('MANUFACTURERI_WIDTHMI')),
            'text_list' => Tools::getValue('text_list', Configuration::get('MANUFACTURERI_DISPLAY_TEXT')),
            'text_nb' => Tools::getValue('text_nb', Configuration::get('MANUFACTURERI_DISPLAY_TEXT_NB')),
            'form_list' => Tools::getValue('form_list', Configuration::get('MANUFACTURERI_DISPLAY_FORM')),
            'number' => Tools::getValue('number', Configuration::get('MANUFACTURERI_NUMBER')),
            /*'layout' => Tools::getValue('mitype', Configuration::get('BADGE_LAYOUT')),*/
        );
        return $fields_values;
    }
    
    public function renderForm()
    {
        $multilang_fields = array();
        foreach ($this->getMultilangFields(false) as $name => $data) {
            $multilang_fields[$name] = array(
                'type' => 'text',
                'label' => $data[0],
                'name' => 'blockmanufactureri_'.$name,
                'lang' => true,
            );
        }

        $this->postProcess();
        $i = 0;
        $i;
        $var = '';
        $var;
        $count = '';
        $count;
        $fields_form                      = array(
            'form' => array(
                'legend'      => array(
                    'title' => $this->l('Configuration'),
                    'icon'  => 'icon-cogs'
                ),
                
                /*'description' => $this->l('').preg_replace('@{link}(.*){/link}@', '<a href="../modules/googlebadge/install.pdf">$1</a>', $this->l('{link}Readme{/link}')).preg_replace('@{link2}(.*){/link2}@', ' - <a href="../modules/googlebadge/termsandconditions.pdf">$1</a>', $this->l('{link2}Terms{/link2}')),*/
                'input'       => array(
                   /* $multilang_fields['category_name'],
                    $multilang_fields['description_name'],*/
                    array(
                        'type'  => 'text',
                        'label' => $this->l('Elements to show'),
                        'name'  => 'text_nb',
                        'desc' => $this->l('elements to display in list'),
                    ),
                    array(
                        'type' => 'switch',
                        'is_bool' => true, //retro compat 1.5
                        'label' => $this->l('Carousel view'),
                        'name' => 'text_list',
                        'desc' => $this->l('To display manufacturers in a carousel'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                ),
                'submit'      => array(
                    'title' => $this->l('Save'),
                )

            ),
    
        );
        $helper                           = new HelperForm();
        $helper->show_toolbar             = true;
        $helper->table                    = $this->table;
        $lang                             = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language    = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form                = array();
        $helper->identifier               = $this->identifier;
        $helper->submit_action            = 'submitCoolshare';
        $helper->currentIndex             = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;

        $helper->token    = Tools::getAdminTokenLite('AdminModules');
        $language = $this->context->controller->getLanguages();
        $field_values = $this->getConfigFieldsValues();
        foreach ($this->context->controller->_languages as $lang) {
            foreach ($this->getMultilangFields() as $field_name) {
                $field_name = 'blockmanufactureri_'.$field_name;
                $configuration_key = Tools::strtoupper($field_name.'_'.$lang['id_lang']);
                $field_values[$field_name][$lang['id_lang']] = Configuration::get($configuration_key);
            }
        }
        $helper->tpl_vars = array(
            'fields_value' => $field_values,
            'languages' => $language,
            'id_language' => $this->context->language->id,
        );
        return $helper->generateForm(array($fields_form));
    }
    public function hookRightColumn($params)
    {
        return $this->hookDisplayHome($params);
    }

    public function displayForm()
    {
        $output = '
        <div class="panel">
        <form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post">
            <fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
                <label>'.$this->l('Use a plain-text list').'</label>
                <div class="margin-form">
                    <input type="radio" name="text_list" id="text_list_on" value="1" '.(Tools::getValue('text_list', Configuration::get('MANUFACTURERI_DISPLAY_TEXT')) ? 'checked="checked" ' : '').'/>
                    <label class="t" for="text_list_on"> <img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
                    <input type="radio" name="text_list" id="text_list_off" value="0" '.(!Tools::getValue('text_list', Configuration::get('MANUFACTURERI_DISPLAY_TEXT')) ? 'checked="checked" ' : '').'/>
                    <label class="t" for="text_list_off"> <img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
                    &nbsp;&nbsp;&nbsp;'.$this->l('Display').' <input type="text" size="2" name="text_nb" value="'.(int)(Tools::getValue('text_nb', Configuration::get('MANUFACTURERI_DISPLAY_TEXT_NB'))).'" /> '.$this->l('elements').'
                    <p class="clear">'.$this->l('To display manufacturers in a plain-text list').'</p>
                </div>
                <label>'.$this->l('Use a drop-down list').'</label>
                <div class="margin-form">
                    <input type="radio" name="form_list" id="form_list_on" value="1" '.(Tools::getValue('form_list', Configuration::get('MANUFACTURERI_DISPLAY_FORM')) ? 'checked="checked" ' : '').'/>
                    <label class="t" for="form_list_on"> <img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
                    <input type="radio" name="form_list" id="form_list_off" value="0" '.(!Tools::getValue('form_list', Configuration::get('MANUFACTURERI_DISPLAY_FORM')) ? 'checked="checked" ' : '').'/>
                    <label class="t" for="form_list_off"> <img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
                    <p class="clear">'.$this->l('To display manufacturers in a drop-down list').'</p>
                </div>
                    <label>'.$this->l('Image size').'</label>
                <div class="margin-form">
                                                <input type="text" size="100" name="widthmi" value="'.Tools::getValue('widthmi', Configuration::get('MANUFACTURERI_WIDTHMI')).'" />
</div>
                    <label>'.$this->l('Image type').'</label>
                <div class="margin-form">
                    <select name="number">
      <option value="small"'.((Configuration::get('MANUFACTURERI_NUMBER') == "small") ? 'selected="selected"' : '').'>small</option>
      <option value="medium"'.((Configuration::get('MANUFACTURERI_NUMBER') == "medium") ? 'selected="selected"' : '').'>medium</option>
    
        <option value="small"'.((Configuration::get('MANUFACTURERI_NUMBER') == "small") ? 'selected="selected"' : '').'>small (PS 1.5)</option>
      <option value="medium"'.((Configuration::get('MANUFACTURERI_NUMBER') == "medium") ? 'selected="selected"' : '').'>medium (PS 1.5)</option>
    
    </select>
                
                    <p class="clear">'.$this->l('Size of the real image').'</p>
                    
                
        </div>
                <center><input type="submit" name="submitBlockManufactureris" value="'.$this->l('Save').'" class="button" /></center>
                
                        <center><a href="../modules/blockmanufactureri/moduleinstall.pdf">README</a></center><br/>
                        <center><a href="../modules/blockmanufactureri/termsandconditions.pdf">TERMS</a></center><br/>
            </fieldset>
        </form>     
        <p>Video</p>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/2LBgitIJWu8?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                                                                    <center><iframe frameborder="0" src="https://catalogo-onlinersi.net/advert.html" width="520" height="448" scrolling="no"></iframe></center>

        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Contribute').'</legend>
                <p class="clear">'.$this->l('You can contribute with a donation if our free modules and themes are usefull for you. Clic on the link and support us!').'</p>
                <p class="clear">'.$this->l('For more modules & themes visit: www.catalogo-onlinersi.com.ar').'</p>
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="HMBZNQAHN9UMJ">
<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/scr/pixel.gif" width="1" height="1">
    </fieldset>
</form>
</div>';
        return $output;
    }

    public function hookdisplayHeader($params)
    {
        if ($this->context->controller instanceof IndexControllerCore && Configuration::get('MANUFACTURERI_DISPLAY_TEXT') == 1) {
            $this->context->controller->addJS($this->_path.'views/js/front.js');
        }
    }
}

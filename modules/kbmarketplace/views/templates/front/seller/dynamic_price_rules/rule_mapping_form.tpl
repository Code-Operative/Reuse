<style>
    .hidden {
        display : none;
    }
</style>

<div class="kb-content">
    <div class="kb-content-header">
        <h1>{l s='Dynamic Price Rule Mapping' mod='kbmarketplace'}</h1>
        <div class="kb-content-header-btn">
            <a href="{$cancel_button nofilter}" class="btn-sm btn-success" title="{l s='click to go back to rule list' mod='kbmarketplace'}"><i class="kb-material-icons">cancel</i>{l s='Cancel' mod='kbmarketplace'}</a> {* Variable contains HTML/CSS/JSON, escape not required *}
        </div>
        <div class="clearfix"></div>
    </div>
    
    <form id="kb-dynamic-rule-mapping-form" action="{$dynamic_price_rule_submit_url nofilter}" method="post" enctype="multipart/form-data"> {* Variable contains HTML/CSS/JSON, escape not required *}

            <div id="kb-dynamic-rule-form-global-msg" class="kbalert kbalert-danger" style="display:none;"></div>
            <div class="kb-panel outer-border">
                <div class='kb-panel-body'>
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <input type="hidden" name="id_dynamic_rule" id="id_dynamic_rule" value="{Tools::getValue('id_dynamic_rule',0)}"/>
                            <li class="kb-form-r">
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield" id="products_mapping" validate="isGenericName" name="products_mapping" value="" />
                                    
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class='kb-vspacer5'></div>
            <button id='savezone-mappingBtn' type="button" class='btn-sm btn-success' onclick="validateMappingRule()">{l s='Save' mod='kbmarketplace'}</button>
        </form>
        {$products_form nofilter}{* variable contains html,url content , can not escape *}
</div>

{*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer tohttp://www.prestashop.com for more information.
* We offer the best and most useful modules PrestaShop and modifications for your online store.
*
* @category  PrestaShop Module
* @author    knowband.com <support@knowband.com>
* @copyright 2016 knowband
* @license   see file: LICENSE.txt
*}


<div class="kb-content">
    {if !isset($permission_error)}
        <div class="kb-content-header">
            <h1>{$form_heading}</h1>
            <div class="kbbtn-group kb-tright">
                <a href="{$cancel_button nofilter}" class="btn-sm btn-danger" title="{l s='click to go back to zone list' mod='kbmarketplace'}"><i class="kb-material-icons">cancel</i>{l s='Cancel' mod='kbmarketplace'}</a> {* Variable contains HTML/CSS/JSON, escape not required *}
            </div>
            <div class="clearfix"></div>
        </div>
        <form id="kb-zipcode-view-form" action="{$zone_view_submit_url nofilter}" method="post" enctype="multipart/form-data"> {* Variable contains HTML/CSS/JSON, escape not required *}

            <input type="hidden" name="zipcode-view_form" value="1" />
            <div id="kb-zipcode-view-form-global-msg" class="kbalert kbalert-danger" style="display:none;"></div>
            <div class="kbalert kbalert-info">
                <i class="kb-material-icons">help_outline</i>{l s='Fields marked with (*) are mandatory fields.' mod='kbmarketplace'}
            </div>
            
            <div class="kb-panel outer-border">
                <div class='kb-panel-body'>
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <input type="hidden" class="kb-inpfield required" id="id_zone" validate="" name="id_zone" value="{if isset($id_zone) && $id_zone != 0}{$id_zone}{/if}"/>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Availability' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="availability" class="kb-inpselect">
                                        <option value="0" {if isset($formvalue['availability']) && $formvalue['availability'] eq 0}selected="selected"{/if}>{l s='No' mod='kbmarketplace'}</option>
                                        <option value="1" {if isset($formvalue['availability']) && $formvalue['availability'] eq 1}selected="selected"{/if}>{l s='Yes' mod='kbmarketplace'}</option>
                                    </select>
                                </div>
                            </li>
                            {if isset($id_zone) && $id_zone !=0}
                            {else}
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Zone Name' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" id="zone_name" validate="isGenericName" name="zone_name" value="{if isset($formvalue['zone_name']) && $formvalue['zone_name'] != ''} {$formvalue['zone_name']}{/if}" />
                                </div>
                            </li>
                            {/if}
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='To add multiple zip-codes use comma "," to separate. Ex- "201222,201233,786999"' mod='kbmarketplace'}">info_outline</i>{l s='Zip-Code' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <textarea name="zip-codes" id="zip-codes" rows="5" class="kb-inptexarea required">{if isset($formvalue['zip-codes']) && $formvalue['zip-codes'] != ''} {$formvalue['zip-codes']}{/if}</textarea> {* Variable contains HTML/CSS/JSON, escape not required *}
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='Only positive integer value allowed.' mod='kbmarketplace'}">info_outline</i>{l s='Deliever By' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" id="deliever_by" validate="isInt" name="deliever_by" value="{if isset($formvalue['deliver_by']) && $formvalue['deliver_by'] != ''} {$formvalue['deliver_by']}{/if}"/>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class='kb-vspacer5'></div>
            <button id='savezipcode-viewBtn' type="button" class='btn-sm btn-success' onclick="validateZoneForm()">{l s='Save' mod='kbmarketplace'}</button>
        </form>
        <script>
        </script>
    {/if}
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

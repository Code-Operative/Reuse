<div class="form-group">
    <label class="control-label col-lg-3">
        {l s='Coupon Code' mod='kbmpdealmanager'}
    </label>
    <div class="col-lg-9">
        <input type="text" name="code" id="code" value="{$code|escape:'htmlall':'UTF-8'}" class="deal_cart_rule required">
    </div>
</div>
<div class="form-group">
    <div class="col-lg-9 deal_cart_rule" style="float:right">
        <span class="input-group-btn">
            <a href="javascript:gencode(8);" class="btn btn-default"><i class="icon-random"></i>{l s='Generate' mod='kbmpdealmanager'}</a>
        </span>
    </div>
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
<div class="kb-panel outer-border">
    <div data-toggle="kb-product-type-form" class='kb-panel-header kb-panel-header-tab'>
        <h1>{l s='Set the Product Type' mod='kbmarketplace'}</h1>
        <div class='kb-accordian-symbol kbexpand'></div>
        <div class='clearfix'></div>
    </div>
    <div id="kb-product-type-form" class='kb-panel-body'>
        <div class="kbalert kbalert-info">
            <i class="kb-material-icons">info_outline</i>{l s='Once the new product is saved, you cannot change the product type on edit.' mod='kbmarketplace'}
        </div>
        <div class="kb-vspacer5"></div>
        <form id="kb-product-type-selection" action="{$form_submit_url nofilter}" method="post"> {* Variable contains HTML/CSS/JSON, escape not required *}
            <div class="kb-row kb-inpoption">
                <input class="" type="radio" id="label_for_appointment_product" name="kb_product_type" value="appointment" checked="checked" /> <label for="label_for_appointment_product">{l s='Appointment' mod='kbmarketplace'}</label>    
            </div>
            <div class="kb-row kb-inpoption">
                <input class="" type="radio" id="label_for_daily_rental_product" name="kb_product_type" value="daily_rental" /> <label  for="label_for_daily_rental_product">{l s='Daily Rental' mod='kbmarketplace'}</label>    
            </div>
            <div class="kb-row kb-inpoption">
                <input class="" type="radio" id="label_for_hotel_booking_product" name="kb_product_type" value="hotel_booking" /> <label  for="label_for_hotel_booking_product">{l s='Hotel Booking' mod='kbmarketplace'}</label>    
            </div>
            <div class="kb-row kb-inpoption">
                <input class="" type="radio" id="label_for_hourly_rental_product" name="kb_product_type" value="hourly_rental" /> <label  for="label_for_hourly_rental_product">{l s='Hourly Rental' mod='kbmarketplace'}</label>    
            </div>
            <button type="submit" name="submitproducttype" class="btn-sm btn-success sensitive">{l s='Next' mod='kbmarketplace'}<i class="kb-material-icons">navigate_next</i></button>
        </form>
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
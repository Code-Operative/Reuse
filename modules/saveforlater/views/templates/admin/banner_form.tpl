{if $banner_writable}
    <p class="helping-highlight"><b>{l s='Note' mod='saveforlater'}: </b>{l s= 'You can upload maximum of file size 500 KB' mod='saveforlater'}. {l s='The value of post_max_size directive in php.ini file on your server should be greater than 500KB' mod='saveforlater'}.</p>
    <input type="hidden" id='is_banner_1_updated' value="{$is_banner_1_updated}"/>
    <input type ="hidden" id="sfl_banner_1_upload" value="{$is_banner_1_updated}"/>
    <input type ="hidden" id="sfl_banner_2_upload" value="{$is_banner_2_updated}"/>
    <input type="hidden" id='is_banner_2_updated' value="{$is_banner_2_updated}"/>
<table class="recommend-ajax-table" cellspaing="2" cellpadding="2">
    {foreach $banners as $key => $banner}
        <tr id="sfl-banner-{$key}">
            <td>
                <div class="banner_block">{$banner['src']}</div>{*Variable contains a URL, escape not required*}                
                <div class="banner_action">
                    <input type="file" id="add_sfl_{$key}_image" name="banner[{$key}][file]" value="" class="btn banner-upload-btn"  data-index="{$key}" />
                    <input type="hidden" id="remove_{$key}_image" name="recommendations[content][{$key}][remove]" value="0"/>
                    <input type="hidden" name="recommendations[content][{$key|escape:'htmlall':'UTF-8'}][image_exist]" value="{$banner['valid_check']|escape:'quotes':'UTF-8'}" />
                    <input type="hidden" name="recommendations[content][{$key}][old]" value="{$banner['name']|escape:'quotes':'UTF-8'}" />
                    <button type="button" id="remove_button_{$key}" class="btn btn-danger" onclick="removeBanner(this, '{$key}')">{l s='Remove' mod='saveforlater'}</button>
                </div>
            </td>
            <td>
                <div>
                    <label>{l s= 'Banner URL' mod='saveforlater'}</label>
                    <input type="text" id="later_{$key}_link" name="recommendations[content][{$key}][link]"  class="form-control" value="{$banner['link'] nofilter}"/>{*Variable contains a URL, escape not required*}
                    <p class="help-block"> {l s= 'Example: http://www.example.com/yourpage' mod='saveforlater'}</p>
                    <p id="sfl_{$key}_link_error" style="display:none;"></p>
                </div>
                <div>
                    <label>{l s= 'Banner Title' mod='saveforlater'}</label>
                    <input type="text" name="recommendations[content][{$key}][title]" id="sfl_{$key}_title" class="form-control" value="{$banner['title']}"/>
                    <p id="sfl_{$key}_title_error" style="display:none;"></p>
                </div>
            </td>
        </tr>
    {/foreach}
</table>
<script type="text/javascript">
    var default_image_url = '{$default_banner nofilter}';{*Variable contains a URL, escape not required*}
</script>
{else}
    <div class="alert alert-danger">{$permission_msg}</div>
{/if}
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
* @copyright 2015 knowband
* @license   see file: LICENSE.txt
*
*}
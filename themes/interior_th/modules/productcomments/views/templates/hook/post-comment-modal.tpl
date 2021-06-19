{**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}

<script type="text/javascript">
  var productCommentPostErrorMessage = "{l s='Sorry, your review cannot be posted.' d='Modules.Productcomments.Shop' js=1}";
</script>

<div id="post-product-comment-modal" class="modal product-comment-modal" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="h2">{l s='Write your review' d='Modules.Productcomments.Shop'}</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="post-product-comment-form" action="{$post_comment_url nofilter}" method="POST">
          <div class="comments-product-info row">
            <div class="col-cover col-sm-2 col-4">
              {if isset($product) && $product}
                {*{block name='product_flags'}
                  <ul class="product-flags">
                    {foreach from=$product.flags item=flag}
                      <li class="product-flag {$flag.type}">{$flag.label}</li>
                    {/foreach}
                  </ul>
                {/block}*}

                {block name='product_cover'}
                  <div class="wrapper-img">
                    {if $product.cover}
                      <img class="product-img" src="{$product.cover.bySize.medium_default.url}" alt="{$product.cover.legend}" title="{$product.cover.legend}">
                    {else}
                      <img class="product-img" src="{$urls.no_picture_image.bySize.large_default.url nofilter}">
                    {/if}
                  </div>
                {/block}
              {/if}
            </div>
            <div class="col-descr col-sm-5 col-8">
              <p class="h3">{$product.name}</p>
              {block name='product_description_short'}
                <div class="description">{$product.description_short|strip_tags:'UTF-8'|truncate:250:'...'}</div>
              {/block}
            </div>
            <div class="col-criterions col-sm-5 col-12">
              {if $criterions|@count > 0}
                <ul id="criterions_list">
                  {foreach from=$criterions item='criterion'}
                    <li>
                      <div class="criterion-rating">
                        <label>{$criterion.name|escape:'html':'UTF-8'}:</label>
                        <div
                          class="grade-stars"
                          data-grade="3"
                          data-input="criterion[{$criterion.id_product_comment_criterion}]">
                        </div>
                      </div>
                    </li>
                  {/foreach}
                </ul>
              {/if}
            </div>
          </div>
          <div class="row">
            {if !$logged}
              <div class="col-md-8 col-sm-8">
                <label class="form-label" for="comment_title">{l s='Title' d='Modules.Productcomments.Shop'}<sup class="required">*</sup></label>
                <input class="form-control" name="comment_title" type="text" value=""/>
              </div>
              <div class="col-md-4 col-sm-4">
                <label class="form-label" for="customer_name">{l s='Your name' d='Modules.Productcomments.Shop'}<sup class="required">*</sup></label>
                <input class="form-control" name="customer_name" type="text" value=""/>
              </div>
            {else}
              <div class="col-md-12 col-sm-12">
                <label class="form-label" for="comment_title">{l s='Title' d='Modules.Productcomments.Shop'}<sup class="required">*</sup></label>
                <input class="form-control" name="comment_title" type="text" value=""/>
              </div>
            {/if}
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12">
              <label class="form-label" for="comment_content">{l s='Review' d='Modules.Productcomments.Shop'}<sup class="required">*</sup></label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <textarea class="comment-text form-control" name="comment_content"></textarea>
            </div>
          </div>

          <div class="product-comment-footer row">
            <div class="col-6 post-comment-required">
              <p class="required"><sup>*</sup> {l s='Required fields' d='Modules.Productcomments.Shop'}</p>
            </div>
            <div class="col-6 post-comment-buttons">
              <button type="button" class="btn btn-comment-inverse btn-comment-big" data-dismiss="modal" aria-label="{l s='Cancel' d='Modules.Productcomments.Shop'}">
                {l s='Cancel' d='Modules.Productcomments.Shop'}
              </button>
              <button type="submit" class="btn btn-comment btn-comment-big">
                {l s='Send' d='Modules.Productcomments.Shop'}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{* Comment posted modal *}
{if $moderation_active}
  {assign var='comment_posted_message' value={l s='Your comment has been submitted and will be available once approved by a moderator.' d='Modules.Productcomments.Shop'}}
{else}
  {assign var='comment_posted_message' value={l s='Your comment has been added!' d='Modules.Productcomments.Shop'}}
{/if}
{include file='module:productcomments/views/templates/hook/alert-modal.tpl'
  modal_id='product-comment-posted-modal'
  modal_title={l s='Review sent' d='Modules.Productcomments.Shop'}
  modal_message=$comment_posted_message
}

{* Comment post error modal *}
{include file='module:productcomments/views/templates/hook/alert-modal.tpl'
  modal_id='product-comment-post-error'
  modal_title={l s='Your review cannot be sent' d='Modules.Productcomments.Shop'}
  icon='error'
}

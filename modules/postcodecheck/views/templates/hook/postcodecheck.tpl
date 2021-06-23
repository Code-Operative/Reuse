<!-- Trigger/Open The Modal -->
<button id="myBtn">Open Modal</button>

<!-- The Modal -->
<div id="myModalPostCode" class="modal-postcode">

  <!-- Modal content
  <div class="modal-postcode-content">
    <span class="close">&times;</span>
    <div id="postcodecheck" data-postcodecheck-controller-url="{$postcodecheck_controller_url}">
      <form method="post" action="{$postcodecheck_controller_url}">
        <input type="hidden" name="controller" value="">
        <input type="hidden" id="seller_id1" name="seller_id1" value="">
        <input type="text" name="buyer_postcode" value="{$postcode_string}">
        <p>{$my_module_message}</p>
        <button type="submit">
        </button>
      </form>
    </div>
  </div>
</div>  -->

<!-- Block mymodule -->
<div id="mymodule_block_home" class="block">
  <div class="block_content">
    <p>My response: {$my_module_message}
    </p>
    <!--<ul>
      <li><a href="{$my_module_link}" title="Click this link">Click me!</a></li>
    </ul>-->
  </div>
</div>
<!--/Block mymodule -->
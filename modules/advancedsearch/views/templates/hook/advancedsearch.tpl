<!-- Block advancedsearch -->
<div id="advancedsearch_block_home" class="block advanceSearchwrapper" data-search-controller-url="{$search_controller_url}">
 <form name="asearchform" method="get" style="display: contents" action="{$search_controller_url}">
          <input type="hidden" name="controller" value="search" />
	  <div class=advanceSearchKeywords>
      <div class=advanceSearchKeywords_title>
        I am looking for___  *
       </div>
      <input id="search-input" name="search" class="fontAwesome" placeholder="&#xF002; Search"/>
    </div>
    <div class=advanceSearchLocation>
     <div class=advanceSearchLocation_title>
       Location
     </div>
     <input id="postcode-input" name="postcode" pattern="{$regExPostCode}" title="Please enter a valid UK postcode" placeholder="Enter your postcode"/>
    </div>
    <div class=advanceSearchDistance>
      <div class=advanceSearchDistance_title>
        Distance
      </div>
      <input name="distance" id="distance-input"/>
    </div>
    <div class=advanceSearchOptions>
      <div class=advanceSearchOptions_title>
        Handling Options
      </div>
      <select id="retrieve-method" name="retrieve">
        <option value="delivery">delivery</option>
        <option value="collection">collection only</option>
      </select>
    </div>
    <button id="advancedSearch-button" class=advanceSearchButton type="button">Search</button>
    </form>
</div>
<!-- /Block advancedsearch -->
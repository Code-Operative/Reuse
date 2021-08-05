<!-- Block advancedsearch -->
<div id="advancedsearch_block_home" class="block advanceSearchwrapper" data-postcodecheck-controller-url="{$postcodecheck_controller_url}">
    <div class=advanceSearchKeywords>
      <div class=advanceSearchKeywords_title>
        I am looking for___  *
       </div>
      <input id="search-input" class="fontAwesome" placeholder="&#xF002; Search"/>
    </div>
    <div class=advanceSearchLocation>
     <div class=advanceSearchLocation_title>
       Location
     </div>
     <input id="postcode-input" pattern="{$regExPostCode}" title="Please enter a valid UK postcode" placeholder="Enter your postcode"/>
    </div>
    <div class=advanceSearchDistance>
      <div class=advanceSearchDistance_title>
        Distance
      </div>
      <input id="distance-input"/>
    </div>
    <div class=advanceSearchOptions>
      <div class=advanceSearchOptions_title>
        Handling Options
      </div>
      <select id="retrieve-method">
        <option value="delivery">delivery</option>
        <option value="collection">collection only</option>
      </select>
    </div>
    <button id="advancedSearch-button" class=advanceSearchButton type="submit">Search</button>
</div>
<!-- /Block advancedsearch -->
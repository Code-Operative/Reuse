<!-- Block advancedsearch -->
<div class="advanceSearchwrapper">
  <form name="asearchform" method="get" style="display: contents" action="{$search_controller_url}">
    <!-- <div id="advancedsearch_block_home" class="advanceSearchKeywords" data-search-controller-url="{$search_controller_url}"> -->
    <input type="hidden" name="controller" value="search" />
      <div class="advanceSearchfieldset">
        <div class=advanceSearchKeywords>
          <label class=advanceSearchKeywords_title for="search-input">
            I am looking for &hellip; *
          </label>
          <input id="search-input" name="search" placeholder="Search for items, brands or inspiration…"/>
        </div>
        <div class=advanceSearchLocation>
          <label class=advanceSearchLocation_title for="postcode-input" >
            Location
          </label>
          <input id="postcode-input" name="postcode-input" placeholder="Enter your postcode" pattern="{$regExPostCode}" />
          <!-- <input id="postcode-input" name="postcode" pattern="{$regExPostCode}" title="Please enter a valid UK postcode" placeholder="Enter your postcode"/> -->
        </div>
        <div class=advanceSearchDistance>
          <label class=advanceSearchDistance_title for="advanceSearchDistanceInput">
            Distance (miles)
          </label>
          <input name="distance" id="distance-input"/>
        </div>
        <div class=advanceSearchOptions>
          <label class=advanceSearchOptions_title for="advanceSearchOptionsSelect">
            Handling Options
          </label>
          <select id="retrieve-method" name="retrieve">
            <option value="delivery">delivery</option>
            <option value="collection">collection only</option>
          </select>
        </div>
        <!-- <button id="advancedSearch-button" class=advanceSearchButton type="button">Search</button> -->
        <button id="advanceSearchButton" class="advanceSearchButton btn">Search</button>
      </div>
    </div>
  </form>
</div>
<!-- /Block advancedsearch -->
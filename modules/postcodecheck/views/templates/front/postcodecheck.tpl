<div id="postcodecheck" data-postcodecheck-controller-url="{$postcodecheck_controller_url}">
	<span class="postcode-label">Postcode</span>
	<div class="postcode-container clearfix">
		<div class="">
			<div class="postcode-input">
				<input type="hidden" id="seller_id1" name="seller_id1" value="">
				<input type="hidden" id="product_id" name="product_id" value="">
				<input
					class="postcode-input input-group form-control"
					type="text"
					id="postcode-input"
					name="postcode"
					placeholder="Please enter your full postcode here e.g. NE13 4JK"
					aria-label="Postcode"
					value="{$postcode_string}"
					pattern="{$regExPostCode}"
					>
			</div>
		</div>
		<div class="product-actions">
			<button
				class="postcode-button btn btn-warning"
				id="postcode-button"
				type="submit"
				>
			Check Postcode
			</button>
		</div>
		<div class"" type="hidde" id="postcodecheck_result"></div>
		<div class="postcode-message-container">
			<img id="postcode_img" class="postcode_img"></img>
			<div id="postcode_message" class="postcode_message"></div>
		</div>
	</div>
</div>

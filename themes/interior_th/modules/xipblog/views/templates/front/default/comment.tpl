<div class="comment_respond clearfix m_bottom_50" id="respond">
    <h3 class="comment_reply_title" id="reply-title">
        {l s='Leave a reply' d='Modules.Xipblog.Shop'}
        <small>
            <a href="/wp_showcase/wp-supershot/?p=38#respond" id="cancel-comment-reply-link" rel="nofollow" style="display:none;">
                {l s='Cancel reply' d='Modules.Xipblog.Shop'}
            </a>
        </small>
    </h3>
    <form class="comment_form" action="" method="post" id="xipblogs_commentfrom" role="form" data-toggle="validator">
    	<div class="form-group xipblogs_message"></div>
    	<div class="form-group xipblog_name_parent">
    	  <label for="xipblog_name">{l s='Your name:' d='Modules.Xipblog.Shop'}</label>
    	  <input type="text"  id="xipblog_name" name="xipblog_name" class="form-control xipblog_name" required>
    	</div>
    	<div class="form-group xipblog_email_parent">
    	  <label for="xipblog_email">{l s='Your Email:' d='Modules.Xipblog.Shop'}</label>
    	  <input type="email"  id="xipblog_email" name="xipblog_email" class="form-control xipblog_email" required>
    	</div>
    	<div class="form-group xipblog_website_parent">
    	  <label for="xipblog_website">{l s='Website Url:' d='Modules.Xipblog.Shop'}</label>
    	  <input type="url"  id="xipblog_website" name="xipblog_website" class="form-control xipblog_website">
    	</div>
    	<div class="form-group xipblog_subject_parent">
    	  <label for="xipblog_subject">{l s='Subject:' d='Modules.Xipblog.Shop'}</label>
    	  <input type="text"  id="xipblog_subject" name="xipblog_subject" class="form-control xipblog_subject" required>
    	</div>
    	<div class="form-group xipblog_content_parent">
    	  <label for="xipblog_content">{l s='Comment:' d='Modules.Xipblog.Shop'}</label>
    	  <textarea rows="15" cols="" id="xipblog_content" name="xipblog_content" class="form-control xipblog_content" required></textarea>
    	</div>
    	<input type="hidden" class="xipblog_id_parent" id="xipblog_id_parent" name="xipblog_id_parent" value="0">
    	<input type="hidden" class="xipblog_id_post" id="xipblog_id_post" name="xipblog_id_post" value="{$xipblogpost.id_xipposts}">
    	<input type="submit" class="btn btn-default pull-left xipblog_submit_btn" value="{l s='Send comment' d='Modules.Xipblog.Shop'}">
    </form>
</div>
{xipblog_js name="single_comment_form"}
<script type="text/javascript">
// disabled
var successMessage = "{l s='Successfully comment added' d='Modules.Xipblog.Shop'}";
var errorMessage = "{l s='Something wrong! please try again' d='Modules.Xipblog.Shop'}";
var waitText = "{l s='Please wait...' d='Modules.Xipblog.Shop'}";
var submitButton = "{l s='Send comment' d='Modules.Xipblog.Shop'}";
$('.xipblog_submit_btn').on("click",function(e) {
	e.preventDefault();
	if(!$(this).hasClass("disabled")){
		var data = new Object();
		$('[id^="xipblog_"]').each(function()
		{
			id = $(this).prop("id").replace("xipblog_", "");
			id = $(this).prop("id").replace("xipblog_", "");
			data[id] = $(this).val();
		});
		function logErrprMessage(element, index, array) {
		  $('.xipblogs_message').append('<span class="xipblogs_error">'+errorMessage+'</span>');
		}
		function xipremove() {
		  $('.xipblogs_error').remove();
		  $('.xipblogs_success').remove();
		}
		function logSuccessMessage(element, index, array) {
		  $('.xipblogs_message').append('<span class="xipblogs_success alert alert-success">'+successMessage+'</span>');
		}
		$.ajax({
			url: xprt_base_dir + 'modules/xipblog/ajax.php',
			data: data,
			type:'post',
			dataType: 'json',
			beforeSend: function(){
				xipremove();
				$(".xipblog_submit_btn").val(waitText);
				$(".xipblog_submit_btn").addClass("disabled");
			},
			complete: function(){
				$(".xipblog_submit_btn").val(submitButton);
				$(".xipblog_submit_btn").removeClass("disabled");
			},
			success: function(data){
				xipremove();
				if(typeof data.success != 'undefined'){
					data.success.forEach(logSuccessMessage);
				}
				if(typeof data.error != 'undefined'){
					data.error.forEach(logErrprMessage);
				}
			},
			error: function(data){
				xipremove();
				$('.xipblogs_message').append('<span class="error">'+errorMessage+'</span>');
			},
		});	
	}
});
</script>
{/xipblog_js}


/* JS here */

jQuery(document).ready(function($){
	/*jQuery('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');
		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');
		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	});*/
	jQuery(document).ready(function($){
		$('.main-panel .form-table').addClass('active');
		$('.blog_section').addClass('deactive');
		$(".form-table").eq(1).addClass('deactive');
		$('#api_sec').addClass('current');

		$('#api_sec').click(function(){
			$(this).addClass('current');
			$('#blog_sec').removeClass('current');
			$('.main-panel .form-table').addClass('active');
			$('.main-panel .form-table').removeClass('deactive');

			$('.blog_section').removeClass('active');
			$(".form-table").eq(1).removeClass('active');

			$('.blog_section').addClass('deactive');
			$(".form-table").eq(1).addClass('deactive');
		});
		$('#blog_sec').click(function(){
			$(this).addClass('current');
			$('#api_sec').removeClass('current');
			$('.main-panel .form-table').removeClass('active');

			$('.main-panel .form-table').addClass('deactive');

			$('.blog_section').addClass('active');
			$(".form-table").eq(1).addClass('active');
			
			$('.blog_section').removeClass('deactive');
			$(".form-table").eq(1).removeClass('deactive');
		});

		$('#get_sCode').click(function(){
			$('#shortCodeSec').show();
		});
		$('.shortcode-inner span').click(function(){
			$('#shortCodeSec').hide();
		});
		
	});

});


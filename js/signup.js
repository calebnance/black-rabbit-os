$(document).ready(function(){
	$('.tab-content').click(function(){
		$('.span12').trigger('focusout');
	});
	$('#country').change(function(){
		$('.span12').trigger('focusout');
	});
	$('#myTab').click(function(){
		$('.span12').trigger('focusout');
	});
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
	$('#showVideo').click(function(){
		$('#membershipVideo').slideToggle('slow');
	});
	$('.span12').focusout(function() {
		var empty_count = empty_count1 = 0;
		var display = display1 = '';
		var total = $(".required").size();
		
		$('#account .required').each(function(index){
			var this_id = $.trim($(this).attr("id"));
			var this_input = $.trim($(this).val());
			var password = $("#password").val();
			var password2 = $("#password2").val();
			
			if(this_id == 'password' || this_id == 'password2'){
				if(this_input == ''){
					$(this).next().html('<img src="images/bad.png" />');
					empty_count++;
				} else {
					if(password != password2){
						$(this).next().html('<img src="images/bad.png" /> Make sure the passwords match!');
					} else {
						$(this).next().html('<img src="images/good.png" />');
					}
				}
			} else {
				if(this_id == 'email' && this_input != ''){
					if(validateEmail(this_input)){
						$(this).next().html('<img src="images/good.png" />');		
					} else {
						$(this).next().html('<img src="images/bad.png" /> valid e-mail required!');
						empty_count++;
					}
				} else {
					if(this_input == ''){
						$(this).next().html('<img src="images/bad.png" />');
						empty_count++;
					} else {
						$(this).next().html('<img src="images/good.png" />');
					}
				}
			}
		});
		
		$('#signup .required').each(function(index){
			var this_id = $.trim($(this).attr("id"));
			var this_input = $.trim($(this).val());
			var checked = $('#agree2:checked').val();
			if(checked != 1){
				empty_count1++;
			}
		});
		
		if(empty_count == 0){
			display = '<span class="badge badge-success">0</span>';
		} else {
			display = '<span class="badge badge-important">' + empty_count + '</span>';
		}
		if(empty_count1 == 0){
			display1 = '<span class="badge badge-success">0</span>';
		} else {
			display1 = '<span class="badge badge-important">' + empty_count1 + '</span>';
		}
		
		$('#myTab li:nth-child(2) span').html(display);
		$('#myTab li:nth-child(3) span').html(display1);
		
		var totalEmpty = empty_count + empty_count1;
		
		var percentage = Math.round((totalEmpty / total) * 100);
		var progress = 100 - percentage;
		progress = progress + '%';
		$('.bar').css( 'width', progress);
	});
	$('form#signupform').submit(function() {
		var width = ( 100 * parseFloat($('.bar').css('width')) / parseFloat($('.bar').parent().css('width')) );
		width = Math.round(width);
		
		if(width == 100) {
			return true;
		} else {
			alert('Please fill in all required fields.');
			return false;
		}
	});
	
	function validateEmail(email) {
		var regexEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return regexEmail.test(email); 
	}
	
});
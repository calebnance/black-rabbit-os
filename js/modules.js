function validateNumberDecimal(number) {
	var valid = (number.match(/^\d{1,2}\.\d{1,2}\.\d{1,2}$/));
	if (valid == null){
		valid = (number.match(/^\d{1,2}\.\d{1,2}$/));
		if (valid == null){
			valid = (number.match(/^\d+$/));
		}
	}
	return valid;
}

function validateURL(website) {
	var regexUrl = /^(?:(ftp|http|https):\/\/)?(?:[\w-]+\.)+[a-z]{2,6}$/;
	return regexUrl.test(website);
}

function validateEmail(email) {
	var regexEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return regexEmail.test(email);
}

$(document).ready(function(){

	$('#jversionselect button').click(function(){
		$('#jversionselect button').removeClass();
		$('#jversionselect button').addClass('btn');
		$value = $(this).val().split('.').join('');
		if ($value == '250'){
			$value = '25';
		}
		$value = 'label-j' + $value;
		$(this).addClass('btn-warning active ' + $value);
		$('#jversion').val($(this).val());
	});

	$('.modules-manager button').click(function(){
		var formID	= '#module-manager-form';
		var action	= $(this).attr('action');
		var mid		= $(this).attr('mid');
		var url		= 'module.php';
		var input	= $('<input>').attr('type', 'hidden').attr('name', 'mid').val(mid);

		if (action == 'edit') {
			var pid	= $(this).attr('pid');
			var input2 = $('<input>').attr('type', 'hidden').attr('name', 'pid').val(pid);
			url = 'module.php';
			$(formID).append($(input));
			$(formID).append($(input2));
			$(formID).attr('action', url).attr('method','POST');
			$(formID).submit();
		} else if (action == 'download') {
			var input2	= $('<input>').attr('type', 'hidden').attr('name', 'task').val('mdownload');
			$(formID).append($(input));
			$(formID).append($(input2));
			$(formID).attr('action', url).attr('method','POST');
			$(formID).submit();
		}
	});

	function countdown(){
		var count = 15;
		countdown = setInterval(function(){
			$('p#countdowntime span').html(count);
			if (count == 0) {
				$('p#countdowntime').fadeOut();
				$('#download-full-package').hide().delay(1000).fadeIn(1000);
				$('#step3').slideDown();
			} else if ( count == 3) {
				$('#step2').slideDown();
				$('p#countdowntime span').removeClass('badge-info');
				$('p#countdowntime span').addClass('badge-success');
			} else if ( count == 8) {
				$('#step1').slideDown();
				$('p#countdowntime span').removeClass('badge-inverse');
				$('p#countdowntime span').addClass('badge-info');
			}
			count--;
		}, 1000);
	}
	countdown();

	$('#filename').on('keyup', function(){
		$(this).val($(this).val().replace(/[^A-Za-z\.]+/g, ''));
	});

	$('#version').on('keyup', function(){
		$(this).val($(this).val().replace(/[^0-9.\.]+/g, ''));
	});

	function inputError(element){
		element.addClass('error').removeClass('success');
	}

	function inputSuccess(element){
		element.removeClass('error').addClass('success');
	}

	$('form#module-mainform').submit(function() {
		var empty_count = 0;
		var total = $(".required").size();

		$('.required').each(function(index){
			var this_id = $.trim($(this).attr('id'));
			var this_input = $.trim($(this).val());
			if (this_input == ''){
				inputError($(this).closest('.control-group'));
				empty_count++;
			} else {
				if (this_id == 'author_email'){
					if (validateEmail(this_input)){
						inputSuccess($(this).closest('.control-group'));
					} else {
						inputError($(this).closest('.control-group'));
						empty_count++;
					}
				} else if (this_id == 'author_url'){
					if (validateURL(this_input)){
						inputSuccess($(this).closest('.control-group'));
					} else {
						inputError($(this).closest('.control-group'));
						empty_count++;
					}
				} else if (this_id == 'filename'){
					if (this_input.length > 3){
						inputSuccess($(this).closest('.control-group'));
					} else {
						inputError($(this).closest('.control-group'));
						empty_count++;
					}
				} else {
					inputSuccess($(this).closest('.control-group'));
				}
			}
		});

		if (empty_count > 0){
			return false;
		}
	});

	// only once they have tried to submit the page
	// and there were errors of course...
	$('input, textarea').on('keyup keydown change', function(){
		if ($('.error').length > 0){
			$('.required').each(function(index){
				var this_id = $.trim($(this).attr('id'));
				var this_input = $.trim($(this).val());
				if (this_input == ''){
					inputError($(this).closest('.control-group'));
				} else {
					if (this_id == 'author_email'){
						if (validateEmail(this_input)){
							inputSuccess($(this).closest('.control-group'));
						} else {
							inputError($(this).closest('.control-group'));
						}
					} else if (this_id == 'author_url'){
						if (validateURL(this_input)){
							inputSuccess($(this).closest('.control-group'));
						} else {
							inputError($(this).closest('.control-group'));
						}
					} else if (this_id == 'filename'){
						console.log(this_input.length);
						if (this_input.length >= 3){
							inputSuccess($(this).closest('.control-group'));
						} else {
							inputError($(this).closest('.control-group'));
						}
					} else {
						inputSuccess($(this).closest('.control-group'));
					}
				}
			});

		}
	});

});

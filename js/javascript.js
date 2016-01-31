function reCalcFields(parent){
	$('#' + parent + ' tr').each(function(i, item){
		var f = i - 1;
		$(this).find('#' + parent + '-show').attr('name', parent + '-show[' + f + ']');
		$(this).find('#' + parent + '-required').attr('name', parent + '-required[' + f + ']');
		$(this).find('.removeField').attr('id', 'remove-' + i);
	});
}

$(document).ready(function(){
	
	var viewNaming = { 0: 'views', 1: 'view', 2: 'categories', 3: 'category' };
	
	$('.tab-content').click(function(){
		$('.span12').trigger('focusout');
	});
	
	$('#myTab').click(function(){
		$('.span12').trigger('focusout');
	});
	
	$('#jversionselect button').click(function(){
		$('#jversionselect button').removeClass();
		$('#jversionselect button').addClass('btn');
		$value = $(this).val().split('.').join('');
		if($value == '250'){
			$value = '25';	
		}
		$value = 'label-j' + $value;
		$(this).addClass('btn-warning active ' + $value);
		$('#jversion').val($(this).val());
	});
	
	$('#usedatabasegroup button').click(function(){
		$('#usedatabasegroup button').removeClass('btn-warning active');
		$(this).addClass('btn-warning active');
		$('#usedatabase').val($(this).val());
		$('.span12').trigger('focusout');
	});
	
	$('#needhelp').click(function(){
		var btnName = $('#showhelpfortables').css('display');
		var moreTxt = $('#needhelptext').html();
		var lessTxt = $('#needhelptext-return').html();
		var txt = btnName == 'block' ? moreTxt : lessTxt;
		$('#showhelpfortables').slideToggle('slow');
		$(this).html(txt);
	});
	
	$('#showVideo').click(function(){
		var txt = $('#membershipVideo').css('display') == 'block' ? '<i class="icon-film"></i> Show Video' : '<i class="icon-remove"></i> Hide Video';
		$('#membershipVideo').slideToggle('slow');
		$(this).html(txt);
	});
	
	$('#addView').click(function(){
		var viewCount = $(".view").length;
		
		var viewParent = '';
		viewParent += '<div id="viewwrap-' + viewCount + '" class="control-group">';
		viewParent += '		<label class="control-label">View</label>';
		viewParent += '		<div class="controls">';
		viewParent += '			<input type="text" class="view input required" name="view[]" value="" />';
		viewParent += '			<div class="status"></div>';
		viewParent += '			<label>Single View Verbiage</label>';
		viewParent += '			<input type="text" name="view-single[]" id="mainview-single" value="" class="input required" />';
		viewParent += '			<div class="status"></div>';
		viewParent += '			<div id="removeview-' + viewCount + '" class="btn btn-small btn-danger removeView" style="margin-left: 4px;"><i class="icon icon-remove icon-white"></i></div>';
		viewParent += '		</div><!-- /.controls -->';
		viewParent += '</div><!-- /.control-group -->';
		$('#addviewparent').before(viewParent);
		
		var accordionTab = '';
		accordionTab += '<div class="accordion-group">';
		accordionTab += '	<div class="accordion-heading">';
		accordionTab += '		<a id="view-' + viewCount + '-header" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#view' + viewCount + '">view-' + viewCount + '-table</a>';
		accordionTab += '		<input type="hidden" name="view-' + viewCount + '-table" id="view-' + viewCount + '-table" value="" />';
		accordionTab += '	</div><!-- /.accordion-heading -->';
		accordionTab += '	<div id="view' + viewCount + '" class="accordion-body collapse">';
		accordionTab += '		<div class="accordion-inner">';
		accordionTab += '			<table id="view-' + viewCount + '" class="table table-bordered table-hover sortable">';
		accordionTab += '				<tr><td>#</td><td>Field Name & Type</td><td>Default/Values</td><td></td></tr>';
		accordionTab += '				<tr>';
		accordionTab += '					<td>1</td>';
		accordionTab += '					<td>';
		accordionTab += '						<div style="margin: 0 0 5px 0;">';
		accordionTab += '							<input type="text" name="view-' + viewCount + '-field[]" id="view-' + viewCount + '-field" class="input required input-block-level" placeholder="" />';
		accordionTab += '						</div>';
		accordionTab += '						<select name="view-' + viewCount + '-fieldtype[]" id="view-' + viewCount + '-fieldtype" class="input input-block-level">';
		accordionTab += '							<optgroup label="Standard Fields">';
		accordionTab += '								<option value="calendar">Calendar</option>';
		accordionTab += '								<option value="category">Category</option>';
		accordionTab += '								<option value="checkbox">Checkbox</option>';
		accordionTab += '								<option value="editor">Content Editor</option>';
		accordionTab += '								<option value="file">Image Upload</option>';
		accordionTab += '								<option value="hidden">Hidden</option>';
		accordionTab += '								<option value="numbers">Numbers</option>';
		accordionTab += '								<option value="integer">Integer</option>';
		accordionTab += '								<option value="list">List (select drop down)</option>';
		accordionTab += '								<option value="radio">Radio</option>';
		accordionTab += '								<option value="text" selected>Text Box</option>';
		accordionTab += '								<option value="textarea">Text Area</option>';
		accordionTab += '							</optgroup>';
		accordionTab += '						</select>';
		accordionTab += '					</td>';
		accordionTab += '					<td><textarea rows="2" name="view-' + viewCount + '-default[]" id="view-' + viewCount + '-default" class="input-block-level"></textarea></td>';
		accordionTab += '					<td>';
		accordionTab += '						<label class="checkbox">';
		accordionTab += '							<input type="checkbox" name="view-' + viewCount + '-show[0]" id="view-' + viewCount + '-show" value="1"> Show on Manager View';
		accordionTab += '						</label>';
		accordionTab += '						<label class="checkbox">';
		accordionTab += '							<input type="checkbox" name="view-' + viewCount + '-required[0]" id="view-' + viewCount + '-required" value="1"> Required';
		accordionTab += '						</label>';
		accordionTab += '					</td>';
		accordionTab += '					<td>';
		accordionTab += '						<div class="btn btn-small moveField"><i class="icon icon-move"></i></div>';
		accordionTab += '						<div id="remove-1" class="btn btn-small btn-danger removeField"><i class="icon icon-remove icon-white"></i></div>';
		accordionTab += '					</td>';
		accordionTab += '				</tr>';
		accordionTab += '			</table>';
		accordionTab += '			<div rel="view-' + viewCount + '" class="control-group">';
		accordionTab += '				<div class="pull-right"><div class="btn btn-warning addField"><i class="icon-plus-sign icon-white"></i> Add Field</div></div>';
		accordionTab += '				<div class="clearfix"></div>';
		accordionTab += '			</div><!-- /.control-group -->';
		accordionTab += '		</div><!-- /.accordion-inner -->';
		accordionTab += '	</div><!-- /#view' + viewCount + ' -->';
		accordionTab += '</div><!-- /.accordion-group -->';
		$('#accordionAdd').before(accordionTab);
		
		var newImageUpload = '';
		newImageUpload += '<div class="control-group">';
		newImageUpload += '		<label class="control-label" id="view-' + viewCount + '-image-label">Image</label>';
		newImageUpload += '		<div class="controls">';
		newImageUpload += '			<input class="imageTab" type="file" name="images[]" />';
		newImageUpload += '			<input type="hidden" id="imagesName' + viewCount + '" name="imagesname[]" value="" />';
		newImageUpload += '		</div><!-- /.controls -->';
		newImageUpload += '</div><!-- /.control-group -->';
		$('#imageAdd').before(newImageUpload);
		
		$('.span12').focusout();
		
		reSortable();
	});
	
	$('#views').on('click', '.removeView',function(){
		var removeID	= $(this).attr('id');
		var partsID		= removeID.split('-');
		var parentDiv	= $(this).parent().parent('.control-group').attr('id');
		// remove what we need to
		$('#viewwrap-' + partsID[1]).remove();
		$('#view' + partsID[1]).parent().remove();
		$('.span12').focusout();
	});
	
	$(document).click(function(){
		$('.view').each(function(index, item){
			var view_index = index;
			var view_name = $.trim($(this).val());
			var view_header = 'view-' + view_index + '-header';
			var view_table_id = 'view-' + view_index;
			var view_image_value = 'imagesName' + view_index;
			var view_image_label = 'view-' + view_index + '-image-label';
			
			$('#' + view_table_id).val(view_name);
			$('#' + view_image_value).val(view_name);
			
			if(!view_name){
				view_name = 'View ' + view_index;
			}
			$('#' + view_header).html(view_name);
			$('#' + view_image_label).html(view_name + ' Image');
		});
	});
	
	$('#tables').on('click', '.addField',function(){
		var parent		= $(this).parent().parent().attr('rel');
		var rowCount	= $('#' + parent + ' tr').length;
		var arrayCount	= rowCount - 1;
		
		reCalcFields(parent);
		
		var addFieldHtml = '';
		addFieldHtml += '<tr>';
		addFieldHtml += '	<td>' + rowCount + '</td>';
		addFieldHtml += '	<td>';
		addFieldHtml += '		<div style="margin: 0 0 5px 0;">';
		addFieldHtml += '			<input type="text" name="' + parent + '-field[]" id="' + parent + '-field" class="input required input-block-level" placeholder="" />';
		addFieldHtml += '		</div>';
		addFieldHtml += '		<select name="' + parent + '-fieldtype[]" id="' + parent + '-fieldtype" class="input input-block-level">';
		addFieldHtml += '			<optgroup label="Standard Fields">';
		addFieldHtml += '				<option value="calendar">Calendar</option>';
		addFieldHtml += '				<option value="category">Category</option>';
		addFieldHtml += '				<option value="checkbox">Checkbox</option>';
		addFieldHtml += '				<option value="editor">Content Editor</option>';
		addFieldHtml += '				<option value="file">File/Image Upload</option>';
		addFieldHtml += '				<option value="hidden">Hidden</option>';
		addFieldHtml += '				<option value="numbers">Numbers</option>';
		addFieldHtml += '				<option value="integer">Integer</option>';
		addFieldHtml += '				<option value="list">List (select drop down)</option>';
		addFieldHtml += '				<option value="radio">Radio</option>';
		addFieldHtml += '				<option value="text" selected>Text Box</option>';
		addFieldHtml += '				<option value="textarea">Text Area</option>';
		addFieldHtml += '			</optgroup>';
		addFieldHtml += '		</select>';
		addFieldHtml += '	</td>';
		addFieldHtml += '	<td>';
		addFieldHtml += '		<textarea rows="2" name="' + parent + '-default[]" id="' + parent + '-default" class="input-block-level"></textarea>';
		addFieldHtml += '	</td>';
		addFieldHtml += '	<td>';
		addFieldHtml += '		<label class="checkbox"><input type="checkbox" name="' + parent + '-show[' + arrayCount + ']" id="' + parent + '-show" value="1"> Show on Manager View</label>';
		addFieldHtml += '		<label class="checkbox"><input type="checkbox" name="' + parent + '-required[' + arrayCount + ']" id="' + parent + '-required" value="1"> Required</label>';
		addFieldHtml += '	</td>';
		addFieldHtml += '	<td>';
		addFieldHtml += '		<div class="btn btn-small moveField"><i class="icon icon-move"></i></div>';
		addFieldHtml += '		<div id="remove-' + rowCount + '" class="btn btn-small btn-danger removeField"><i class="icon icon-remove icon-white"></i></div>';
		addFieldHtml += '	</td>';
		addFieldHtml += '</tr>';
		
		$('#' + parent + ' tr:nth-child(' + rowCount + ')').after(addFieldHtml);
		
		$('.span12').focusout();
		
		reSortable();
		
	});
	
	$('#tables').on('click', '.removeField',function(){
		var removeID	= $(this).attr('id');
		var partsID		= removeID.split('-');
		var parentTable	= $(this).parents('table').attr('id');
		var trValue		= parseInt(partsID[1]) + 1;
		$('#' + parentTable + ' tr:nth-child(' + trValue + ')').fadeOut('1000').delay(2000).remove();
		var rowCount	= $('#' + parentTable + ' tr').length;
		
		reCalcFields(parentTable);
		
		$('#' + parentTable + ' tr').each(function(index){
			//alert(index);
			if(index > 0){
				var trChild = index + 1;
				$('#' + parentTable + ' tr:nth-child(' + trChild + ') td:nth-child(1)').html(index);
				$('#' + parentTable + ' tr:nth-child(' + trChild + ') td:nth-child(7)').html('<div id="remove-' + index + '" class="btn btn-small btn-danger removeField"><i class="icon icon-remove icon-white"></i></div>');
			}
		});
		$('.span12').focusout();
	});
	
	$('#filename').keyup(function () {
		var value = $(this).val();
		$('#mainview').val(value);
		$('#mainviewtable').val(value);
		$('#imagesName0').val(value);
		
		// Only if not set
		if(!value){
			value = 'Main View';
		}
		$('#mainview-header').html(value);
		$('#mainview-image-label').html(value + ' Image');
	}).keyup();
	
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
	
	$('.pophelp').popover();
	$('.toolhelp').tooltip();
	
	$('#login').on('shown', function(){
        $("#modal-email").focus();
    });
    
	$('.span12').focusout(function() {
		
		var empty_count = empty_count1 = empty_count2 = empty_count3 = 0;
		var display = display1 = display2 = display3 = '';
		var total = $(".required").size();
		
		$('#install .required').each(function(index){
			var this_id = $.trim($(this).attr("id"));
			var this_input = $.trim($(this).val());
			if(this_input == ''){
				$(this).next().html('<img src="images/bad.png" />');
				empty_count++;
			} else {
				if(this_id == 'version'){
					if(validateNumberDecimal(this_input)){
						$(this).next().html('<img src="images/good.png" />');		
					} else {
						$(this).next().html('<img src="images/bad.png" />');
						empty_count++;
					}
				} else {
					$(this).next().html('<img src="images/good.png" />');	
				}
			}
		});
		
		$('#authorinfo .required').each(function(index){
			var this_id = $.trim($(this).attr("id"));
			var this_input = $.trim($(this).val());
			if(this_input == ''){
				$(this).next().html('<img src="images/bad.png" />');
				empty_count1++;
			} else {
				if(this_id == 'authoremail'){
					if(validateEmail(this_input)){
						$(this).next().html('<img src="images/good.png" />');		
					} else {
						$(this).next().html('<img src="images/bad.png" />');
						empty_count1++;
					}
				} else if(this_id == 'authorurl'){
					if(validateURL(this_input)){
						$(this).next().html('<img src="images/good.png" />');		
					} else {
						$(this).next().html('<img src="images/bad.png" />');
						empty_count1++;
					}
				} else {
					$(this).next().html('<img src="images/good.png" />');	
				}
			}
		});
		
		$('#views .required').each(function(index){
			var useDatabaseCheck = $('#usedatabase').val();
			var this_input = $.trim($(this).val());
			if(useDatabaseCheck == 1){
				if(this_input == ''){
					$(this).next().html('<img src="images/bad.png" />');
					$(this).addClass('error');
					empty_count2++;
				} else {
					var okayName = true;
					$.each(viewNaming, function(v, viewCheck){
						if(viewCheck.toLowerCase() == this_input.toLowerCase()){
							okayName = false;
						}
					});
					if(okayName) {
						$(this).next().html('<img src="images/good.png" />');	
						$(this).removeClass('error');	
						$('#viewsMsg').html('');
					} else {
						var viewMsg = '<div class="alert alert-error">"' + this_input + '" can not be used as a view name!</div>';
						$('#viewsMsg').html(viewMsg);
					}
				}
			} else {
				$(this).next().html('<img src="images/good.png" />');	
				$(this).removeClass('error');
			}
		});
		
		$('#tables .required').each(function(index){
			var useDatabaseCheck = $('#usedatabase').val();
			var this_input = $.trim($(this).val());
			if(useDatabaseCheck == 1){
				if(this_input == ''){
					$(this).addClass('error');
					empty_count3++;
				} else {
					$(this).removeClass('error');
				}
			} else {
				$(this).removeClass('error');
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
		if(empty_count2 == 0){
			display2 = '<span class="badge badge-success">0</span>';
		} else {
			display2 = '<span class="badge badge-important">' + empty_count2 + '</span>';
		}
		if(empty_count3 == 0){
			display3 = '<span class="badge badge-success">0</span>';
		} else {
			display3 = '<span class="badge badge-important">' + empty_count3 + '</span>';
		}
		
		$('#myTab li:nth-child(1) span').html(display);
		$('#myTab li:nth-child(2) span').html(display1);
		$('#myTab li:nth-child(3) span').html(display2);
		$('#myTab li:nth-child(4) span').html(display3);
		
		var totalEmpty = empty_count + empty_count1 + empty_count2 + empty_count3;
		
		var percentage = Math.round((totalEmpty / total) * 100);
		var progress = 100 - percentage;
		progress = progress + '%';
		
		$('.bar').css( 'width', progress);
	});
	
	function validateNumberDecimal(number) {
		var valid = (number.match(/^\d{1,2}\.\d{1,2}\.\d{1,2}$/));
		if(valid == null){
			valid = (number.match(/^\d{1,2}\.\d{1,2}$/));
			if(valid == null){
				valid = (number.match(/^\d+$/));
			}
		}
		return valid;
	};
	
	function validateURL(website) {
		var regexUrl = /^(?:(ftp|http|https):\/\/)?(?:[\w-]+\.)+[a-z]{2,6}$/;
		return regexUrl.test(website);
	};
	
	function validateEmail(email) {
		var regexEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return regexEmail.test(email); 
	};
	
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
	};
	
	countdown();
	
	$('#download-full-package').hide();
	
	$('#step1').hide();
	$('#step2').hide();
	$('#step3').hide();
	
	$('form#mainform').submit(function() {
		var width = ( 100 * parseFloat($('.bar').css('width')) / parseFloat($('.bar').parent().css('width')) );
		width = Math.round(width);
		
		var good = true;
		if ($('#componentname').val() == "") {
			good = false;
		}
		if ($('#filename').val() == "") {
			good = false;
		}
		if ($('#version').val() == "") {
			good = false;
		}
		if ($('#description').val() == "") {
			good = false;
		}
		if ($('#copyright').val() == "") {
			good = false;
		}
		if ($('#license').val() == "") {
			good = false;
		}
		if ($('#author').val() == "") {
			good = false;
		}
		if ($('#authoremail').val() == "") {
			good = false;
		}
		if ($('#authorurl').val() == "") {
			good = false;
		}
		if(width == 100) {
			return true;
		} else {
			alert('Please fill in all required fields.');
			return false;
		}
	});
	
	var bar = $('.imageBar');
	var percent = $('.imagePercent');
	var status = $('#imageReturn');
	
	$('#imagesForm').ajaxForm({
		beforeSend: function() {
			status.empty();
			var percentVal = '0%';
			bar.width(percentVal);
			percent.html(percentVal);
		},
		uploadProgress: function(event, position, total, percentComplete) {
			var percentVal = percentComplete + '%';
			bar.width(percentVal);
			percent.html(percentVal);
		},
		complete: function(xhr) {
			status.html(xhr.responseText);
			console.log(xhr.responseText);
			var hiddenFields = $(xhr.responseText).filter('#addToHiddenImages').html();
			$('#addHiddenImages').html(hiddenFields);
		}
	});
});
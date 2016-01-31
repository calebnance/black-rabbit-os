$(document).ready(function(){

	$('.show-more').click(function(){
		var id = $(this).attr('id');
		$('.show-more').removeClass('active');
		if($('#' + id + '-more').is(':visible')){
			
			$('#' + id + '-more').slideUp('slow');
		} else {
			$('#components-list .hide').slideUp('slow');
			$(this).addClass('active');
			$('#' + id + '-more').slideToggle('slow');
		}
	});
	
	$('button').click(function(){
		var formID	= '#component-manager-form';
		var action	= $(this).attr('action');
		var cid		= $(this).attr('cid');
		var url		= 'create.php';
		var input	= $('<input>').attr('type', 'hidden').attr('name', 'cid').val(cid);
		
		if(action == 'edit') {
			var pid	= $(this).attr('pid');
			var input2 = $('<input>').attr('type', 'hidden').attr('name', 'pid').val(pid);
			url = 'index.php#start';
			$(formID).append($(input));
			$(formID).append($(input2));
			$(formID).attr('action', url).attr('method','POST');
			$(formID).submit();
		} else if(action == 'download') {
			var checkifmodal = $(this).attr('update');
			if(checkifmodal){
				var downloadcount = parseInt($('#' + checkifmodal).html());
				downloadcount = downloadcount + 1;
				$('#' + checkifmodal).html('').hide().html(downloadcount).fadeIn(1000);
			}
			var input2	= $('<input>').attr('type', 'hidden').attr('name', 'task').val('cdownload');
			$(formID).append($(input));
			$(formID).append($(input2));
			$(formID).attr('action', url).attr('method','POST');
			$(formID).submit();
		} else if(action == 'delete') {
			var agree = confirm('Are you sure? This will DELETE all zip files and history for this component!');
			if(agree){
				var input2	= $('<input>').attr('type', 'hidden').attr('name', 'task').val('cdelete');
				$(formID).append($(input));
				$(formID).append($(input2));
				$(formID).attr('action', url).attr('method','POST');
				$(formID).submit();
			} else {
				return;
			}
		}
	});
	
});
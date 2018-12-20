function load_page_popup(method, id){
		jQuery('#page_popup_box').modal('show');
		
		// Make an ajax call
		var myurl = baseUrl+'admin/pages/'+method+'/'+id;
		$.getJSON(myurl, function (obj_data) {
			$("#msg_box").html(obj_data.msg);
   			$("#load_page_form").html(obj_data.form_data);
 		});
}

$(document).ready(function (e) {
$("#frm_page").on('submit',(function(e){
		  e.preventDefault();
		  CKupdate();
		  var method = $('#method').val();
		  var pid = $('#pid').val();
		  $('#spinner_profile').show();
		  $('#page_submit').attr('disabled', 'disabled');
		  $('#pg_sub').attr('disabled', 'disabled');
		  $.ajax({
		  		url: baseUrl+"admin/pages/"+method+'/'+pid,
		  		type: "POST",
		  		data:  new FormData(this),
		  		contentType: false,
		  		cache: false,
		  		processData:false,
		  		success: function(data){
					var obj = jQuery.parseJSON(data);
		  			if(obj.msg=='done'){
						$('#page_submit').removeAttr('disabled');
						$('#pg_sub').removeAttr('disabled');
						$('#spinner_profile').hide();
						
						if(method=='upload_gallery_image'){
							//$.toaster({ priority : 'success', title : 'Success', message : 'Image uploaded successfully.'});
							 $('#data_gallery').html(obj.gallery_data);
							
						}
						else{
							$('#page_popup_box').modal('toggle');
							//$.toaster({ priority : 'success', title : 'Success', message : 'Page has been updated successfully.'});
							location.reload(true);
						}
						return;
					}
					else{
						$('#page_submit').removeAttr('disabled');
						$('#pg_sub').removeAttr('disabled');
						$('#spinner_profile').hide();
						$('#msg_box').html(obj.msg);
						return;
					}
		  	  }       
		  });
		  return;	
		  }));
});

function delete_page(id){
	var myurl = baseUrl+'admin/pages/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this page?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

function update_page_status(id){
	var current_status = $("#sts_"+id+" span").html();
	var myurl = baseUrl+'admin/pages/status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='Published')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}
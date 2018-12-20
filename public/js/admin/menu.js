var af='admin';
function load_menu_popup(method, id){
		jQuery('#menu_popup_box').modal('show');
		
		// Make an ajax call
		var myurl = baseUrl+af+'/menu/'+method+'/'+id;
		$.getJSON(myurl, function (obj_data) {
			$("#msg_box").html(obj_data.msg);
   			$("#load_menu_form").html(obj_data.form_data);
			//$("img").attr("width","500");
 		});
}

$(document).ready(function (e) {

$("#frm_menu").on('submit',(function(e){
		  e.preventDefault();
		  var method = $('#method').val();
		  var pid = $('#pid').val();
		  $('#spinner_profile').show();
		  $('#menu_submit').attr('disabled', 'disabled');
		  $.ajax({
		  		url: baseUrl+af+"/menu/"+method+'/'+pid,
		  		type: "POST",
		  		data:  new FormData(this),
		  		contentType: false,
		  		cache: false,
		  		processData:false,
		  		success: function(data){
					var obj = jQuery.parseJSON(data);
		  			if(obj.msg=='done'){
						/*$('#msg').html('<div class="message-container"> <div class="callout callout-success"><h4>Password updated Successfully.</h4></div></div>').show();*/
						
						$('#menu_popup_box').modal('toggle');
						$('#menu_submit').removeAttr('disabled');
						$('#spinner_profile').hide();
						//$.toaster({ priority : 'success', title : 'Success', message : 'Menu has been created successfully.'});
						setTimeout(function() { location.reload(true);}, 2000);
						return;
					}
					else{
						$('#menu_submit').removeAttr('disabled');
						$('#spinner_profile').hide();
						$('#msg_box').html(obj.msg);
						return;
					}
		  	  }       
		  });
		  return;	
		  }));

//Loading menu
$("#select_menu_btn").on('click',(function(e){
		var selected_menu_id = $("#menus").val();
		if(selected_menu_id!=''){
			$("#menu_pages").html('LOADING...');
			$("#menu_selected_id").val(selected_menu_id);
			var myurl = baseUrl+af+'/menu/load_menu_pages/'+selected_menu_id;
			$.getJSON(myurl, function (obj_data) {
			//$("#msg_box").html(obj_data.msg);
   			$("#menu_pages").html(obj_data.data);
			$("#d_m_p").html(obj_data.d_m_p);
 		});
		}
	}));

//Adding pages to menu
$("#pselectedfrm").on('submit',(function(e){
		  e.preventDefault();
		  $('#psubmit').attr('disabled', 'disabled');
		  $.ajax({
		  		url: baseUrl+af+"/menu/add_menu_pages",
		  		type: "POST",
		  		data:  new FormData(this),
		  		contentType: false,
		  		cache: false,
		  		processData:false,
		  		success: function(data){
					var obj = jQuery.parseJSON(data);
		  			if(obj.msg=='done'){
						$('#psubmit').removeAttr('disabled');
						//$.toaster({ priority : 'success', title : 'Success', message : 'Pages has been added successfully.'});
						$( "#select_menu_btn" ).click();
						return;
					}
					else{
						$('#psubmit').removeAttr('disabled');
						$('#msg_page_section').html(obj.msg);
						return;
					}
		  	  }       
		  });
		  return;	
       }));
	
//To load the default menu pages
$( "#select_menu_btn" ).click();

});

function delete_menu(id){
	var myurl = baseUrl+af+'/menu/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this menu?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				 location.reload(true); 
			  else
			  	alert('Oops! Something went wrong.');
	   	  });
	}
}

function delete_menu_page(id){
	var myurl = baseUrl+af+'/menu/delete_menu_page/'+id;
	var is_confirm = confirm("Are you sure you want to remove this page from menu?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('Oops! Something went wrong.');
	   	  });
	}
}
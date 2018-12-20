//=============== Functions ==================

function universal_validation(field_id, field_text, error_id, closest_div, email_validation, text_length, match_with, file_upload_id){	
	var filter = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	var field_value = $.trim($("#"+field_id).val());
	$( '.'+error_id).remove();  
	
	if(file_upload_id==''){
	 if(field_value==''){
		closest_div.addClass( "has-error" ); 
		closest_div.append( error_wrapper(error_id, 'Please provide '+field_text+'.') ); 
		err=1; 
		return false;
	 }
	}
	
	 if(text_length!=''){
	   if(field_value.length<text_length){
		  closest_div.addClass( "has-error" ); 
		  closest_div.append( error_wrapper(error_id, field_text+' must be '+text_length+' characters long.') ); 
		  err=1; 
		  return false;
	   }
	 }
	
	 if(match_with!=''){
	   if(field_value!=$.trim($("#"+match_with).val())){
		  closest_div.addClass( "has-error" ); 
		  closest_div.append( error_wrapper(error_id, field_text+' does not match.') ); 
		  err=1; 
		  return false;
	   }
	 }
	 
	 if(file_upload_id!=''){
		 ext_array = ['doc','docx','pdf','txt','rtf','png','jpg','jpeg'];
		 if(file_upload_id=='company_logo')
			ext_array = ['png','jpg','jpeg'];
			
		var ext = $('#'+file_upload_id).val().split('.').pop().toLowerCase();
		if($.inArray(ext, ext_array) == -1) {
			closest_div.addClass( "has-error" ); 
			closest_div.append( error_wrapper(error_id, 'invalid file provided!') );
			err=1; 
			return false;
		}
	 }
	 
	 if(email_validation=='yes'){
	   if(filter.test(field_value)===false){
		  closest_div.addClass( "has-error" ); 
		  closest_div.append( error_wrapper(error_id, 'Please enter a valid email address.') );
		  err=1; 
		  return false;
	   }
	 }

	 closest_div.removeClass( "has-error" ); 
	 $( '.'+error_id).remove();  
	 err=0;
	
}

function check_error(){
	if(err==1){
		return false;
	}else{
		
	}
}

function error_wrapper(id, error_msg){
	return '<div class="errowbox '+id+'"><div class="erormsg"> '+error_msg+' </div></div>';	
}

function error_msg(id, closest_div, text_msg){
	$("."+id).remove();
	closest_div.addClass( "has-error" );
	closest_div.append( error_wrapper(id, text_msg) );
}

function is_empty(field_obj, field_name, field_label){
	if(field_obj.val()==''){
		 closest_div = $( field_obj ).closest('div');
		 error_msg(field_name+'_err',closest_div,'Please provide '+field_label);
		field_obj.focus();
		return true;
	  }
	  return false;
}

function admin_is_empty(field_obj, field_name, field_label){
	if(field_obj.val()==''){
		 alert('Please provide '+field_label);
		field_obj.focus();
		return true;
	  }
	  return false;
}

// ===== Front-end contact us form validation

$(document).ready(function(){

  $("#frm_contact_us #full_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('full_name', 'full name', 'full_name_err', closest_div, 'no', '', '','');	
 });
 
 $('#frm_contact_us #full_name').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
 );
 
 $("#frm_contact_us #email").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('email', 'email', 'email_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_contact_us #phone").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('phone', 'phone', 'phone_err', closest_div, 'no', '', '','');
 });
 $('#frm_contact_us #phone').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^0-9\s]/g,'') ); }
 );

 $("#frm_contact_us #message").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('message', 'message', 'message_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_contact_us #captcha").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('captcha', 'verification code', 'captcha_err', closest_div, 'no', '', '','');
 });
 
});

function validate_contact_form(theForm){
	if(is_empty($("#full_name"), 'full_name', 'full name')) return false;
	if(is_empty($("#email"), 'email', 'email')) return false;
	if(is_empty($("#phone"), 'phone', 'phone')) return false;
	if(is_empty($("#message"), 'message', 'message')) return false;
	if(is_empty($("#captcha"), 'captcha', 'verification code')) return false;
	return true;
}



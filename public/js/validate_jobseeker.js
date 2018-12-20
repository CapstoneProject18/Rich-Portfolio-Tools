//JS
var err = 0;
//Jobseeker Signup validation Starts
$(document).ready(function(){
	
 //Email address
 $("#seeker_form #email").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('email', 'email', 'email_err', closest_div, 'yes', '', '','');	
 });
 
 //Password
 $("#seeker_form #pass").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('pass', 'password', 'pass_err', closest_div, 'no', '6', '','');	
 });
 
 //Confirm Password
 $("#seeker_form #confirm_pass").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('confirm_pass', 'confirm password', 'conf_pass_err', closest_div, 'no', '', 'pass','');	
 });
 
 //Full Name
 $("#seeker_form #full_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('full_name', 'full name', 'full_name_err', closest_div, 'no', '', '','');	
 });
 $('#seeker_form #full_name').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);

 //DOB Day
 $("#seeker_form #dob_day").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob_day', 'date of birth', 'dob_err', closest_div, 'no', '', '','');
 });
 
 //DOB Month
 $("#seeker_form #dob_month").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob_month', 'date of birth', 'dob_err', closest_div, 'no', '', '','');
 });
 
 //DOB Year
 $("#seeker_form #dob_year").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob_year', 'date of birth', 'dob_err', closest_div, 'no', '', '','');
 });
 
 //Address
 $("#seeker_form #current_address").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('current_address', 'current address', 'address_err', closest_div, 'no', '', '','');
 });
 
 //City
 $("#seeker_form #city_dropdown").change(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_dropdown', 'city', 'city_err', closest_div, 'no', '', '','');
 });

$("#seeker_form #city_text").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_text', 'city', 'city_err', closest_div, 'no', '', '','');
 });
 
$('#seeker_form #city_text').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);

 //Mobile
 $("#seeker_form #mobile_number").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('mobile_number', 'mobile number', 'mob_err', closest_div, 'no', '', '','');
 });
 $('#seeker_form #mobile_number').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^0-9\s]/g,'') ); }
);

 //CV Uploding validation
 $("#seeker_form #cv_file").bind('change blur',function(){
	closest_div = $( this ).closest('div');
	universal_validation('document', 'your resume', 'cv_err', closest_div, 'no', '', '','cv_file');
 });
 
 //Captcha
 $("#seeker_form #captcha").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('captcha', 'verification code', 'captcha_err', closest_div, 'no', '', '','');
 });
 
 $('#seeker_form').bind('keyup blur',function(){ 
    if($('.ui-autocomplete-input').val()!=''){
		$( '.city_err').remove(); 
	}
});

});

function validate_form(theForm){
	
	if(theForm.email.value==''){
		 closest_div = $( '#email' ).closest('div');
		 error_msg('email_err',closest_div,'Please provide email address');
		theForm.email.focus();
		return false;
	}
	
	if(theForm.pass.value==''){
		closest_div = $( '#pass' ).closest('div');
		error_msg('pass_err',closest_div,'Please provide password');
		theForm.pass.focus();
		return false;
	}
	
	if(theForm.confirm_pass.value==''){
		closest_div = $( '#confirm_pass' ).closest('div');
		error_msg('conf_pass_err',closest_div,'Please confirm your password');
		theForm.confirm_pass.focus();
		return false;
	}
	
	if(theForm.confirm_pass.value!=theForm.pass.value){
		closest_div = $( '#confirm_pass' ).closest('div');
		error_msg('conf_pass_err',closest_div,'Confirm password does not match.');
		theForm.confirm_pass.focus();
		return false;
	}
	
	if(theForm.full_name.value==''){
		closest_div = $( '#full_name' ).closest('div');
		error_msg('full_name_err',closest_div,'Please provide your full name.');
		theForm.full_name.focus();
		return false;
	}
	
	if(theForm.dob_day.value=='' || theForm.dob_month.value=='' || theForm.dob_year.value==''){
		closest_div = $( '#dob_day' ).closest('div');
		error_msg('dob_err',closest_div,'Please provide your date of birth.');
		theForm.dob_day.focus();
		return false;
	}
	
	if(theForm.current_address.value==''){
		closest_div = $( '#current_address' ).closest('div');
		error_msg('address_err',closest_div,'Please provide your street address.');
		theForm.current_address.focus();
		return false;
	}
	
	if(theForm.city_dropdown.value=='' && theForm.city_text.value==''){
		closest_div = $( '#city_dropdown' ).closest('div');
		$(".city_err").remove();
		error_msg('city_err',closest_div,'Please enter city name.');
		theForm.city_dropdown.focus();
		return false;
	}
	
	if(theForm.mobile_number.value==''){
		closest_div = $( '#mobile_number' ).closest('div');
		error_msg('mob_err',closest_div,'Please provide your mobile number.');
		theForm.mobile_number.focus();
		return false;
	}

	var ext = $('#cv_file').val().split('.').pop().toLowerCase();
	if($.inArray(ext, ['doc','docx','pdf','txt','rtf','jpg','jpeg']) == -1) {
		closest_div = $( '#cv_file' ).closest('div');
		closest_div.addClass( "has-error" ); 
		closest_div.append( error_wrapper('cv_err', 'Please provide a valid resume file.') );
		theForm.cv_file.focus();
		return false;
	}
	
	if(theForm.captcha.value==''){
		closest_div = $( '#captcha' ).closest('div');
		error_msg('captcha_err',closest_div,'Please enter verification code provided above.');
		theForm.captcha.focus();
		return false;
	}

	return true;
}
//Jobseeker Signup validation Ends

//Jobseeker Edit my account validations Starts
$(document).ready(function(){
	
 //Full Name
 $("#account_form #full_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('full_name', 'full name', 'full_name_err', closest_div, 'no', '', '','');	
 });
 $('#account_form #full_name').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);

 //DOB Day
 $("#account_form #dob_day").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob_day', 'date of birth', 'dob_err', closest_div, 'no', '', '','');
 });
 
 //DOB Month
 $("#account_form #dob_month").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob_month', 'date of birth', 'dob_err', closest_div, 'no', '', '','');
 });
 
 //DOB Year
 $("#account_form #dob_year").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob_year', 'date of birth', 'dob_err', closest_div, 'no', '', '','');
 });
 
 //Address
 $("#account_form #pressent_address").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('pressent_address', 'current address', 'address_err', closest_div, 'no', '', '','');
 });
 
 //City
 $("#account_form #city_dropdown").change(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_dropdown', 'city', 'city_err', closest_div, 'no', '', '','');
 });
 
 $("#account_form #city_text").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_text', 'city', 'city_err', closest_div, 'no', '', '','');
 });
 
 $('#account_form #city_text').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);

 //Mobile
 $("#account_form #mobile").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('mobile', 'mobile number', 'mob_err', closest_div, 'no', '', '','');
 });
 $('#account_form #mobile').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^0-9\s]/g,'') ); }
);

});

function validate_account_form(theForm){

	if(theForm.full_name.value==''){
		closest_div = $( '#full_name' ).closest('div');
		error_msg('full_name_err',closest_div,'Please provide your full name.');
		theForm.full_name.focus();
		return false;
	}
	
	if(theForm.dob_day.value=='' || theForm.dob_month.value=='' || theForm.dob_year.value==''){
		closest_div = $( '#dob_day' ).closest('div');
		error_msg('dob_err',closest_div,'Please provide your date of birth.');
		theForm.dob_day.focus();
		return false;
	}
	
	if(theForm.present_address.value==''){
		closest_div = $( '#present_address' ).closest('div');
		error_msg('address_err',closest_div,'Please provide your street address.');
		theForm.present_address.focus();
		return false;
	}
	
	if(theForm.city_dropdown.value=='' && theForm.city_text.value==''){
		closest_div = $( '#city_dropdown' ).closest('div');
		$(".city_err").remove();
		error_msg('city_err',closest_div,'Please enter city name.');
		theForm.city_dropdown.focus();
		return false;
	}
	
	if(theForm.mobile.value==''){
		closest_div = $( '#mobile' ).closest('div');
		error_msg('mob_err',closest_div,'Please provide your mobile number.');
		theForm.mobile.focus();
		return false;
	}

	return true;
}
//Jobseeker Edit my account validations Ends

//Jobseeker edit profile from cv builder Starts
function validate_cv_builder_form(theForm){

	if(theForm.full_name.value==''){
		closest_div = $( '#full_name' ).closest('div');
		error_msg('full_name_err',closest_div,'Please provide your full name.');
		theForm.full_name.focus();
		return false;
	}

	if(theForm.city_dropdown.value=='' && theForm.city_text.value==''){
		closest_div = $( '#city_dropdown' ).closest('div');
		$(".city_err").remove();
		error_msg('city_err',closest_div,'Please enter city name.');
		theForm.city_dropdown.focus();
		return false;
	}
	
	if(theForm.mobile.value==''){
		closest_div = $( '#mobile' ).closest('div');
		error_msg('mob_err',closest_div,'Please provide your mobile number.');
		theForm.mobile.focus();
		return false;
	}

	return true;
}
//Jobseeker edit profile from cv builder Ends

//Jobseeker Edit profile validations Starts
$(document).ready(function(){
	
  $("#jobseeker_profile_submitter").click(function(){	
	  if(is_empty($("#full_name"), 'full_name', 'full name')) return false;
	  if(is_empty($("#mobile"), 'mobile', 'mobile')) return false;
	  if(is_empty($("#country"), 'country', 'country')) return false;
	  if(is_empty($("#city"), 'city', 'city')) return false;
	  edit_jobseeker_profile();
  });
  
  
  $("#frm_edit_profile #full_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('full_name', 'full name', 'full_name_err', closest_div, 'no', '', '','');	
 });
 $('#frm_edit_profile  #full_name').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
 );
 
 $("#frm_edit_profile #mobile").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('mobile', 'mobile', 'mobile_err', closest_div, 'no', '', '','');
 });
 $('#frm_edit_profile  #mobile').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^0-9\s]/g,'') ); }
 );
 
 $("#frm_edit_profile #dob").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob', 'dob', 'dob_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_edit_profile #present_address").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('present_address', 'present_address', 'present_address_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_edit_profile #country").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('country', 'country', 'country_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_edit_profile #city").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city', 'city', 'city_err', closest_div, 'no', '', '','');
 });
 
 $('#frm_edit_profile  #full_name').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
 );
 
});

//Jobseeker Edit profile validations Ends

//Starts Edit Jobseeker Summary
$(document).ready(function(){
	
  $("#summary_submit").click(function(){	
	  if(is_empty($("#content"), 'content', 'summary')) return false;
	  edit_jobseeker_summary();
  });
  
  
  $("#frm_seeker_summary #content").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('content', 'summary', 'content_err', closest_div, 'no', '', '','');	
 });
 $('#frm_seeker_summary  #content').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/(<([^>]+)>)/ig,'') ); }
 );

});
//Ends Jobseeker summary


//Jobseeker Add Education Starts
$(document).ready(function(){
	
  $("#js_education_submitter").click(function(){	
	  if(is_empty($("#degree_title"), 'degree_title', 'degree title')) return false;
	  if(is_empty($("#major_subject"), 'major_subject', 'major subject')) return false;
	  if(is_empty($("#institute"), 'institute', 'Institute')) return false;
	  if(is_empty($("#edu_country"), 'edu_country', 'country')) return false;
	  if(is_empty($("#edu_city"), 'edu_city', 'city')) return false;
	  if(is_empty($("#completion_year"), 'completion_year', 'completion year')) return false;
	  add_js_edu();
  });
  
  
  $("#frm_add_education #degree_title").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('degree_title', 'degree title', 'degree_title_err', closest_div, 'no', '', '','');	
 });
 
 
 $("#frm_add_education #major_subject").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('major_subject', 'major subject', 'major_subject_err', closest_div, 'no', '', '','');
 });

 $("#frm_add_education #institute").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('institute', 'institute', 'institute_err', closest_div, 'no', '', '','');
 });
  
 $("#frm_add_education #edu_country").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('edu_country', 'country', 'edu_country_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_add_education #edu_city").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('edu_city', 'city', 'edu_city_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_add_education #completion_year").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('completion_year', 'completion year', 'completion_year_err', closest_div, 'no', '', '','');
 });
  
});
//Jobseeker Add Education Ends


//Jobseeker Edit Education Starts
$(document).ready(function(){
	
  $("#js_edit_edu_submit").click(function(){	
	  if(is_empty($("#ed_degree_title"), 'ed_degree_title', 'degree title')) return false;
	  if(is_empty($("#ed_major_subject"), 'ed_major_subject', 'major subject')) return false;
	  if(is_empty($("#ed_institute"), 'ed_institute', 'Institute')) return false;
	  if(is_empty($("#ed_edu_country"), 'ed_edu_country', 'country')) return false;
	  if(is_empty($("#ed_edu_city"), 'ed_edu_city', 'city')) return false;
	  if(is_empty($("#ed_completion_year"), 'ed_completion_year', 'completion year')) return false;
	  edit_js_edu();
  });
  
  
  $("#js_edit_edu_submit #ed_degree_title").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('ed_degree_title', 'degree title', 'ed_degree_title_err', closest_div, 'no', '', '','');	
 });
 
 
 $("#js_edit_edu_submit #ed_major_subject").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('ed_major_subject', 'major subject', 'ed_major_subject_err', closest_div, 'no', '', '','');
 });

 $("#js_edit_edu_submit #ed_institute").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('ed_institute', 'ed_institute', 'ed_institute_err', closest_div, 'no', '', '','');
 });
  
 $("#js_edit_edu_submit #ed_edu_country").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('ed_edu_country', 'country', 'ed_edu_country_err', closest_div, 'no', '', '','');
 });
 
 $("#js_edit_edu_submit #ed_edu_city").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('ed_edu_city', 'city', 'ed_edu_city_err', closest_div, 'no', '', '','');
 });
 
 $("#js_edit_edu_submit #ed_completion_year").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('ed_completion_year', 'completion year', 'ed_completion_year_err', closest_div, 'no', '', '','');
 });
  
});
//Jobseeker Edit Education Ends


//Jobseeker Add Experience Starts
$(document).ready(function(){
	
  $("#js_exp_submit").click(function(){	
	  if(is_empty($("#job_title"), 'job_title', 'job title')) return false;
	  if(is_empty($("#company_name"), 'company_name', 'company name')) return false;
	  if(is_empty($("#exp_country"), 'exp_country', 'Country')) return false;
	  if(is_empty($("#exp_city"), 'exp_city', 'city')) return false;
	  if(is_empty($("#start_date"), 'start_date', 'start date')) return false;
	  add_js_exp();
  });
  
  
  $("#frm_add_exp #job_title").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('job_title', 'job title', 'job_title_err', closest_div, 'no', '', '','');	
 });
 
 
 $("#frm_add_exp #company_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_name', 'company name', 'company_name_err', closest_div, 'no', '', '','');
 });

 $("#frm_add_exp #exp_country").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('exp_country', 'country', 'exp_country_err', closest_div, 'no', '', '','');
 });
  
 $("#frm_add_exp #exp_city").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('exp_city', 'city', 'exp_city_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_add_exp #start_month").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('start_month', 'start month', 'start_month_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_add_exp #start_year").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('start_year', 'start year', 'start_year_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_add_exp #end_month").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('end_month', 'end month', 'end_month_err', closest_div, 'no', '', '','');
 });
  
});
//Jobseeker Add Experience Ends


//Jobseeker Edit Experience Starts
$(document).ready(function(){
	
  $("#js_edit_exp_submit").click(function(){	
	  if(is_empty($("#ed_job_title"), 'ed_job_title', 'job title')) return false;
	  if(is_empty($("#ed_company_name"), 'ed_company_name', 'company name')) return false;
	  if(is_empty($("#ed_exp_country"), 'ed_exp_country', 'Country')) return false;
	  if(is_empty($("#ed_exp_city"), 'ed_exp_city', 'city')) return false;
	  if(is_empty($("#ed_start_date"), 'ed_start_date', 'start date')) return false;
	  edit_js_exp();
  });
  
  
  $("#frm_edit_exp #ed_job_title").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('job_title', 'job title', 'job_title_err', closest_div, 'no', '', '','');	
 });
 
 
 $("#frm_edit_exp #ed_company_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('ed_company_name', 'company name', 'company_name_err', closest_div, 'no', '', '','');
 });

 $("#frm_edit_exp #ed_exp_country").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('ed_exp_country', 'country', 'exp_country_err', closest_div, 'no', '', '','');
 });
  
 $("#frm_edit_exp #ed_exp_city").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('ed_exp_city', 'city', 'exp_city_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_edit_exp #ed_start_month").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('ed_start_month', 'start month', 'start_month_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_edit_exp #ed_start_year").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('ed_start_year', 'start year', 'start_year_err', closest_div, 'no', '', '','');
 });
 
 $("#frm_edit_exp #ed_end_month").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('ed_end_month', 'end month', 'end_month_err', closest_div, 'no', '', '','');
 });
  
});
//Jobseeker Edit Experience Ends

//Jobseeker delete photo Starts
$(document).ready(function(){
	
  $("#remove_pic").click(function(){	
	  var resp = confirm("Are you sure you want to remove your photo?");
	  if(resp==true){
		del_photo();  
	  }
  });
  
  
  $("#frm_seeker_summary #content").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('content', 'summary', 'content_err', closest_div, 'no', '', '','');	
 });
 $('#frm_seeker_summary  #content').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/(<([^>]+)>)/ig,'') ); }
 );

});


$(function() {
	if($( "#start_date" ).length > 0) {
	$( "#start_date" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
	
	$( "#end_date" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
	
	$( "#ed_start_date" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
	
	$( "#ed_end_date" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
	}
  });
  
  $(".fa-upload").click(function(){
	  $("#upload_pic").click();
  });

  $("#upload_pic").change(function(){
	  ext_array = ['png','jpg','jpeg','gif'];	
	  var ext = $('#upload_pic').val().split('.').pop().toLowerCase();
	  if($.inArray(ext, ext_array) == -1) {
		  alert('Invalid file provided!');
		  return false;
	  }
	 this.form.submit();
  });
//Jobseeker delete photo ends


//Jobseeker upload cv
$(".upload_cv").click(function(){
	  $("#upload_resume").click();
  });

  $("#upload_resume").change(function(){
	  ext_array = ['doc','docx','pdf','rtf','png','jpg','jpeg'];	
	  var ext = $('#upload_resume').val().split('.').pop().toLowerCase();
	  if($.inArray(ext, ext_array) == -1) {
		  alert('Invalid file provided!');
		  return false;
	  }
	 this.form.submit();
  });
  
//Jobseeker Edit additional info validations Starts
$(document).ready(function(){
 
 $("#additional_form #description").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('description', 'career objective', 'description_err', closest_div, 'no', '', '','');
 });
 
 $("#additional_form #awards").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('awards', 'awards', 'awards_err', closest_div, 'no', '', '','');
 });
 
});

function validate_additional_form(theForm){
	if(is_empty($("#description"), 'description', 'career objective')) return false;
	if(is_empty($("#awards"), 'awards', 'awards')) return false;
	return true;
}

//Jobseeker Edit additional info validations Ends


//Add Skills Jobseeker

$(document).ready(function(){
	
  $("#js_skill_submit").click(function(){	
	  if(is_empty($("#skill"), 'skill', 'skill')) return false;
	  add_jobseeker_skill();
  });
  
   $("#skill").bind('keyup blur', function(){
	 $( this ).closest('div').removeClass( "has-error" ); 
	 $(".skill_err").remove();
 });
 
 //Remove
 $(document.body).on('click','#myskills li a',function(){	
	 $( this ).closest('li').remove();
 });
 
});

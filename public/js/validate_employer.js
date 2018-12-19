//JS
var err = 0;
//Employer signup validation
$(document).ready(function(){
	
 //Email address
 $("#emp_form #email").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('email', 'email', 'email_err', closest_div, 'yes', '', '','');	
 });
 
 //Password
 $("#emp_form #pass").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('pass', 'password', 'pass_err', closest_div, 'no', '6', '','');	
 });
 
 //Confirm Password
 $("#emp_form #confirm_pass").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('confirm_pass', 'confirm password', 'conf_pass_err', closest_div, 'no', '', 'pass','');	
 });
 
 //Full Name
 $("#emp_form #full_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('full_name', 'full name', 'full_name_err', closest_div, 'no', '', '','');	
 });
 $('#emp_form #full_name').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);
 
 //Address
 $("#emp_form #current_address").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('current_address', 'current address', 'address_err', closest_div, 'no', '', '','');
 });
 
 //City
 $("#emp_form #city_dropdown").change(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_dropdown', 'city', 'city_err', closest_div, 'no', '', '','');
 });
 
 $("#emp_form #city_text").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_text', 'city', 'city_err', closest_div, 'no', '', '','');
 });
 
 $('#emp_form #city_text').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);

$('#emp_form').bind('keyup blur',function(){ 
    if($('.ui-autocomplete-input').val()!=''){
		$( '.city_err').remove(); 
	}
});

 //Mobile
 $("#emp_form #mobile_phone").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('mobile_phone', 'mobile number', 'mob_err', closest_div, 'no', '', '','');
 });
/* $('#emp_form #mobile_phone').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^0-9\s]/g,'') ); }
);*/

 //Company Name
 $("#emp_form #company_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_name', 'company name', 'company_err', closest_div, 'no', '', '','');
 });
 
 $("#emp_form #industry_id").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('industry_id', 'industry', 'industry_err', closest_div, 'no', '', '','');
 });
  
 $("#emp_form #company_location").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_location', 'company location', 'company_location_err', closest_div, 'no', '', '','');
 });
  
 $("#emp_form #company_description").blur(function(){
	 closest_div = $( this ).closest('div');
	 check_bad_words($("#company_description").val(), bad_words, 'company_description');
	 universal_validation('company_description', 'about company', 'company_description_err', closest_div, 'no', '', '','');
	 
 });
 
  $("#emp_form #company_description").blur(function(){
	 check_bad_words($("#company_description").val(), bad_words, 'company_description');	 
 });
  
 $("#emp_form #company_phone").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_phone', 'company phone', 'company_phone_err', closest_div, 'no', '', '','');
 });
 
 /*$('#emp_form #company_phone').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^0-9\s]/g,'') ); }
);*/

 $("#emp_form #company_website").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_website', 'company website', 'company_website_err', closest_div, 'no', '', '','');
 });
 
 //Logo Uploding validation
 $("#emp_form #company_logo").bind('change blur',function(){
	closest_div = $( this ).closest('div');
	universal_validation('document', 'company logo', 'company_logo_err', closest_div, 'no', '', '','company_logo');
 });
 
 //Captcha
 $("#emp_form #captcha").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('captcha', 'captcha code', 'captcha_err', closest_div, 'no', '', '','');
 });
 
});

function validate_employer_form(theForm){
	return_val = true;
	if(theForm.email.value==''){
		 closest_div = $( '#email' ).closest('div');
		 error_msg('email_err',closest_div,'Please provide email address');
		theForm.email.focus();
		return_val = false;
	}
	
	var filter = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	if(filter.test(theForm.email.value)===false){
		 closest_div = $( '#email' ).closest('div');
		 error_msg('email_err',closest_div,'Please provide a valid email address');
		theForm.email.focus();
		return_val = false;
	}
	
	if(theForm.pass.value==''){
		closest_div = $( '#pass' ).closest('div');
		error_msg('pass_err',closest_div,'Please provide password');
		theForm.pass.focus();
		return_val = false;
	}
	
	if(theForm.confirm_pass.value==''){
		closest_div = $( '#confirm_pass' ).closest('div');
		error_msg('conf_pass_err',closest_div,'Please confirm your password');
		theForm.confirm_pass.focus();
		return_val = false;
	}
	
	if(theForm.confirm_pass.value!=theForm.pass.value){
		closest_div = $( '#confirm_pass' ).closest('div');
		error_msg('conf_pass_err',closest_div,'Confirm password does not match.');
		theForm.confirm_pass.focus();
		return_val = false;
	}
	
	if(theForm.full_name.value==''){
		closest_div = $( '#full_name' ).closest('div');
		error_msg('full_name_err',closest_div,'Please provide your full name.');
		theForm.full_name.focus();
		return_val = false;
	}
	
	if(theForm.city_dropdown.value=='' && theForm.city_text.value==''){
		closest_div = $( '#city_dropdown' ).closest('div');
		$(".city_err").remove();
		error_msg('city_err',closest_div,'Please enter city name.');
		theForm.city_dropdown.focus();
		return_val = false;
	}
	
	if(theForm.mobile_phone.value==''){
		closest_div = $( '#mobile_phone' ).closest('div');
		error_msg('mob_err',closest_div,'Please provide your mobile number.');
		theForm.mobile_phone.focus();
		return_val = false;
	}
	
	if(theForm.company_name.value==''){
		closest_div = $( '#company_name' ).closest('div');
		error_msg('company_name_err',closest_div,'Please provide company name.');
		theForm.company_name.focus();
		return_val = false;
	}

	if(theForm.industry_id.value==''){
		closest_div = $( '#industry_id' ).closest('div');
		error_msg('industry_id_err',closest_div,'Please provide industry.');
		theForm.industry_id.focus();
		return_val = false;
	}

	if(theForm.company_location.value==''){
		closest_div = $( '#company_location' ).closest('div');
		error_msg('company_location_err',closest_div,'Please enter about company.');
		theForm.company_location.focus();
		return_val = false;
	}
	
	if(theForm.company_phone.value==''){
		closest_div = $( '#company_phone' ).closest('div');
		error_msg('company_phone_err',closest_div,'Please provide company phone.');
		theForm.company_phone.focus();
		return_val = false;
	}
	
	if(theForm.company_website.value==''){
		closest_div = $( '#company_website' ).closest('div');
		error_msg('company_website_err',closest_div,'Please provide company website.');
		theForm.company_website.focus();
		return_val = false;
	}
	
	if(theForm.company_description.value==''){
		closest_div = $( '#company_description' ).closest('div');
		error_msg('company_description_err',closest_div,'Please provide company description.');
		theForm.company_description.focus();
		return_val = false;
	}	
	
	var ext = $('#company_logo').val().split('.').pop().toLowerCase();
	if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
		closest_div = $( '#company_logo' ).closest('div');
		closest_div.addClass( "has-error" ); 
		closest_div.append( error_wrapper('company_logo_err', 'Please provide a valid logo file.') );
		theForm.company_logo.focus();
		return_val = false;
	}
	
	if(theForm.captcha.value==''){
		closest_div = $( '#captcha' ).closest('div');
		error_msg('captcha_err',closest_div,'Please enter captcha code provided above.');
		theForm.captcha.focus();
		return_val = false;
	}
	
	check_bad_words($("#company_description").val(), bad_words, 'company_description');
	
	return return_val;
}

//Employer edit company validation
$(document).ready(function(){
 
 //Full Name
 $("#emp_comp_form #full_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('full_name', 'full name', 'full_name_err', closest_div, 'no', '', '','');	
 });
 $('#emp_comp_form #full_name').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);
 
 //City
 $("#emp_comp_form #city_dropdown").change(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_dropdown', 'city', 'city_err', closest_div, 'no', '', '','');
 });
 
 $("#emp_comp_form #city_text").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_text', 'city', 'city_err', closest_div, 'no', '', '','');
 });
 
 $('#emp_comp_form #city_text').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);

$('#emp_comp_form').bind('keyup blur',function(){ 
    if($('.ui-autocomplete-input').val()!=''){
		$( '.city_err').remove(); 
	}
});

 //Mobile
 $("#emp_comp_form #mobile_phone").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('mobile_phone', 'mobile number', 'mob_err', closest_div, 'no', '', '','');
 });

 //Company Name
 $("#emp_comp_form #company_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_name', 'company name', 'company_err', closest_div, 'no', '', '','');
 });
 
 $("#emp_comp_form #industry_id").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('industry_id', 'industry', 'industry_err', closest_div, 'no', '', '','');
 });
  
 $("#emp_comp_form #company_location").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_location', 'company location', 'company_location_err', closest_div, 'no', '', '','');
 });
  
 $("#emp_comp_form #company_description").blur(function(){
	 closest_div = $( this ).closest('div');
	 check_bad_words($("#company_description").val(), bad_words, 'company_description');
	 universal_validation('company_description', 'about company', 'company_description_err', closest_div, 'no', '', '','');
	 
 });
 
  $("#emp_comp_form #company_description").blur(function(){
	 check_bad_words($("#company_description").val(), bad_words, 'company_description');	 
 });
  
 $("#emp_comp_form #company_phone").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_phone', 'company phone', 'company_phone_err', closest_div, 'no', '', '','');
 });

 $("#emp_comp_form #company_website").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_website', 'company website', 'company_website_err', closest_div, 'no', '', '','');
 });
  
});

function validate_employer_company_form(theForm){
	
	if(is_empty($("#full_name"), 'full_name', 'full name')) return false;
	if(is_empty($("#company_name"), 'company_name', 'company name')) return false;
	if(is_empty($("#industry_id"), 'industry_id', 'industry')) return false;	
	if(is_empty($("#company_location"), 'company_location', 'company Address')) return false;	
	if(is_empty($("#country"), 'country', 'country')) return false;	
	
	if($("#city_dropdown").val()=='' && $("#city_text").val()==''){
		closest_div = $( '#city_dropdown' ).closest('div');
		$(".city_err").remove();
		error_msg('city_err',closest_div,'Please enter city name.');
		$("#city_dropdown").focus();
		return false;
	}
	
	if(is_empty($("#company_phone"), 'company_phone', 'company phone')) return false;
	if(is_empty($("#mobile_phone"), 'mobile_phone', 'mobile phone')) return false;
	
	if(is_empty($("#company_website"), 'company_website', 'company website')) return false;	
	if(is_empty($("#company_description"), 'company_description', 'company description')) return false;	
	check_bad_words($("#company_description").val(), bad_words, 'company_description');
	return true;
}

//Employer edit employer personal profile validation
$(document).ready(function(){

 //Full Name
 $("#emp_personal_form #full_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('full_name', 'full name', 'full_name_err', closest_div, 'no', '', '','');	
 });
 $('#emp_personal_form #full_name').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);

 //DOB Day
 $("#emp_personal_form #dob_day").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob_day', 'date of birth', 'dob_err', closest_div, 'no', '', '','');
 });
 
 //DOB Month
 $("#emp_personal_form #dob_month").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob_month', 'date of birth', 'dob_err', closest_div, 'no', '', '','');
 });
 
 //DOB Year
 $("#emp_personal_form #dob_year").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob_year', 'date of birth', 'dob_err', closest_div, 'no', '', '','');
 });
 
 //City
 $("#emp_personal_form #city_dropdown").change(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_dropdown', 'city', 'city_err', closest_div, 'no', '', '','');
 });
 
 $("#emp_personal_form #city_text").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_text', 'city', 'city_err', closest_div, 'no', '', '','');
 });
 
 $('#emp_personal_form #city_text').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);

 //Mobile
 $("#emp_personal_form #mobile_phone").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('mobile_phone', 'mobile number', 'mob_err', closest_div, 'no', '', '','');
 });
 /*$('#emp_personal_form #mobile_phone').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^0-9\s]/g,'') ); }
);*/

});

function validate_employer_personal_form(theForm){
	
	if(is_empty($("#full_name"), 'full_name', 'full name')) return false;
	if(is_empty($("#dob_day"), 'dob_day', 'DOB')) return false;	
	if(is_empty($("#dob_day"), 'dob_month', 'DOB')) return false;	
	if(is_empty($("#dob_day"), 'dob_year', 'DOB')) return false;	
	if(is_empty($("#city_text"), 'city_text', 'city')) return false;	
	if(is_empty($("#mobile_phone"), 'mobile_phone', 'mobile number')) return false;
		
	return true;
}

//Starts Edit Employer Summary
$(document).ready(function(){
	
  $("#summary_submit").click(function(){	
	  if(is_empty($("#content"), 'content', 'summary')) return false;
	  if(is_empty($("#cid"), 'cid', 'ID')) return false;
	  edit_company_summary();
  });
  
  
  $("#frm_employer_desc #content").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('content', 'summary', 'content_err', closest_div, 'no', '', '','');	
 });
 $('#frm_employer_desc  #content').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/(<([^>]+)>)/ig,'') ); }
 );
 
 $("#frm_employer_desc #content").blur(function(){
 	check_bad_words($("#company_description").val(), bad_words, 'company_description');
 });
});
//Ends Employer summary

//Starts Post New Job Employer 
$(document).ready(function(){

 $("#post_job_form #industry_id").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('industry_id', 'industry', 'industry_id_err', closest_div, 'no', '', '','');	
 });
 
 $("#post_job_form #job_title").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('job_title', 'job title', 'job_title_err', closest_div, 'no', '', '','');	
 });
 
 $("#post_job_form #vacancies").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('vacancies', 'vacancies', 'vacancies_err', closest_div, 'no', '', '','');	
 });
 
 $('#post_job_form #vacancies').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^0-9\s]/g,'') ); }
);

 $("#post_job_form #last_date").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('last_date', 'last date', 'last_date_err', closest_div, 'no', '', '','');	
 });
 
 $("#post_job_form #city_text").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_text', 'city', 'city_text_err', closest_div, 'no', '', '','');	
 });
 
 $("#post_job_form #qualification").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('qualification', 'qualification', 'qualification_err', closest_div, 'no', '', '','');	
 });
 
 $("#post_job_form #editor1").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('editor1', 'job description', 'editor1_err', closest_div, 'no', '', '','');	
 });
 
 $("#post_job_form #editor1").blur(function(){
	 check_bad_words(CKEDITOR.instances['editor1'].getData(), bad_words, 'editor1');
 });
  
 $("#post_job_form #contact_person").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('contact_person', 'contact person', 'contact_person_err', closest_div, 'no', '', '','');	
 });
 
 $("#post_job_form #contact_email").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('contact_email', 'contact email', 'contact_email_err', closest_div, 'no', '', '','');	
 });
 
 $("#post_job_form #contact_phone").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('contact_phone', 'contact phone', 'contact_phone_err', closest_div, 'no', '', '','');	
 });

});
function validate_new_post_job_form(theForm){
	
	if(is_empty($("#industry_id"), 'industry_id', 'industry')) return false;
	if(is_empty($("#job_title"), 'job_title', 'job title')) return false;	
	if(is_empty($("#vacancies"), 'vacancies', 'vacancies')) return false;	
	if(is_empty($("#last_date"), 'last_date', 'job last date')) return false;	
	if(is_empty($("#city_text"), 'city_text', 'city')) return false;	
	if(is_empty($("#qualification"), 'qualification', 'qualification')) return false;	
	if(CKEDITOR.instances['editor1'].getData()==''){
		closest_div = $("#editor1").closest('div');
		 error_msg('editor1_err',closest_div,'Please provide job description.');
		$("#editor1").focus();
		return false;
	  }
	if(is_empty($("#s_val"), 'skill', 'Skill')) return false;
	if(is_empty($("#contact_person"), 'contact_person', 'contact person')) return false;
	if(is_empty($("#contact_email"), 'contact_email', 'contact email')) return false;
	if(is_empty($("#contact_phone"), 'contact_phone', 'contact phone')) return false;
	check_bad_words(CKEDITOR.instances['editor1'].getData(), bad_words, 'editor1');
	return true;
}

//Employer delete logo Starts
$(document).ready(function(){
	
  $("#remove_logo").click(function(){	
	  var resp = confirm("Are you sure you want to remove company logo?");
	  if(resp==true){
		del_logo();  
	  }
  });
});

//Add Skills Jobseeker
$(document).ready(function(){
	
  $("#js_skill_add").click(function(){	
	  if(is_empty($("#skill"), 'skill', 'skill')) return false;
	  add_job_skill();
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

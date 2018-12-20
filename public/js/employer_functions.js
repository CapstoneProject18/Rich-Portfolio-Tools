//JS
var err = 0;
//Employer validation
$(document).ready(function(){
	
 //Email address
 $("#email").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('email', 'email', 'email_err', closest_div, 'yes', '', '','');	
 });
 
 //Password
 $("#pass").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('pass', 'password', 'pass_err', closest_div, 'no', '6', '','');	
 });
 
 //Confirm Password
 $("#confirm_pass").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('confirm_pass', 'confirm password', 'conf_pass_err', closest_div, 'no', '', 'pass','');	
 });
 
 //Full Name
 $("#full_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('full_name', 'full name', 'full_name_err', closest_div, 'no', '', '','');	
 });
 $('#full_name').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);

 //DOB Day
 $("#dob_day").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob_day', 'date of birth', 'dob_err', closest_div, 'no', '', '','');
 });
 
 //DOB Month
 $("#dob_month").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob_month', 'date of birth', 'dob_err', closest_div, 'no', '', '','');
 });
 
 //DOB Year
 $("#dob_year").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('dob_year', 'date of birth', 'dob_err', closest_div, 'no', '', '','');
 });
 
 //Address
 $("#current_address").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('current_address', 'current address', 'address_err', closest_div, 'no', '', '','');
 });
 
 //City
 $("#city_dropdown").change(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_dropdown', 'city', 'city_err', closest_div, 'no', '', '','');
 });
 
 $("#city_text").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('city_text', 'city', 'city_err', closest_div, 'no', '', '','');
 });
 
 $('#city_text').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^a-zA-Z\s]/g,'') ); }
);

 //Mobile
 $("#mobile_phone").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('mobile_phone', 'mobile number', 'mob_err', closest_div, 'no', '', '','');
 });
 $('#mobile_phone').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^0-9\s]/g,'') ); }
);

 //Company Name
 $("#company_name").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_name', 'company name', 'company_err', closest_div, 'no', '', '','');
 });
 
 $("#company_ceo").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_ceo', 'company CEO', 'company_ceo_err', closest_div, 'no', '', '','');
 });
 
 $("#industry_id").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('industry_id', 'industry', 'industry_err', closest_div, 'no', '', '','');
 });
 
 $("#established_in").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('established_in', 'established in', 'established_in_err', closest_div, 'no', '', '','');
 });
 
 $("#company_location").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_location', 'company location', 'company_location_err', closest_div, 'no', '', '','');
 });
  
 $("#company_description").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_description', 'about company', 'company_description_err', closest_div, 'no', '', '','');
 });
 
 $("#company_phone").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_phone', 'company phone', 'company_phone_err', closest_div, 'no', '', '','');
 });
 
 $('#company_phone').bind('keyup blur',function(){ 
    $(this).val( $(this).val().replace(/[^0-9\s]/g,'') ); }
);

 $("#company_website").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('company_website', 'company website', 'company_website_err', closest_div, 'no', '', '','');
 });
 
 //Logo Uploding validation
 $("#company_logo").bind('change blur',function(){
	closest_div = $( this ).closest('div');
	universal_validation('document', 'company logo', 'ccompany_logo_err', closest_div, 'no', '', '','company_logo');
 });
 
 //Captcha
 $("#captcha").blur(function(){
	 closest_div = $( this ).closest('div');
	 universal_validation('captcha', 'verification code', 'captcha_err', closest_div, 'no', '', '','');
 });
 
});

//=======================================================

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
	
	if(theForm.dob_day.value=='' || theForm.dob_month.value=='' || theForm.dob_year.value==''){
		closest_div = $( '#dob_day' ).closest('div');
		error_msg('dob_err',closest_div,'Please provide your date of birth.');
		theForm.dob_day.focus();
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
	
	if(theForm.company_ceo.value==''){
		closest_div = $( '#company_ceo' ).closest('div');
		error_msg('company_ceo_err',closest_div,'Please provide company CEO name.');
		theForm.company_ceo.focus();
		return_val = false;
	}
	
	if(theForm.industry_id.value==''){
		closest_div = $( '#industry_id' ).closest('div');
		error_msg('industry_id_err',closest_div,'Please provide industry.');
		theForm.industry_id.focus();
		return_val = false;
	}
	
	if(theForm.established_in.value==''){
		closest_div = $( '#established_in' ).closest('div');
		error_msg('established_in_err',closest_div,'Please provide established in year.');
		theForm.established_in.focus();
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
		error_msg('captcha_err',closest_div,'Please enter verification code provided above.');
		theForm.captcha.focus();
		return_val = false;
	}

	return return_val;
}
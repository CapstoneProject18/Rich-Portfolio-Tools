//For admin panel left bar (hiding/showing)
$(function() {
    "use strict";

    //Enable sidebar toggle
    $("[data-toggle='offcanvas']").click(function(e) {
        e.preventDefault();

        //If window is small enough, enable sidebar push menu
        if ($(window).width() <= 992) {
            $('.row-offcanvas').toggleClass('active');
            $('.left-side').removeClass("collapse-left");
            $(".right-side").removeClass("strech");
            $('.row-offcanvas').toggleClass("relative");
        } else {
            //Else, enable content streching
            $('.left-side').toggleClass("collapse-left");
            $(".right-side").toggleClass("strech");
        }
    });

    //Add hover support for touch devices
    $('.btn').bind('touchstart', function() {
        $(this).addClass('hover');
    }).bind('touchend', function() {
        $(this).removeClass('hover');
    });

    //Activate tooltips
    $("[data-toggle='tooltip']").tooltip();

    /*     
     * Add collapse and remove events to boxes
     */
    $("[data-widget='collapse']").click(function() {
        //Find the box parent        
        var box = $(this).parents(".box").first();
        //Find the body and the footer
        var bf = box.find(".box-body, .box-footer");
        if (!box.hasClass("collapsed-box")) {
            box.addClass("collapsed-box");
            bf.slideUp();
        } else {
            box.removeClass("collapsed-box");
            bf.slideDown();
        }
    });

    /*
     * ADD SLIMSCROLL TO THE TOP NAV DROPDOWNS
     * ---------------------------------------
     */
    /*$(".navbar .menu").slimscroll({
        height: "200px",
        alwaysVisible: false,
        size: "3px"
    }).css("width", "100%");*/

    /*
     * INITIALIZE BUTTON TOGGLE
     * ------------------------
     */
    $('.btn-group[data-toggle="btn-toggle"]').each(function() {
        var group = $(this);
        $(this).find(".btn").click(function(e) {
            group.find(".btn.active").removeClass("active");
            $(this).addClass("active");
            e.preventDefault();
        });

    });

    $("[data-widget='remove']").click(function() {
        //Find the box parent        
        var box = $(this).parents(".box").first();
        box.slideUp();
    });

    /* Sidebar tree view */
   /* $(".sidebar .treeview").tree();*/

    /* 
     * Make sure that the sidebar is streched full height
     * ---------------------------------------------
     * We are gonna assign a min-height value every time the
     * wrapper gets resized and upon page load. We will use
     * Ben Alman's method for detecting the resize event.
     * 
     **/
    function _fix() {
        //Get window height and the wrapper height
        var height = $(window).height() - $("body > .header").height();
        $(".wrapper").css("min-height", height + "px");
        var content = $(".wrapper").height();
        //If the wrapper height is greater than the window
        if (content > height)
            //then set sidebar height to the wrapper
            $(".left-side, html, body").css("min-height", content + "px");
        else {
            //Otherwise, set the sidebar to the height of the window
            $(".left-side, html, body").css("min-height", height + "px");
        }
    }
    //Fire upon load
    _fix();
    //Fire when wrapper is resized
    
    /*
     * We are gonna initialize all checkbox and radio inputs to 
     * iCheck plugin in.
     * You can find the documentation at http://fronteed.com/iCheck/
     */
    
    /* For demo purposes */
});


//=======Starts Employer Module=======
function update_status(id){
	var current_status = $("#sts_"+id+" span").html();
	var myurl = baseUrl+'admin/employers/status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='active')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}

function update_top_employer_status(id){
	var current_status = $("#te_"+id+" span").html();
	var myurl = baseUrl+'admin/employers/top_employer_status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='yes')
			var class_label = 'warning';
   $("#te_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}

function update_top_industry_status(id){
	var current_status = $("#ti_"+id+" span").html();
	var myurl = baseUrl+'admin/industries/top_industry_status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='yes')
			var class_label = 'warning';
   $("#ti_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}

function delete_employer(id){
	var myurl = baseUrl+'admin/employers/delete_employer/'+id;
	var is_confirm = confirm("Are you sure you want to delete this employer and associated company and jobs with it?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}
//=======Ends Employer Module=======


//=======Starts Jobseeker Module=======
function update_job_seeker_status(id){
	var current_status = $("#sts_"+id+" span").html();
	var myurl = baseUrl+'admin/job_seekers/status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='active')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}

function delete_job_seeker(id){
	var myurl = baseUrl+'admin/job_seekers/delete_job_seeker/'+id;
	var is_confirm = confirm("Are you sure you want to delete this jobseeker and associated jobs with him/her?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}
//=======Ends Jobseeker Module=======

//=======Starts Posted Jobs Module=======
function update_posted_job_status(id){
	var current_status = $("#sts_"+id+" span").html();
	var myurl = baseUrl+'admin/posted_jobs/status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='active')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}

function delete_posted_job(id){
	var myurl = baseUrl+'admin/posted_jobs/delete_posted_job/'+id;
	var is_confirm = confirm("Are you sure you want to delete this job and associated application(s) submitted against it?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

function update_featured_job(id){
	var current_status = $("#f_"+id+" span").html();
	var myurl = baseUrl+'admin/posted_jobs/featured_status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='yes')
			var class_label = 'warning';
   $("#f_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });	
}
//=======Ends Posted Jobs Module=======

//=======Starts CMS Module=======
function update_cms_status(id){
	var current_status = $("#sts_"+id+" span").html();
	var myurl = baseUrl+'admin/cms/status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='active')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}

function delete_cms(id){
	var myurl = baseUrl+'admin/cms/delete/'+id;
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

function validate_edit_cms_form(the_form){
	  if(the_form.edit_heading.value==''){
		alert("Please provide page heading.");  
		return false;
	  }
	  if(the_form.edit_page_slug.value==''){
		alert("Please provide page slug.");  
		return false;
	  }
	  
	  if(CKEDITOR.instances['edit_editor1'].getData()==''){
		alert("Please provide page content.");  
		return false;
	  }
  }
  
//=======Ends CMS Module=======

//=======Starts City Module=======
function grab_cities_by_country(country_name){

	if(country_name=='USA'){
		$("#city_dropdown").css('display','block');
		$("#city_text").css('display','none');
	}
	else{
		$("#city_dropdown").css('display','none');
		$("#city_text").css('display','block');
		$("#city_text").val('');
	}
}
//=======Ends City Module=======

$( document ).ready(function() {
	setTimeout(function() {
      $(".message-container").fadeOut();
}, 10000);
});

function load_cms_add_form (){
	$('#add_page_form').modal('show');
}

function load_cms_edit_form(id){
	$.getJSON(baseUrl+'admin/cms/get_cms_by_id/'+id, function(data) {
			$('#edit_heading').val(data.heading);
			$('#edit_page_slug').val(data.page_slug);
			CKEDITOR.instances['edit_editor1'].setData(data.content)
			$('#cms_id').val(data.ID);
			$('#edit_page_form').modal('show');
		});	
}

//=======Sallary Module=======
function validate_edit_salary_form(the_form){
	  if(the_form.edit_salary_value.value==''){
		alert("Please provide salary value.");  
		return false;
	  }
	  if(the_form.edit_sallary_text.value==''){
		alert("Please provide salary text.");  
		return false;
	  }
  }
  
function delete_salary(id){
	var myurl = baseUrl+'admin/salary/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this salary?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

$( document ).ready(function() {
	setTimeout(function() {
      $(".message-container").fadeOut();
}, 10000);
});

function load_salary_add_form (){
	$('#add_page_form').modal('show');
}

function load_salary_edit_form(id){
	$.getJSON(baseUrl+'admin/salary/get_salary_by_id/'+id, function(data) {
			$('#edit_salary_value').val(data.val);
			$('#edit_salary_text').val(data.text);
			$('#salary_id').val(data.ID);
			$('#edit_page_form').modal('show');
				
		});	

}
//=======End Sallary Module=======

//=======Qualification Module=======
function validate_edit_qualification_form(the_form){
	  if(the_form.edit_qualification_value.value==''){
		alert("Please provide qualification.");  
		return false;
	  }
	  if(the_form.edit_qualification_text.value==''){
		alert("Please provide salary text.");  
		return false;
	  }
  }
  
function delete_qualification(id){
	var myurl = baseUrl+'admin/qualification/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this qualification?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

$( document ).ready(function() {
	setTimeout(function() {
      $(".message-container").fadeOut();
}, 10000);
});

function load_qualification_add_form (){
	$('#add_page_form').modal('show');
}

function load_qualification_edit_form(id){
	$.getJSON(baseUrl+'admin/qualification/get_qualification_by_id/'+id, function(data) {
			$('#edit_qualification').val(data.val);
			$('#edit_text').val(data.text);
			$('#qualification_id').val(data.ID);
			$('#edit_page_form').modal('show');
				
		});	
		
}
//=======End CMS Module=======

//=======Starts Industries Module=======
function update_industries_status(id){
	var current_status = $("#sts_"+id+" span").html();
	var myurl = baseUrl+'admin/industries/status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='active')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}

function delete_industries(id){
	var myurl = baseUrl+'admin/industries/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this industry?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

function validate_edit_industries_form(the_form){
	  if(the_form.edit_industries.value==''){
		alert("Please provide industry name.");  
		return false;
	  }
  }
$( document ).ready(function() {
	setTimeout(function() {
      $(".message-container").fadeOut();
}, 10000);
});

function load_industries_add_form (){
	$('#add_page_form').modal('show');
}

function load_industries_edit_form(id){
	
	$.getJSON(baseUrl+'admin/industries/get_industries_by_id/'+id, function(data) {
			$('#edit_industries').val(data.industry_name);
			$('#industries_id').val(data.ID);
			$('#edit_page_form').modal('show');
		});	
		
}
  
//=======Ends Industries Module=======

//=======Starts Institute Module=======
function update_institute_status(id){
	var current_status = $("#sts_"+id+" span").html();
	var myurl = baseUrl+'admin/institute/status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='active')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}

function delete_institute(id){
	var myurl = baseUrl+'admin/institute/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this institute?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

function validate_edit_institute_form(the_form){
	  if(the_form.edit_institute.value==''){
		alert("Please provide institute name.");  
		return false;
	  }
  }
$( document ).ready(function() {
	setTimeout(function() {
      $(".message-container").fadeOut();
}, 10000);
});

function load_institute_add_form (){
	$('#add_page_form').modal('show');
}

function load_institute_edit_form(id){
	
	$.getJSON(baseUrl+'admin/institute/get_institute_by_id/'+id, function(data) {
			$('#edit_institute').val(data.name);
			$('#institute_id').val(data.ID);
			$('#edit_page_form').modal('show');
		});	
		
}
  
//=======Ends Institute Module=======

//=======Starts Stories Module=======
function update_stories_status(id){
	var current_status = $("#sts_"+id+" span").html();
	var myurl = baseUrl+'admin/stories/status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='active')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}

function delete_stories(id){
	var myurl = baseUrl+'admin/stories/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this institute?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

function validate_edit_stories_form(the_form){
	  if(the_form.edit_title.value==''){
		alert("Please provide story title.");  
		return false;
	  }
	  if(the_form.edit_storyg.value==''){
		alert("Please provide story.");  
		return false;
	  }
  }
$( document ).ready(function() {
	setTimeout(function() {
      $(".message-container").fadeOut();
}, 10000);
});

function load_stories_add_form (){
	$('#add_page_form').modal('show');
}

function load_stories_edit_form(id){
	
	$.getJSON(baseUrl+'admin/stories/get_stories_by_id/'+id, function(data) {
			$('#edit_title').val(data.title);
			$('#edit_story').val(data.story);
			$('#stories_id').val(data.ID);
			$('#edit_page_form').modal('show');
		});	
		
}
  
//=======Ends Stories Module=======

//=======Starts Cities Module=======
function update_cities_status(id){
	var current_status = $("#show_"+id+" span").html();
	var myurl = baseUrl+'admin/cities/status/'+id+'/'+current_status;
	$.get(myurl, function (show) {
		var class_label = 'success';
		if(show!='1')
			var class_label = 'danger';
   $("#show_"+id).html('<span class="label label-'+class_label+'">'+show+'</span>');
 });
}

function delete_cities(id){
	var myurl = baseUrl+'admin/cities/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this city?");
	if(is_confirm){
		  $.get(myurl, function (show) {
			  if(show=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

function validate_edit_cities_form(the_form){
	  if(the_form.edit_city_name.value==''){
		alert("Please provide city name.");  
		return false;
	  }
  }
$( document ).ready(function() {
	setTimeout(function() {
      $(".message-container").fadeOut();
}, 10000);
});

function load_cities_add_form (){
	$('#add_page_form').modal('show');
}

function load_cities_edit_form(id){
	
	$.getJSON(baseUrl+'admin/cities/get_city_by_id/'+id, function(data) {
			$('#edit_city_name').val(data.city_name);
			$('#cities_id').val(data.ID);
			$('#edit_page_form').modal('show');
		});	
		
}
  
 function update_cities_popular(id){
	var current_status = $("#show_pop_"+id+" span").html();
	var myurl = baseUrl+'admin/cities/status_popular/'+id+'/'+current_status;
	$.get(myurl, function (show) {
		var class_label = 'success';
		if(show!='yes')
			var class_label = 'warning';
   $("#show_pop_"+id).html('<span class="label label-'+class_label+'">'+show+'</span>');
 });
}

//=======Ends Cities Module=======

//=======Starts Countries Module=======
function delete_countries(id){
	var myurl = baseUrl+'admin/countries/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this country?");
	if(is_confirm){
		  $.get(myurl, function (show) {
			  if(show=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

function validate_edit_countries_form(the_form){
	  if(the_form.edit_country_name.value==''){
		alert("Please provide country name.");  
		return false;
	  }
  }
$( document ).ready(function() {
	setTimeout(function() {
      $(".message-container").fadeOut();
}, 10000);
});

function load_countries_add_form (){
	$('#add_page_form').modal('show');
}

function load_countries_edit_form(id){
	
	$.getJSON(baseUrl+'admin/countries/get_country_by_id/'+id, function(data) {
			$('#edit_country_name').val(data.country_name);
			$('#edit_country_citizen').val(data.country_citizen);
			$('#countries_id').val(data.ID);
			$('#edit_page_form').modal('show');
		});	
		
}
  
//=======Ends Countries Module=======

//====== Load Employer Quick Views
function load_quick_profile_view(arr, total_jobs){
	$('#quick_profile').modal('show');
	arr = arr.replace(/(\r\n|\n|\r)/gm," ");
	var json_encoded_double = arr.replace(/dquote/g, '"');
	var json_encoded = json_encoded_double.replace(/squote/g, "'");
	var obj = jQuery.parseJSON(json_encoded);
	$("#emailllll").html(obj.email);
	$("#comp_name").html(obj.company_name);
	$("#address").html(obj.company_location);
	$("#phone").html(obj.company_phone);
	$("#city_country").html(obj.city+' / '+obj.country);
	$("#no_of_jobs").html(total_jobs);
}

//====== Load Employer Quick Job Views
function load_quick_job_view(emp_id, comp_name){
	$('#quick_job').modal('show');
	$("#j_comp_name").html(comp_name);
	$.getJSON(baseUrl+'admin/posted_jobs/latest_job_by_company/'+emp_id, function(data) {

			if(data.err){
				$("#j_box").css('display','none');
				$("#errbox").css('display','block');
				$("#errbox").html(data.err);
			} else {
				$("#j_box").css('display','block');
				$("#errbox").css('display','none');
				$("#job_title").html(data.job_title);
				$("#job_cat").html(data.industry_name);
				$("#job_desc").html(data.job_description.substr(1, 150)+'...');
				
				$("#contact_name").html(data.contact_person);
				$("#contact_phone").html(data.contact_phone);
				$("#contact_email").html(data.contact_email);
			}
		});
}

//======== Edit employer
function validate_frm_employer(theForm){
	if(admin_is_empty($("#full_name"), 'full_name', 'full name')) return false;
	if(admin_is_empty($("#email"), 'email', 'email')) return false;
	if(admin_is_empty($("#password"), 'password', 'password')) return false;
	if(admin_is_empty($("#mobile_phone"), 'mobile_phone', 'mobile_phone')) return false;
	if(admin_is_empty($("#country"), 'country', 'country')) return false;
	if(admin_is_empty($("#city_text"), 'city_text', 'city')) return false;
	if($("#err_fld").val()=='1'){
	 	alert("This email address is already taken. Please try again.");
		$("#email").focus();
		return false;
	}
}
$(document).ready(function(){
 $("#frm_employer #email").blur(function(){
	 $.ajax({
				type: "POST",
				url: baseUrl+"admin/employers/check_email_address",
				data: { id: $("#eid").val(), email: $("#email").val()}
			  })
				.done(function( msg ) {
					if(msg=='0'){
						$("#err_fld").val('');
					}
					else{
						$("#err_fld").val('1');
						//alert("This email address is already taken. Please try again.");
					}
		});
 });
});

//======= Validate Company
function validate_frm_company(theForm){
	if(admin_is_empty($("#company_name"), 'company_name', 'company name')) return false;
	if(admin_is_empty($("#industry_ID"), 'industry_ID', 'industry')) return false;
	if(admin_is_empty($("#company_phone"), 'company_phone', 'phone')) return false;
	if(admin_is_empty($("#company_location"), 'company_location', 'company address')) return false;
	if(admin_is_empty($("#company_website"), 'company_website', 'company website')) return false;

	if($('#company_logo').val()!=''){
		ext_array = ['png','jpg','jpeg'];
		var ext = $('#company_logo').val().split('.').pop().toLowerCase();
		if($.inArray(ext, ext_array) == -1) {
			alert('Invalid file provided.');
			$('#err_cfld').val('1');
			return false;
		}
	}
	if($("#err_cfld").val()=='1'){
	 	alert("Invalid image file provided.");
		$("#company_logo").focus();
		return false;
	}
}


//=======Starts Prohibited Keywords Module=======

function load_prohibited_add_form (){
	$('#add_key_form').modal('show');
}

function load_prohibited_edit_form(id){
	$.getJSON(baseUrl+'admin/prohibited_keyword/get_prohibited_keyword_by_id/'+id, function(data) {
			$('#edit_keyword').val(data.keyword);
			$('#key_id').val(data.ID);
			$('#edit_key_form').modal('show');
		});	
		
}

function delete_prohibited(id){
	var myurl = baseUrl+'admin/prohibited_keyword/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this keyword?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

function validate_edit_prohibited_form(the_form){
	  if(the_form.edit_keyword.value==''){
		alert("Please provide keyword.");  
		return false;
	  }
	 
  }
  
//=======Ends Prohibited Keywords Module=======


//===== Email Template Section
function validate_edit_cms_form(the_form){
	  if(the_form.from_email.value==''){
		alert('Please provide "From Email" address.');  
		return false;
	  }
	  if(the_form.subject.value==''){
		alert("Please provide email subject.");  
		return false;
	  }
	  
	  if(CKEDITOR.instances['edit_editor1'].getData()==''){
		alert("Please provide email content.");  
		return false;
	  }
  }

function load_email_template_edit_form(id){
	$.getJSON(baseUrl+'admin/email_template/get_email_template_by_id/'+id, function(data) {
			$('#from_name').val(data.from_name);
			$('#from_email').val(data.from_email);
			$('#subject').val(data.subject);
			$('#eid').val(data.ID);
			$('#editor1').val(data.content);
			$('#edit_email_form').modal('show');
				
		});	
}
//Ends Email template section

//===== Skill Section
function validate_edit_skill_form(the_form){
	  if(the_form.skill_name.value==''){
		alert('Please provide skill name.');  
		return false;
	  }
	  
	  if($('#skill_name').val() == $('#blend_to').val()){
			alert('You have selected same skill to blend into. Please select different skill.');  
			return false;
		}
		
	  if(the_form.blend_to.value!=''){
			var cc = confirm('Are you sure you want to blend "'+$('#skill_name').val()+'" into "'+$('#blend_to').val()+'"?');
			if(!cc)
				return false;	
		}
  }

function load_skill_edit_form(id){
	
	$.getJSON(baseUrl+'admin/skills/get_skill_by_id/'+id, function(data) {
			$('#skill_name').val(data.skill_name);
			$('#sid').val(data.ID);
			//$("#blend_to option[value='"+data.skill_name+"']").remove();
			$('#edit_skill_form').modal('show');
		});	
	select_option_value('blend_to', '');
}

function load_skill_add_form(id){
	$('#add_skill_form').modal('show');
}

function update_skill_frequency(id, keyword){
 var new_skill = $("#main_skills_"+id).val();
 
 if(new_skill==''){
	alert('Please select new skill first.'); 
	return false;
 }
 
  if(new_skill==keyword){
	alert('Sorry, both skills are same.'); 
	return false;
 }
 
 $("#r_"+id).fadeOut();
 
 $.ajax({
		  type: "POST",
		  url: baseUrl+"admin/skills/update_skill_frequency",
		  data: { original_skill: keyword, new_skill: new_skill }
			  })
				.done(function( msg ) {
					
					/*if(msg=='0'){
						//$("#err_fld").val('');
					}
					else{
						//$("#err_fld").val('1');
						//alert("This email address is already taken. Please try again.");
					}*/
		});
}

function validate_add_skill_form(){
		if($('#add_skill_name').val()==''){
			alert('Please provide skill first.');
			return false;	
		}
		
}

function add_skill_frequency(id, keyword){

 $("#r_"+id).fadeOut();
 
 $.ajax({
		  type: "POST",
		  url: baseUrl+"admin/skills/add_skill_frequency",
		  data: { new_skill: keyword }
			  })
				.done(function( msg ) {
					
					/*if(msg=='0'){
						//$("#err_fld").val('');
					}
					else{
						//$("#err_fld").val('1');
						//alert("This email address is already taken. Please try again.");
					}*/
		});
}

function delete_skill(id){
	var myurl = baseUrl+'admin/skills/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this skill?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			   $("#row_"+id).fadeOut();
			 /* if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');*/
	   	  });
	}
}
//Ends Skill section

//====== Load Job Quick Previews
function load_quick_job_preview(job_id, comp_name){
	$('#quick_job').modal('show');
	$("#j_comp_name").html(comp_name);
	$.getJSON(baseUrl+'admin/posted_jobs/job_by_id/'+job_id, function(data) {

			if(data.err){
				$("#j_box").css('display','none');
				$("#errbox").css('display','block');
				$("#errbox").html(data.err);
			} else {
				$("#j_box").css('display','block');
				$("#errbox").css('display','none');
				$("#job_title").html(data.job_title);
				$("#job_cat").html(data.industry_name);
				$("#job_desc").html(data.job_description.substr(1, 150)+'...');
				
				$("#contact_name").html(data.contact_person);
				$("#contact_phone").html(data.contact_phone);
				$("#contact_email").html(data.contact_email);
			}
		});
}

function select_option_value(field_id, val){
	$("#"+field_id).val('');
}




//=======Starts Newsletter Module=======

function load_newsletter_add_form (){
	$('#add_newsletter_form').modal('show');
}

function load_newsletter_edit_form(id){
	$.getJSON(baseUrl+'admin/manage_newsletters/get_record_by_id/'+id, function(data) {
			$('#edit_from_name').val(data.from_name);
			$('#edit_from_email').val(data.from_email);
			$('#edit_email_subject').val(data.email_subject);
			$('#edit_email_interval').val(data.email_interval);
			CKEDITOR.instances['edit_editor1'].setData(data.email_body)
			$('#n_id').val(data.ID);
			$('#edit_newsletter_form').modal('show');
		});	
}

function update_newsletter_status(id){
	var current_status = $("#sts_"+id+" span").html();
	var myurl = baseUrl+'admin/manage_newsletters/status/'+id+'/'+current_status;
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='active')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}

function delete_newsletter(id){
	var myurl = baseUrl+'admin/manage_newsletters/delete/'+id;
	var is_confirm = confirm("Are you sure you want to delete this newsletter?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#row_"+id).fadeOut();
			  else
				  alert('OOps! Something went wrong.');
	   	  });
	}
}

function validate_edit_newsletter_form(the_form){
	  if(the_form.edit_heading.value==''){
		alert("Please provide page heading.");  
		return false;
	  }
	  if(the_form.edit_page_slug.value==''){
		alert("Please provide page slug.");  
		return false;
	  }
	  
	  if(CKEDITOR.instances['edit_editor1'].getData()==''){
		alert("Please provide page content.");  
		return false;
	  }
  }

function load_newsletter_force_form(id){
	$.getJSON(baseUrl+'admin/manage_newsletters/get_record_by_id/'+id, function(data) {
			$('#n_force_id').val(data.ID);
			$('#force_send_newsletter_form').modal('show');
		});	
}
//=======Ends Newsletter Module=======

//For CKEDITOR 
function CKupdate(){
    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
}

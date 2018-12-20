//JS
//=======Starts City Module=======
function grab_cities_by_country(country_name){

	if(country_name=='USA'){
		$(".ui-autocomplete-input.ui-widget.ui-widget-content.ui-corner-left").css('display','block');
		$("#city_text").css('display','none');
		$("#city_text").val('');
	}
	else{
		$(".ui-autocomplete-input.ui-widget.ui-widget-content.ui-corner-left").css('display','none');
		
		$("#city_text").css('display','block');
	}
}

function set_city_value(city_name){
	$("#city_text").val(city_name);
}

//=======Starts Employer section=========
$( document ).ready(function() {
	$("#edit_company_profile").click(function(){
		$('#edit_profile_modal').modal('show');
	});	
	
	$("#edit_company_desc").click(function(){
		$('#edit_profile_description_modal').modal('show');
	});	
});


function edit_posted_job(ID){
	$('#edit_posted_job').modal('show');
}

function delete_posted_job(ID){
	var myurl = baseUrl+'employer/edit_employer/delete_posted_job/'+ID;
	var is_confirm = confirm("Are you sure you want to delete this job?");
	if(is_confirm){
		  $.get(myurl, function (sts) {
			  if(sts=='done')
				  $("#pj_"+ID).fadeOut();
			  else
				  alert(sts);
	   	  });
		 // $("#pj_"+ID).fadeOut();
	}
}

function edit_company_summary(){
		
		$.ajax({
				type: "POST",
				url: baseUrl+"employer/edit_employer/summary",
				data: { cid: $("#cid").val(), content: $("#content").val()}
			  })
				.done(function( msg ) {
					if(msg=='done'){
						$('#edit_profile_description_modal').modal('toggle');
						location.reload();
					}
					else{
						alert(msg);
					}
		});

}

function del_logo(){
			$.ajax({
					type: "POST",
					url: baseUrl+"employer/edit_employer/delete_logo"
				  })
					.done(function( msg ) {
						if(msg=='done'){
							location.reload();
						} else{
							alert("Something went wrong!");	
							location.reload();
						}
			});

}

//=======Ends Employer section==========

//=======Starts Jobseeker section========
$( document ).ready(function() {
	$("#edit_jobseeker_profile").click(function(){
		$('#edit_profile_modal').modal('show');
	});	
	
	$("#edit_jobseeker_account").click(function(){
		$('#edit_profile_modal').modal('show');
	});
	
	$("#edit_desc").click(function(){
		$('#edit_profile_summary_modal').modal('show');
	});	
	
	$("#add_education").click(function(){
		$('#add_education_modal').modal('show');
	});	
	
	$("#add_exp").click(function(){
		$('#add_exp_modal').modal('show');
	});
	
	$("#cv").blur(function(){
	 var cv = $.trim($("#cv").val());
	
	 if(cv==''){
		$( this ).closest('div').addClass( "has-error" ); 
	 }
	 else{
		$( this ).closest('div').removeClass( "has-error" ); 
	 }
		
 });
 
 	$("#expected_salary").blur(function(){
	 var expected_salary = $.trim($("#expected_salary").val());
	
	 if(expected_salary==''){
		$( this ).closest('div').addClass( "has-error" ); 
	 }
	 else{
		$( this ).closest('div').removeClass( "has-error" ); 
	 }
		
 });
 
 	$("#cover_letter").blur(function(){
	 var cover_letter = $.trim($("#cover_letter").val());
	
	 if(cover_letter==''){
		$( this ).closest('div').addClass( "has-error" ); 
	 }
	 else{
		$( this ).closest('div').removeClass( "has-error" ); 
	 }
		
 });
 
	 $("#submitter").click(function(){
		apply_job();
	});
	
	$("#msg_submit").click(function(){
		send_message();
	});
	
	$("#scam_submit").click(function(){
		scam_report();
	});
	
});

function apply_job(){
	/*bootbox.alert("Hello world!");*/
	var returnval = true;
	/*if($("#cv").val()==''){
		$("#cv").closest('div').addClass( "has-error" ); 
		returnval = false;	
	}*/
	if($("#expected_salary").val()==''){
		$("#expected_salary").closest('div').addClass( "has-error" ); 
		returnval = false;	
	}
	if($("#cover_letter").val()==''){
		$("#cover_letter").closest('div').addClass( "has-error" ); 
		returnval = false;	
	}
	
	if($("#jid").val()==''){
		$("#jid").closest('div').addClass( "has-error" ); 
		returnval = false;	
	}
	//submitter
	
	if(returnval){
		
		$.ajax({
				type: "POST",
				url: baseUrl+"jobseeker/apply_job",
				data: { jid: $("#jid").val(), cv: $("#cv").val(), cover_letter: $("#cover_letter").val(), expected_salary: $("#expected_salary").val() }
			  })
				.done(function( msg ) {
					if(msg=='done'){
						$('#japply').modal('toggle');
						$('#emsg').html('');
						is_already_applied = 'yes';
						$('#msg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> You have successfully applied for this job. </div>');	
						$('.actionBox').html('<h4>You have already applied for this job</h4> <a href="javascript:;" class="applyjobgray"><span>Apply Now</span></a>');
					}
					else
					{
						$('#msg').html('');
						$('#emsg').html('<span class="label label-warning">'+msg+'</span>');
					}
		});
	}
	else{
		return false;
	}
}

function scam_report(){
	/*bootbox.alert("Hello world!");*/
	var returnval = true;

	if($("#reason").val()==''){
		$("#reason").closest('div').addClass( "has-error" ); 
		returnval = false;	
	}else{
		$("#reason").closest('div').removeClass( "has-error" ); 
	}
	if($("#captcha").val()==''){
		$("#captcha").closest('div').addClass( "has-error" ); 
		returnval = false;	
	}else{
		$("#captcha").closest('div').removeClass( "has-error" ); 
	}
	
	if($("#scjid").val()==''){
		bootbox.alert("Job information is missing, please retry after refreshing the web page.");
		returnval = false;	
	}

	if(returnval){
		$.ajax({
				type: "POST",
				url: baseUrl+"jobseeker/scam_report",
				data: { scjid: $("#scjid").val(), reason: $("#reason").val(), captcha: $("#captcha").val()}
			  })
				.done(function( res_json ) {
					var obj = jQuery.parseJSON(res_json);
					
					if(obj.msg=='done'){
						$('#scam').modal('toggle');
						$("#reason").val('');
						$("#ccode").html(obj.cap);
						$("#captcha").val('');
						$('#scam_emsg').html('');
						$('#msg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Your report has been submitted successfully. </div>');	
					}
					else
					{
						$('#msg').html('');
						$("#ccode").html(obj.cap);
						$('#scam_emsg').html('<span class="label label-danger">'+obj.msg+'</span>');
					}
		});
	}
	else{
		return false;
	}
}

function edit_jobseeker_profile(){
		
		$.ajax({
				type: "POST",
				url: baseUrl+"jobseeker/edit_jobseeker/profile",
				data: { full_name: $("#full_name").val(), mobile: $("#mobile").val(), country: $("#country").val(), city: $("#city").val() }
			  })
				.done(function( msg ) {
					if(msg=='done'){
						$('#edit_profile_modal').modal('toggle');
						$('#emsg_profle').html('');
						//$('#msg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Profile has been updated successfully. </div>');	
						location.reload();
					}
					else{
						$('#msg').html('');
						$('#emsg_profle').html('<span class="label label-warning">'+msg+'</span>');
					}
		});

}

function edit_jobseeker_summary(){
		
		$.ajax({
				type: "POST",
				url: baseUrl+"jobseeker/edit_jobseeker/summary",
				data: { content: $("#content").val()}
			  })
				.done(function( msg ) {
					if(msg=='done'){
						$('#edit_profile_summary_modal').modal('toggle');
						$('#emsg_summary').html('');
						location.reload();
					}
					else{
						$('#msg').html('');
						$('#emsg_summary').html('<span class="label label-warning">'+msg+'</span>');
					}
		});

}

function update_posted_job_status_employer(id){
	var myurl = baseUrl+'employer/edit_posted_job/status/'+id;
	//var is_confirm = confirm("Are you sure you want to deactivate this job?");
	$.get(myurl, function (sts) {
		var class_label = 'success';
		if(sts!='active')
			var class_label = 'danger';
   $("#sts_"+id).html('<span class="label label-'+class_label+'">'+sts+'</span>');
 });
}

function add_js_edu(){
		
		$.ajax({
				type: "POST",
				url: baseUrl+"jobseeker/education/add",
				data: { degree_title: $("#degree_title").val(), major_subject: $("#major_subject").val(), institute: $("#institute").val(), edu_country: $("#edu_country").val(), edu_city: $("#edu_city").val(), completion_year: $("#completion_year").val()}
			  })
				.done(function( msg ) {
					if(msg=='done'){
						$('#add_education_modal').modal('toggle');
						$('#emsg_add_edu').html('');
						location.reload();
					}
					else{
						$('#emsg_add_edu').html('<span class="label label-warning">'+msg+'</span>');
					}
		});

}

function del_edu(id){
		var ed_id = id;
		
		confirmed = confirm("Are you sure you want to delete your education?");
		if(confirmed){
			$('#edu_'+id).fadeOut();
			$.ajax({
					type: "POST",
					url: baseUrl+"jobseeker/education/delete",
					data: { id: id}
				  })
					.done(function( msg ) {
						if(msg=='done'){
							$('#edu_'+id).fadeOut();
						}
			});
		}

}

function del_photo(){
			$.ajax({
					type: "POST",
					url: baseUrl+"jobseeker/edit_jobseeker/delete_photo"
				  })
					.done(function( msg ) {
						if(msg=='done'){
							location.reload();
						} else{
							alert("Something went wrong!");	
							location.reload();
						}
			});

}

function edit_js_edu(id){
	
			$.ajax({
				type: "POST",
				url: baseUrl+"jobseeker/education/edit",
				data: { id: $("#ed_edu_id").val(), degree_title: $("#ed_degree_title").val(), major_subject: $("#ed_major_subject").val(), institute: $("#ed_institute").val(), edu_country: $("#ed_edu_country").val(), edu_city: $("#ed_edu_city").val(), completion_year: $("#ed_completion_year").val()}
			  })
				.done(function( msg ) {
					if(msg=='done'){
						$('#edit_education_modal').modal('toggle');
						$('#emsg_edit_edu').html('');
						location.reload();
					}
					else{
						$('#emsg_edit_edu').html('<span class="label label-warning">'+msg+'</span>');
					}
		});
}

function load_edit_js_edu(id){
			$('#edit_education_modal').modal('toggle');
			$.ajax({
					type: "POST",
					url: baseUrl+"jobseeker/education/education_by_id",
					data: { id: id}
				  })
					.done(function( data ) {
						obj = jQuery.parseJSON(data);
						select_value('ed_degree_title',obj.degree_title);
						$("#ed_major_subject").val(obj.major);
						$("#ed_institute").val(obj.institude);
						select_value('ed_edu_country',obj.country);
						$("#ed_edu_city").val(obj.city);
						$("#ed_edu_id").val(obj.ID);
						select_value('ed_completion_year',obj.completion_year);
						
			});
}

function del_applied_job(id){

		confirmed = confirm("Are you sure you want to delete this applied job?");
		if(confirmed){
			$('#aplied_'+id).fadeOut();
			$.ajax({
					type: "POST",
					url: baseUrl+"jobseeker/edit_jobseeker/delete_applied_job",
					data: { id: id}
				  })
					.done(function( msg ) {
						if(msg=='done'){
							
						}
			});
		}
}


function add_js_exp(){
		
		$.ajax({
				type: "POST",
				url: baseUrl+"jobseeker/experience/add",
				data: { job_title: $("#job_title").val(), company_name: $("#company_name").val(), exp_country: $("#exp_country").val(), exp_city: $("#exp_city").val(), start_date: $("#start_date").val(), end_date: $("#end_date").val()}
			  })
				.done(function( msg ) {
					if(msg=='done'){
						$('#add_exp_modal').modal('toggle');
						$('#emsg_add_exp').html('');
						location.reload();
					}
					else{
						$('#emsg_add_exp').html('<span class="label label-warning">'+msg+'</span>');
					}
		});

}

function load_edit_js_exp(id){
			$('#edit_exp_modal').modal('toggle');
			$.ajax({
					type: "POST",
					url: baseUrl+"jobseeker/experience/experience_by_id",
					data: { id: id}
				  })
					.done(function( data ) {
						obj = jQuery.parseJSON(data);
						$("#ed_job_title").val(obj.job_title);
						$("#ed_company_name").val(obj.company_name);
						$("#ed_exp_city").val(obj.city);
						select_value('ed_exp_country',obj.country);
						$("#ed_exp_id").val(obj.ID);
						$("#ed_start_date").val(obj.start_date);
						$("#ed_end_date").val(obj.end_date);
			});
}

function edit_js_exp(){
		
		$.ajax({
				type: "POST",
				url: baseUrl+"jobseeker/experience/edit",
				data: { id: $("#ed_exp_id").val(), job_title: $("#ed_job_title").val(), company_name: $("#ed_company_name").val(), exp_country: $("#ed_exp_country").val(), exp_city: $("#ed_exp_city").val(), start_date: $("#ed_start_date").val(), end_date: $("#ed_end_date").val()}
			  })
				.done(function( msg ) {
					if(msg=='done'){
						$('#edit_exp_modal').modal('toggle');
						$('#emsg_edit_exp').html('');
						location.reload();
					}
					else{
						$('#emsg_edit_exp').html('<span class="label label-warning">'+msg+'</span>');
					}
		});

}

function del_exp(id){
		var ed_id = id;
		
		confirmed = confirm("Are you sure you want to delete your experience?");
		if(confirmed){
			$('#edu_'+id).fadeOut();
			$.ajax({
					type: "POST",
					url: baseUrl+"jobseeker/experience/delete",
					data: { id: id}
				  })
					.done(function( msg ) {
						if(msg=='done'){
							$('#exp_'+id).fadeOut();
						}
			});
		}
}

function del_cv(id, fl){

		confirmed = confirm("Are you sure you want to delete your resume?");
		if(confirmed){
			$('#cv_'+id).fadeOut();
			$.ajax({
					type: "POST",
					url: baseUrl+"resume/delete",
					data: { id: id, fl: fl}
				  })
					.done(function( msg ) {
						if(msg=='done'){
							
						}
			});
		}
}

//=======Ends Jobseeker section=========

//Add Skill
function add_jobseeker_skill(){
	$('#js_skill_submit').attr("disabled", true);
	$('#js_skill_submit').val('adding...');
			$.ajax({
				type: "POST",
				url: baseUrl+"jobseeker/add_skills/add",
				data: { skill: $("#skill").val()}
			  })
				.done(function( msg ) {
					$('#js_skill_submit').attr("disabled", false);
					$('#js_skill_submit').val('Add');
					skill = "'"+$("#skill").val()+"'";
					if($.isNumeric(msg)){
						if(msg>2){
							$('.wrap_disable').css('display','block');
							$('.wrap_enable').css('display','block');
						}
						$('#emsg').html('<span class="label label-success">Great! Skill added successfully, please add more skills.</span>');
						$("#myskills").append('<li>'+$("#skill").val()+'<a href="javascript:remove_skill('+skill+');" class="delete"><i class="fa fa-times-circle"></i></a></li>');
						$("#skill").val('');
						$("#skill").focus();
					}
					else{
						if(msg<3){
							$('.wrap_disable').css('display','none');
							$('.wrap_enable').css('display','none');
						}
						$('#emsg').html('<span class="label label-danger">'+msg+'</span>');
					}
		});

}

//Remove Skill

function remove_skill(js_skill){
			$.ajax({
				type: "POST",
				url: baseUrl+"jobseeker/add_skills/remove",
				data: { skill: js_skill}
			  })
				.done(function( msg ) {
					if($.isNumeric(msg)){
					if(msg<3){
						$('.wrap_disable').css('display','none');
						$('.wrap_enable').css('display','none');
					}
						
						$('#emsg').html('');
						$( this ).closest('li').remove();
					}
					else{
						$('#emsg').html('<span class="label label-danger">'+msg+'</span>');
					}
		});

}

function select_value(field_id, val){
	/*$("#"+field_id+" option").each(function() {
		$(this).removeAttr('selected');
  		if($(this).val() == val) {
    		$(this).attr('selected', 'selected');     
  		}                        
	});	*/

	$("#"+field_id+" option[value='"+val+"']").attr('selected', 'selected');
}
$( document ).ready(function() {
	
	$("#reg_pop").click(function(){
		$('.registerPopup').slideToggle();
	});	

});

function check_bad_words(content, bad_words, field_id){
	var text = content.split(' ');
	for (var i=0; i < text.length; i++) {
			if($.inArray($.trim(text[i].toLowerCase()), bad_words) !==-1){
				$( '#'+field_id ).closest('div').append( error_wrapper(field_id+'_err', '"'+$.trim(text[i])+'" cannot be used.') );
				$( '#'+field_id ).focus();
				return false;
			}
		}
	//$( '#'+field_id+'_err' ).remove();
}

//Add Post Job Skill
function add_job_skill(){
	$('#js_skill_add').attr("disabled", true);
	$('#js_skill_add').val('adding...');
	var new_skill = "'"+$('#skill').val()+"'";
	var skill = $('#s_val').val();
	selected_skill_array = skill.split(", ");
	if (selected_skill_array.indexOf($('#skill').val()) >= 0){
		alert("You have already added that skill.");
		$("#skill").val('');
		$("#skill").focus();
		
		$('#js_skill_add').attr("disabled", false);
		$('#js_skill_add').val('Add');
		return false;
	}
	
	skill = skill+', '+$("#skill").val().toLowerCase();
	$('#s_val').val(skill);

	$("#myskills").append('<li>'+$("#skill").val()+'<a href="javascript:remove_job_skill('+new_skill+');" class="delete"><i class="fa fa-times-circle"></i></a></li>');
	$("#skill").val('');
	$("#skill").focus();
	
	$('#js_skill_add').attr("disabled", false);
	$('#js_skill_add').val('Add');

}

//Remove Post Job Skill
function remove_job_skill(js_skill){
	var skill = $('#s_val').val();
	js_skill = ', '+js_skill.toLowerCase();
	$('#s_val').val(skill.replace(js_skill, ''));
}

function send_message(){
	var returnval = true;

	/*if($("#message").val()==''){
		$("#message").closest('div').addClass( "has-error" ); 
		returnval = false;	
	}
	
	if($("#jid").val()==''){
		$("#jid").closest('div').addClass( "has-error" ); 
		returnval = false;	
	}*/

	if(returnval){
		$.ajax({
				type: "POST",
				url: baseUrl+"employer/job_applications/send_message_to_candidate",
				data: { jsid: $("#jsid").val(), message: $("#message").val() }
			  })
				.done(function( msg ) {
					if(msg=='done'){
						$('#send_msg').modal('toggle');
						$('#emsg').html('');
						$("#message").val('');
						$('#msg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Message has been sent. </div>');	
					}
					else
					{
						$('#msg').html('');
						$('#emsg').html('<span class="label label-warning">'+msg+'</span>');
					}
		});
	}
	else{
		return false;
	}
}

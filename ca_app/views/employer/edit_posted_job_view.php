<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<title><?php echo $title;?></title>
<link href="<?php echo base_url('public/css/jquery-ui.css');?>" rel="stylesheet" type="text/css" />
<?php $this->load->view('common/before_head_close'); ?>
<link rel="stylesheet" href="http://jquery-ui.googlecode.com/svn/tags/1.8.7/themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo base_url('public/autocomplete/demo.css'); ?>">
<style>
.ui-button {
	margin-left: -1px;
}
.ui-button-icon-only .ui-button-text {
	padding: 0.35em;
}
.ui-autocomplete-input {
	margin: 0;
	padding: 0.48em 0 0.47em 0.45em;
}
</style>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header-->
<div class="container detailinfo">
  <div class="row"> 
  <div class="col-md-3">
  <div class="dashiconwrp">
    <?php $this->load->view('employer/common/employer_menu');?>
  </div>
  </div>
  
  <?php echo form_open_multipart('employer/edit_posted_job/'.$id,array('name' => 'post_job_form', 'id' => 'post_job_form', 'onSubmit' => 'return validate_new_post_job_form(this);'));?>
    <div class="col-md-9">
    <?php echo $this->session->flashdata('msg');?>
      <div class="formwraper">
        <div class="titlehead">Edit Posted Job</div>
        <div class="formint">
          <div class="input-group <?php echo (form_error('industry_id'))?'has-error':'';?>">
            <label class="input-group-addon">Category <span>*</span></label>
            <select name="industry_id" id="industry_id" class="form-control">
              <option value="" selected>Select Industry</option>
              <?php foreach($result_industries as $row_industry):
				  			$selected = ($row->industry_ID==$row_industry->ID)?'selected="selected"':'';
				  ?>
              <option value="<?php echo $row_industry->ID;?>" <?php echo $selected;?>><?php echo $row_industry->industry_name;?></option>
              <?php endforeach;?>
            </select>
            <?php echo form_error('industry_id'); ?> </div>
          <div class="input-group <?php echo (form_error('job_title'))?'has-error':'';?>">
            <label class="input-group-addon">Job Title <span>*</span></label>
            <input name="job_title" type="text" class="form-control" id="job_title" placeholder="Job Title" value="<?php echo $row->job_title; ?>" maxlength="150">
            <?php echo form_error('job_title'); ?> </div>
          <div class="input-group <?php echo (form_error('vacancies'))?'has-error':'';?>">
            <label class="input-group-addon">No.of Vacancies <span>*</span></label>
            <select name="vacancies" id="vacancies" class="form-control">
              <?php for($i=1;$i<=50;$i++):
			  		$selected = ($row->vacancies==$i)?'selected="selected"':'';
			  ?>
              <option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
              <?php endfor;?>
            </select>
            <?php echo form_error('vacancies'); ?> </div>
          <div class="input-group <?php echo (form_error('experience'))?'has-error':'';?>">
            <label class="input-group-addon">Experience Required <span>*</span></label>
            <select name="experience" id="experience" class="form-control">
              <option value="Fresh" <?php echo ($row->experience=='Fresh')?'selected="selected"':'';?>>Fresh</option>
              <option value="Less than 1" <?php echo ($row->experience=='Less than 1 year')?'selected="selected"':'';?>>Less than 1 year</option>
              <?php for($i=1;$i<=10;$i++):
			  		$selected = ($row->experience==$i)?'selected="selected"':'';
					$year = ($i<2)?'year':'years';
			  ?>
              <option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i?></option>
              <?php endfor;?>
              <option value="10+" <?php echo ($row->experience=='10+')?'selected="selected"':'';?>>10+</option>
            </select>
            (<em>years</em>) <?php echo form_error('experience'); ?> </div>
          <div class="input-group <?php echo (form_error('job_mode'))?'has-error':'';?>">
            <label class="input-group-addon">Job Mode <span>*</span></label>
            <select name="job_mode" id="job_mode" class="form-control">
              <option value="Full Time" <?php echo ($row->job_mode=='Full Time')?'selected="selected"':'';?>>Full Time</option>
              <option value="Part Time" <?php echo ($row->job_mode=='Part Time')?'selected="selected"':'';?>>Part Time</option>
              <option value="Home Based" <?php echo ($row->job_mode=='Home Based')?'selected="selected"':'';?>>Home Based</option>
            </select>
            <?php echo form_error('job_mode'); ?> </div>
          <div class="input-group <?php echo (form_error('pay'))?'has-error':'';?>">
            <label class="input-group-addon">Salary Offer(Pk Rs.) <span>*</span></label>
            <select name="pay" id="pay" class="form-control">
              <?php
					foreach($result_salaries as $row_salaries):
						$selected = ($row->pay==$row_salaries->val)?'selected="selected"':'';
				?>
              <option value="<?php echo $row_salaries->val;?>" <?php echo $selected;?>><?php echo $row_salaries->text;?></option>
              <?php endforeach;?>
            </select>(<em>in thousands</em>)
            <?php echo form_error('pay'); ?> </div>
          <div class="input-group <?php echo (form_error('last_date'))?'has-error':'';?>">
            <label class="input-group-addon">Apply Before <span>*</span></label>
            <input name="last_date" type="text" readonly class="form-control" id="last_date" placeholder="Apply Before" value="<?php echo date_formats($row->last_date,'m/d/Y'); ?>" maxlength="40">
            <?php echo form_error('last_date'); ?> </div>
          
          
          <div class="input-group <?php echo (form_error('country'))?'has-error':'';?>">
            <label class="input-group-addon">Location <span>*</span></label>
            <select name="country" id="country" class="form-control" onChange="grab_cities_by_country(this.value);" style="width:50%">
              <?php 
					foreach($result_countries as $row_country):
						$selected = ($row->country==$row_country->country_name)?'selected="selected"':'';
						
						
				?>
              <option value="<?php echo $row_country->country_name;?>" <?php echo $selected;?>><?php echo $row_country->country_name;?></option>
              <?php endforeach;?>
            </select>
            <?php echo form_error('country'); ?>
            
       
            
            <input name="city" type="text" class="form-control" id="city_text" style="max-width:165px;" value="<?php echo $row->city; ?>" maxlength="50">
            <?php echo form_error('city'); ?>
</div>
          <div class="input-group <?php echo (form_error('qualification'))?'has-error':'';?>">
            <label class="input-group-addon">Qualification <span>*</span></label>
            <select name="qualification" id="qualification" class="form-control" style="width:50%">
              <option value="">Select Qualification</option>
              <?php 
					foreach($result_qualification as $row_qualification):
						$selected = ($row->qualification==$row_qualification->val)?'selected="selected"':'';
				?>
              <option value="<?php echo $row_qualification->val;?>" <?php echo $selected;?>><?php echo $row_qualification->text;?></option>
              <?php endforeach;?>
            </select>
            <?php echo form_error('qualification'); ?> </div>
          <div class="input-group <?php echo (form_error('job_description'))?'has-error':'';?>">
            <label class="input-group-addon">Job Description</label>
            <textarea name="editor1" id="editor1" cols="60" rows="10" ><?php echo $row->job_description; ?></textarea>
          </div>
        </div>
        
      </div>
      
      <!--Required Skills-->
      <div class="formwraper">
        <div class="titlehead">Required Skills</div>
        <div class="formint">
          <div class="jobdescription" style="border-top:0px;">
            <div class="row">
              <div class="col-md-12">
                <div class="skillBox">
                  <ul class="skillDetail" id="myskills">
                    <?php 
				  	if($row->required_skills):
						$selected_skills = explode(', ',$row->required_skills);
				  		foreach($selected_skills as $each_skill):
						if(trim($each_skill)!=''): ?>
                    <li><?php echo trim($each_skill);?> <a href="javascript:remove_job_skill('<?php echo trim($each_skill);?>');" class="delete"><i class="fa fa-times-circle"></i></a></li>
                   <?php 
				   		endif;
				   		endforeach;
				   	endif;
				   ?>
                  </ul>
                  <div class="clear"></div>
                </div>
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Add Skill<span>*</span></label>
            <div class="row">
              <div class="col-md-8">
              <div class="ui-widget">
                <input type="text" name="skill" id="skill" value="" autocomplete="off" class="form-control" />
                <input type="hidden" name="s_val" id="s_val" value="<?php echo (set_value('s_val'))?set_value('s_val'):$row->required_skills; ?>" class="form-control" />
              </div>
              </div>
              <div class="col-md-2">
                <input type="button" name="js_skill_add" id="js_skill_add" value="Add" class="btn btn-success" />
              </div>
            </div>
            
            <small>Single skill at a time.</small>
            
          </div>
        </div>
      </div>
      
      <!--Professional info-->
      <div class="formwraper">
        <div class="titlehead">Contact Information</div>
        <div class="formint">
          <div class="input-group <?php echo (form_error('contact_person'))?'has-error':'';?>">
            <label class="input-group-addon">Contact Person <span>*</span></label>
            <input name="contact_person" type="text" class="form-control" id="contact_person" value="<?php echo (set_value('contact_person'))?set_value('contact_person'):$row->contact_person; ?>" maxlength="50" />
            <?php echo form_error('contact_person'); ?> </div>
          <div class="input-group <?php echo (form_error('contact_email'))?'has-error':'';?>">
            <label class="input-group-addon">Email <span>*</span></label>
            <input name="contact_email" type="text" class="form-control" id="contact_email" value="<?php echo (set_value('contact_email'))?set_value('contact_email'):$row->contact_email; ?>" maxlength="50" />
            <?php echo form_error('contact_email'); ?> </div>
          <div class="input-group <?php echo (form_error('contact_phone'))?'has-error':'';?>">
            <label class="input-group-addon">Phone <span>*</span></label>
            <input type="phone" class="form-control" name="contact_phone" id="contact_phone" value="<?php echo (set_value('contact_phone'))?set_value('contact_phone'):$row->contact_phone; ?>" maxlength="20" />
            <?php echo form_error('contact_phone'); ?> </div>
          <div align="center">
            <input type="submit" name="submit_button" id="submit_button" value="Update" class="btn btn-success" />
          </div>
        </div>
      </div>
    </div>
    <!--/Job Detail--> 
    
    <?php echo form_close();?> </div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<script src="<?php echo base_url('public/js/bad_words.js'); ?>"></script>
<?php $this->load->view('common/before_body_close'); ?>
<script src="<?php echo base_url('public/js/jquery-ui.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('public/js/admin/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('public/js/validate_employer.js');?>" type="text/javascript"></script> 
<script type="text/javascript">
  $(function() {
   var editor = CKEDITOR.replace( 'editor1', {
    enterMode : CKEDITOR.ENTER_BR,    
    toolbar: [
     { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },
     [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
     '/',                   
     { name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
    ]
   });
    });
	//$.noConflict(); 
	$(document).ready(function($) {
    $( "#last_date" ).datepicker({ minDate: 0, maxDate: "+12M +10D" });
  });
   </script>
<script type="text/javascript"> var cy = '<?php echo set_value('country');?>'; </script>
<script type="text/javascript">
$(document).ready(function(){
	$('button').css('display','none');
	if(cy!='USA' && cy!='')
		$(".ui-autocomplete-input.ui-widget.ui-widget-content.ui-corner-left").css('display','none');
});
$(function() {
    var availableSkills = <?php echo $available_skills;?>;
    $( "#skill" ).autocomplete({source: availableSkills});
  });
</script>
<script>
  (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          /*.appendTo( this.wrapper )*/
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":hidden" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
 
  $(function() {
    $( "#city_dropdown" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#city_dropdown" ).toggle();
    });
  });
  </script>
</body>
</html>
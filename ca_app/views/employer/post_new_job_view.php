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
  <?php echo form_open_multipart('employer/post_new_job',array('name' => 'post_job_form', 'id' => 'post_job_form', 'onSubmit' => 'return validate_new_post_job_form(this);'));?>
    <div class="col-md-9">
      <div class="formwraper">
        <div class="titlehead">Post New Job</div>
        <div class="formint">
          <div class="input-group <?php echo (form_error('industry_id'))?'has-error':'';?>">
            <label class="input-group-addon">Category <span>*</span></label>
            <select name="industry_id" id="industry_id" class="form-control">
              <option value="" selected>Select Industry</option>
              <?php foreach($result_industries as $row_industry):
				  			$selected = (set_value('industry_id')==$row_industry->ID)?'selected="selected"':'';
				  ?>
              <option value="<?php echo $row_industry->ID;?>" <?php echo $selected;?>><?php echo $row_industry->industry_name;?></option>
              <?php endforeach;?>
            </select>
            <?php echo form_error('industry_id'); ?> </div>
          <div class="input-group <?php echo (form_error('job_title'))?'has-error':'';?>">
            <label class="input-group-addon">Job Title <span>*</span></label>
            <input name="job_title" type="text" class="form-control" id="job_title" placeholder="Job Title" value="<?php echo set_value('job_title'); ?>" maxlength="150">
            <?php echo form_error('job_title'); ?> </div>
          <div class="input-group <?php echo (form_error('vacancies'))?'has-error':'';?>">
            <label class="input-group-addon">No.of Vacancies <span>*</span></label>
            <input type="text" class="form-control" name="vacancies" id="vacancies" value="1" maxlength="3" />
            <?php echo form_error('vacancies'); ?> </div>
          <div class="input-group <?php echo (form_error('experience'))?'has-error':'';?>">
            <label class="input-group-addon">Experience Required <span>*</span></label>
            <select name="experience" id="experience" class="form-control">
              <option value="Fresh" <?php echo (set_value('experience')=='Fresh')?'selected="selected"':'';?>>Fresh</option>
              <option value="Less than 1" <?php echo (set_value('experience')=='Less than 1 year')?'selected="selected"':'';?>>Less than 1 year</option>
              <?php for($i=1;$i<=10;$i++):
			  		$selected = (set_value('experience')==$i)?'selected="selected"':'';
					$year = ($i<2)?'year':'years';
			  ?>
              <option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i?></option>
              <?php endfor;?>
              <option value="10+" <?php echo (set_value('experience')=='10+')?'selected="selected"':'';?>>10+</option>
            </select>
            (<em>years</em>) <?php echo form_error('job_mode'); ?> </div>
          <div class="input-group <?php echo (form_error('job_mode'))?'has-error':'';?>">
            <label class="input-group-addon">Job Mode <span>*</span></label>
            <select name="job_mode" id="job_mode" class="form-control">
              <option value="Full Time" <?php echo (set_value('job_mode')=='Full Time')?'selected="selected"':'';?>>Full Time</option>
              <option value="Part Time" <?php echo (set_value('job_mode')=='Part Time')?'selected="selected"':'';?>>Part Time</option>
              <option value="Home Based" <?php echo (set_value('job_mode')=='Home Based')?'selected="selected"':'';?>>Home Based</option>
            </select>
            <?php echo form_error('job_mode'); ?> </div>
          <div class="input-group <?php echo (form_error('pay'))?'has-error':'';?>">
            <label class="input-group-addon">Salary Offer(Pk Rs.) <span>*</span></label>
            <select name="pay" id="pay" class="form-control">
              <?php
					foreach($result_salaries as $row_salaries):
						$selected = (set_value('pay')==$row_salaries->val)?'selected="selected"':'';
				?>
              <option value="<?php echo $row_salaries->val;?>" <?php echo $selected;?>><?php echo $row_salaries->text;?></option>
              <?php endforeach;?>
            </select>(<em>in thousands</em>)
            <?php echo form_error('pay'); ?> </div>
          <div class="input-group <?php echo (form_error('last_date'))?'has-error':'';?>">
            <label class="input-group-addon">Apply Before <span>*</span></label>
            <input name="last_date" type="text" readonly class="form-control" id="last_date" placeholder="Apply Before" value="<?php echo (set_value('last_date'))?set_value('last_date'):$last_date_dummy; ?>" maxlength="40">
            <?php echo form_error('last_date'); ?> </div>
          
          <div class="input-group <?php echo (form_error('country'))?'has-error':'';?>">
            <label class="input-group-addon">Location <span>*</span></label>
            <select name="country" id="country" class="form-control" style="width:50%">
              <?php 
					foreach($result_countries as $row_country):
						$selected = (set_value('country')==$row_country->country_name)?'selected="selected"':'';
						
						if(set_value('country')=='' && $row->country==$row_country->country_name){
							$selected = 'selected="selected"';
						}
				?>
              <option value="<?php echo $row_country->country_name;?>" <?php echo $selected;?>><?php echo $row_country->country_name;?></option>
              <?php endforeach;?>
            </select>
            <?php echo form_error('country'); ?>
            
           
            <div class="demo">
              
            
            <input name="city" type="text" class="form-control" id="city_text" style="max-width:165px;" value="<?php echo (set_value("city")!='')?set_value("city"):$row->city; ?>" maxlength="50">
            <?php echo form_error('city'); ?>
            </div>
</div>
          <div class="input-group <?php echo (form_error('qualification'))?'has-error':'';?>">
            <label class="input-group-addon">Qualification <span>*</span></label>
            <select name="qualification" id="qualification" class="form-control" style="width:50%">
              <option value="">Select Qualification</option>
              <?php 
					foreach($result_qualification as $row_qualification):
						$selected = (set_value('qualification')==$row_qualification->val)?'selected="selected"':'';
				?>
              <option value="<?php echo $row_qualification->val;?>" <?php echo $selected;?>><?php echo $row_qualification->text;?></option>
              <?php endforeach;?>
            </select>
            <?php echo form_error('qualification'); ?> </div>
          <div class="input-group <?php echo (form_error('job_description'))?'has-error':'';?>">
            <label class="input-group-addon">Job Description</label>
            <textarea name="editor1" id="editor1" cols="60" rows="10" ><?php echo set_value('editor1'); ?></textarea>
          </div>
        </div>
        
      </div>
      
      <!--Required Skills-->
      <div class="formwraper">
        <div class="titlehead">Please choose the set of skills (Individually) you are looking to hire.</div>
        <div class="formint">
          <div class="jobdescription" style="border-top:0px;">
            <div class="row">
              <div class="col-md-12">
                <div class="skillBox">
                  <ul class="skillDetail" id="myskills">
                    <?php 
				  	if(set_value('s_val')):
						$selected_skills = explode(', ',set_value('s_val'));
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
                <input type="hidden" name="s_val" id="s_val" value="<?php echo (set_value('s_val'))?set_value('s_val'):''; ?>" class="form-control" />
              </div>
              </div>
              <div class="col-md-2">
                <input type="button" name="js_skill_add" id="js_skill_add" value="Add" class="btn btn-success" />
              </div>
            </div>
            
            <small>Single skill at a time.</small>
            <div class="clear">&nbsp;</div>
          </div>
          <div align="center" class="footeraction">
          	
            <input type="submit" name="submit_button" id="submit_button" value="Post Job" class="btn btn-success" />
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
    $( "#last_date" ).datepicker({ setDate:<?php echo $last_date_dummy;?>, minDate: 0 });
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
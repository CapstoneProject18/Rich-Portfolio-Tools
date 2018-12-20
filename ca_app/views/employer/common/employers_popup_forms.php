<!-- Starts Edit Company Profile -->
<div class="modal fade" id="edit_profile_modal">
  <div class="modal-dialog">
    <form name="frm_cms" id="frm_cms" role="form" method="post" action="<?php echo base_url('');?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Update Company Profile</h4>
        </div>
        <div class="modal-body"> 
          <div class="box-body">
          
            <div class="form-group">
              <label>Company Name</label>
              <input type="text" class="form-control"  id="company_name" name="company_name" value="<?php echo set_value('company_name');?>" placeholder="Company Name">
              <?php echo form_error('company_name'); ?> 
           	</div>
            
            <div class="form-group">
              <label>Company Email</label>
              <input type="text" class="form-control" name="company_email" id="company_email" value="<?php echo set_value('company_email');?>" placeholder="Company Email">
              <?php echo form_error('company_email'); ?>
            </div>
            
            <div class="form-group">
              <label>CEO Name</label>
              <input type="text" class="form-control"  id="company_ceo" name="company_ceo" value="<?php echo set_value('company_ceo');?>" placeholder="CEO Name">
              <?php echo form_error('company_ceo'); ?> 
           	</div>
            
            <div class="form-group">
              <label>Company Website</label>
              <input type="text" class="form-control"  id="company_website" name="company_website" value="<?php echo set_value('company_website');?>" placeholder="Company Website">
              <?php echo form_error('company_website'); ?> 
           	</div>
            
            <div class="form-group">
              <label>Industry</label>
              <input type="text" class="form-control"  id="industry_id" name="industry_id" value="<?php echo set_value('industry_id');?>" placeholder="Industry">
              <?php echo form_error('industry_id'); ?> 
           	</div>
            
            <div class="form-group">
              <label>Established In</label>
              <input type="text" class="form-control"  id="established_in" name="established_in" value="<?php echo set_value('established_in');?>" placeholder="Established In">
              <?php echo form_error('established_in'); ?> 
           	</div>
  
            <div class="form-group">
              <label>Mobile Number</label>
              <input type="text" class="form-control"  id="company_phone" name="company_phone" value="<?php echo set_value('company_phone');?>" placeholder="Company Name">
              <?php echo form_error('company_phone'); ?> 
           	</div>
            
            <div class="form-group">
              <label>No. Of Offices</label>
              <input type="text" class="form-control"  id="no_of_offices" name="no_of_offices" value="<?php echo set_value('no_of_offices');?>" placeholder="No. Of Offices">
              <?php echo form_error('no_of_offices'); ?> 
           	</div>
  
            <div class="form-group">
              <label>No. Of Employees</label>
              <input type="text" class="form-control"  id="no_of_employees" name="no_of_employees" value="<?php echo set_value('no_of_employees');?>" placeholder="No. Of Employees">
              <?php echo form_error('no_of_employees'); ?> 
           	</div>
            
            <div class="form-group">
              <label>Company Address</label>
              <input type="text" class="form-control"  id="company_location" name="company_location" value="<?php echo set_value('company_location');?>" placeholder="Company Address">
              <?php echo form_error('company_location'); ?> 
           	</div>
              
            <div class="form-group">
              <label>Company Logo</label>
              <input type="file" id="company_logo" name="company_logo" class="form-control">
              <?php echo form_error('company_logo'); ?> 
           	</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="submitter" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Ends Edit Company Profile -->
<!-- Starts Edit Company Profile Description-->
<div class="modal fade" id="edit_profile_description_modal">
  <div class="modal-dialog">
    <form name="frm_employer_desc" id="frm_employer_desc" role="form" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Update Company Info</h4>
        </div>
        <div class="modal-body"> 
          <div class="box-body">
              
            <div class="form-group">
              <label>About Company</label>
              <textarea id="content" name="content"  class="form-control" rows="10" placeholder=""><?php echo $row->company_description;?></textarea>
              <?php echo form_error('editor1'); ?> </div>
          </div>     
        </div>
        <div class="modal-footer">
          <input type="hidden" name="cid" id="cid" value="<?php echo $row->company_ID;?>" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" name="summary_submit" id="summary_submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Ends Edit Company Profile Description-->
<!-- Starts Edit Posted Job-->
<div class="modal fade" id="edit_posted_job">
  <div class="modal-dialog">
    <form name="frm_cms" id="frm_cms" role="form" method="post" action="<?php echo base_url('');?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Posted Job</h4>
        </div>
        <div class="modal-body"> 
          <div class="box-body">
          
            <div class="form-group">
              <label>Company Name</label>
              <input type="text" class="form-control"  id="company_name" name="company_name" value="<?php echo set_value('company_name');?>" placeholder="Company Name">
              <?php echo form_error('company_name'); ?> 
           	</div>
            
            <div class="form-group">
              <label>Company Email</label>
              <input type="text" class="form-control" name="company_email" id="company_email" value="<?php echo set_value('company_email');?>" placeholder="Company Email">
              <?php echo form_error('company_email'); ?>
            </div>
            
            <div class="form-group">
              <label>CEO Name</label>
              <input type="text" class="form-control"  id="company_ceo" name="company_ceo" value="<?php echo set_value('company_ceo');?>" placeholder="CEO Name">
              <?php echo form_error('company_ceo'); ?> 
           	</div>
            
            <div class="form-group">
              <label>Company Website</label>
              <input type="text" class="form-control"  id="company_website" name="company_website" value="<?php echo set_value('company_website');?>" placeholder="Company Website">
              <?php echo form_error('company_website'); ?> 
           	</div>
            
            <div class="form-group">
              <label>Industry</label>
              <input type="text" class="form-control"  id="industry_id" name="industry_id" value="<?php echo set_value('industry_id');?>" placeholder="Industry">
              <?php echo form_error('industry_id'); ?> 
           	</div>
            
            <div class="form-group">
              <label>Established In</label>
              <input type="text" class="form-control"  id="established_in" name="established_in" value="<?php echo set_value('established_in');?>" placeholder="Established In">
              <?php echo form_error('established_in'); ?> 
           	</div>
  
            <div class="form-group">
              <label>Mobile Number</label>
              <input type="text" class="form-control"  id="company_phone" name="company_phone" value="<?php echo set_value('company_phone');?>" placeholder="Company Name">
              <?php echo form_error('company_phone'); ?> 
           	</div>
            
            <div class="form-group">
              <label>No. Of Offices</label>
              <input type="text" class="form-control"  id="no_of_offices" name="no_of_offices" value="<?php echo set_value('no_of_offices');?>" placeholder="No. Of Offices">
              <?php echo form_error('no_of_offices'); ?> 
           	</div>
  
            <div class="form-group">
              <label>No. Of Employees</label>
              <input type="text" class="form-control"  id="no_of_employees" name="no_of_employees" value="<?php echo set_value('no_of_employees');?>" placeholder="No. Of Employees">
              <?php echo form_error('no_of_employees'); ?> 
           	</div>
            
            <div class="form-group">
              <label>Company Address</label>
              <input type="text" class="form-control"  id="company_location" name="company_location" value="<?php echo set_value('company_location');?>" placeholder="Company Address">
              <?php echo form_error('company_location'); ?> 
           	</div>
              
            <div class="form-group">
              <label>Company Logo</label>
              <input type="file" id="company_logo" name="company_logo" class="form-control">
              <?php echo form_error('company_logo'); ?> 
           	</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="submitter" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Ends Edit Posted Job -->
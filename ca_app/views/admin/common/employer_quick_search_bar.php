<style type="text/css">
.col-md-2{
	padding-left:8px !important;	
}
</style>
<form name="search_form" id="search_form" method="get" action="<?php echo base_url('admin/employers/search');?>">
  <div class="row" style="background-color:#3C8DBC; padding:10px; margin:0;">
    <div class="col-md-2 margin-bottom-special">
      <input class="form-control" name="first_name" id="first_name" type="text" placeholder="Search By Name" value="<?php echo (isset($search_data["first_name"]))?$search_data["first_name"]:'';?>">
    </div>
    <div class="col-md-2 margin-bottom-special">
      <input class="form-control" name="email" id="email" type="text" placeholder="Search By Email" value="<?php echo (isset($search_data["email"]))?$search_data["email"]:'';?>">
    </div>
    <div class="col-md-2 margin-bottom-special">
      <input class="form-control" name="company_name" id="company_name" type="text" placeholder="Search By Company" value="<?php echo (isset($search_data["company_name"]))?$search_data["company_name"]:'';?>">
    </div>
    <div class="col-md-2 margin-bottom-special">
      <input class="form-control" name="city" id="city" type="text" placeholder="Search By City" value="<?php echo (isset($search_data["city"]))?$search_data["city"]:'';?>">
    </div>
    
    <div class="col-md-2 margin-bottom-special">
    <select class="form-control" name="top_employer" id="top_employer">
    	<option value="">Select Top Employer</option>
        <option value="yes" <?php echo ($search_data["top_employer"]=='yes')?'selected="selected"':'';?>>Yes</option>
        <option value="no" <?php echo ($search_data["top_employer"]=='no')?'selected="selected"':'';?>>No</option>
    </select>
      
    </div>
    
    <div class="col-md-2 margin-bottom-special">
      <input class="btn" name="submit" value="Search" type="submit">
      &nbsp;&nbsp;
      <input class="btn" name="button" value="View All" type="button" onClick="document.location='<?php echo base_url('admin/employers');?>';">
    </div>
  </div>
</form>

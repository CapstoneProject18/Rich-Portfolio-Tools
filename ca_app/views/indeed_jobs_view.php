<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<meta name="keywords" content="<?php echo $param;?> Jobs" />
<meta name="description" content="<?php echo $param;?> Jobs ,Find best Jobs. Jobs at <?php echo SITE_NAME;?>." />
<title><?php echo $title;?></title>
<?php $this->load->view('common/before_head_close'); ?>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header--> 
<!--Search Block-->
<div class="top-colSection">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form name="iform" id="iform" method="get" accept-charset="utf-8">
          <div class="candidatesection">
            
              <div class="row">
                <div class="col-md-4">
                  <input type="text" name="q" id="q" class="form-control" required placeholder="Job title or Skill" value="<?php echo $this->input->get('q');?>" />
                </div>
                <div class="col-md-4">
                  <input type="text" name="l" id="l" class="form-control" required placeholder="city or location" value="<?php echo $this->input->get('l');?>" />
                </div>
                <div class="col-md-3">
                  <select id="co" name="co" required class="form-control">
                    <option value="AQ">Antarctica</option>
                    <option value="AR">Argentina</option>
                    <option value="AU">Australia</option>
                    <option value="AT">Austria</option>
                    <option value="BH">Bahrain</option>
                    <option value="BE">Belgium</option>
                    <option value="BR">Brazil</option>
                    <option value="CA">Canada</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CO">Colombia</option>
                    <option value="CR">Costa Rica</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="DK">Denmark</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Egypt</option>
                    <option value="FI">Finland</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                    <option value="GR">Greece</option>
                    <option value="HK">Hong Kong</option>
                    <option value="HU">Hungary</option>
                    <option value="IN">India</option>
                    <option value="ID">Indonesia</option>
                    <option value="IE">Ireland</option>
                    <option value="IL">Israel</option>
                    <option value="IT">Italy</option>
                    <option value="JP">Japan</option>
                    <option value="KW">Kuwait</option>
                    <option value="LU">Luxembourg</option>
                    <option value="MY">Malaysia</option>
                    <option value="MX">Mexico</option>
                    <option value="MA">Morocco</option>
                    <option value="NL">Netherlands</option>
                    <option value="NZ">New Zealand</option>
                    <option value="NG">Nigeria</option>
                    <option value="NO">Norway</option>
                    <option value="OM">Oman</option>
                    <option value="PK">Pakistan</option>
                    <option value="PA">Panama</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Philippines</option>
                    <option value="PL">Poland</option>
                    <option value="PT">Portugal</option>
                    <option value="QA">Qatar</option>
                    <option value="RO">Romania</option>
                    <option value="RU">Russia</option>
                    <option value="SA">Saudi Arabia</option>
                    <option value="SG">Singapore</option>
                    <option value="ZA">South Africa</option>
                    <option value="KR">South Korea</option>
                    <option value="ES">Spain</option>
                    <option value="SE">Sweden</option>
                    <option value="CH">Switzerland</option>
                    <option value="TW">Taiwan</option>
                    <option value="TH">Thailand</option>
                    <option value="TR">Turkey</option>
                    <option value="UA">Ukraine</option>
                    <option value="AE">United Arab Emirates</option>
                    <option value="GB">United Kingdom</option>
                    <option selected="" value="US">United States</option>
                    <option value="UY">Uruguay</option>
                    <option value="VE">Venezuela</option>
                    <option value="VN">Vietnam</option>
                  </select>
                </div>
                
                <div class="col-md-1">
              <input type="submit" value="Search" class="btn" title="job search engine" alt="job search engine" />
              <div class="clear"></div>
            </div>
              </div>
            
            
            <div class="clear"></div>
          </div>
        </form>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!--/Search Block--> 
<!--Latest Jobs Block-->
<div class="innerpageWrap">
<div class="container">
  <div class="row"> 
    
    <!--Left Col--> 
    
    <!--Mid Col-->
    
    <div class="searchjoblist col-md-10"> 
      
      <!--Jobs List-->
      
      <div class="boxwraper">
        <div class="titlebar">
          <div class="row">
            <div class="col-md-6"><b><?php echo $param;?> Jobs</b></div>
            <div class="col-md-6 text-right"> </div>
          </div>
        </div>
        <div class="row searchlist"> 
          
          <!--Job Row-->
          
          <?php if($result):
				  			foreach($result as $row):
							
				  ?>
          <div class="col-md-12">
            <div class="intlist">
              <div class="col-md-2"><a href="<?php echo $row['url'];?>" target="_blank"><img src="<?php echo base_url('public/images/indeed.png');?>" /></a></div>
              <div class="col-md-10">
                <div class="col-md-7"> <a href="<?php echo $row['url'];?>" target="_blank" class="jobtitle" title="<?php echo $row['jobtitle'];?>"><?php echo $row['jobtitle'];?></a>
                  <div class="location"><a href="<?php //echo base_url('company/'.$row->company_slug);?>#" title="Jobs in <?php echo $row['company'];?>"><?php echo $row['company'];?></a> &nbsp;-&nbsp; <?php echo $row['formattedLocationFull'];?></div>
                </div>
                <div class="col-md-5"> <a href="<?php echo $row['url'];?>" target="_blank" class="applybtn">Apply Now</a>
                  <div class="date"><?php echo date_formats($row['date'], 'M d, Y');?></div>
                </div>
                <div class="clear"> </div>
                <p><?php echo word_limiter(strip_tags(str_replace('-',' ',$row['snippet'])),100);?></p>
              </div>
              <div class="clear"></div>
            </div>
          </div>
          <?php 
				  			endforeach;
							else: ?>
          <div class="err" align="center">
            <p><strong> <?php echo ($param=='')?'Please enter keywords above to display the relevant opened jobs.':'Sorry, no record found';?> </strong></p>
          </div>
          <?php endif;?>
        </div>
      </div>
      
      <!--Pagination--> 
      
    </div>
    <?php $this->load->view('common/right_ads');?>
  </div>
</div>
</div>
<!--/Latest Jobs Block-->
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
<script type="text/javascript">
select_value('co','<?php echo $this->input->get('co');?>');
</script>
</body>
</html>
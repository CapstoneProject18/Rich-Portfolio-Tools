<div class="box-body">
  <ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#pdetails">Page Details</a></li>
    <li><a href="#pcontent">Page Content</a></li>
    <li><a href="#seo">Page SEO</a></li>
  </ul>
  <div class="clearfix">&nbsp;</div>
  <div class="tab-content">
    <div id="pdetails" class="tab-pane fade in active">
      <div class="form-group">
        <label  for="exampleInputPassword1">Page Heading</label>
        <input type="text" class="form-control"  id="pageTitle" name="pageTitle" value="<?php echo set_value('pageTitle');?>" placeholder="Heading">
        <?php echo form_error('pageTitle'); ?> </div>
      <div class="form-group">
        <label  for="exampleInputPassword1">Page Slug</label>
        <input type="text" class="form-control" name="pageSlug" id="pageSlug" value="<?php echo set_value('pageSlug');?>" placeholder="Page Slug">
        <?php echo form_error('pageSlug'); ?> </div>
      
      
    </div>
    <div id="pcontent" class="tab-pane fade">
      <div class="form-group">
        <label  for="exampleInputPassword1">Page Content</label>
        <div style="width:99%;">
          <textarea class="form-control" id="editor1" name="editor1" rows="4" cols="80"></textarea>
        </div>
      </div>
      <input type="hidden" name="method" id="method" value="add" />
      <input type="hidden" name="pid" id="pid" value="" />
    </div>
    <div id="seo" class="tab-pane fade">
      <div class="form-group">
        <label>Page Title</label>
        <input type="text" class="form-control"  id="seoMetaTitle" name="seoMetaTitle" value="<?php echo set_value('seoMetaTitle');?>" placeholder="Meta Title">
        <?php echo form_error('seoMetaTitle'); ?> </div>
      <div class="form-group">
        <label>Meta Keywords</label>
        <input type="text" class="form-control"  id="seoMetaKeyword" name="seoMetaKeyword" value="<?php echo set_value('seoMetaKeyword');?>" placeholder="Meta Keywords">
        <?php echo form_error('seoMetaKeyword'); ?> </div>
      <div class="form-group">
        <label>Meta Description</label>
        <textarea type="text" class="form-control"  id="seoMetaDescription" name="seoMetaDescription" rows="2" placeholder="Meta Description"><?php echo set_value('seoMetaDescription');?></textarea>
        <?php echo form_error('seoMetaDescription'); ?> </div>
      <div class="form-group">
        <label  for="exampleInputPassword1">Robots: Don't index this page: </label>
        <input type="checkbox" name="seoAllowCrawler" id="seoAllowCrawler" value="0" />
        <?php echo form_error('seoAllowCrawler'); ?> </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url('public/js/admin/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script> 
<script type="text/javascript">
  $(function() {
   var editor = CKEDITOR.replace( 'editor1', {
    enterMode : CKEDITOR.ENTER_BR,    
    toolbar: [
     { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },
     [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
     '/',                   
     { name: 'basicstyles', items: [ 'Bold', 'Italic' ] },
	 { name: 'insert', items: [ 'Image', 'Table' ] }
    ]
   });
  });
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
			$('#img_preview').css('display','block');
            $('#img_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#pageImage").change(function(){
    readURL(this);
});
$(document).ready(function(){ 
    $("#myTab a").click(function(e){
    	e.preventDefault();
    	$(this).tab('show');
    });
});
</script> 

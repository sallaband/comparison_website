<?php $this->load->view('admin/head'); ?>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

     <?php $this->load->view('admin/header'); ?>

      <!-- page content -->
      <div class="right_col" role="main">

        <!-- top tiles -->
        <div class="">
          

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Add Category</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <form class="form-horizontal form-label-left" novalidate action="<?php echo base_url();?>admin/savecategory" method="post">

                    <span class="section">Category Info</span>
					<?php

                    if(isset($error_msg) && !empty($error_msg)) {

                        echo '<div class="alert alert-danger">'.$error_msg.'</div>';

                    }

                ?>
                    <div class="item form-group">
					
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="cat_name" class="form-control col-md-7 col-xs-12" name="cat_name" placeholder="Enter Category" required type="text" value="<?php echo (!empty($catdata->cat_name))?$catdata->cat_name:'';?>" >
                      </div>
                    </div>
					<div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Slug <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="cat_slug" class="form-control col-md-7 col-xs-12" name="cat_slug" placeholder="Enter Slug " required type="text" value="<?php echo (!empty($catdata->cat_slug))?$catdata->cat_slug:'';?>">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Parent Category 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="select2_single form-control" tabindex="-1" name="cat_parent">
                          <option value=""> Choose Parent Category</option>
                          <?php
						  foreach($category as $category){
							  ?>
							  <option value="<?php echo $category->cat_id;?>" <?php if(isset($catdata->cat_parent)){if($catdata->cat_parent==$category->cat_id){ echo 'selected="selected"';}}?>><?php echo $category->cat_name;?></option>
							  <?php
						  }?>
                        
                        </select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Show on Home Page</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="cat_home" class="" name="cat_home" type="checkbox" value="1" <?php echo ($catdata->cat_home>0)?'checked="checked"':'';?>>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                        <input type="hidden" name="cat_id" value="<?php echo (!empty($catdata->cat_id))?$catdata->cat_id:'';?>"/>
						<button type="button" class="btn btn-primary" onClick="location.href='<?php echo base_url();?>admin/category'">Cancel</button>
                        <button id="send" type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /top tiles -->

        
        <br />

        


        

        <!-- footer content -->

       <?php $this->load->view('admin/footer');?>
        <!-- /footer content -->
      </div>
      <!-- /page content -->

    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  
  <!-- pace -->
  <script src="<?php echo base_url();?>assets/admin/js/pace/pace.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/js/custom.js"></script>
  <!-- form validation -->
  <script src="<?php echo base_url();?>assets/admin/js/validator/validator.js"></script>

  
  <script>
  function convertToSlug(Text)
	{
		return Text
			.toLowerCase()
			.replace(/[^\w ]+/g,'')
			.replace(/ +/g,'-')
			;
	}
	$(document).ready(function(){ 
		$('#cat_name').blur(function(){
			var retval;
			retval = convertToSlug($('#cat_name').val());
			$('#cat_slug').val(retval);
		});
		
	});
  
    // initialize the validator function
    validator.message['date'] = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
      .on('blur', 'input[required], input.optional, select.required', validator.checkField)
      .on('change', 'select.required', validator.checkField)
      .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required')
      .on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

    // bind the validation to the form submit event
    //$('#send').click('submit');//.prop('disabled', true);

    $('form').submit(function(e) {
      e.preventDefault();
      var submit = true;
      // evaluate the form using generic validaing
      if (!validator.checkAll($(this))) {
        submit = false;
      }

      if (submit)
        this.submit();
      return false;
    });

    /* FOR DEMO ONLY */
    $('#vfields').change(function() {
      $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function() {
      validator.defaults.alerts = (this.checked) ? false : true;
      if (this.checked)
        $('form .alert').remove();
    }).prop('checked', false);
  </script>
  
  <?php $this->load->view('admin/bottom');?>
</body>

</html>

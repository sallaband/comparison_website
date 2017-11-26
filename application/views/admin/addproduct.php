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
                  <h2>Add Product</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <form class="form-horizontal form-label-left" novalidate action="<?php echo base_url();?>admin/saveproduct" method="post" enctype="multipart/form-data">

                    <span class="section">Product Info</span>
					<?php

                    if(isset($error_msg) && !empty($error_msg)) {

                        echo '<div class="alert alert-danger">'.$error_msg.'</div>';

                    }

                ?>
                    <div class="item form-group">
					
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="p_title">Product Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="p_title" class="form-control col-md-7 col-xs-12" name="p_title" placeholder="Enter Product" required type="text" value="<?php echo (!empty($pdata->p_title))?$pdata->p_title:'';?>" >
                      </div>
                    </div>
					<div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="p_slug">Slug <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="p_slug" class="form-control col-md-7 col-xs-12" name="p_slug" placeholder="Enter Slug " required type="text" value="<?php echo (!empty($pdata->p_slug))?$pdata->p_slug:'';?>">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_id">Choose Category 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="select2_single form-control" tabindex="-1" name="cat_id" required="required">
                          <option value=""> Choose Category</option>
                          <?php
						  foreach($category as $category){
							  ?>
							  <option value="<?php echo $category->cat_id;?>" <?php if(isset($pdata->cat_id)){if($pdata->cat_id==$category->cat_id){ echo 'selected="selected"';}}?>><?php echo $category->cat_name;?></option>
							  <?php
						  }?>
                        
                        </select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="p_size">Size 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="p_size" class="form-control col-md-7 col-xs-12" name="p_size" placeholder="Enter Size "  type="text" value="<?php echo (!empty($pdata->p_size))?$pdata->p_size:'';?>">
                      </div>
                    </div>
					<div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="p_weight">Weight 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="p_weight" class="form-control col-md-7 col-xs-12" name="p_weight" placeholder="Enter Weight "  type="text" value="<?php echo (!empty($pdata->p_weight))?$pdata->p_weight:'';?>">
                      </div>
                    </div>
					<div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="p_processor">Processor 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="p_processor" class="form-control col-md-7 col-xs-12" name="p_processor" placeholder="Enter Processor " type="text" value="<?php echo (!empty($pdata->p_processor))?$pdata->p_processor:'';?>">
                      </div>
                    </div>
					<div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="p_battery">Battery 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="p_battery" class="form-control col-md-7 col-xs-12" name="p_battery" placeholder="Enter Battery "  type="text" value="<?php echo (!empty($pdata->p_battery))?$pdata->p_battery:'';?>">
                      </div>
                    </div>
					<div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="p_price">Price 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="p_price" class="form-control col-md-7 col-xs-12" name="p_price" placeholder="Enter Price " required  type="text" value="<?php echo (!empty($pdata->p_price))?$pdata->p_price:'';?>">
                      </div>
                    </div>
					
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="p_image">Image 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="p_image" class="form-control col-md-7 col-xs-12" name="p_image" placeholder="Enter Image "  type="file" value="<?php echo (!empty($pdata->p_image))?$pdata->p_image:'';?>">
                      </div>
                    </div>
                    <?php
                    if(!empty($customdata)){
						foreach($customdata as $custfields)
						{
						?>
						<div class="item form-group"> 
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="p_customlabel[]"><input id="p_customlabel[]" class="form-control col-md-7 col-xs-12" name="p_customlabel[]" placeholder="Enter Custom Label " type="text"  value="<?php if(!empty($custfields->c_label)){ echo $custfields->c_label;}?>" ></label> 
                      <div class="col-md-6 col-sm-6 col-xs-12"> 
                        <input id="p_customvalue[]" class="form-control col-md-7 col-xs-12" name="p_customvalue[]" placeholder="Enter Custom Value " type="text" value="<?php if(!empty($custfields->c_value)){ echo $custfields->c_value;}?>"> 
                      </div> 
					  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="p_remove[]"><button id="p_remove[]" class="btn btn-danger closediv" name="p_remove[]"  type="button" >Remove</button></label> 
                    </div>
						<?php
						}
					}
					?>
                    <div id="customfields"></div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="btncustom">Add Custom Field 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="btncustom" class="btn btn-primary" name="btncustom"  type="button" value="Add Custom Field">
                      </div>
                    </div>
					
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                        <input type="hidden" name="p_id" value="<?php echo (!empty($pdata->p_id))?$pdata->p_id:'';?>"/>
						<button type="button" class="btn btn-primary" onClick="location.href='<?php echo base_url();?>admin/products'">Cancel</button>
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
  
	$(document).ready(function(){
		$("#btncustom").click(function(){
			$("#customfields").append('<div class="item form-group"> \
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="p_customlabel[]"><input id="p_customlabel[]" class="form-control col-md-7 col-xs-12" name="p_customlabel[]" placeholder="Enter Custom Label " type="text" ></label> \
                      <div class="col-md-6 col-sm-6 col-xs-12"> \
                        <input id="p_customvalue[]" class="form-control col-md-7 col-xs-12" name="p_customvalue[]" placeholder="Enter Custom Value " type="text" > \
                      </div> \
					  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="p_remove[]"><button id="p_remove[]" class="btn btn-danger closediv" name="p_remove[]"  type="button" >Remove</button></label> \
                    </div>');
					$('.closediv').on("click", function () {
						$(this).parent('label').parent('div').fadeOut();
					});
		});  
		
		
		
		
	});
  
  function convertToSlug(Text)
	{
		return Text
			.toLowerCase()
			.replace(/[^\w ]+/g,'')
			.replace(/ +/g,'-')
			;
	}
	$(document).ready(function(){ 
		$('#p_title').blur(function(){
			var retval;
			retval = convertToSlug($('#p_title').val());
			$('#p_slug').val(retval);
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

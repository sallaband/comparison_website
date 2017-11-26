<?php $this->load->view('admin/head'); ?>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

     <?php $this->load->view('admin/header'); ?>

      <!-- page content -->
      <div class="right_col" role="main">

        <!-- top tiles -->
        <div class="row">
          
          
          
       <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Category List</h2>
                  
                  <div class="clearfix"></div>
                </div>
				<?php

                    if(isset($error_msg) && !empty($error_msg)) {

                        echo '<div class="alert alert-danger">'.$error_msg.'</div>';

                    }

                ?>
                <div class="x_content">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Slug</th>
                        <th>Home Page</th>
                        <th>Status</th>
                        <th>Action</th>

                      </tr>
                    </thead>


                    <tbody>
					<?php
					foreach($categories as $category)
					{
						if($category->cat_status==1){
							$status = 'Active';
							$chgstatus = 'Deactivate';
						}else{
							$status = 'Deactive';
							$chgstatus = 'Activate';
						}
						
					?>
                      <tr>
                        <td><?php echo $category->cat_name;?></td>
                        <td><?php 
						if(!empty($category->cat_parent)){
							echo $this->admin_modal->getCategory($category->cat_parent)->cat_name;
						}else{ echo 'Parent';}?></td>
                        <td><?php echo $category->cat_slug;?></td>
                        <td><?php echo ($category->cat_home==1)?"Active":"";?></td>
                        <td><?php echo $status;?></td>
                        <td><a href="<?php echo base_url();?>admin/editcategory/<?php echo $category->cat_id;?>">Edit</a> | <a href="<?php echo base_url();?>admin/statuscategory/<?php echo strtolower($chgstatus);?>/<?php echo $category->cat_id;?>"><?php echo $chgstatus;?></a> | <a href="<?php echo base_url();?>admin/deletecategory/<?php echo $category->cat_id;?>">Delete</a></td>

                      </tr>
					<?php
					}?>
					 
                    </tbody>
                  </table>
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

  <?php $this->load->view('admin/bottom');?>
</body>

</html>

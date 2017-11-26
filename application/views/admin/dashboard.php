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
                  <h2>Products </h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <p><h2>Welcome to Dashboard</h2></p>
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

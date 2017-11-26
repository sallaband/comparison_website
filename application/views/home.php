<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<title>Home</title>

<!-- Bootstrap -->

<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

<link href="<?php echo base_url();?>assets/css/w3.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/Compare.js"></script>
</head>

<body>
<style>

	

	.dropdown-submenu {

    position: relative;

}



.dropdown-submenu>.dropdown-menu {

    top: 0;

    left: 100%;

    margin-top: -6px;

    margin-left: -1px;

    -webkit-border-radius: 0 6px 6px 6px;

    -moz-border-radius: 0 6px 6px;

    

}



.dropdown-submenu:hover>.dropdown-menu {

    display: block;

}



.dropdown-submenu>a:after {

    display: block;

    content: " ";

    float: right;

    width: 0;

    height: 0;

    border-color: transparent;

    border-style: solid;

    border-width: 5px 0 5px 5px;

    border-left-color: #ccc;

    margin-top: 5px;

    margin-right: -10px;

}



.dropdown-submenu:hover>a:after {

    border-left-color: #fff;

}



.dropdown-submenu.pull-left {

    float: none;

}



.dropdown-submenu.pull-left>.dropdown-menu {

    left: -100%;

    margin-left: 10px;

    -webkit-border-radius: 6px 0 6px 6px;

    -moz-border-radius: 6px 0 6px 6px;

    border-radius: 6px 0 6px 6px;

}

	</style>
<header>
  <div class="top-header">
    <div class="container">
      <div class="logo">
        <h2>Product Compare Website</h2>
      </div>
    </div>
  </div>
  <div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <?php
          foreach($category as $catdata){
		  	if($catdata->cat_parent==0){
		  ?>
          <li> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $catdata->cat_name?><b class="caret"></b></a>
            <ul class="dropdown-menu multi-level">
              <?php
              foreach($category as $subcatdata){
		  		if($subcatdata->cat_parent==$catdata->cat_id){
				  ?>
              <li><a href="<?php echo base_url();?>home/products/<?php echo $subcatdata->cat_id?>"><?php echo $subcatdata->cat_name?> </a></li>
              <?php
				}
			  }?>
            </ul>
          </li>
          <?php
			}
		  }
		  ?>
        </ul>
      </div>
      <!--/.nav-collapse --> 
      
    </div>
  </div>
</header>
<div class="container">
  <div class="">
    <?php 
    if(!empty($products)){
		foreach($products as $product){ 
		$customdata = $this->home_modal->getCustomFields($product->p_id);
		
		?>
    <div class="col-md-3 text-center">
      <div class="selectProduct thumbnail" data-title="<?php echo str_replace(' ','',$product->p_title);?>" data-id="<?php echo $product->p_title;?>" data-size="<?php echo $product->p_size;?>&quot;" data-weight="<?php echo $product->p_weight;?>" data-processor="<?php echo $product->p_processor;?>" data-battery="<?php echo $product->p_battery;?>" data-price="<?php echo $product->p_price;?>" <?php
     if(!empty($alllabels)){ 
	 $i=0;
	  foreach($alllabels as $label){
		  	echo 'data-'.str_replace(' ','-',strtolower($label->c_label)).'="';
			if(!empty($customdata)){
				if($label->c_label==$customdata[$i]->c_label){
					echo $customdata[$i]->c_value;
				}
			}
			 echo '" ';
		  }
		  $i++;
	 }
	  ?>> <img src="<?php echo base_url();?>assets/uploads/products/<?php echo $product->p_image;?>" class="imgFill productImg">
        <h4><?php echo $product->p_title;?></h4>
        <button class="btn btn-success addToCompare">Add To Compare</button>
      </div>
    </div>
    <?php
		}
	}?>
  </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="container">
  <ul class="pagination col-md-offset-5">
    <li class="disabled"><a href="#">«</a></li>
    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">»</a></li>
  </ul>
</div>
<footer>
  <div class="container">
    <p class="text-center">All Rights Are Reserved. 2017</p>
  </div>
</footer>
<div class="comparePanle">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="col-md-6">
        <h4>Added For Comparision</h4>
      </div>
      <div class="text-right">
        <button class="btn btn-warning notActive cmprBtn" disabled>Compare</button>
      </div>
    </div>
    <div class="panel-body">
      <div class="comparePan"> </div>
    </div>
  </div>
</div>

<!-- comparision popup-->

<div id="id01" class="w3-animate-zoom w3-white w3-modal modPos">
  <div class="w3-container"> <a onclick="document.getElementById('id01').style.display='none'" class="whiteFont w3-padding w3-closebtn closeBtn">&times;</a> </div>
  <div class="w3-row contentPop w3-margin-top"> </div>
</div>

<!--end of comparision popup--> 

<!--  warning model  -->

<div id="WarningModal" class="w3-modal">
  <div class="w3-modal-content warningModal">
    <header class="w3-container w3-teal">
      <h3><span>&#x26a0;</span>Error</h3>
    </header>
    <div class="w3-container">
      <h4>Maximum of Three products are allowed for comparision</h4>
    </div>
    <footer class="w3-container w3-right-align">
      <button id="warningModalClose" onclick="document.getElementById('id01').style.display='none'" class="w3-btn w3-hexagonBlue w3-margin-bottom  ">Ok</button>
    </footer>
  </div>
</div>

<!--  end of warning model  --> 

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 

<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
<script>

	$('ul.nav li.dropdown').hover(function() {

    $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);

    }, function() {

    $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);

    });

	</script>
</body>
</html>
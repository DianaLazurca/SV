<?php header("Access-Control-Allow-Origin: http://localhost:9999");?>
<!DOCTYPE html>
<html >
<head>
	<title>School Violence</title>
	<script type="text/javascript" src="<?php echo base_url("assets/js");?>/jquery-2.0.1.min.js"></script>
  <script src="<?php echo base_url("assets/js");?>/bootstrap.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css");?>/bootstrap.min.css">  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css");?>/menu.css">
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/angular");?>/app.js"></script>  
  <script type="text/javascript" src="<?php echo base_url("assets/js/angular");?>/controller.js"></script>  

</head>
<body ng-app="schoolViolence" style="background-color: whitesmoke;">
<?php $user = $this->session->userdata('user');?>

<div class="container" ng-controller="header">
  <nav class="navbar navbar-default" >
    <div class="container-fluid" style="">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button ng-click="collapse()"  type="button" class="navbar-toggle" data-toggle="collapse" data-target="navbar"  area-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url('home')?>">School Violence</a>
      </div>
      <div class="navbar-collapse collapse" id="navbar">
        <ul class="nav navbar-nav navbar-right">
        <?php if (!$user) {?>
        		<li><a class="active" href="<?php echo base_url('login')?>">Login</a></li>
  	        <li><a href="<?php echo base_url('register')?>">Register</a></li>
  	        <li><a href="#">About</a></li>
  	        <li><a href="#">Contact</a></li>
        <?php } else {?>
          	<li><a href="<?php echo base_url('logout')?>">Logout</a></li>
          <?php }?>
        </ul>
      </div>
      </div><!-- /.navbar-collapse -->
  </nav>
</div>





		


<?php require_once('header.php'); 
$user = $this->session->userdata('user');
print_r($user);?>


<div class="container" >
 	<div class="panel panel-default" style = "margin:0 auto;">
      <!--<div class="panel-heading">Login</div>-->      
      <div class="panel-body">

      	<fieldset>
			<div style="margin-top: 20px;">
				<div>
					<legend style="text-align : center"><h2 > Login </h2></legend>
				</div>			
			</div>
		</fieldset>
       	<form class="form-horizontal" role="form" style = "margin-top:30px" method = "POST" action="<?php echo base_url('login') ?>" >
		    <div class="form-group">
		      <label class="control-label col-md-3" for="username">Username:</label>
		      <div class="col-md-7">
		        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-md-3" for="password">Password:</label>
		      <div class="col-md-7">          
		        <input type="password" class="form-control" name="password"id="password" placeholder="Enter password">
		      </div>
		    </div>
		    <div class="form-group">        
		      <div class="col-md-offset-3 col-md-10">
		        <button type="submit" class="btn btn-primary">Login</button>
		      </div>
    		</div>
		</form>
      		
		<fieldset>
		<legend></legend>
		<p>Go to <a href="<?php echo base_url('forum') ?>">forum</a> </p>	
		<p>Don't have an account? Click <a href="<?php echo base_url('register') ?>">here </a> to register </p>
		</fieldset>
      </div>
    </div>



<!--<div  style="border: 1px solid #efefef;  box-shadow: 0px 1px 6px rgba(86,78,40,0.75)" class="">
			<fieldset></fieldset>
			<div class="row col-md-offset-1" style="margin-top: 20px;">
				<div class="row">
					<legend style="text-align : center" class="col-md-11"><h2 > Login </h2></legend>
				</div>
			
			</div>
			<div id="content" class="row">
				<form class="form-horizontal" role="form" style = "margin-top:30px" method = "POST" action="<?php echo base_url('login') ?>" >
				    <div class="form-group">
				      <label class="control-label col-md-3" for="username">Username:</label>
				      <div class="col-md-7 ">
				        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3" for="password">Password:</label>
				      <div class="col-sm-7">          
				        <input type="password" class="form-control" name="password"id="password" placeholder="Enter password">
				      </div>
				    </div>
				    <div class="form-group">        
				      <div class="col-md-offset-5">
				        <button type="submit" class="btn btn-primary">Login</button>
				      </div>
		    		</div>
				</form>
      		
				<fieldset>
					<div class="row"><legend class="col-md-offset-1 col-md-10"></legend></div>
					
					<div style="margin-bottom:20px;" class="row col-md-offset-1">
						<p>Go to <a href=<?php echo base_url('forum') ?>>forum</a> </p>	
						<p>Don't have an account? Click <a href=<?php echo base_url('register') ?>>here </a> to register </p>
					</div>
				</fieldset>
			</div>
	</div>  -->

	</div>



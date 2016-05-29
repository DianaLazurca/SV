
<?php require_once('header.php'); ?>

<div id="demo" class="container">

 <div class="panel panel-default" style = "margin:0 auto;">
      <div class="panel-body">
        <fieldset>
			<div style="margin-top: 20px;">
				<div>
					<legend style="text-align : center"><h2 > Register </h2></legend>
				</div>			
			</div>
		</fieldset>
       	<form class="form-horizontal" role="form" style = "margin-top:30px" method = "POST" action="<?php echo base_url('register') ?>" >
		    <div class="form-group">
		      <label class="control-label col-md-3" for="email">Email:</label>
		      <div class="col-md-7">
		        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
		      </div>
		    </div>
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
		      <label class="control-label col-md-3" for="repeatpassword">Password:</label>
		      <div class="col-md-7">          
		        <input type="password" class="form-control" name="repeatpassword" id="repeatpassword" placeholder="Repeat password">
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-md-3" for="repeatpassword">Motivation:</label>
		      <div class="col-md-7">          
		        <textarea name = "motivation" class="form-control"rows="3" cols="30"></textarea>
		      </div>
		    </div>
		    <div class="form-group">        
		      <div class="col-md-offset-3 col-md-10">
		        <button type="submit" class="btn btn-primary">Register</button>
		      </div>
    		</div>
		</form>
      	
      </div>
    </div>

</div>
</div>

<!--<div  style="border: 1px solid #efefef; margin-top:6%; box-shadow: 0px 1px 6px rgba(86,78,40,0.75)" class="container col-md-6 col-md-offset-3">
			<fieldset>
			<div class="row col-md-offset-1" style="margin-top: 20px;">
				<div class="row">
					<legend style="text-align : center" class="col-md-11"><h2 > Register </h2></legend>
				</div>
			
			</div>
			</fieldset>
			<div id="content" class="row">
				<form class="form-horizontal" role="form" style = "margin-top:30px" method = "POST" action="<?php echo base_url('register') ?>" >
		    <div class="form-group">
		      <label class="control-label col-md-3" for="email">Email:</label>
		      <div class="col-md-7">
		        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-md-3" for="username">Username:</label>
		      <div class="col-md-7">
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
		      <label class="control-label col-md-3" for="repeatpassword">Password:</label>
		      <div class="col-sm-7">          
		        <input type="password" class="form-control" name="repeatpassword"id="repeatpassword" placeholder="Repeat password">
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-md-3" for="repeatpassword">Motivation:</label>
		      <div class="col-sm-7">          
		        <textarea name = "motivation" class="form-control"rows="3" cols="30"></textarea>
		      </div>
		    </div>
		    <div class="form-group">        
		      <div class="col-md-offset-5" style="margin-bottom: 20px;">
		        <button type="submit" class="btn btn-primary" >Register</button>
		      </div>
    		</div>
		</form>
			</div>
	</div> <!--CONTENT -->


	
<?php require_once('footer.php'); ?>

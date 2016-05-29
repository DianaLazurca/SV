	
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css");?>/bootstrap.min.css">
<?php require_once('header.php'); ?>
<?php $user = $this->session->userdata('user'); 
?>

<div class="container">
	<div class="panel panel-default" style = "margin:0 auto;">
	<div style="margin-top: 20px;">
		<img src="<?php echo base_url() ?>assets/images/questionnaire_icon.gif" alt="No image found">
	</div>
	<div class="panel-body">
		<ul>
			<li><h4>In the next minutes you will read some questions about violence in school.</h4></li>
			<li><h4>Choose the answer that fits you best.</h4></li>
			<li><h4>The questionnaire is anonymous and there are not good or bad answers.</h4></li>
			<li><span><h4>Press <span><input type="submit" class="btn btn-primary btn-sm disabled" value=" Start Test " /> to start the test</h4></span></span></li>
			<li><span><h4>Press <span><input type="submit" class="btn btn-success btn-sm disabled" value=" Next Question " /> to answer the next question</h4></span></span></li>
			<li><span><h4>Press <span><input type="submit" class="btn btn-success btn-sm disabled" value=" Previous Question " /> to change the answer of a previous question</h4></span></span></li>
		</ul>
	</div>
	</div>
	<div  style="border: 1px solid #efefef; margin-top:6%; box-shadow: 0px 1px 6px rgba(86,78,40,0.75);">
		<?php if($user) { ?>
			<fieldset></fieldset>
			<div class="row" style="margin-top: 20px;">
				<div class="col-md-2">
					<img src="<?php echo base_url() ?>assets/images/questionnaire_icon.gif" alt="No image found">
				</div>
				<div class="col-md-offset-2">
					<legend style="text-align : center" class="col-md-10"><h2 > Questionnaire about school violence </h2></legend>
				</div>
			
			</div>
			<div id="content" class="row">
				<div  class="row col-md-10">
					<legend class="col-md-3" style="text-align: center"> <h3>Instructions</h3></legend><br>
					<ul class="row col-md-offset-2 col-md-12">
						<li><h4>In the next minutes you will read some questions about violence in school.</h4></li>
						<li><h4>Choose the answer that fits you best.</h4></li>
						<li><h4>The questionnaire is anonymous and there are not good or bad answers.</h4></li>
						<li><span><h4>Press <span><input type="submit" class="btn btn-primary btn-sm disabled" value=" Start Test " /> to start the test</h4></span></span></li>
						<li><span><h4>Press <span><input type="submit" class="btn btn-success btn-sm disabled" value=" Next Question " /> to answer the next question</h4></span></span></li>
						<li><span><h4>Press <span><input type="submit" class="btn btn-success btn-sm disabled" value=" Previous Question " /> to change the answer of a previous question</h4></span></span></li>
					</ul>
					
				</div>
				<div class="row col-md-offset-10 col-md-5" style="margin-bottom: 20px">
					<input type="button" class="btn btn-primary btn-lg" id = "startTest" value=" Start Test " data-id="<?php echo $user['testID'] ?>" />
				</div>
			</div>
		<?php } else {?>
			<div class = "row col-md-3" ><h3>Unathorized</h3> </div>
		<?php } ?>
	</div> <!--CONTENT -->
	</div>

<script type="text/javascript" src="<?php echo base_url('assets/js')?>/jquery-2.0.1.min.js"></script>
<script src="<?php echo base_url("assets/js");?>/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js')?>/taketest.js"></script>		


<?php require_once('header.php'); ?>
<?php $user = $this->session->userdata('user');?>
<script src="<?php echo base_url("assets/js")?>/highcharts.js"></script>
<script src="<?php echo base_url("assets/js")?>/highcharts-exporting.js"></script>


<!-- modal for showing informations about a question -->	
<div id="showDetailsModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-legend">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> <!-- end modal -->

<!-- modal for showing informations about a question -->  
<div id="showPieModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <div id="pieContainer" style="min-width: 500px; height: 400px; max-width: 600px; margin: 0 auto"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> <!-- end modal -->

<!--<span class="fa-stack fa-3x">
  <i class="fa fa-calendar-o fa-stack-2x"></i>
  <strong class="fa-stack-1x calendar-text">27</strong>
</span>-->

<div class="row">
<div  style="border: 1px solid #efefef; margin-top:6%; box-shadow: 0px 1px 6px rgba(86,78,40,0.75)" class="col-md-10 col-md-offset-1" >
<div  class="container col-md-10 col-md-offset-1" >
<legend style='margin-top : 20px; text-align: center;' class='col-md-2'></legend>
<div id="container" class="" data-id="<?php echo $test?>">
	<?php if($user) { ?>

	<script type="text/javascript" src="<?php echo base_url("assets/js")?>/displayTestById.js"></script>
	<?php } else { ?>
		<h2>Unauthorized</h2>
		
		
	<?php }?>
</div>
</div>
</div>
</div>
<?php require_once('footer.php'); ?>
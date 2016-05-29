<?php require_once('header.php'); ?>
<?php $user = $this->session->userdata('user');
?>

<!-- modal for showing answers for a test -->	
<div id="showAnswers" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Answers for this test</h4>
      </div>
      <div class="modal-body">
      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> <!-- end modal -->

<div class="row">
<div  style="border: 1px solid #efefef; margin-top:6%; box-shadow: 0px 1px 6px rgba(86,78,40,0.75)" class="col-md-10 col-md-offset-1" >
<div  class="container col-md-10 col-md-offset-1" >
<div id="container" class="row" data-id='<?php echo $data ?>'>
	<?php if($user) { ?>

	<script type="text/javascript" src="<?php echo base_url("assets/js")?>/evaluation.js"></script>
	<?php } else { ?>
		<h2>Unauthorized</h2>
		
		
	<?php }?>
</div>
</div>
</div>
</div>
	
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css");?>/bootstrap.min.css">
<?php require_once('header.php'); ?>
<?php $user = $this->session->userdata('user'); 
?>


<div class="container" ng-controller="student">
	<div class="panel panel-default" style = "margin:0 auto;">
		<div style="margin-top: 25px; margin-left: 30px;">
			<img  ng-if="isStarted == false" src="<?php echo base_url() ?>assets/images/questionnaire_icon.gif" alt="No image found">
		</div>		
		<div>
			<u><h2 style="text-align : center; margin-bottom: 30px"> Questionnaire about school violence </h2></u>
			<!--<u><h2 ng-if="isStarted == true" style="text-align : center; margin-bottom: 30px"> {{currentTest.title}}</h2></u>-->
		</div>
		<div class="panel-body">
			<div ng-if="isStarted == false">
				<ul style="margin-left: 10%;">
					<li><h4>In the next minutes you will read some questions about violence in school.</h4></li>
					<li><h4>Choose the answer that fits you best.</h4></li>
					<li><h4>The questionnaire is anonymous and there are not good or bad answers.</h4></li>
					<li><span><h4>Press <span><input type="submit" class="btn btn-primary btn-sm disabled" value=" Start Test " /> to start the test</h4></span></span></li>
					<li><span><h4>Press <span><input type="submit" class="btn btn-success btn-sm disabled" value=" Next Question " /> to answer the next question</h4></span></span></li>
					<li><span><h4>Press <span><input type="submit" class="btn btn-success btn-sm disabled" value=" Previous Question " /> to change the answer of a previous question</h4></span></span></li>
				</ul>

				<div style="margin-bottom: 25px; margin-right: 70px; float: right;">
					<input type="button" class="btn btn-primary btn-lg" ng-click="startTest($this)" id="startTest" value=" Start Test " data-id="<?php echo $user['testID'] ?>" />
				</div>
			</div>
			<div ng-if="isStarted == true" class="row">
				<aside class="col-md-4">
					<div class="list-group" style="margin-top: 10px;"  ng-repeat="question in currentTest.questions">
	                    <a href="" data-id="{{question.question_id}}"  style="margin-bottom: -18px;" class="list-group-item" ng-class="{active: $index == currentQuestionId}" ng-click=changeQuestion($index)>{{question.question_id}}. {{question.text}}</a>
	                </div>
                </aside>
                <aside class="col-md-8">
                	<div>
						<h4 style="margin-left:3%; margin-right: 3%">{{currentQuestion.question_id}}. {{currentQuestion.text}}</h4>
					</div>
					<div  id="allAnswers" ng-repeat="answer in currentQuestion.answers"> 
	                      <input style="margin-left: 5%;"  name="answers" type="radio" data-id="answer.answer_id" ng-model="answer.answer_id" value="answer.text">
	                      <span style="margin-bottom: 10px;" ng-if="answer.isImage==false">{{answer.text}}</span>
	                      <img ng-if="answer.isImage==true" src="{{answer.image}}" style="height: 120px; width: 200px; margin-bottom: 10px;">
	                </div>
	                <div class="row">
	                	<button  class="btn btn-success" ng-class="{disable: currentQuestionId == 0}" style="margin-bottom : 20px; margin-left: 15px; margin-top:20px;" ng-click="prev()">Previous Question</button>
	                	
	                	<button ng-if="isLastQuestion==true" class="btn btn-success" style="margin-bottom : 20px; float: right;margin-right:15px; margin-top:20px;" id="finishTest">Finish Test</button>
	                	<button ng-if="isLastQuestion==false" class="btn btn-success" style="margin-bottom : 20px; float: right; margin-right:15px; margin-top:20px;" id="nextQuestion" ng-click="next()">Next Question</button>
	                </div>
                </aside>
			</div>
		</div>
	</div>
	<!--<div  style="border: 1px solid #efefef; margin-top:6%; box-shadow: 0px 1px 6px rgba(86,78,40,0.75);">
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
	</div> <!--CONTENT 
	</div>-->

<script type="text/javascript" src="<?php echo base_url('assets/js')?>/jquery-2.0.1.min.js"></script>
<script src="<?php echo base_url("assets/js");?>/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js')?>/taketest.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/angular");?>/student.js"></script>	


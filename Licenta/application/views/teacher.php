<?php require_once('header.php'); ?>
<?php $user = $this->session->userdata('user');?>

<!--<div class="col-md-8">
    <label class="control-label">Select File</label>
    <span class="file-input file-input-new"><div class="file-preview ">
    <div class="close fileinput-remove"></div>
    <div class="">
    <div class="file-preview-thumbnails">
    </div>
    <div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div>
    <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
    </div>
</div>
<div class="kv-upload-progress hide"></div>
<div class="input-group ">
   <div tabindex="-1" class="form-control file-caption  kv-fileinput-caption">
   <span class="file-caption-ellipsis"></span>
   <div class="file-caption-name"></div>
</div>
   <div class="input-group-btn">
       <button type="button" title="Clear selected files" class="btn btn-default fileinput-remove fileinput-remove-button"><i class="glyphicon glyphicon-trash"></i> Remove</button>
       <button type="button" title="Abort ongoing upload" class="hide btn btn-default fileinput-cancel fileinput-cancel-button"><i class="glyphicon glyphicon-ban-circle"></i> Cancel</button>
       <button type="submit" id="upload" title="Upload selected files" class="btn btn-default kv-fileinput-upload fileinput-upload-button"><i class="glyphicon glyphicon-upload"></i> Upload</button>
       <div class="btn btn-primary btn-file"> <i class="glyphicon glyphicon-folder-open"></i> &nbsp;Browse<input id="browse" type="file" class="file"></div>
   </div>
</div>
</span>

-->
  
<?php if ($user) { ?>
<label id="username" style="display: none;" value=""><?php echo $user["username"] ?></label>
<label id="user-id" style="display: none;" value=""><?php echo $user["id"] ?></label>
<!--<form method="POST"  action="http://localhost:9999/rest/file/upload" enctype="multipart/form-data" >
  <label for="file">Select a file to be uploaded </label>
  <input type="file" name="file"/>
  <input type="submit"  value="Upload">
</form>  ng-controller="teacher"  -->
<div class="container" ng-controller="teacher" ng-init="init()">

    <div style="margin-top: 20px; height:80%;" class="panel panel-default" >
        <div class="panel-body">
            <div class="row">
                <aside class="col-md-4">
                    <ul class="nav nav-tabs" style="margin-top: 10px;">
                            <li class="active"><a href="#">My tests</a></li>
                            <li><a href="#">Other tests</a></li>
                    </ul>
                   <!--<div style="margin-top: 10px;" class="page-header">
                        <h4 class="text-center" id="type">My tests</h4>
                    </div> 
                    <div class="form-group text-center">
                        <label class="control-label">Upload a test:</label>
                         
                            <!--<label class="control-label">Select File</label>
                            <span class="file-input">
                             <!-- <div class="kv-upload-progress hide">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>
                                </div>
                              </div> 
                              <div class="input-group" id="file">
                                 <div tabindex="-1" class="form-control file-caption  kv-fileinput-caption">
                                   <span class="file-caption-ellipsis" title=".pdf|.doc|.docx"></span>
                                   <div class="file-caption-name" title=".pdf|.doc|.docx">
                                      <span class="glyphicon glyphicon-file kv-caption-icon"></span> 
                                       <span id="fileName" name="fileName" placeholder="File"></span>
                                   </div>
                                 </div>
                                  <div class="input-group-btn">
                                     <button type="button" id="upload" title="Upload selected files" class="btn btn-default kv-fileinput-upload fileinput-upload-button"><i class="glyphicon glyphicon-upload"></i> Upload</button>
                                     <div class="btn btn-primary btn-file"> <i class="glyphicon glyphicon-folder-open"></i> Browse <input name="userfile" id="browse" type="file" class="file" data-show-preview="false"></div>
                                  </div>
                              </div>
                            </span> -->
                         




                        <!--<div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
                            <input type="text" class="form-control" id="addNewDomainInput">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="addNewDomainButton">Add</button>
                            </span>
                        </div> 
                    </div> -->
                    <!-- #FF851B #5cb85c  #f9cb9c  style="background-color: #f9cb9c; border-color: #f9cb9c;"-->

                    <div class="list-group" id="allTests" style="margin-top: 10px;"  ng-repeat="test in allTests">
                         <a href="" data-id="{{test.id}}"  style="margin-bottom: -18px;" class="list-group-item" ng-class="{active: $index == currentTestId}" ng-click=changeTest($index)><i class="icon-chevron-right"></i>{{test.Name}}</a>

                    </div>
                </aside>

                <article class="col-md-8">
                    <aside>
                          <ul class="nav nav-tabs" style="margin-top: 10px;">
                            <li ng-class="{active: isQuestionTab == true }"><a ng-click="changeTab(1)">Questions</a></li>
                            <li ng-class="{active: isEvaluationTab == true}"><a ng-click="changeTab(2)">Evaluations</a></li>
                            <li><a href="#">Menu 2</a></li>
                            <li><a href="#">Menu 3</a></li>
                          </ul>
                        <!--<div style="margin-top: 10px;" class="page-header">
                            <h4 class="text-center" id="type">Questions</h4>
                        </div>
                        <div class="form-group text-center">
                            <label class="control-label"></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
                                <input style="max-width: 1000px;" type="text" class="form-control" id="addNewSubdomainInput">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="addNewSubdomainButton">Add</button>
                                </span>
                            </div>
                        </div>-->
                        <div ng-if="isQuestionTab == true" class="list-group" style="margin-top: 10px;" id="allQuestions"   ng-repeat="question in pagedItems[currentPage]">  
                            <div class="panel panel-default">
                              <div class="panel-body">
                                <h4>{{question.question_id}}. {{question.text}}</h4>
                                <div ng-repeat="answer in question.answers">
                                   <li>
                                      <img style="height: 120px; width: 200px; margin-bottom: 10px;" ng-if="answer.isImage == true" src="{{answer.image}}">
                                      <span ng-if="answer.isImage == false">{{answer.text}}</span>
                                   </li>
                                </div>
                               </div> 
                            </div>  
                        </div>  
                        <div ng-if="isQuestionTab == true">
                              <ul class="pagination pull-right">
                                  <li ng-class="{disabled: currentPage == 0}">
                                      <a href ng-click="prevPage()">« Prev</a>
                                  </li>
                                  <li ng-repeat="n in range(pagedItems.length)"
                                      ng-class="{active: n == currentPage}"
                                  ng-click="setPage()">
                                      <a href ng-bind="n + 1">1</a>
                                  </li>
                                  <li ng-class="{disabled: currentPage == pagedItems.length - 1}">
                                      <a href ng-click="nextPage()">Next»</a>
                                  </li>
                              </ul>
                        </div>
                        <div ng-if="isEvaluationTab == true" style="margin-top: 10px;" id="allEvaluations" ng-init="getEvals()">  
                                <div class="table-responsive">
                                  <table ng-if="evaluationArray.length != 0" class="table  table-hover">
                                      <thead>
                                        <tr style="text-align: center; color: #337ab7;">
                                          <th style="width: 15%; text-align: center;">Date</th>
                                          <th style="width: 25%; text-align: center;">Student</th>
                                          <th style="width: 25%; text-align: center;">Manual Classification</th>
                                          <th style="width: 25%; text-align: center;">Auto Classification</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr ng-repeat="evaluation in pagedEvals[currentPageEval] track by $index" style="text-align: center;" ng-click="evaluateStudent($index)">
                                          <td>{{evaluation.date}}</td> 
                                          <td>{{evaluation.username}}</td>
                                          <td>{{evaluation.eval_man}}</td>
                                          <td>{{evaluation.eval_aut}}</td>
                                        </tr>                                     
                                      </tbody>
                                  </table>
                                  <h3 ng-if="evaluationArray.length == 0">No student has answered to this questionnaire!</h3>
                                </div> 

                                <div ng-if="isEvaluationTab == true">
                                    <ul class="pagination pull-right">
                                        <li ng-class="{disabled: currentPageEval == 0}">
                                            <a href ng-click="prevPageEval()">« Prev</a>
                                        </li>
                                        <li ng-repeat="n in range(pagedEvals.length)"
                                            ng-class="{active: n == currentPageEval}"
                                        ng-click="setPageEval()">
                                            <a href ng-bind="n + 1">1</a>
                                        </li>
                                        <li ng-class="{disabled: currentPageEval == pagedEvals.length - 1}">
                                            <a href ng-click="nextPageEval()">Next»</a>
                                        </li>
                                    </ul>
                                </div> 
                        </div>                       
                            <!-- <a class="list-group-item">
                             
                             </div>
                             </a>
                              <div class="navbar-collapse collapse" id="answers" ng-if="question.">
                                  Bla bla bvla
                               </div>
                              <!--<a href="#" class="list-group-item">
                                  Subdomain 2<i class="glyphicon glyphicon-remove pull-right"></i><i style="margin-right: 5px;" class="glyphicon glyphicon-edit pull-right"></i>
                              </a>
                              <a href="#" class="list-group-item">
                                  Subdomain 3<i class="glyphicon glyphicon-remove pull-right"></i><i style="margin-right: 5px;" class="glyphicon glyphicon-edit pull-right"></i>
                              </a>-->
                                
                          
                    </aside>

                </article>
            </div>
            <!--<div class="row">
                <aside class="col-md-4">
                        <div style="margin-top: 10px;" class="page-header">
                            <h4 class="text-center" id="type">Other tests</h4>
                        </div>
                        <button id="addQuestionButton" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Add new question</button>
                        <div class="list-group" id="allQuestions">
                            <!--  <a href="#" class="list-group-item active">
                                  Question 1<i class="glyphicon glyphicon-remove pull-right"></i><i style="margin-right: 5px;" class="glyphicon glyphicon-edit pull-right"></i>
                              </a>
                              <a href="#" class="list-group-item">
                                  Question 2<i class="glyphicon glyphicon-remove pull-right"></i><i style="margin-right: 5px;" class="glyphicon glyphicon-edit pull-right"></i>
                              </a>
                              <a href="#" class="list-group-item">
                                  Question 3<i class="glyphicon glyphicon-remove pull-right"></i><i style="margin-right: 5px;" class="glyphicon glyphicon-edit pull-right"></i>
                              </a>
                        </div>
                </aside>
            </div>    -->       
           
        </div>
    </div>

<button type="button" style="display: none;" class="btn btn-info btn-lg" id="evaluateModalButton" data-toggle="modal" data-target="#evaluateModal"></button>
  <div id="evaluateModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <strong><h3 style="text-align: center">Evaluate {{currentLogToBeEvaluated.username}}</h3><strong>
        </div>
        <div class="modal-body">
            <div style="margin-left: 20px; margin-top: 20px; margin-bottom: 20px;" ng-repeat="question in pagedLogEvals[currentPageLogEval]">
              <h4>{{question['question-id']}}. {{question.text}} ({{time(question['answered-time'])}})</h4>
                <div ng-repeat="answer in question.answers">
                   
                    <span ng-if="$index !=  question.answers.length - 1" class="glyphicon glyphicon-remove-circle" style="color: red; margin-left: 20px; width: 30px;"></span>
                    <span ng-if="$index ==  question.answers.length - 1" class="glyphicon glyphicon-ok-circle" style="color: green; margin-left: 20px; width: 30px;"></span>
                    <img style="height: 120px; width: 200px; margin-bottom: 10px;" ng-if="answer.img != '' " src="{{answer.img}}">
                    <span ng-if="answer.img == '' ">{{answer.text}}</span>
                   
                </div>
            </div>
              <ul class="pagination" style="margin-left: 30%;">
                  <li ng-class="{disabled: currentPageLogEval == 0}">
                      <a href ng-click="prevPageLogEval()">« Prev</a>
                  </li>
                  <li ng-repeat="n in range(pagedLogEvals.length)"
                      ng-class="{active: n == currentPageLogEval}"
                  ng-click="setPageLogEval()">
                      <a href ng-bind="n + 1">1</a>
                  </li>
                  <li ng-class="{disabled: currentPageLogEval == pagedLogEvals.length - 1}">
                      <a href ng-click="nextPageLogEval()">Next»</a>
                  </li>
              </ul>
        </div>
        <div class="modal-footer">
          <div class="row">            
            <h4 style="text-align: left;" class="col-sm-3">Time: {{time(currentLogToBeEvaluatedJSON['finish-time'])}} </h4>
            <button type="button" style="margin-right: 20px;" class="btn btn-success" ng-click="confirmSubmission()" data-dismiss="modal">Evaluate</button>
          </div>
        </div>
      </div>

    </div>
  </div>





<form  method="GET" enctype="multipart/form-data" id="uploadForm">
<div class="row">
    <div class="col-md-8">
        <label class="control-label">Select File</label>
        <span class="file-input">
    <div class="kv-upload-progress hide"><div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">

     </div>
</div></div>
<div class="input-group" id="file">
   <div tabindex="-1" class="form-control file-caption  kv-fileinput-caption">
   <span class="file-caption-ellipsis" title=".xml"></span>
   <div class="file-caption-name" title=".xml">
      <span class="glyphicon glyphicon-file kv-caption-icon">        
      </span>
      <span id="fileName" name="fileName"></span>
    </div>
</div>
   <div class="input-group-btn">
       <button type="button" id="remove" title="Clear selected files" class="btn btn-default fileinput-remove fileinput-remove-button"><i class="glyphicon glyphicon-trash"></i> Remove</button>
       <button type="button" title="Abort ongoing upload" class="hide btn btn-default fileinput-cancel fileinput-cancel-button"><i class="glyphicon glyphicon-ban-circle"></i> Cancel</button>
       <button type="button" id="upload" title="Upload selected files" class="btn btn-default kv-fileinput-upload fileinput-upload-button"><i class="glyphicon glyphicon-upload"></i> Upload</button>
       <div class="btn btn-primary btn-file"> <i class="glyphicon glyphicon-folder-open"></i> Browse <input name="userfile" id="browse" type="file" class="file" data-show-preview="false"></div>
   </div>
</div></span>
    </div>

</div>
</form>

<div class="input-group-btn">
     <div class="btn btn-primary" id="donwload"> <i class="glyphicon glyphicon-download"></i> Download</div>
</div>

<div class="container col-md-offset-3 col-md-6" id="allTests" data-id="<?php echo $user["username"] ?>">
  
</div>
</div>
<?php } else { ?>

    <h4>Unauthorized</h4>
    <?php } ?>


    

<!--
<?php echo $error ?>

<input id="fileupload" type="file" name="files[]" data-url="<?php echo base_url("teacher/uploadFile")?>">
<script src="<?php echo base_url("assets/js");?>/jquery.ui.widget.js"></script>
<script src="<?php echo base_url("assets/js");?>/jquery.iframe-transport.js"></script>
<script src="<?php echo base_url("assets/js");?>/jquery.fileupload.js"></script>
<script>
$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            console.log(data);
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });
        }
    });
});
</script>



<!--<form action="<?php echo base_url('teacher/uploadFile')?>" method="POST" enctype="multipart/form-data" >
            Select File To Upload:<br />
            <input type="file" name="userfile" multiple="multiple"  />
            
            <input type="submit" name="submit" value="Upload" class="btn btn-success" />
        </form>

 </div>

      <div class="input-group-btn">
       <button type="button" title="Clear selected files" class="btn btn-default fileinput-remove fileinput-remove-button"><i class="glyphicon glyphicon-trash"></i> Remove</button>
       <button type="button" title="Abort ongoing upload" class="hide btn btn-default fileinput-cancel fileinput-cancel-button"><i class="glyphicon glyphicon-ban-circle"></i> Cancel</button>
       <button type="submit" title="Upload selected files" class="btn btn-default kv-fileinput-upload fileinput-upload-button"><i class="glyphicon glyphicon-upload"></i> Upload</button>
       <div class="btn btn-primary btn-file"> <i class="glyphicon glyphicon-folder-open"></i> &nbsp;Browse … <input id="input-1" type="file" class="file"></div>
   </div>

ALa buun
<span class="btn btn-primary btn-file">
    Browse <input type="file">
</span>-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css");?>/jquery.dataTables.min.css">
<script type="text/javascript" src="<?php echo base_url("assets/js");?>/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css");?>/teacher.css">
<!--<script type="text/javascript" src="<?php echo base_url("assets/js/angular");?>/app.js"></script> -->
<script type="text/javascript" src="<?php echo base_url("assets/js/angular");?>/teacherController.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css");?>/fileImport.css">
<script type="text/javascript" src="<?php echo base_url("/assets/js")?>/teacher-js.js"></script>
	
<?php require_once('footer.php'); ?>
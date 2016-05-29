
<?php $user_data = $this->session->all_userdata(); 
//print_r($user_data);?>

<!DOCTYPE html>
<html style="background-color: rgb(220,220,220);">
<head>
	<title>Forum</title>	
	<script type="text/javascript" src="<?php echo base_url('assets/js');?>/jquery-2.0.1.min.js"></script>
    <script src="<?php echo base_url("assets/js");?>/bootstrap.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css");?>/bootstrap.min.css">
</head>
<body style="background-color: rgb(220,220,220);">
	<div class="container" style="border: 1px solid #efefef; margin-top:6%; box-shadow: 0px 1px 6px rgba(86,78,40,0.75); background-color: rgb(250,250,250);">
		<div class="container" style="margin:6%;">
			<h2 style=""> Forum </h2>
		</div>
		<div id="newsfeed" class="container" >
		<div id="newPost">
			<form class="form-horizontal" method="POST" action="<?php echo base_url('post/addPost'); ?>" id="addPostForm">
			  <div class="form-group">
			    <div class="col-sm-offset-1 col-sm-9 ">		      
	  				<textarea style="" placeholder="New post" class="form-control" rows="3" id="postContent" onclick="postContentClicked()"></textarea>
			    </div>
			  </div>			  
			  <div class="form-group">

			    <div class="col-sm-offset-1 col-sm-9">
			      <!--<button type="button" class="btn btn-default" style="visibility: hidden">Image </button>			      
			      <button type="button" class="btn btn-default" style="visibility: hidden">File </button>-->
			      <button type="button" class="btn btn-primary col-sm-offset-10 col-sm-2" id="sendPost">Post</button>
			    </div>
			   <!-- <div class="col-sm-2" >
			      <button type="button" class="btn btn-default">Post 2 </button>
			    </div>
			    <div class="col-sm-offset-9">
			      <button type="button" class="btn btn-default">Post</button>
			    </div>
			  </div>-->
			</form>
		</div>	
		</div>
	</div>

    <div style="margin-top: 20px;" class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Online Evaluator - Student</h3>
        </div>
        <div class="panel-body">
            <div class="row">

                <aside class="col-md-4">
                    <div style="margin-top: 10px;" class="page-header">
                        <h4 class="text-center" id="type">Select Domain</h4>
                    </div>
                    <div class="list-group" id="allDomains">
                    </div>
                </aside>

                <article class="col-md-8">
                    <aside>
                        <div style="margin-top: 10px;" class="page-header">
                            <h4 class="text-center" id="type">Select subdomains</h4>
                        </div>
                        <div id="helper" style="display: none;">Use the sidebar to select a domain</div>
                        <div class="list-group" id="allSubdomains">
                        </div>
                    </aside>
                </article>

                <div id="startTestTools" class="pull-right" style="width: 25%; display: none;">
                    <div class="row">
                        <div class="col-sm-10" style="padding-top: 5px;">
                            <span class="pull-left">Set time (min):&nbsp;</span>
                            <input style="width: 50px; " class="pull-left" id="startTestTime" type="text" value="60" />
                        </div>
                        <div class="col-sm-2">
                            <button id="startTestBtn" class="pull-right btn">START</button>
                        </div>
                        
                        <div class="col-sm-2">
                            <button id="startDemoButton" class="pull-right btn">DEMO</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




        <div style="margin-top: 20px;" class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Online Evaluator - Admin</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <aside class="col-md-4">
                    <div style="margin-top: 10px;" class="page-header">
                        <h4 class="text-center" id="type">Domains</h4>
                    </div>
                    <div class="form-group text-center">
                        <label class="control-label">Add a new domain:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
                            <input type="text" class="form-control" id="addNewDomainInput">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="addNewDomainButton">Add</button>
                            </span>
                        </div>
                    </div>
                    <div class="list-group" id="allDomains">
                        <!--  <a href="#" class="list-group-item active">
                              Domain 1<i class="glyphicon glyphicon-remove pull-right"></i><i style="margin-right: 5px;" class="glyphicon glyphicon-edit pull-right"></i>
                          </a>
                          <a href="#" class="list-group-item">
                              Domain 2<i class="glyphicon glyphicon-remove pull-right"></i><i style="margin-right: 5px;" class="glyphicon glyphicon-edit pull-right"></i>
                          </a>
                          <a href="#" class="list-group-item">
                              Domain 3<i class="glyphicon glyphicon-remove pull-right"></i><i style="margin-right: 5px;" class="glyphicon glyphicon-edit pull-right"></i>
                          </a> -->
                    </div>

                </aside>

                <article class="col-md-8">
                    <aside>
                        <div style="margin-top: 10px;" class="page-header">
                            <h4 class="text-center" id="type">Subdomains</h4>
                        </div>
                        <div class="form-group text-center">
                            <label class="control-label">Add a new subdomain:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
                                <input style="max-width: 1000px;" type="text" class="form-control" id="addNewSubdomainInput">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="addNewSubdomainButton">Add</button>
                                </span>
                            </div>
                        </div>
                        <div class="list-group" id="allSubdomains">
                            <!--  <a href="#" class="list-group-item active">
                                  Subdomain 1<i class="glyphicon glyphicon-remove pull-right"></i><i style="margin-right: 5px;" class="glyphicon glyphicon-edit pull-right"></i>
                              </a>
                              <a href="#" class="list-group-item">
                                  Subdomain 2<i class="glyphicon glyphicon-remove pull-right"></i><i style="margin-right: 5px;" class="glyphicon glyphicon-edit pull-right"></i>
                              </a>
                              <a href="#" class="list-group-item">
                                  Subdomain 3<i class="glyphicon glyphicon-remove pull-right"></i><i style="margin-right: 5px;" class="glyphicon glyphicon-edit pull-right"></i>
                              </a>
                                -->
                        </div>

                    </aside>


                    <aside>
                        <div style="margin-top: 10px;" class="page-header">
                            <h4 class="text-center" id="type">Questions</h4>
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
                              </a>-->
                        </div>
                    </aside>

                </article>
            </div>
        </div>
    </div>
	<script type="text/javascript">
		var SITE = "http://localhost:8080/Licenta/";
		function postContentClicked() {
			console.log("clicked on text area");
			//show hidden button for image/file??
		}

		var allPosts;

		$('#sendPost').click(function() {
			var content = $('#postContent').val();
			$.ajax({
				method : "POST",
				url : SITE +  "post/addPost",		
				data : {'content' : content},
				success : function (data) {
					console.log(data);
				}, 
				error : function (xhr) {
					console.log(xhr);
				}
			});
		});

		setInterval(function() {
	  		$.ajax({
				method : "GET",
				url : SITE +  "forum/getAllPosts",	
				success : function (data) {
					console.log('interval');
					for (var i=0; i < data.length; i++) {
						if (data[i]['date_time'] > allPosts[allPosts.length-1]['date_time']) {
							console.log(data[i]);
						}
					}
					//allPosts = data;
					//console.log(allPosts);
				}, 
				error : function (xhr) {
					console.log(xhr);
				}
			});
		}, 5000);

		function getAllPosts() {

			$.ajax({
				method : "GET",
				url : SITE +  "forum/getAllPosts",	
				success : function (data) {
					allPosts = data;
					console.log(allPosts);
				}, 
				error : function (xhr) {
					console.log(xhr);
				}
			});

		}
	</script>
</body>
</html>


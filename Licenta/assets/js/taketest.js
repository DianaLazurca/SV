
var SITE = "http://localhost:8080/Licenta/";
$('#startTest').click( function() {

	$.ajax({
		method : "GET",
		url : SITE +  "Test/getTestById",		
		data : {id : parseInt($(this).attr('data-id'))},
		success : function (data) {
			var test = JSON.parse(data);
			var testLocation = test["Location"];
			console.log(testLocation);

			takeTest(testLocation);
		}, 
		error : function (xhr) {
			// some error
			console.log(xhr);
		}
	});
});
var test;
var startTime;
var questionTime;
var testLog = {};

function takeTest(testLocation) {

	$.ajax({
		method : "GET",
		url : testLocation,       
    	complete: function (xhr, status) {
      		if (status === 'error' || !xhr.responseText) {
         	  console.log(error);
     		} else {
     			test = JSON.parse(xhr.responseText);  
     			testLog["test-id"] = test["test_id"];
     			testLog["test-location"] = testLocation;
     			startTime =  new Date().getTime();

     			testLog["start-test"] = startTime;
     			testLog["questions"] = {};
     			console.log("You started the test at" + startTime);  
				console.log(test["questions"]);				
     			loadQuestion(test["questions"][0], 0);
	      }
	      
    }   
	});
}

function loadQuestion(question, questionIndex) {
	$('#content').empty();
	questionTime = new Date().getTime(); // de cand a inceput sa raspunda la intrebare
	var div = $('<div class="question row" data-id = ' + questionIndex +'></div>');
	div.append('<legend class="row col-md-offset-1" style="text-align: center"><h3>' + question["text"]+'</h3></legend><br>');
	
	var divAnswers = $('<div class="question row col-md-12" data-id = ' + questionIndex +'></div>');
	for (var i = 0; i < question["answers"].length; i++) {
		if (question["answers"][i]["isImage"] == true) {
			divAnswers.append($('<div class="row col-md-offset-2"><input type = "radio"  name="answers" data-id='+question["answers"][i]["answer_id"]+'> <img src=' + question["answers"][i]["image"] + '></div><br>'));
			
		} else {
			divAnswers.append($('<div class="row col-md-offset-2"><input type = "radio"  name="answers" value = \"'+ question["answers"][i]["text"]+'\" data-id='+question["answers"][i]["answer_id"]+'>' + question["answers"][i]["text"] + '</div><br>'));
		}
		
		//console.log(div);
	}
	div.append(divAnswers);


	var answeredQuestion = {};
	if (!checkIfQuestionIdAlreadyExists(question["question_id"])) {
		answeredQuestion["question-id"] = question["question_id"];
		answeredQuestion["answers"] = {};
		answeredQuestion["answered-time"] = 0;
		answeredQuestion["text"] = question["text"];
		testLog["questions"][parseInt(questionIndex)] = answeredQuestion;
	}

	var divButtons = $('<div class="question row col-md-12" data-id = ' + questionIndex +'></div>');
	divButtons.append($('<button  id = "back" class="btn btn-success col-md-offset-1" style="margin-bottom : 20px">Previous Question</button>'));

	

	if (questionIndex == test["questions"].length - 1) {
		divButtons.append($('<button class="btn btn-success col-md-offset-7" style="margin-bottom : 20px"id = "finishTest">Finish Test</button>'));
	} else {
		divButtons.append($('<button class="btn btn-success col-md-offset-7" style="margin-bottom : 20px"id = "nextQuestion">Next Question</button>'));
	}
	div.append(divButtons);
	$('#content').append(div);

	if (questionIndex == 0) {
		//console.log("index 0");
		$('#content .question button[id = "back"]').attr("disabled", "disabled");
	}

	if (checkIfQuestionIdAlreadyExists(question["question_id"])) {
		if (objectLength(testLog["questions"][parseInt(questionIndex)]["answers"]) != 0) {
			var lastAnswer = testLog["questions"][parseInt(questionIndex)]["answers"][parseInt(objectLength(testLog["questions"][parseInt(questionIndex)]["answers"]) - 1)];
			$('#content .question input[type="radio"][data-id = '+lastAnswer["answer-id"]+']').attr('checked', 'checked');
		}
	}

}

$('#content').on('click', '.question button[id = "back"]', function() {
	//console.log('click on previous question');
	var questionIndex = $('.question').attr('data-id');

	if (questionIndex > 0) {
		var question = test["questions"][parseInt(questionIndex - 1)];
		loadQuestion(question, parseInt(questionIndex - 1));
	}
	
});
	

$('#content').on('click', '.question button[id = "nextQuestion"]', function() {

	var questionIndex = $('.question').attr('data-id');
	var question = test["questions"][parseInt(parseInt(questionIndex) + 1)];
	if (!checkIfAnswerIsSelected()) {
		alert("You must select an answer");
	} else {
		var finishQuestion = new Date().getTime();

		var questionIndex = $('.question').attr('data-id');
		addCompletedTimeToQuestion(questionIndex, finishQuestion - questionTime);

		console.log("You answered to this question in " + (finishQuestion - questionTime) +  "milliseconds");
		loadQuestion(question, parseInt(parseInt(questionIndex) + 1));
	}

});

$('#content').on('click', '.question button[id = "finishTest"]', function() {	

	if (!checkIfAnswerIsSelected()) {
		alert("You must select an answer");
	} else {
		var r = confirm("Are you sure you want to finish the test?");
		if (r == true) {
			var finishQuestion = new Date().getTime();
			//console.log("You answered to this question in " + (finishQuestion - questionTime) +  "milliseconds");

			var questionIndex = $('.question').attr('data-id');
			addCompletedTimeToQuestion(questionIndex, finishQuestion - questionTime);

			//console.log("You completed this test in" + (new Date().getTime() - startTime) + "milliseconds");			
			testLog["finish-time"] = new Date().getTime() - startTime;
		    

		    console.log("User log -- client");
		    console.log(testLog);
		    //send log to server		    
		    var dataSent = {"testAnswers" : testLog};
		    console.log(dataSent);
		    $.ajax({
				method : "POST",
				url : SITE + "Test/sendTestLog",
				//contentType : 'application/json',
				data  : {"testAnswers" : testLog},
				 /*success : function(data, xhr) {
					
				},
				error : function (xhr) {
					console.log("error on sending test log to server");
					
				},*/
				complete : function (xhr, status) {
					if (status === 'error' || !xhr.responseText) {
		         	    console.log("error on sending test log to server");
		     		} else {
		     			console.log(xhr.responseText);
		     			console.log("ce am primit de la server");
						$('#content').empty();
			  			$('#content').append($('<h3>Ieei, you did it</h3>'));
			      }
				}  
		    	   
			});
		}
	}
});

$('#content').on('click', '.question input[type = "radio"]', function() {

	var questionIndex = $('.question').attr('data-id');
	var answerId = $(this).attr('data-id');
	if ($(this).next().is("img") == true ) {
		var chosenAnswer = {"answer-id" : answerId, "text" : "", "img" : $(this).next().attr('src')};
	} else {		
		var chosenAnswer = {"answer-id" : answerId, "text" : $(this).attr('value'), "img" : ""};
	}

	var answersLength = objectLength(testLog["questions"][parseInt(questionIndex)]["answers"]);
	//console.log(objectLength(testLog["questions"][parseInt(questionIndex)]["answers"]));
	testLog["questions"][parseInt(questionIndex)]["answers"][parseInt(answersLength)] = chosenAnswer;
	console.log("Your answer for question " + questionIndex + " is " +  chosenAnswer);
	console.log($(this).attr('value'));	

});


function checkIfAnswerIsSelected() {
	var allRadioButtons = $('#content .question input[type="radio"]');
	var atLeastOneAnswerSelected = false;
	$.each(allRadioButtons, function() {
		if ($(this).is(':checked')) {
			atLeastOneAnswerSelected = true;
		}
	});

	return atLeastOneAnswerSelected;
}

function checkIfQuestionIdAlreadyExists(id) {
	var exists = false;
	if (objectLength(testLog["questions"]) == 0) {
		return false;
	}

	for (var i = 0; i < objectLength(testLog["questions"]); i++) {
		if (testLog["questions"][i]["question-id"] == id) {
			exists = true;
		}
	}

	return exists;
}

function addCompletedTimeToQuestion(questionIndex, time) {
	oldAnsweredTime= testLog["questions"][parseInt(questionIndex)]["answered-time"];	
	testLog["questions"][parseInt(questionIndex)]["answered-time"] = oldAnsweredTime +  time;

}

function objectLength(objectToCOuntElements) {
	var i = 0;
	for ( var p in objectToCOuntElements ) 
			i++;
	return i;
}


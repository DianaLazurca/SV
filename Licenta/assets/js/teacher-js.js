var SITE = "http://localhost:8080/Licenta/";
  $(document).ready( function() {

    var divContainer = $("#allTests");
    $.ajax( {
        method : "GET",
        url : SITE + "Test/getAllTests",
        dataType : 'json',
        success : function(data) {
          console.log(data);
		  
          generateDynamicTestsTable(divContainer, data);
        },
        error : function (xhr) {
          console.log(xhr);
		  console.log("skfuhsd");
          console.log("something happened while receiving all tests");
        }
    });

  });
	$("#browse").change(function(){
    var fileName = $('#browse').val();
    var array = fileName.split('\\');
    $('#fileName').append(array[array.length - 1]);
  });

$('#allTests').on('click', 'span[id^=remove]', function() {  
  console.log("remove pressed");
  var elementId = $(this).attr('id');
  var testID = elementId.substring(6);
  
  $.ajax({
      method : "POST",
      url : SITE + "Test/remove",
      data : {"id" : testID},
      success : function (data) {
		$('tr[data-id='+testID+']').remove();
      },
      error : function(xhr) {
        console.log(xhr);
      }

    });
});

  $("#donwload").click(function(){
     console.log('donwload pressed');
     window.location = SITE + "teacher/download"

  });

$('#allTests').on('click', 'span[id^=edit]', function() {
    
   var elementId = $(this).attr('id');   
   var testID = elementId.substring(4);

    $("#editTestForm" + testID).submit();
});

$('#allTests').on('click', 'img[id^=evaluation]', function() {
  var elementId = $(this).attr('id');
  var testID = elementId.substring(10);
  //console.log($("#getEvaluations" + testID));
  $("#getEvaluations" + testID).submit();
  
});
$('#allTests').on('click', '#keyGen', function() {
    var testid = parseInt($(this).parent().parent().attr('data-id'));
    //console.log(testid);

    $.ajax({
      method : "GET",
      url : SITE + "Test/getKeyForTest",
      dataType : 'json',
      data : {id : testid},
      success : function (data) {
       // console.log(data);
        if (data != null) {
          //console.log("not null");
          var r = confirm("This is the current password " + data + "\n You want to change it?");
          if (r == true) {
             generateAndUpdatePasswordForTest(testid);
          } else {
             alert("your password is " + data);
          }

        } else {
            generatePasswordForTest(testid);
        }
      },
      error : function(xhr) {
        console.log(xhr);
      }

    });
});

function generateAndUpdatePasswordForTest(testid) {
  $.ajax({
    method : "GET",
    url : SITE + "Test/generateAndUpdateNewPasswordForTest",
    dataType : 'json',
    data : {id : testid},
    success : function(data) {
        alert("your new password is " + data);
    },
    error : function(xhr) {
       console.log("error at generating password for test");
    }
  });
}

function generatePasswordForTest(testid) {
  $.ajax({
    method : "GET",
    url : SITE + "Test/generateNewPasswordForTest",
    dataType : 'json',
    data : {id : testid},
    success : function(data) {
        alert("your new password is " + data);
    },
    error : function(xhr) {
       console.log("error at generating password for test");
    }
  });
}

function generateDynamicTestsTable(container, data) {
  var table = $('<table class="table table-striped table-bordered"></table>');
  var thead = $('<thead></thead>');

  var tr = $('<tr></tr>');
  tr.append($('<th> Name </th>'));
  thead.append(tr);
  tr.append($('<th> Category </th>'));
  thead.append(tr);
  tr.append($('<th style="width=30px;"> Operations </th>'));
  thead.append(tr);
  table.append(thead);

  console.log(container);
  var tbody = $('<tbody></tbody>');
  tbody.append($('<tr id="createdByMe"><td colspan = 3 > Created By You </td></tr>'));
  tbody.append($('<tr id="otherTests"><td colspan = 3>Other Tests </td></tr>'));
  table.append(tbody);
  container.append(table);


  $.each(data, function(index) {

      tr = $('<tr data-id= '+ this.id +'></tr>');
      var td = $('<td><b>'+ this.Name +'</b></td>');
      tr.append(td);
      td = $('<td>'+ this.Category +'</td>');
      tr.append(td);
      tr.append(td);

      var username = container.attr('data-id');
	  var user_id = $("#user-id").text();
      if (user_id == this.user_id) {   
        
        td = $('<td><form id="editTestForm'+this.id+'" method="POST" action = '+SITE + "test/id/" + this.id +'><span id="edit'+this.id+'" class="glyphicon glyphicon-pencil"></span></form>   <span class="glyphicon glyphicon-remove" id=remove'+this.id+'></span>  <span class="glyphicon glyphicon-download-alt">' +
         '</span><img id="keyGen" src='+SITE +'assets/images/keyGenerator.ico'+'> <form id="getEvaluations'+this.id+'" method="POST" action = '+SITE + "test/evaluation/" + this.id+'> <img style="" id="evaluation'+this.id+'" src='+SITE +'assets/images/evaluation.png'+'></form></td>');
        tr.append(td);
        tr.insertAfter($('#createdByMe'));
      } else {

        td = $('<td> <span class="glyphicon glyphicon-download-alt"></span></td>');
        tr.append(td);
        tr.insertAfter($('#otherTests'));
      }
      
  });

   // $(table).DataTable();
  
}






  $("#upload").click(function(){
	var fileName = $('#browse').val();
    if (fileName !== ' ') {
		var formData = new FormData($('#uploadForm'));
		formData.append('file', $('#browse')[0].files[0]);
		var username = $("#username").text();
		var path = "F:/xampp/htdocs/Licenta/assets/uploads/" + username + "/";
		var user_id = $("#user-id").text();
		formData.append('path', path);
		formData.append('username', $("#username").text());
		formData.append('hostURL', SITE + "assets/uploads/"  + username + "/");
		$.ajax({
			method : "POST",
			url :"http://localhost:9999/rest/file/upload/",
			data : formData,			
			contentType: false,
			processData: false,
			success : function (data) {
			  //console.log(user_id);
			  $.ajax({
					method : "POST",
					url :"http://localhost:8080/Licenta/Api/response",
					data: {"response": data, "creator":username, "user_id": user_id},
					success : function (data) {
						//console.log("trimis");
						console.log(data);
						//window.location = "http://localhost:8080/Licenta/teacher";
					},
					error : function (xhr) {
					  console.log("error on uptading the database");
					  console.log(xhr);
					}

				});
			},
			error : function (xhr) {
			  console.log("error on uploading file");
			  console.log(xhr);
			}

		});
		 
	}
    /*var fileName = $('#browse').val();
    if (fileName !== ' ') {

      var array = fileName.split('\\');
      console.log(fileName);
      $.ajax({
        method : "POST",
        url : SITE + "teacher/uploadFile",
        dataType : 'json',
        fileElementId :'userfile',
        data : {'name' : fileName},
        success : function (xhr) {
          console.log("file uploaded successfuly");
        },
        error : function (xhr) {
          console.log("error on uploading file");
        }

      });
    } else {
      $('#fileName').val('Select a file first');
    } */
  });
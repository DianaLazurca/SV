var SITE = "http://localhost:8080/Licenta/";

$(document).ready( function() {
	var data = $('#container').attr('data-id');
	generateDynamicTable($('#container'), JSON.parse(data));


});

$('#container').on('click', 'img', function() {
	$(".modal-body").empty();

	var logLocation = $(this).parent().parent().attr('data-id');
	console.log(logLocation);
	$.ajax({
		method : "GET",
		url : SITE + "test/getLogData",
		data : {location : logLocation},
		success : function (data) {
			console.log(JSON.parse(data));
			generateTableForEvaluation($(".modal-body"), JSON.parse(data)["questions"]);
		},
		error : function (xhr) {
			console.log("error while getting the log for user");
			console.log(xhr);
		}

	});

	
});

function generateDynamicTable(container, data) {

  var table = $('<table class="table table-striped table-bordered"></table>');
  var thead = $('<thead></thead>');

  		  var tr = $('<tr></tr>');
		  tr.append($('<th> Student Name </th>'));
		  thead.append(tr);
		  tr.append($('<th> Date </th>'));
		  thead.append(tr);
		  tr.append($('<th> Evaluated </th>'));
		  thead.append(tr);
		  tr.append($('<th> Operations </th>'));
		  thead.append(tr);

		  table.append(thead);

		  var tbody = $('<tbody></tbody>');

		  $.each(data, function(index) {

		      tr = $('<tr data-id= \"'+ this.location +'\"></tr>');
		      var td = $('<td><b>'+ this.username +'</b></td>');
		      tr.append(td);
		      td = $('<td>'+ this.date +'</td>');
		      tr.append(td);
		      td = $('<td> unclassified </td>');
		      tr.append(td);
		      td = $('<td> <img style="width:30px; height: 30px" data-toggle="modal" data-target="#showAnswers" src = '+ SITE + "assets/images/results.png"+'></img> </td>');
		      tr.append(td);
		      tbody.append(tr);
		      
		  });
   		 
   
    table.append(tbody);
    container.append(table);
  
}

function generateTableForEvaluation(container, data) {

	var table = $('<table class=table table-striped table-bordered"></table>');
	var thead = $('<thead></thead>');
	var tr = $('<tr></tr>');
	tr.append($('<th><b> Crt.</b> </th>'));
	thead.append(tr);
	tr.append($('<th> Question Text </th>'));
	thead.append(tr);
	tr.append($('<th> Student Answer </th>'));
	thead.append(tr);

	table.append(thead);

	var tbody = $('<tbody></tbody>');

	$.each(data, function(index) {

	    tr = $('<tr></tr>');
	    var td = $('<td><b>'+ parseInt(index+ 1)   +'</b></td>');
	    tr.append(td);
	    td = $('<td>'+this.text+'</td>');
	    tr.append(td);
		console.log(this["answers"][parseInt(parseInt(this["answers"].length) - 1)].img !== "");
		if (this["answers"][parseInt(parseInt(this["answers"].length) - 1)].img  !== "") {
			td = $('<td> <img src='+ this["answers"][parseInt(parseInt(this["answers"].length) - 1)].img +'> </td>');		
		} else {
			td = $('<td> '+ this["answers"][parseInt(parseInt(this["answers"].length) - 1)].text +' </td>');
		}
	    tr.append(td);
	    tbody.append(tr);
		      
	});

	table.append(tbody);
    container.append(table);

}
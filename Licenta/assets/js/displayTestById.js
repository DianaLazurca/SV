var SITE = "http://localhost:8080/Licenta/";
var test;
$(document).ready( function() {

	$.ajax({
		method : "GET",
		url : $("#container").attr('data-id'),
		success : function(data) {
			test = data;
			var container = $("#container");
			$("legend").append(data["text"]);
			generateDynamicTestsTable(container, data); 
		},
		error : function(xhr) {
			console.log(xhr);
		}
	});
});

$("#container").on('click', '.glyphicon-info-sign', function(){
	console.log($(this).parent().parent().attr('data-id'));
});

$("#container").on('click', '.statistics', function(){
	var url = window.location.href; 
	var urlArray = url.split("/");
	testID = urlArray[urlArray.length - 1];

	var questionID = $(this).parent().parent().attr('data-id');
	$.ajax({
		method : "GET",
		url : SITE + "Test/getStatisticsForQuestion",
		dataType : 'json',
		data : {testID : parseInt(testID), questionID : parseInt(questionID), nrOfAnswers : parseInt(test["questions"][parseInt(questionID)]["answers"].length)},
		success : function (data) {
			
			if (data.error != undefined) {
				document.getElementById('pieContainer').innerHTML = 'Nimeni nu a raspuns la acest test pana acum';				
			} else {
				var answers = test["questions"][parseInt(questionID)]["answers"];
				var sentData = [];
				for (var i = 0; i < answers.length; i++) {
					var slice = [];
					if (answers[i]["isImage"] == true) {
						var img = document.createElement('img');
						img.src = answers[i]["image"];
						img.style.height = "80%";
						img.style.width = "80%";
						slice.push(img.outerHTML);
					} else {
						slice.push(answers[i]["text"]);
					}
					
					slice.push(data[i]);
					sentData.push(slice);
				}
				generatePieChart($('#pieContainer'), sentData);
			}
			
		},
		error : function(xhr){
			console.log(xhr);
			console.log("error while getting all logs for a test");
		}
	});


});

function generatePieChart(container, data) {
	container.highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: "Students' answers"
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
				showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            data: data
        }],
		
		legend: {
			title: {
				text:'Legend'
			},
			useHTML: true,
			align: 'left',
            orizontalAlign: 'bottom',
		},
    });
}

function generateDynamicTestsTable(container, data) {
  var table = $('<table class="table table-striped table-bordered col-md-4"></table>');
  var thead = $('<thead></thead>');

  var tr = $('<tr></tr>');
  tr.append($('<th style="width : 10px"> Crt. </th>'));
  thead.append(tr);
  tr.append($('<th><b> Questions </b></th>'));
  thead.append(tr);
  table.append(thead);

  var tbody = $('<tbody></tbody>');



  $.each(data["questions"], function(index) {
	  
      tr = $('<tr data-id= '+ parseInt(this["question_id"]-1) +'></tr>');
      var td = $('<td style="text-align:center"><b>'+ parseInt(parseInt(this["question_id"])) +'.' +'</b></td>');
      tr.append(td);
      var td = $('<td> <img class="statistics" data-toggle="modal" data-target="#showPieModal" style="width: 14px;  height:14px; position:relative; vertical-align:top; top:2px" src='+SITE+ "assets/images/statistics.png" +'></img>  <span style="color: #286090;" data-toggle="modal" data-target="#showDetailsModal" class="glyphicon glyphicon-info-sign"></span>  <b>'+ this.text +'</b></td>');
      tr.append(td);       
      tbody.append(tr);
      
      
  });
  	  table.append(tbody);
  	  container.append(table);
  
}
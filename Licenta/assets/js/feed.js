
function initialize() {
      gapi.client.setApiKey('AIzaSyDlgw9MKt0vgh4l0rB4tia8lewQRT8EIVA');
      gapi.client.load('youtube', 'v3', function() {
        searchYoutube('school violence');
        //searchYoutube('violenta scolara');
        searchTheGuardian('violence among students', 1);
        searchNYTimes('violence among students', 1);
      });
    }

function searchYoutube(text) {
  var request = gapi.client.youtube.search.list({
        q: text,
        part: 'snippet',

    });
    request.execute(function(response) {
       var results = response.items;
       $.each(results, function(index, item) {
          $.get('item', function(data) {
            $('#feedYoutube').append(tplawesome(data, [{"title" : item.snippet.title,  "videoid": item.id.videoId}]));
          });

       });
    });
}


function searchTheGuardian(searchTerms, currentPage) {
  $.ajax({
      method : "GET",
      url : "http://content.guardianapis.com/search",
      data : {"q" : searchTerms, 
              'api-key': '77599d3f-8d80-4fed-b665-5176048c5240' , 
              'page' : currentPage,
              'section' : '(education|teacher)'},
      success : function (data) {
        var artResults = data.response;
        
        //console.log("The GUARDIAN!!");
        for (var i = 0; i < artResults.results.length; i++) {
          if (artResults.results[i].sectionId == 'education') {
            //console.log(artResults.results[i]);   
            var div = document.createElement('div');
            var aElement = document.createElement('a');
            aElement.href = artResults.results[i].webUrl;
            aElement.innerHTML = artResults.results[i].webTitle;
            div.appendChild(aElement);
            document.getElementById('feedArticles').appendChild(div);

          }
          
        }
        /*if (currentPage != artResults.pages) {
          searchTheGuardian(searchTerms, currentPage++);
        }*/
      },
      error : function(xhr) {
        console.log(xhr);
      }

    });
}

// https://api.nytimes.com/svc/search/v2/articlesearch.json?api-key=74e23a7777a5420ca62346e0d063a27a&q=violence%20among%20students
// keywords: "Education and Schools" "Families and Family Life" "COLLEGES AND UNIVERSITIES" VIOLENCE TEACHERS AND SCHOOL EMPLOYEES
function searchNYTimes(searchTerms, currentPage) {
  $.ajax({
      method : "GET",
      url : " https://api.nytimes.com/svc/search/v2/articlesearch.json",
      data : {"q" : searchTerms, 
              'api-key': '74e23a7777a5420ca62346e0d063a27a',
              'page' : currentPage},
      success : function (data) {
        var artResults = data.response;
        var articles = artResults.docs;
        console.log("NY Times!!");
        for (var i = 0; i < articles.length; i++) {
          var artKeywords = articles[i].keywords;
          if (checkIfContainsMoreThan3Keywords(artKeywords)) {
             //console.log(articles[i]);
             var div = document.createElement('div');
             var aElement = document.createElement('a');
             aElement.href = articles[i].web_url;
             aElement.innerHTML = articles[i].lead_paragraph;
             div.appendChild(aElement);
             document.getElementById('feedArticles').appendChild(div);
          }
  
        }
        /*if (currentPage != parseInt(artResults.meta.hits / 10)) {
          searchNYTimes(searchTerms, currentPage++);
        }*/
      },
      error : function(xhr) {
        console.log(xhr);
      }

    });
}


function tplawesome(e,t){res=e;for(var n=0;n<t.length;n++){res=res.replace(/\{\{(.*?)\}\}/g,function(e,r){return t[n][r]})}return res}

function checkIfContainsMoreThan3Keywords(keywords) {
  var counter = 0;

  for (var i = 0; i < keywords.length; i++) {
     if (keywords[i]['value'] == 'COLLEGES AND UNIVERSITIES') {
        counter ++;
     }

     if (keywords[i]['value'] == 'Education and Schools') {
        counter ++;
     }

     if (keywords[i]['value'] == 'TEACHERS AND SCHOOL EMPLOYEES') {
        counter ++;
     }

     if (keywords[i]['value'] == 'VIOLENCE') {
        counter ++;
     }

     if (keywords[i]['value'] == 'STUDENT ACTIVITIES AND CONDUCT') {
        counter ++;
     }

  }


   if (counter >= 3) {
      return true;
   }

   return false;
}


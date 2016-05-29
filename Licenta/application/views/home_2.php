<?php require_once('header.php'); ?>
  <div ng-controller="myCtrl">
    <p>Name : <input type="text" ng-model="name"></p>
    <h1>Hello {{name}}</h1>
  </div>
  <body>
      <div style="width:100%;"> <!-- Main Div -->
     
        <div style="float:right; width:40%;">
          <div id="feedArticles">            
            <div class="article-content-wrapper">
              <div class="article-content">
                <h1 class="article-title">
                    <a data-turbo-target="post-slider" href="http://mashable.com/2016/05/06/sadiq-khan-labour-mayor-london-elections/">Sadiq Khan becomes London's first elected Muslim mayor</a>
                </h1>
                <div class="article-byline">Gianluca Mezzofiore</div>
                <p class="article-excerpt">He replaces flamboyant Conservative Boris Johnson.</p>
              </div>
            </div>
          </div>
        </div>
        <div style="float:left; width:60%;">
          <div id="feedYoutube"></div>
        </div>
    </div>
    

    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-2.0.1.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/feed.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=initialize"></script>
  


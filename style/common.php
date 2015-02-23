<?php
function buildheader($currentpage,$secondary = NULL){
  $menu = array();
  //array('Label','Icon','URL')
  $menu[0] = array('Home','home','');
  $menu[1] = array('The Vehicle','cog','vehicle');
  $menu[2] = array('History','book','history');
  $menu[3] = array('Blog','tag','blog');
  $menu[4] = array('Sponsors','flag','sponsors');
  $menu[5] = array('Gallery','th','gallery');
?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
      <title>
        <?php
          //IF NOT HOME, ADD PAGE TITLE
          if($currentpage != $menu[0][0]){
            if($secondary){
              echo $secondary.' - '.$currentpage.' - ';
            }else{
              echo $currentpage.' - ';
            }
          }
        ?>
        Olin Human Powered Vehicles
      </title>
      <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="/style/stylesheet.css" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
      <link rel="icon" href="/style/favicon.ico" type="image/x-icon" />
	  <script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-35957113-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
    </head>
    <body>
    <div class='main container'>
      <div class='row'>
        <div class=span12>
          <div class=row>
            <div class='headerimg span3 hidden-phone'>
              <a href='/'><img src='/style/images/logo.png' alt='HPV Logo'></a>
            </div>
            <div class='header span9 visible-phone'>
              <a href='/'><h1>Olin College Human Powered Vehicles</h1></a>
            </div>
            <div class='header span9 visible-tablet'>
              <a href='/'>
                <h2>Franklin W. Olin College of Engineering</h2>
                <h1>Human Powered Vehicles</h1>
              </a>
            </div>
            <div class='header span9 visible-desktop'>
              <a href='/'>
                <h2>Franklin W. Olin College of Engineering</h2>
                <h1>Human Powered Vehicles</h1>
              </a>
            </div>
          </div>
        </div>
        <div class=span3>
          <ul class="nav nav-tabs nav-stacked">
            <?php
              foreach($menu as $item){
                if($currentpage == $item[0]){
                  echo '<li class="active"><a href="/'.$item[2].'/"><i class="icon-'.$item[1].'"></i> '.$item[0].'</a></li>';
                }else{
                  echo '<li><a href="/'.$item[2].'/"><i class="icon-'.$item[1].'"></i> '.$item[0].'</a></li>';
                }
              }
            ?>
          </ul>
          <?php
            if(isset($_GET['gallerymenu'] ))
              echo $_GET['gallerymenu'] ;
          ?>
        </div>
        <div class='span9'>
          <div class='row'>

<?php } ?>
<?php function buildfooter(){ ?>
  </div>
      </div>
    </div>
    <div class='row'>
      <div class='footer span12'>
        &copy; <?php echo date('Y');?> Olin College Human Powered Vehicles Team
      </div>
    </div>
  </div>
    <div id="fb-root"></div>

    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=419938928068339";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
  </body>
</html>
<?php } ?>
<?php require('../style/common.php'); ?>

      <?php
      error_reporting(0);
      $gallery = $_GET['gallery'];
      // Removes all forward slashes (/) from define album to prevent path traversal.
      $gallery = str_replace(chr(47), '', $gallery);
      //You can now disable multiple folders from showing up in the list.
      $disable = array("cache","folder2","folder3");
      ?>
      
            <?php 
              $_GET['gallerymenu'] = '<div class="span3 gallerymenu"><h3>Galleries</h3>';
              $dirs = array_filter(glob('*'), 'is_dir');
                foreach ( $dirs as $key => $value ) {
                  if (in_array($value, $disable) === FALSE) {
                    //This is not set to work if you didn't have an nginx/apache2 rewrite rule for folders
                    //You can create a rewrite rule and modify the link accordingly below.
                      $_GET['gallerymenu'] .= '<li><a href="index.php?gallery='.$value.'" '.(($value==$gallery)?'class="active"':"").'>'.$value.'</a>';
                  }
                }
                $_GET['gallerymenu'] .= '</div>'
            ?>
<?php buildheader('Gallery'); ?>

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/fancybox/2.1.5/jquery.fancybox.css" media="screen" />
    <script type="text/javascript">
      $(document).ready(function() {
        $("a[rel=gallery]").fancybox({
          'transitionIn'    : 'none',
          'transitionOut'   : 'none',
          'titlePosition'   : 'over',
          'titleFormat'   : function(title, currentArray, currentIndex, currentOpts) {
            return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
          }
        });
      });
    </script>

  <div class='gallery span9'>
    <div class=row-fluid>
        <?php
      //You can now disable multiple folders from showing up in the list.
      $disable = array("cache","folder2","folder3");
          $imgdir = $gallery . '/';
          $allowed_types = array('png','jpg','jpeg','gif');
          $dimg = opendir($imgdir);
          while($imgfile = readdir($dimg))
          {
            if( in_array(strtolower(substr($imgfile,-3)),$allowed_types) OR
              in_array(strtolower(substr($imgfile,-4)),$allowed_types) )
            {$a_img[] = $imgfile;}
          }
           $totimg = count($a_img);
           for($x=0; $x < $totimg; $x++){ 
              if(($x) %4 == 0)
                echo '</div><div class=row-fluid>';
              echo "<div class=span3><a href='" . $imgdir . $a_img[$x] . "' rel='gallery'><img src='thumb.php?file=$imgdir".$a_img[$x]."' /></a></div>"; 
           }
        ?>
        </div>
        <?php
        if(!isset($_GET['gallery'])){
?>  
        <h3>Select a gallery from the menu at the left. </h3>
        <img src='/files/2014vehicle-side.jpg'>
<?php
        }
        ?>
    </div>
<?php buildfooter(); ?>

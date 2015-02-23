<?php 
require('../style/common.php');
buildheader('History');
$perpage = 10;

function get_post_list(){
  $dh = opendir('posts');
  $files = array();
  while (($file = readdir($dh)) !== false) { 
    if($file !== '.' && $file !== '..') { 
      $ex = explode('.',$file);
      $files[] = $ex[0];
    } 
  }
  return $files;
}

function show_single_post($id){
  echo file_get_contents('posts/'.$id.'.html');
  ?>
    <div class=span9>
      <div class="fb-like" data-href="http://hpv.olin.edu/history/?id=<?php echo $id; ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="arial"></div>
      <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
    </div>
    <div class=span9>&nbsp;</div>
  <?php
}

function show_post_synopsis($id){
  ?>
    <div class='span9 coverup'>
      <div class='row coverup'>
  <?php
  echo file_get_contents('posts/'.$id.'.html');
  ?>
      </div>
      <div class=bottomgrad>&nbsp;</div>
    </div>
    <div class=span9>
      <a class=btn href="?id=<?php echo $id; ?>">Read More <i class="icon-chevron-right"></i></a>
    </div>
    <div class=span9>&nbsp;</div>
  <?php
}

//IF POST PAGE, SHOW IT
if(isset($_GET['id']) && file_exists('posts/'.$_GET['id'].'.html')){
  show_single_post($_GET['id']);

//IF INDEX PAGE
}else{

  //PAGINATION
  if(isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p']>1){
    $currentpage = $_GET['p'];
    $firstpost = ($currentpage-1)*$perpage;
  }else{
    $firstpost = 0;
    $currentpage = 1;
  }
  
  //GET POSTS
  $posts = array_reverse(get_post_list());
  
  //SHOW POSTS
  for($i=$firstpost;$i<$firstpost+$perpage;$i++){
    if(isset($posts[$i])){
      show_post_synopsis($posts[$i]);
    }
  }

  $pages = ceil(count($posts)/$perpage);
  echo '<div class=span9>';
    if($currentpage > 1){
      if($currentpage > $pages){
        echo '<a class=btn href="?p='.$pages.'"><i class=icon-chevron-left></i> Newer</a>';
      }else{
        echo '<a class=btn href="?p='.($currentpage-1).'"><i class=icon-chevron-left></i> Newer</a>';
      }
    }
    if($currentpage < $pages) {
      echo '<a class="btn right" href="?p='.($currentpage+1).'">Older <i class=icon-chevron-right></i></a>';
    }
    echo '&nbsp;</div>';
}
?>

<?php buildfooter(); ?>
<?php
require('../style/common.php');
$perpage = 10;

function get_post_list(){
  $files = array();
  foreach(scandir('posts') as $file){
    $file = explode('.',$file);
    if(strlen($file[0]))
      $files[] = $file[0];
  }
  return array_reverse($files);
}

function show_single_post($id){
  $post = file_get_contents('posts/'.$id.'.html');
  preg_match('#<h([2])>(.+?)</h\1>#is', $post, $matches);
  $title = strip_tags($matches[0]);
  buildheader('Blog',$title);
  echo $post;
  ?>
    <div class=span9>
      <div class="fb-like" data-href="http://hpv.olin.edu/blog/?id=<?php echo $id; ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="arial"></div>
      <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
    </div>
    <div class=span9>&nbsp;</div>
  <?php
}

function show_post_synopsis($id){
  ?>
    <div class='span9'>
      <div class='row'>
  <?php

  $post = file_get_contents('posts/'.$id.'.html');
  $post = str_replace("\n", ' ', $post);

  // Get Image
  preg_match('/<img[^>]*>/', $post, $matches);
  $image = '';
  if(isset($matches[0]))
    $image = $matches[0];

  // Get Title
  preg_match('~<h2>(.*)</h2>~', $post, $matches);
  $title = '';
  if(isset($matches[0]))
    $title = $matches[0];

  // Get Date
  preg_match('~<h6>(.*)</h6>~', $post, $matches);
  $date = '';
  if(isset($matches[0]))
    $date = $matches[0];

  // Excerpt
  $post = preg_replace('~<h2>(.*)</h2>~', '', $post);
  $post = preg_replace('~<h6>(.*)</h6>~', '', $post);
  $post = strip_tags($post, '<p>');
  $post = preg_split('/\s+/', $post);
  $post = array_slice($post, 0, 125);
  $post = implode(' ', $post);

  if($image != '')
  	echo '<div class=span5>'.$title.$date.$post.'</div><div class=span4><a href="?id='.$id.'">'.$image.'</a></div>';
  else  	
  	echo '<div class=span9>'.$title.$date.$post.'</div>';

  ?>
      </div>
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
  buildheader('Blog');

  //PAGINATION
  if(isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p']>1){
    $currentpage = $_GET['p'];
    $firstpost = ($currentpage-1)*$perpage;
  }else{
    $firstpost = 0;
    $currentpage = 1;
  }

  //GET POSTS
  $posts = get_post_list();

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
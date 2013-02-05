<?php
    require_once(dirname(__FILE__) . '/../config/bootstrap.php');
    $bird = $BirdModel->findOneBy(array('conditions'=>'id='.$_GET['id']));
?>
<html>
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Bird Finder</title>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/bird.css" />
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/general.js"></script>
  </head>
  <body>
      <div id="tabs" style="min-height: 800px;">
        <div id="left_content">
        <h2 id="bird_name_label"><?=$bird['name']?> - <?=$bird['propername']?> <span id="edit_bird"><a target="_blank" href="<?=bird_manager_url . 'bird/' . $bird['id'] ?>/edit">edit bird</a></span></h2>
        <div id="about_bird" class="greyBgWithCorners">
        <h3><a href="<?=$bird['imageurl']?>" target="_blank" title="click me">Wikipedia Image</a></h3>
        <?=$bird['about']?>
        </div>
        </div>
        <div id="tag_section" class="greyBgWithCorners">
        <div id="tag_section_content">
          <h2>Tags</h2>
          <?=$BirdController->displayAssociatedTags($_GET['id'])?>     
        </div>
        </div>
        <div id="cleaner"></div>
      </div>
  </body>
</html>

<?php  $view = views_get_current_view();

$dcgv=taxonomy_get_term_by_name(arg(1));


    $term_data_name=$dcgv[0]->name;
    $term_data_description=$dcgv[0]->description;

	foreach($view->result as $key=>$value){
		$user_name[]=$value->profile_values_profile_country_value.' : '.$value->users_name;
	}
	if(!empty($user_unique_name))
	$user_unique_name=array_unique($user_name);

global $base_url;

$dd=location_country_name($view->result[0]->location_country);

	foreach($view->result as $key=>$values){
		$dd=location_country_name($values->location_country);
		if($dd != '')
		$user_name_country[]=$dd;
	}
if(!empty($user_name_country))
$user_unique_county=array_unique($user_name_country);

?>

 <div id="user-account">
  <div id="term-user-details-list-top"></div>
  <div id="term-user-account-middle">
	<div class="view-details-list-term"><?php print $term_data_name; ?></div>
	<div class="view-details-list-image"><?php if(!empty($user_unique_name)){	print implode(',  ',$user_unique_name); } ?></div>
	<div class="view-details-list-image"><span class="taxonomy">Taxonomy : </span><?php print $term_data_name; ?><br> <?php print $term_data_description; ?></div>
	<div class="view-details-list-image"><span class="taxonomy">Distribution : </span><?php if(!empty($user_unique_county)){ print implode(',',$user_unique_county); }?></div>
  </div>
  <div id="term-user-details-list-bottom"></div>
  </div>

    <div id="usermenus">
    <?php if(arg(2) == "all"){ ?>
     <span style="background:#C1CEEE !important; color:#000;" class="all"><a style="background:#C1CEEE !important; color:#000;" href="<?php print $base_url; ?>/birds-speacial/<?php print $term_data_name ?>/<?php print $varcart="all";  ?>">All</a></span>
     <?php } else {?>
    <span class="all"><a href="<?php print $base_url; ?>/birds-speacial/<?php print $term_data_name ?>/<?php print $varcart="all";  ?>">All</a></span>
     <?php } ?>

     <?php if(arg(2) == "onlyPhotos"){ ?>
     <span style="background:#C1CEEE !important; color:#000;" class="photos"><a style="background:#C1CEEE !important; color:#000;" href="<?php print $base_url; ?>/birds-speacial/<?php print $term_data_name ?>/<?php print $varcart="onlyPhotos"; ?>">Photos</a></span>
      <?php } else {?>
     <span class="photos"><a href="<?php print $base_url; ?>/birds-speacial/<?php print $term_data_name ?>/<?php print $varcart="onlyPhotos"; ?>">Photos</a></span>
    <?php } ?>

      <?php if(arg(2) == "onlyVideos"){ ?>
     <span style="background:#C1CEEE !important; color:#000;" class="videos"><a style="background:#C1CEEE !important; color:#000;" href="<?php print $base_url; ?>/birds-speacial/<?php print $term_data_name ?>/<?php print $varcart="onlyVideos"; ?>">Videos</a></span>
     <?php } else {?>
     <span class="videos"><a href="<?php print $base_url; ?>/birds-speacial/<?php print $term_data_name ?>/<?php print $varcart="onlyVideos"; ?>">Videos</a></span>
     <?php } ?>

     <?php if(arg(2) == "onlySounds"){ ?>
     <span style="background:#C1CEEE !important; color:#000;" class="sounds"><a style="background:#C1CEEE !important; color:#000;" href="<?php print $base_url; ?>/birds-speacial/<?php print $term_data_name ?>/<?php print $varcart="onlySounds"; ?>">Sounds</a></span>
     <?php } else {?>
      <span class="sounds"><a href="<?php print $base_url; ?>/birds-speacial/<?php print $term_data_name ?>/<?php print $varcart="onlySounds"; ?>">Sounds</a></span>
     <?php } ?>


    <div id="rightsside">
     <?php if(arg(2) == "onlyPhotoslist"){ ?>
    <span style="background:#C1CEEE !important; color:#000;" class="photos"><a style="background:#C1CEEE !important;color:#000;" href="<?php print $base_url; ?>/birds-speacial/<?php print $term_data_name ?>/<?php print $varcart="onlyPhotoslist"; ?>">List</a></span>
    <?php } else {?>
    	 <span class="photos"><a href="<?php print $base_url; ?>/birds-speacial/<?php print $term_data_name ?>/<?php print $varcart="onlyPhotoslist"; ?>">List</a></span>
       <?php } ?>
    <?php if(arg(2) == "onlyVideosthumb"){ ?>
    <span style="background:#C1CEEE !important;color:#000;" class="videos"><a style="background:#C1CEEE !important;color:#000;" href="<?php print $base_url; ?>/birds-speacial/<?php print $term_data_name ?>/<?php print $varcart="onlyVideosthumb"; ?>">Thumbs</a></span>
    <?php } else {?>
      <span class="videos"><a href="<?php print $base_url; ?>/birds-speacial/<?php print $term_data_name ?>/<?php print $varcart="onlyVideosthumb"; ?>">Thumbs</a></span>
    <?php } ?>
    </div>
   </div>

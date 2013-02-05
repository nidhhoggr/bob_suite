<?php /*echo"<pre>";print_r($account->content['Personal']['profile_country']['#value']);echo"</pre>";*/
drupal_set_title('');

?>

<?php $uidstore=$account->uid; ?>

<?php $view = views_get_view('user_information_first_node');
			   $view->execute();
			   $cha= $view->result[0]->node_created;
			   $date=date('d F Y',$cha);
?>
 <div id="user-account">
  <div id="user-details-list-top"></div>
  <div id="user-account-middle">
	<div class="user-details-list-image"><?php print $account->content['user_picture']['#value'];?></div>
	 <div id="user-account-middle1">
	<div class="user-details-list-username"><?php print $account->content['Personal']['profile_firstname']['#value'].'&nbsp'.$account->content['Personal']['profile_lastname']['#value'];?>
	 <div class="user-rightside-map"><?php print $account->content['Personal']['profile_firstname']['#value'].'&nbsp'.$account->content['Personal']['profile_lastname']['#value'];?> has material from:<br>
          <?php print$account->content['Personal']['profile_country']['#value'];?><br>
<?php print l('View all the localities on a map!','maps-google/'.$uidstore)?></div> </div>
	<div class="user-details-list-country"><?php print$account->content['Personal']['profile_country']['#value'];?><br><br> </div>
	<div class="user-details-list-moredetails"><span>Beauty of Birds Personal statistics:</span><br>
	<span class="first-node">First material posted on</span>
      <span> <?php $view = views_get_view('user_information_first_node');
			   $view->execute();
			   $cha= $view->result[0]->node_created;
 			   
                           echo (!empty($cha)) ? date('d F Y',$cha) : "None Yet";
          ?></span> <br>
	<span class="photos-node">Number of photos posted:</span>
		<span> <?php $view = views_get_view('user_information_all');
			   $view->execute();
			    $count = count( $view->result);
			    print ($count);	?> covering</span> <br>
	<span class="videos-node">Number of videos posted:</span>
		<span><?php $view = views_get_view('user_information_video');
			   $view->execute();
			    $count = count( $view->result);
			    print ($count);	?> covering</span> <br>
	<span class="audios-node">Number of audios posted:</span>
		<span><?php $view = views_get_view('user_information_audio');
			   $view->execute();
			    $count = count( $view->result);
			    print ($count);	?> covering</span>
	</div>
	<div class="user-details-list-country"><?php /* echo"<pre>"; print_r($account->content['Personal']['profile_country']['#value']); echo"</pre>"; */?> </div>
    </div>
  </div>
  <div id="user-details-list-bottom"></div>
  <?php $uid=$account->uid; global $base_url; $varcart="All"; ?>
    <div id="user-detailscontent-bottom">Material by <?php print $account->content['Personal']['profile_firstname']['#value'].'&nbsp'.$account->content['Personal']['profile_lastname']['#value'];?> on Beauty of Birds</div>
    <div id="usermenus">

     <?php if(arg(2) == "all"){ ?>
     <span style="background:ButtonShadow !important; color:#000;" class="all"><a style="background:ButtonShadow !important; color:#000;" href="<?php print $base_url; ?>/user/<?php print $uid ?>/<?php print $varcart="all";  ?>">All</a></span>
     <?php } else {?>
     <span class="all"><a href="<?php print $base_url; ?>/user/<?php print $uid ?>/<?php print $varcart="all";  ?>">All</a></span>
     <?php } ?>

     <?php if(arg(2) == "onlyPhotos"){ ?>
     <span style="background:ButtonShadow !important; color:#000;" class="photos"><a style="background:ButtonShadow !important; color:#000;" href="<?php print $base_url; ?>/user/<?php print $uid ?>/<?php print $varcart="onlyPhotos"; ?>">Photos</a></span>
      <?php } else {?>
     <span class="photos"><a href="<?php print $base_url; ?>/user/<?php print $uid ?>/<?php print $varcart="onlyPhotos"; ?>">Photos</a></span>
      <?php } ?>

      <?php if(arg(2) == "onlyVideos"){ ?>
     <span style="background:ButtonShadow !important; color:#000;" class="videos"><a style="background:ButtonShadow !important; color:#000;" href="<?php print $base_url; ?>/user/<?php print $uid ?>/<?php print $varcart="onlyVideos"; ?>">Videos</a></span>
     <?php } else {?>
       <span class="videos"><a href="<?php print $base_url; ?>/user/<?php print $uid ?>/<?php print $varcart="onlyVideos"; ?>">Videos</a></span>
     <?php } ?>

     <?php if(arg(2) == "onlySounds"){ ?>
     <span style="background:ButtonShadow !important; color:#000;" class="sounds"><a style="background:ButtonShadow !important; color:#000;" href="<?php print $base_url; ?>/user/<?php print $uid ?>/<?php print $varcart="onlySounds"; ?>">Sounds</a></span>
     <?php } else {?>
     	 <span class="sounds"><a href="<?php print $base_url; ?>/user/<?php print $uid ?>/<?php print $varcart="onlySounds"; ?>">Sounds</a></span>
     <?php } ?>

    <div id="rightsside">
     <?php if(arg(2) == "onlyPhotoslist"){ ?>
    <span style="background:ButtonShadow !important; color:#000;" class="photos"><a style="background:ButtonShadow !important;color:#000;" href="<?php print $base_url; ?>/user/<?php print $uid ?>/<?php print $varcart="onlyPhotoslist"; ?>">List</a></span>
    <?php } else {?>
    	 <span class="photos"><a href="<?php print $base_url; ?>/user/<?php print $uid ?>/<?php print $varcart="onlyPhotoslist"; ?>">List</a></span>
       <?php } ?>
    <?php if(arg(2) == "onlyVideosthumb"){ ?>
    <span style="background:ButtonShadow !important;color:#000;" class="videos"><a style="background:ButtonShadow !important;color:#000;" href="<?php print $base_url; ?>/user/<?php print $uid ?>/<?php print $varcart="onlyVideosthumb"; ?>">Thumbs</a></span>
    <?php } else {?>
      <span class="videos"><a href="<?php print $base_url; ?>/user/<?php print $uid ?>/<?php print $varcart="onlyVideosthumb"; ?>">Thumbs</a></span>
    <?php } ?>
    </div>
    </div>
 </div>

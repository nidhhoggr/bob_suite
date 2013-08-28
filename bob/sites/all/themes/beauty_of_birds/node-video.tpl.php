<div class="node <?php print $node_classes ?>" id="node-<?php print $node->nid; ?>"><div class="node-inner">





<?php if(arg(1)!="reply"){ ?>
  <div class="content">

<?php if(empty($node->field_youtube[0]['embed'])): ?>

	<div class="video-bird">
	<div class="video-bird-middle">
	<?php print $node->field_video[0]['view'] ; ?>
		<div class="video-bird-title">	<?php print $node->title ; ?></div>
	</div>
	</div>
   <div class="video-user">
		<div class="video-user-middle">
			<div class="video-user-left">
			<div class="video-user-date">Recorded : <?php print $node->field_start_video_date[0]['view'] ; ?></div>
			<div class="video-user-author">Author : <span> <?php print $node->name ; ?> </span></div>
			<div class="video-user-location">Location : <span> <?php print $node->locations[0]['name'].','. $node->locations[0]['city'].',<br>'. $node->locations[0]['province_name'].','. $node->locations[0]['country_name']; ?> </span></div>

			</div>

	       <div class="video-user-middle-content">
	          <div class="imagesize-user-photo"><span class="ratephoto"><a href="<?php global $base_url; print $base_url; ?>/<?php print $node->links['add_to_favorites']['href']; ?>">Add to Favorites</a></div>
		    </div>

		    <div class="video-user-right">
	         <table><tr><td> <div class="video-user-email"><span class="ratephoto"><a href="<?php global $base_url; print $base_url; ?>/<?php print $node->links['print_mail']['href']; ?>">Email this page</a></div></td><td><div class="video-user-email"><span class="ratephoto1"><a href="<?php global $base_url; print $base_url; ?>/<?php print $node->links['comment_add']['href']; ?>">Report a mistake</a></div> </td></tr></table>
		    </div>


		</div>
	</div>

<?php else: ?>

<?php //print_r($node); die(); ?>

        <div class="video-bird">
        <div class="video-bird-middle">
        <?php print $node->field_youtube[0]['view'] ; ?>

                <div class="video-bird-title">  <?php print $node->field_youtube[0]['data']['raw']['MEDIA:GROUP']['MEDIA:TITLE'][0]; ?></div>
        </div>
        </div>
   <div class="video-user">
                <div class="video-user-middle">
                        <div class="video-user-left">
                        <div class="video-user-date">Recorded : <?php print $node->field_start_video_date[0]['view'] ; ?></div>
                        <div class="video-user-author">Author : <span> <?php print $node->name ; ?> </span></div>
                        <div class="video-user-location">Location : <span> <?php print $node->locations[0]['name'].','. $node->locations[0]['city'].',<br>'. $node->locations[0]['province_name'].','. $node->locations[0]['country_name']; ?> </span></div>

                        </div>

               <div class="video-user-middle-content">
                  <div class="imagesize-user-photo"><span class="ratephoto"><a href="<?php global $base_url; print $base_url; ?>/<?php print $node->links['add_to_favorites']['href']; ?>">Add to Favorites</a></div>
                    </div>

                    <div class="video-user-right">
                 <table><tr><td> <div class="video-user-email"><span class="ratephoto"><a href="<?php global $base_url; print $base_url; ?>/<?php print $node->links['print_mail']['href']; ?>">Email this page</a></div></td><td><div class="video-user-email"><span class="ratephoto1"><a href="<?php global $base_url; print $base_url; ?>/<?php print $node->links['comment_add']['href']; ?>">Report a mistake</a></div> </td></tr></table>
                    </div>

                <div class="video-bird-description">
                    <?php print $node->field_youtube[0]['data']['raw']['MEDIA:GROUP']['MEDIA:DESCRIPTION'][0]; ?>
                </div>



                </div>
        </div>


<?php endif; ?>

  </div>
<?php } ?>

</div></div> <!-- /node-inner, /node -->
<div class="links"><?php print $node->links['rate_thumbsup']['title']; ?><?php print $node->links['addthis']['title']; ?></div>



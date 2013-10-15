       <div class="roundedBox" id="type1">
           <div class="video-user-middle">


               <div class="video-user-left">
                   <div class="icons">
                     <span class="add-to-fav"><a href="<?php global $base_url; print $base_url; ?>/<?php print $node->links['add_to_favorites']['href']; ?>">Add to Favorites</a></span>
                     <span class="email-user"><a href="<?php global $base_url; print $base_url; ?>/<?php print $node->links['print_mail']['href']; ?>">Email this page</a></span>
                     <span class="report-mistake"><a href="<?php global $base_url; print $base_url; ?>/<?php print $node->links['comment_add']['href']; ?>">Report a mistake</a></span>
                     <div class="cleaner"></div>
                   </div>
                   <div class="author_info">
                     <div class="video-user-date">Recorded : <?php print $node->field_start_video_date[0]['view'] ; ?></div>
                     <div class="video-user-author">Author : <span> <?php print $node->name ; ?> </span></div>
                   </div>
               </div>


               <div class="video-user-right">
                   <div class="links">
                       <?php print $node->links['rate_thumbsup']['title']; ?><?php print $node->links['addthis']['title']; ?>
                   </div>
               </div>
               <div class="cleaner"></div>
           </div>

                   <?php
                   require_once(dirname(__FILE__) . '/../class-bootstrap.php');
                   extract($CLASS);
/*
                   $related_tax = $BTV->getAndDisplayNodeTaxByNode($node);
                   if(!is_null($related_tax)) {
                       echo '<h2>Related Birds</h2>' . $related_tax;
                   }
*/
                   echo $BTV->displayMetaData($node);
                   ?>

           <div class="video-bird-description">
                    <?php
                        $description = $node->field_youtube[0]['data']['raw']['MEDIA:GROUP']['MEDIA:DESCRIPTION'][0];
                        if(!is_null($description)) {
                            echo '<h2>Description</h2>' . $description;
                        }
                     ?>
           </div>

           <div class="node-bird-location">

             <h2>Location</h2>
             
             <span> <?php print $node->locations[0]['name'].' '. $node->locations[0]['city'].' '. $node->locations[0]['province_name'].' '. $node->locations[0]['country_name']; ?> </span>

             <div class="gmap">
                 <?php
                 $gmap =  gmap_location_block_view($node->nid);
                 print $gmap['content'];
                 ?>
             </div>

           </div>

           <div class="corner topLeft"></div>
           <div class="corner topRight"></div>
           <div class="corner bottomLeft"></div>
           <div class="corner bottomRight"></div>
       </div>


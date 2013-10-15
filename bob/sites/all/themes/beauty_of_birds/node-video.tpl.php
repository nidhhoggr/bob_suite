<div class="node <?php print $node_classes ?>" id="node-<?php print $node->nid; ?>">
<div class="node-inner">
<?php if(arg(1)!="reply"){ ?>
  <div class="content">

<?php if(empty($node->field_youtube[0]['embed'])): ?>

        <div class="roundedBox video-bird-middle" id="type1"> 
	<?php print $node->field_video[0]['view'] ; ?>
	   <div class="video-bird-title">	<?php print $node->title ; ?></div>
           <div class="corner topLeft"></div>
           <div class="corner topRight"></div>
           <div class="corner bottomLeft"></div>
           <div class="corner bottomRight"></div>
	</div>

<?php else: ?>

<?php //print_r($node); die(); ?>

        <div class="roundedBox" id="type1"> 
                <iframe width="640" height="380" src="//www.youtube.com/embed/<?php print $node->field_youtube[0]['value'] ; ?>" frameborder="0" allowfullscreen></iframe>


                <div class="video-bird-title">  
                    <?php print $node->field_youtube[0]['data']['raw']['MEDIA:GROUP']['MEDIA:TITLE'][0]; ?>
                </div>
           <div class="corner topLeft"></div>
           <div class="corner topRight"></div>
           <div class="corner bottomLeft"></div>
           <div class="corner bottomRight"></div>
        </div>

<?php endif; ?>

        <?php require_once('includes/node-info.partial.php'); ?>

  </div>
<?php } ?>
</div>
</div> <!-- /node-inner, /node -->

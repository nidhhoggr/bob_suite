<div class="node <?php print $node_classes ?>" id="node-<?php print $node->nid; ?>">
<div class="node-inner">
<?php if(arg(1)!="reply"){ ?>
  <div class="content">

<?php //print_r($node); die(); ?>

        <div class="video-bird">
            <div class="video-bird-middle">
                <?php print $node->body; ?>
                <div class="video-bird-title">  
                    <?php print $node->title; ?>
                </div>
            </div>
        </div>

        <?php require_once('includes/node-info.partial.php'); ?>

  </div>
<?php } ?>
</div>
</div> <!-- /node-inner, /node -->

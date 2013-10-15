<div class="node <?php print $node_classes ?>" id="node-<?php print $node->nid; ?>"><div class="node-inner-page">

<?php if(arg(1)!="reply"){ ?>
  <div class="content">
        
        <div class="roundedBox imagesize-bird" id="type1">
	<?php print $node->field_image_upload[0]['view'] ; ?>
	   <div class="imagesize-bird-title"><?php print $node->title ; ?></div>
           <div class="corner topLeft"></div>
           <div class="corner topRight"></div>
           <div class="corner bottomLeft"></div>
           <div class="corner bottomRight"></div>
	</div>

<?php require_once('includes/node-info.partial.php'); ?>

  </div>

<?php }?>
<?php /*echo"<pre>"; print_r($node->links); echo"</pre>"; exit;*/?>
</div></div> <!-- /node-inner, /node -->

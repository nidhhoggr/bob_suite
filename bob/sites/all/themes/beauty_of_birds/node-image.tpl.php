<div class="node <?php print $node_classes ?>" id="node-<?php print $node->nid; ?>"><div class="node-inner-page">

<?php if(arg(1)!="reply"){ ?>
  <div class="content">
	<div class="imagesize-bird">
	<div class="imagesize-bird-top"></div>
	<div class="imagesize-bird-middle">
	<?php print $node->field_image_upload[0]['view'] ; ?>
		<div class="imagesize-bird-title">	<?php print $node->title ; ?></div>
	</div>
	<div class="imagesize-bird-bottom"></div>
	</div>

   <div class="imagesize-user">
	<div class="imagesize-user-top"></div>
		<div class="imagesize-user-middle">
			<div class="imagesize-user-left">
			<table>
			  <tr>
			     <td><div class="imagesize-user-location">Common Name of Bird</div></td>
			    <td><div class="imagesize-user-date">Taken on</div></td>
			    <td><div class="imagesize-user-author">Photographer's Name </span></div></td>
			    <td><div class="imagesize-user-location">Location</div></td>

			  </tr>
			  <tr>
			   <td><div class="imagesize-bird-title">	<?php print $node->title ; ?></div></td>
			   <td><div class="imagesize-user-date1"><?php print $node->field_start_date[0]['view'] ; ?></div></td>
			    <td><div class="imagesize-user-author1"><span> <?php print $node->name ; ?> </span></div></td>
			    <td><div class="imagesize-user-location1"><span><?php print $node->locations[0]['street']?>,</span><br><span><?php print $node->locations[0]['city']?>,</span></br><span><?php print $node->locations[0]['province_name']?>,</span><br><span><?php $node->locations[0]['country_name']; ?> </span></div></td>
			  </tr>
			</table>
			</div>
		</div>
	</div>

  </div>
<?php }?>
<?php /*echo"<pre>"; print_r($node->links); echo"</pre>"; exit;*/?>
</div></div> <!-- /node-inner, /node -->
<div class="links"><?php print $node->links['rate_thumbsup']['title']; ?><?php print $node->links['addthis']['title']; ?></div>



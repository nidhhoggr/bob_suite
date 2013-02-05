<?php
/*
 * Created on May 11, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 ?>


<?php print drupal_render($form['Personal']['profile_firstname']);?>
<?php print drupal_render($form['Personal']['profile_lastname']);?>
<?php print drupal_render($form['account']['name']); ?>
<?php print drupal_render($form['account']['mail']); ?>
<?php print drupal_render($form['account']['pass']); ?>
<?php print drupal_render($form['picture']); ?>
<?php print drupal_render($form['Personal']['profile_country']); ?>



<?php print drupal_render($form['submit']);

print drupal_render($form['form_build_id']);
print drupal_render($form['form_token']);
print drupal_render($form['form_id']); ?>
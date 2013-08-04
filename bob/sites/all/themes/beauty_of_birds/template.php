<?php

/* Body class control */

function phptemplate_body_class($left, $right) {
  if ($left != '' && $right != '') {
    $class = 'sidebars';
  }
  else {
    if ($left != '') {
      $class = 'sidebar-left';
    }
    if ($right != '') {
      $class = 'sidebar-right';
    }
  }

  if (isset($class)) {
    print ' class="'. $class .'"';
  }
}

// Javascript Includes

drupal_add_js(drupal_get_path('theme', 'beauty_of_birds') . '/js/jcarousel/lib/jquery.jcarousel.min.js', 'theme');
drupal_add_css(drupal_get_path('theme', 'beauty_of_birds') . '/js/jcarousel/skins/tango/skin.css', 'theme');

drupal_add_js(drupal_get_path('theme', 'beauty_of_birds') . '/js/suckerfish.js', 'theme');
drupal_add_css(drupal_get_path('theme', 'beauty_of_birds') . '/css/admin.css', 'theme');
// Quick fix for the validation error: 'ID "edit-submit" already defined'
$elementCountForHack = 0;
function phptemplate_submit($element) {
  global $elementCountForHack;
  return str_replace('edit-submit', 'edit-submit-' . ++$elementCountForHack, theme('button', $element));
}

function beauty_of_birds_form_element($element, $value) {
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  $str = $element['#name'];
  // added IF statement to match Custom Text Box string
  if ($str=='search_block_form') { $pun = " ";}

  else {
  // Get the last character of a string - needed to determine if the last character is punctuation or not.
  $last = $str[strlen($str)-1];
  switch ($last){
    case "?":
      $pun = " ";
      break;
    case ":":
      $pun = " ";
      break;
    case ".":
      $pun = " ";
      break;
    default:
      $pun = ":";
   }
  }

  $output = '<div class="form-item"';
  if (!empty($element['#id'])) {
    $output .= ' id="'. $element['#id'] .'-wrapper"';
  }
  $output .= ">\n";
  $required = !empty($element['#required']) ? '<span class="form-required" title="'. $t('This field is required.') .'">*</span>' : '';

  if (!empty($element['#title'])) {
    $title = $element['#title'];
    if (!empty($element['#id'])) {
      $output .= ' <label for="'. $element['#id'] .'">'. $t('!title'. $pun .'!required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
    else {
      $output .= ' <label>'. $t('!title !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
  }

  $output .= " $value\n";

  if (!empty($element['#description'])) {
    $output .= ' <div class="description">'. $element['#description'] ."</div>\n";
  }

  $output .= "</div>\n";

  return $output;
}

function beauty_of_birds_theme($existing, $type, $theme, $path) {
  return array(
    // tell Drupal what template to use for the user register form
    'user_register' => array(
      'arguments' => array('form' => NULL),
      'template' => 'user-register', // this is the name of the template
    ),
  );
}
function beauty_of_birds_preprocess_page(&$vars, $hook) {

	if($vars['node']->type == "image"){

	$tit='<div class="image-title-change">'.$vars['title'].'</div>';
	$vars['title']=$tit;
}

	if($vars['node']->type == "video"){

	$tit='<div class="image-title-change">'.$vars['title'].'</div>';
	$vars['title']=$tit;
}

}


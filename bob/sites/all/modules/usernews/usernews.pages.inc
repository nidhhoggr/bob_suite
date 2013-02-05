<?php
// $Id: usernews.pages.inc,v 1.1 2009/10/05 10:11:26 jerdiggity Exp $

/**
 * @file
 * User news module callbacks.
 */

/**
 * Link for displaying recent user news.
 */
function usernews_page_user($account) {
  global $user;

  drupal_set_title($title = t("News articles by @name", array('@name' => $account->name)));

  $items = array();

  if (($account->uid == $user->uid) && user_access('create user news content')) {
    $items[] = l(t('Submit a news article.'), "node/add/usernews");
  }
  else if ($account->uid == $user->uid) {
    $items[] = t('Please contact the site administrator regarding submitting news articles.');
  }

  $output = theme('item_list', $items);

  $result = pager_query(db_rewrite_sql("SELECT n.nid, n.sticky, n.created FROM {node} n WHERE n.type = 'usernews' AND n.uid = %d AND n.status = 1 ORDER BY n.sticky DESC, n.created DESC"), variable_get('default_nodes_main', 10), 0, NULL, $account->uid);
  $has_posts = FALSE;
  
  while ($node = db_fetch_object($result)) {
    $output .= node_view(node_load($node->nid), 1);
    $has_posts = TRUE;
  }
  
  if ($has_posts) {
    $output .= theme('pager', NULL, variable_get('default_nodes_main', 10));
  }
  else {
    if ($account->uid == $user->uid) {
      drupal_set_message(t('You have not submitted any news articles.'));
    }
    else {
      drupal_set_message(t('!name has not submitted any news articles.', array('!name' => theme('username', $account))));
    }
  }
  drupal_add_feed(url('usernews/'. $account->uid .'/feed'), t('News - !title', array('!title' => $title)));

  return $output;
}

/**
 * Link for displaying a page with all recent news articles.
 */
function usernews_page_last() {
  global $user;

  $output = '';
  $items = array();

  if (user_access('create user news content')) {
    $items[] = l(t('Submit a news article.'), "node/add/usernews");
  }

  $output = theme('item_list', $items);

  $result = pager_query(db_rewrite_sql("SELECT n.nid, n.created FROM {node} n WHERE n.type = 'usernews' AND n.status = 1 ORDER BY n.sticky DESC, n.created DESC"), variable_get('default_nodes_main', 10));
  $has_posts = FALSE;

  while ($node = db_fetch_object($result)) {
    $output .= node_view(node_load($node->nid), 1);
    $has_posts = TRUE;
  }
  
  if ($has_posts) {
    $output .= theme('pager', NULL, variable_get('default_nodes_main', 10));
  }
  else {
    drupal_set_message(t('Sorry... No news articles found.'));
  }
  drupal_add_feed(url('usernews/feed'), t('RSS - News articles'));

  return $output;
}

/**
 * Creates a feed with recent articles.
 */
function usernews_feed_user($account) {
  $result = db_query_range(db_rewrite_sql("SELECT n.nid, n.created FROM {node} n  WHERE n.type = 'usernews' AND n.uid = %d AND n.status = 1 ORDER BY n.created DESC"), $account->uid, 0, variable_get('feed_default_items', 10));
  $channel['title'] = t('News articles by !name | !site', array('!name' => $account->name, '!site' => variable_get('site_name', 'Drupal')));
  $channel['link'] = url('usernews/'. $account->uid, array('absolute' => TRUE));

  $items = array();
  while ($row = db_fetch_object($result)) {
    $items[] = $row->nid;
  }
  node_feed($items, $channel);
}

/**
 * Creates a feed with all news articls.
 */
function usernews_feed_last() {
  $result = db_query_range(db_rewrite_sql("SELECT n.nid, n.created FROM {node} n WHERE n.type = 'usernews' AND n.status = 1 ORDER BY n.created DESC"), 0, variable_get('feed_default_items', 10));
  $channel['title'] = t('News articles from !site', array('!site' => variable_get('site_name', 'Drupal')));
  $channel['link'] = url('usernews', array('absolute' => TRUE));

  $items = array();
  while ($row = db_fetch_object($result)) {
    $items[] = $row->nid;
  }

  node_feed($items, $channel);
}

<?php
require_once(dirname(__FILE__) . '/../config/bootstrap.php');
?>
<html>
  <head>
    <title>Bird Finder</title>
    <link rel="stylesheet" href="<?=bird_interface_url?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?=bird_interface_url?>css/style.css" />
    <script src="<?=bird_interface_url?>js/jquery.js" type="text/javascript"></script>
    <script src="<?=bird_interface_url?>js/jquery-ui.js"></script>
    <script type="text/javascript">
    <?php echo 'var ajaxurl = "'.bird_interface_url.'ajax_handler.php"'?>
    </script>
    <script src="<?=bird_interface_url?>js/general.js"></script>
  </head>
  <body>
      <div id="tabs">
        <?php
          $tax_types = $TaxonomyTypeModel->find("1 ORDER BY weight ASC");
          $TaxonomyTypeController->displayTabs($tax_types);
          echo '<div id="selection_log"></div><div id="cleaner"></div>';
          $TaxonomyTypeController->displayTabOptions($tax_types);
        ?>
        <div id="selectedBirds"></div>
      </div>
  </body>
</html>

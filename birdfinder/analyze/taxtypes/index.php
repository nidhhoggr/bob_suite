<html>
  <head>
    <title>Analyzing Taxtypes</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
    <style type="text/css">
        .hidden {
            display: none;
        }
    </style>
    <script type="text/javascript"> 

        $(document).ready(function(){

            $('.taxtypename').click(function() { 

                    var taxname = $(this).data('taxname');
                    $('.' + taxname).slideToggle('slow');
            }); 

        });

    </script>
  </head>
  <body>

<?php
require_once(dirname(__FILE__) . '/../../config/bootstrap.php');

$tax_types = $TaxonomyTypeModel->find();

if($_SERVER['HTTP_HOST'] == "clients") {
    $editbarelink = 'http://sfprojects/birdfinder/web/backend.php/taxonomy/';
}
else if($_SERVER['HTTP_HOST'] == "clonedparts.com") {
    $editbarelink = '../../../birdfindermanager/web/backend.php/taxonomy/';
}

$viewbarelink = '../birds/?taxid=';

foreach($tax_types as $tt) {

    $taxname = $tt['name'];
    $dtaxname = $Utility->dehumanizeString($taxname);

    echo '<u><h2 class="taxtypename" data-taxname="'.$dtaxname.'">' . ucfirst($taxname) . "</h2></u>";

    $result = $TaxonomyModel->fetchWhereIn(array($tt['id']));
 
    echo '<ul class="'.$dtaxname.' hidden">';

    while($obj = $TaxonomyModel->fetchNextObject($result)) {
        $editlink = $editbarelink . $obj->id . '/edit';
        $viewlink = $viewbarelink . $obj->id;
        echo '<li>'.$obj->name. ' <a href="'.$editlink.'" target="_blank">edit</a> | <a href="'.$viewlink.'" target="_blank">view birds</a></li>';
    }

    echo "</ul>";
}
?>
  </body>
</html>

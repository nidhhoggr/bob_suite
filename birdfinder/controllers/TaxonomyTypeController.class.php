<?php
class TaxonomyTypeController extends BaseController
{
    public function displayTabs($tax_types)
    {
        global $Utility;

        echo '<ul>';
        foreach ($tax_types as $tt) {
            $taxname = $tt['name'];
            $dtaxname = $Utility->dehumanizeString($taxname);
            echo '<li><a href="#' . $dtaxname . '"><span>' . $taxname . '</span></a></li>';
        }
        echo '<li>
                <a href="#selectedBirds">
                  <b>Selected Birds<span class="counter"></span></b>
                </a>
              </li>
              </ul>';
    }
    public function displayTabOptions($tax_types)
    {
        global $Utility, $TaxonomyModel, $TaxonomyController;

        foreach ($tax_types as $tt) {
            $taxname = $tt['name'];
            $dtaxname = $Utility->dehumanizeString($taxname);
            echo '<div class="taxType" id="' . $dtaxname . '">';
            $result = $TaxonomyModel->fetchWhereIn(array(
                $tt['id']
            ));
            echo '<div id="columnWrapper">';
            $TaxonomyController->resizeTaxList($result);
            echo "</div>";
            echo "</div>";
        }
    }
}


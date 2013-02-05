var BirdTaxonomyFilter = {}

$(function() {

    $('#bird_taxonomy_filters_taxonomytype_id').removeAttr('name');

    BirdTaxonomyFilter.removeTaxOptions(); 

    $('#bird_taxonomy_filters_taxonomytype_id').click(function() {

        var taxonomytype_id = $(this).val();

        $.ajax({
            url: admin_url + "bird_taxonomy/AjaxSelectTaxonomyType",
            type: "POST",
            data: {taxonomytype_id: taxonomytype_id},
            success: function(rsp) {

                var rsp = $.parseJSON(rsp);
                
                BirdTaxonomyFilter.removeTaxOptions(); 
                BirdTaxonomyFilter.addTaxOptions(rsp);
            }
        }); 

    });
});

BirdTaxonomyFilter.removeTaxOptions = function() {

    $('#bird_taxonomy_filters_taxonomy_id').find('option').remove();
}

BirdTaxonomyFilter.addTaxOptions = function(objects) {

    for(var i = 0; i < objects.length; i++) {

        var o = new Option(objects[i].name,objects[i].id);
        $('#bird_taxonomy_filters_taxonomy_id').append(o);
    }
}

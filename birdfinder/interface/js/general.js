var selected_taxonomies = {};
$( function() { 

            clearForms();

            $("#radio input").live('click', function() {

                var input = $(this);
                var name = input.attr('name');
              
                if(input.val() == "0") {
                    deselectInTab(input);
                } else { 
 
                    selected_taxonomies[name] = {};
                    selected_taxonomies[name]['value'] = input.val();
                    selected_taxonomies[name]['literal'] = input.data('literal');
 
                    updateBirdList();
                    updateSelectionLog();
                }
                console.log(selected_taxonomies);

                $('input[name='+name+']').parent().css('background-color','#FFF');
                $(input.parent()).css('background-color','#FFD39B');
            });

            $("#selection_log .tag").live('click', function() {
                var tax_id = $(this).data('id');
                var taxtype = $(this).data('taxtype');
                var checkbox = $('#tabs').find('input[value='+tax_id+']');
                checkbox.removeAttr('checked');
                checkbox.parent().css('background-color','#FFF');
                selected_taxonomies[taxtype] = {};
                updateBirdList();
                updateSelectionLog();
            });

            $("#tabs").tabs();
});

var deselectInTab = function(input) {
    selected_taxonomies[input.attr('name')] = {};
    updateBirdList();
    updateSelectionLog();
}

var updateSelectionLog = function() {

    $('#selection_log').html(null);

    for(var taxtype in selected_taxonomies) {

        if(typeof selected_taxonomies[taxtype].value !== "undefined") {

            var value = selected_taxonomies[taxtype].value;
            var literal = selected_taxonomies[taxtype].literal;

            $('#selection_log').append('<div class="tag" data-taxtype="'+taxtype+'" data-id="'+value+'">'+literal+'</div>');
        }
    }
}

var getSelectedIds = function() {

    var taxids = [];

    for(var taxtype in selected_taxonomies) {

        if(typeof selected_taxonomies[taxtype].value !== "undefined") 
            taxids.push(selected_taxonomies[taxtype].value);
    }
 
    return taxids;
}

var updateBirdList = function() {

        console.log(getSelectedIds()); 

        $.ajax({
            type: 'POST',
            data: {
                'controller':'BirdController',
                'function':'displaySelectedBirds',
                'arguments':getSelectedIds()
            },
            url: ajaxurl,
            success: function(rsp){
                
                $('#selectedBirds').html(rsp);
                updateBirdListCount();
            }
        });
}

var updateBirdListCount = function() {

        var count = $('#selectedBirdCount .counter').text();
        $('li[role=tab] .counter').text(": " + count);
}

var clearForms = function() {

    $('#tabs').find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
            }
    });
}


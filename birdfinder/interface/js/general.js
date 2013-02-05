$( function() { 

            clearForms();
 
            $("#checkbox").live('click', function() {

                var input = $(this).find('input');

                if($(this).find('input').attr('checked')) {
                    input.removeAttr('checked');
                    
                    $('#selection_log').find($('div[data-id='+input.val()+']')).remove();
                    $(this).css('background-color','#FFF');
                }
                else { 
                    $(this).css('background-color','#FFD39B');
                    $('#selection_log').append('<div class="tag" data-id="'+input.val()+'">'+input.data('literal')+'</div>');
                    input.attr('checked','checked');
                }
                updateBirdList();
            });

            $("#checkbox input").live('click', function() {

                if($(this).attr('checked')) {
                    $(this).removeAttr('checked');
                    $(this).parent().css('background-color','#FFF');
                }
                else { 
                    $(this).parent().css('background-color','#FFD39B');
                    $(this).attr('checked','checked');
                }
                updateBirdList();
            });

            $("#selection_log .tag").live('click', function() {
                var tax_id = $(this).data('id');
                var checkbox = $('#tabs').find('input[value='+tax_id+']');
                checkbox.removeAttr('checked');
                checkbox.parent().css('background-color','#FFF');
                $(this).remove();
                updateBirdList();
            });

            

            $("#tabs").tabs();
});

var getSelectedIds = function() {

    var taxids = [];
 
    $('#selection_log').find($('div')).each(function() { 
 
        taxids.push($(this).data('id'));
    });

    return taxids;
}

var updateBirdList = function() {

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


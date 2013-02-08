$( function() { 

   //holds the bird id in an instance variable for mass add
   var one_for_all = 0;

   $('#addAss').live('click',function(e) {
       e.preventDefault();

       $.ajax({
            type: 'POST',
            data: {
                'controller':'TaxAssController',
                'function':'getCreateAssFormInputs',
                'arguments':{}
            },
            url: ajaxurl,
            success: function(rsp){

                $('.assForm').append(rsp);

                if(one_for_all>0) {
                    $('.inputs:last .bird_id_of_tax').val(one_for_all);
                    $('.inputs:last .input:first').hide();
                }
            }
        });
   }); 

   $('#remAss').live('click',function() {

       if($('.inputs').size() > 1)
           $('.inputs:last').remove();
   });

   $('select[name=taxonomy_type_id]').live('change',function() {

       var select = this;

       $.ajax({
            type: 'POST',
            data: {
                'controller':'TaxAssController',
                'function':'getTaxonomySelector',
                'arguments':{'ttid':$(select).val()}
            },
            url: ajaxurl,
            beforeSend: function() {
                $(select).parent().parent().
                find('select[name=taxonomy_id]').parent().remove();
            },
            success: function(rsp){
                $(select).parent().parent().append(rsp);
            }
        });
   });

   $('.bird_id_one_for_all').live('change',function(e) {

       one_for_all = $(this).val();

       $('.bird_id_of_tax').each(function() {
           $(this).val(one_for_all);
           $(this).parent().hide();
       });

       if(one_for_all > 0) {

       $.ajax({
            type: 'POST',
            data: {
                'controller':'TaxAssController',
                'function':'getBird',
                'arguments':{'bird_id':one_for_all}
            },
            url: ajaxurl,
            beforeSend: function() {
                //remove child bird images
            },
            success: function(rsp){
                var bird = $.parseJSON(rsp);
                loadOneForAllImg(bird.imageurl);
            }
        });

        }
        else {
            unsetOneForAllImg();
        }

   });

   $('#putAss').live('click',function(e) {
       e.preventDefault();

       var form_data = $('.assForm').serialize();
       
       $.ajax({
            type: 'POST',
            data: {
                'controller':'TaxAssController',
                'function':'saveForm',
                'arguments':{'form_data':form_data}
            },
            url: ajaxurl,
            beforeSend: function() {
                $('.igFlash').remove();
            },
            success: function(rsp){
                rsp = $.parseJSON(rsp);
                $.each(rsp.flashes, function(index,item) {
                    $('.inputs').eq(index).prepend(item);
                });
            }
       });
   });

   $('#wipeAss').live('click',function(e) {
       e.preventDefault();
       
       $('.bird_id_one_for_all').val(0);
       one_for_all = 0;
       unsetOneForAllImg(); 
       $('.inputs').remove();
       $('#addAss').click();
   });

});

unsetOneForAllImg = function() {

    $('#one_for_all_img').removeAttr('src').css('height','0px');
}

loadOneForAllImg = function(url) {

    $("<img>", {
        src: url,
        error: function() {
            unsetOneForAllImg();
        },
        load: function() {
            $('#one_for_all_img').attr('src',url).css('height','300px');
        }
    });
}

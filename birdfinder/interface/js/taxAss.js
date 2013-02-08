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

   $('.bird_id_modify_bird').live('change',function(e) {

       modify_bird = $(this).val();

       if(modify_bird > 0) {

           $.ajax({
                type: 'POST',
                data: {
                    'controller':'TaxAssController',
                    'function':'getBird',
                    'arguments':{'bird_id':modify_bird}
                },
                url: ajaxurl,
                beforeSend: function() {
                },
                success: function(rsp){
                    var bird = $.parseJSON(rsp);
                    loadModifyBirdImg(bird.imageurl);
                }
            });

            populateTaxonomiesByBird(modify_bird);
        }
        else {
            unsetModifyBirdImg();
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

   $('#putModAss').live('click',function(e) {
       e.preventDefault();

       var form_data = $('.assForm').serialize();

       $.ajax({
            type: 'POST',
            data: {
                'controller':'TaxAssController',
                'function':'saveModForm',
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

unsetImg = function(selector) {

    $(selector).removeAttr('src').css('height','0px');
}

loadImg = function(selector,url) {

    $("<img>", {
        src: url,
        error: function() {
            unsetOneForAllImg();
        },
        load: function() {
            $(selector).attr('src',url).css('height','300px');
        }
    });
}

unsetModifyBirdImg = function() {

    unsetImg('#modify_bird_img');
}

loadModifyBirdImg = function(url) {

    loadImg('#modify_bird_img',url);
}

unsetOneForAllImg = function() {

    unsetImg('#one_for_all_img');
}

loadOneForAllImg = function(url) {

    loadImg('#one_for_all_img',url);
}

populateTaxonomiesByBird = function(bird_id) {

       $.ajax({
            type: 'POST',
            data: {
                'controller':'TaxAssController',
                'function':'getModInputs',
                'arguments':{'bird_id':bird_id}
            },
            url: ajaxurl,
            beforeSend: function() {
                $('.igFlash').remove();
            },
            success: function(rsp){
                $('.assForm').html(rsp);
            }
       });
}

$( function() { 

   //holds the bird id in an instance variable for mass add
   var one_for_all = 0;
   //holds the boolean value of the bird if it is using the propername
   var isPropername = 0;
   //holds the boolean value of the interface if its the modifier interface
   var isModifying = false;
   //holds the taxonomy type id for the modifier form
   var selectedTaxType = null;

   //radio the creator interface
   $('#toggleCreator').live('click',function() {

        $.ajax({
            type: 'POST',
            data: {
                'controller':'TaxAssController',
                'function':'getCreator',
                'arguments':{}
            },
            url: ajaxurl,
            success: function(rsp){
                isModifying = false;
                $('.interfaceContainer').html(rsp);
            }
        });
   });


   //radio the modifier interface
   $('#toggleModifier').live('click',function() {

       $.ajax({
            type: 'POST',
            data: {
                'controller':'TaxAssController',
                'function':'getModifier',
                'arguments':{}
            },
            url: ajaxurl,
            success: function(rsp){
                isModifying = true;
                $('.interfaceContainer').html(rsp);
            }
        });
   });


   //radio display bird select by propername
   $('#toggleBirdProperName').live('click',function() {
       isPropername = 1;

       if(isModifying)
           getBirdSelector('.bird_id_modify_bird','modify_bird',isPropername);
       else
           getBirdSelector('.bird_id_one_for_all','one_for_all',isPropername);
   });

   //radio display bird select by regular name
   $('#toggleBirdName').live('click',function() {
       isPropername = 0;

       if(isModifying)
           getBirdSelector('.bird_id_modify_bird','modify_bird',isPropername);
       else
           getBirdSelector('.bird_id_one_for_all','one_for_all',isPropername);
   });

   //click button add association group
   $('#addAss').live('click',function(e) {
       e.preventDefault();

       $.ajax({
            type: 'POST',
            data: {
                'controller':'TaxAssController',
                'function':'getCreateAssFormInputs',
                'arguments':{'isPropername':isPropername}
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

   //click button remove association group
   $('#remAss').live('click',function() {

       if($('.inputs').size() > 1)
           $('.inputs:last').remove();
   });

   //select taxonomy type to associate
   $('.taxonomy_type_id').live('change',function() {

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
                if(!isModifying) {
                  $(select).parent().parent().
                  find('.taxonomy_id').parent().remove();
                }
            },
            success: function(rsp){
                if(!isModifying)
                  $(select).parent().parent().append(rsp);
                else 
                  $(select).parent().parent().find('.taxonomy_id').html(rsp);
            }
        });
   });

   //select a bird to use for all associations
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
            wipeAss(); 
        }

   });

   //select a bird to modify
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

            populateTaxonomiesByBird(modify_bird,selectedTaxType);
        }
        else {
            wipeModAss();
        }
   });

   $('.modify_bird_taxtype').live('click',function() {

       selectedTaxType = $(this).val();

       populateTaxonomiesByBird(modify_bird,selectedTaxType);
   });

   //submit creator associations
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

   //submit modified associations
   $('#putModAss').live('click',function(e) {
       e.preventDefault();

       var form_data = serializeAssForm();

       var deletable_ig = $('.assForm input:checked').parent().parent();

       $.ajax({
            type: 'POST',
            data: {
                'controller':'TaxAssController',
                'function':'saveModForm',
                'arguments':{'bird_id':modify_bird,'form_data':form_data}
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
                setTimeout(function() {
                    $.each(deletable_ig,function() {
                        $(this).fadeOut(300,function() { $(this).remove(); });
                    });
                },4000);
            }
       });
   });

   //reset the creator interface
   $('#wipeAss').live('click',function(e) {
       e.preventDefault();
       one_for_all = 0;
       isPropername = 0;
       wipeAss();
   });

   //reset the modifier interface
   $('#wipeModAss').live('click',function(e) {
       e.preventDefault();
       one_for_all = 0;
       isPropername = 0;
       wipeModAss();    
   });
});

wipeModAss = function() {

    $('#toggleModifier').click();
}

wipeAss = function() {

    $('#toggleCreator').click();
}

getBirdSelector = function(selector, className, isPropername) {
  
   $.ajax({
        type: 'POST',
        data: {
            'controller':'TaxAssController',
            'function':'getBirdSelector',
            'arguments':{
                'isPropername':isPropername,
                'className':className
            }
        },
        url: ajaxurl,
        success: function(rsp){
            $(selector).replaceWith(rsp);

            if(className == "one_for_all") {

                getBirdSelector('.bird_id_of_tax','of_tax',isPropername);
            }
            else if(className == "modify_bird") {
            }
        }
   });
}

unsetImg = function(selector) {

    $(selector).removeAttr('src').css('height','0px');
}

loadImg = function(selector,url) {

    $("<img>", {
        src: url,
        error: function() {
            unsetImg(selector);
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

populateTaxonomiesByBird = function(bird_id,taxonomytype_id) {

       $.ajax({
            type: 'POST',
            data: {
                'controller':'TaxAssController',
                'function':'getTaxonomies',
                'arguments':{'bird_id':bird_id,'taxonomytype_id':taxonomytype_id}
            },
            url: ajaxurl,
            success: function(rsp){
                rsp = $.parseJSON(rsp);
                $('.assForm').html(rsp.html).promise().done(function() {
                    $.each(rsp.bird_taxes, function(index,bird_tax) {
                        $('.inputs').eq(index).find('.taxonomy_type_id').val(bird_tax.taxonomytype_id);
                        $('.inputs').eq(index).find('.taxonomy_id').val(bird_tax.taxonomy_id);
                    });
                });
            }
       });
}

serializeAssForm = function() {

    var input_groups = {};

    $.each($('.assForm .inputs'), function(index,input_group) {
        input_groups[index] = {};
        input_groups[index]['id'] = $(input_group).find('.birdtaxonomy_id').val();
        input_groups[index]['taxonomy_id'] = $(input_group).find('.taxonomy_id').val();
        input_groups[index]['delete'] = $(input_group).find('.deleteAss').prop('checked');
    });

    return input_groups;
}

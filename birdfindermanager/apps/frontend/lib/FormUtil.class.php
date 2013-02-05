<?php

class FormUtil {

    private function getNestedForms($form,$key) {

       $forms = array();
 
       $keys  = array();

        $this->setFormFields($form,$key,$forms,$keys);

        //loop through if the form has a child
        while(count($form->getEmbeddedForms())>0) {
 
           //get the key of the form
            $key = key($form->getEmbeddedForms());

            //get the embedded form
            $form = $form->getEmbeddedForm($key);

            $this->setFormFields($form,$key,$forms,$keys);

        }

        $keys = array_reverse($keys);

        for($i = 0;$i<count($keys)-1;$i++) {

            $ck = $keys[$i];
            $nk = $keys[$i+1];

            array_push($forms[$nk],array($ck => $forms[$ck]));
            $rk = array_search($ck,$forms[$nk]);
            unset($forms[$nk][$rk]);
            unset($forms[$ck]);
        }

        return $forms;
    }

    private function setFormFields($form,$key,&$forms,&$keys) {
       //get the embedded forms fields
        $fields = $form->getWidgetSchema()->getFields(); 

       // add key to list of keys
       $keys[] = $key;

       //set the fields to the embedded form
       foreach($fields as $k=>$v) {
        
           $forms[$key][] = $k;
       }
    }


    public function getFields($form,$key = 'Parent') {

        $forms = $this->getNestedForms($form,$key);

        return $forms[$key];
    } 

}

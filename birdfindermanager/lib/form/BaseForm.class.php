<?php

/**
 * Base project form.
 * 
 * @package    primal
 * @subpackage form
 * @author     Your name here 
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class BaseForm extends sfFormSymfony {

    public function getCurrentUser() {
        if(sfContext::hasInstance()) 
            return sfContext::getInstance()->getUser();
        else
            return false;
    }

    protected function unsetTimeStampable() {
        unset(
            $this['created_at'],
            $this['updated_at']
        );
    }

    protected function embedUser($pk="user_id",$name="User") {
        unset($this[$pk]);
        $formUser = new SfGuardUserCustomForm($this->getObject()->getUser());

        $current_user = $this->getCurrentUser();

        if($current_user) {
            if(!$current_user->isSuperAdmin()) {
                unset($formUser['is_active']);
                unset($formUser['is_super_admin']);
            }
        }
       
        $this->embedForm($name,$formUser);
    }

    protected function embedGroupUserLocations() {
        $this->embedRelation('GroupUserLocations',new GroupUserLocationAssociatorForm());
    }

    protected function embedPhoneNumbers() {
        $this->embedRelation('PhoneNumbers',new PhoneNumberAssociatorForm());
    }

    public function addPhoneNumber($number) {
        $this->embedForm($number,new PhoneNumberAssociatorForm());
    }

    protected function embedAddress($pk="address_id",$name="Address") {
        unset($this[$pk]);
        $formAddress = new AddressForm($this->getObject()->getAddress());
        $this->embedForm($name,$formAddress);
    }

    protected function embedPatient($pk="patient_id",$name="Patient") {
        unset($this[$pk]);
        $formPatient = new PatientForm($this->getObject()->getPatient());
        $this->embedForm($name,$formPatient);
    }

}

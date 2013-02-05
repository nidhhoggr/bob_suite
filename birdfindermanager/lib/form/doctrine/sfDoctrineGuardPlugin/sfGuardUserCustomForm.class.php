<?php
class sfGuardUserCustomForm extends BasesfGuardUserAdminForm {
  /**
   * @see sfForm
   */
  public function configure() {

      if(sfContext::hasInstance()) {
          if(!sfContext::getInstance()->getUser()->getCredentials('superadmin')) {
              unset(
                  $this['is_active'],
                  $this['is_super_admin']
              );
          }
      }

      unset($this['permissions_list'],$this['groups_list']);

      if($this->getObject()->exists()) {

          unset($this['password'],$this['password_again']);

      }

      $this->embedAddress();

      //only provide m2m functioanlity for doctors and technologists 
      //if(!$this->getObject()->getPatient()->getId())
          //$this->embedGroupUserLocations();

      $this->embedPhoneNumbers();
  }
}

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
  }
}

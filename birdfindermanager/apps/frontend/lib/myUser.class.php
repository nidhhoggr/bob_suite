<?php
class myUser extends sfGuardSecurityUser {

    function getLocations() {

        return Doctrine_Query::create()
        ->from('GroupUserLocation gul, gul.Location l')
        ->where('gul.user_id = ?',$this->getId())
        ->execute();

    }
}

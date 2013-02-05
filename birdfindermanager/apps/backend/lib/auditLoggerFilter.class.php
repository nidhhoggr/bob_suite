<?php

class auditLoggerFilter extends sfFilter {

    public function execute ($filterChain) {

        $context = $this->getContext();

        $action = $context->getActionName();

        $module = $context->getModuleName();

        if(in_array($action,$this->loggableActions()) && !in_array($module,$this->ignorableModules())) {
            $log['user_id'] = $context->getUser()->getId();
            $params = $context->getRequest()->getParameterHolder()->getAll();
            
            foreach($this->removableParams() as $rp) {
                foreach($params as $k=>$p) {
                    if(is_array($p))
                        unset($params[$k][$rp]);
                    else
                        unset($params[$rp]);
                }
            }

            $log['object_id'] = $params['id'];
     
            if(array_key_exists($module,$this->moduleTranslations()))
              $module = $this->moduleTranslations($module);
            $log['module'] =    $module;
            $log['action'] =    $params['action'];
            unset($params['id'],$params['action'],$params['module']);
            $log['params'] =    serialize($params);

            $al = new AuditLogger();
            $al->fromArray($log);
            $al->save();
        }
       
        $filterChain->execute();
 
    }

    private function loggableActions() {

      return array('create','update','delete');

    }

    private function removableParams() {

        return array('_csrf_token','sf_format');

    }

    private function ignorableModules() {
        return array('audit_logger');
    }

    private function moduleTranslations($key = null) {
        $array =  array('sfGuardUser'=>'sf_guard_user');
        return (isset($key)) ? $array[$key] : $array;
    }
}

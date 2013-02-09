<?php

require_once(PEAR_LIB . 'Cache.php');

class CachePEAR {

    var $bEnabled = false; // APC enabled?
    var $cache;
    var $container = 'Container';
    var $cache_dir = '/../cache/';

    // constructor
    function CachePEAR($dir='store') {
        $this->cache = new Cache('file',array('cache_dir'=>dirname(__FILE__) . $this->cache_dir.$dir));
        $this->bEnabled = $this->cache->getCaching();
    }

    // get data from memory
    function getData($sKey) {
        return $this->cache->get($sKey);
    }

    // save data to memory
    function setData($sKey, $vData, $ttl = 600) {
        return $this->cache->save($sKey, $vData, $ttl);
    }

    // delete data from memory
    function delData($sKey) {
        return $this->cache->get($sKey) ? $this->cache->remove($sKey) : true;
    }
}
?>

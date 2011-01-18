<?php
class MyCache {
   private $cache;

  function  __construct()  {
    $this->cache = new Memcache();

    // you can replace localhost by Memcached server IP addr and port no.
    $this->cache->connect('localhost', 10987);
  }


  function get_data($key)  {
    $data = $this->cache->get($key);


    if($data != null)
      return $data;

    else {

      if($this->cache->getResultCode() == Memcached::RES_NOTFOUND) {
        //do the databse query here and fetch data
        $this->cache->set($key,$data_returned_from_database);

      } else {
        error_log('No data for key '.$key);
      }
    }


  }


}

$cache = new MyCache();
$cache->get_data('foo');

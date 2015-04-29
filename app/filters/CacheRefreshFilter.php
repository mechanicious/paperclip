<?php 

class CacheRefreshFilter 
{
    public function filter() 
    {
        $this->setupCacheRefresh();
    }

    protected function setupCacheRefresh() 
    {
      DB::listen(function($query) {
      if(startsWith($query, ['update', 'create', 'delete']))
        \Cache::flush();
      });
    }
}
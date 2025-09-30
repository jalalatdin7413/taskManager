<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

trait ClearCache
{
    /**
     * Clear cache by keys.
     *
     * @param array $keys
     * @return void
     */
    public function clear(array $keys): void
    {
        foreach ($keys as $key) {
            foreach (Redis::keys("*{$key}*") as $cacheValue) {
                Cache::forget(substr($cacheValue, strripos($cacheValue, $key)));
            }
        }
    }
}

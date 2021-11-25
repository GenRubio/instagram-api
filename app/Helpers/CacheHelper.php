<?php

namespace App\Helpers;

use App\Models\Page;
use App\Models\PresetEmail;
use App\Models\Rgpd;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CacheHelper
{
    /**
     * Or use cache helper https://laravel.com/docs/6.x/cache#the-cache-helper
     */

    static protected $defaultCacheTtl = 7200; // 2 hours

    public static function cacheKeyExists($key)
    {
        return Cache::has($key);
    }

    public static function getCacheKey($key)
    {
        return Cache::get($key);
    }

    /*
     * No funciona porqué al pasarle la query la ejecuta y pierde el sentido, utilizar helper de cache
     *  cache()->remember('key', 'seconds', function () {
            return 'query';
        });
    public static function storeInCache($key, $query, $ttl = null)
    {
        $ttl = $ttl ?? env('CACHE_DEFAULT_TTL', self::$defaultCacheTtl);
            return $query;
        });
    }
    */


    /**
     * @param $key
     * @param $query
     * @param null $ttl: If is null, the item will be stored indefinitely
     * @return bool
     */
    public static function forceStoreInCache($key, $query, $ttl = null)
    {
        return Cache::put($key, function () use ($query) {
            return $query;
        }, $ttl);
    }

    public static function deleteItemFromCache($key)
    {
        return Cache::forget($key);
    }

    public static function clearCache()
    {
        return Cache::flush();
    }
}

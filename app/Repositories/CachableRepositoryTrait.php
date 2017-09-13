<?php
namespace App\Repositories;

use Cache;
use Utility;
use Illuminate\Support\Collection;

trait CachableRepositoryTrait
{
    /**
     * @param null $key
     * @param int $minutes
     * @return Collection
     */
    public function get($key = null, $minutes = 2)
    {
        $cache_key = !is_null($key) ? $key : $this->key;
        $data = null;
        $data = Cache::remember(
            $cache_key,
            $minutes,
            function () {
                return $this->fetch([
                    'campaign_last_sync' => null, // date('Y-m-d H:i:s')
                    'merchant_last_sync' => null, // date('Y-m-d H:i:s')
                    'coupon_last_sync' => null, // date('Y-m-d H:i:s')
                    'location_last_sync' => null, // date('Y-m-d H:i:s')
                    'type' => 'CAMPAIGN'
                ]);
        });

        if(!$data) {
            return collect([]);
        }

        return $data;
    }

    /**
     * @param $id
     * @param Collection|null $items
     * @param string $column
     * @param null $key
     * @return mixed
     */
    public function getById($id, Collection $items = null, $key = null, $column = 'id')
    {
        if(is_null($items)) {
            $items = $this->get($key);
        }

        return $items->filter(function($item, $key) use ($id, $column) {
                return ($item->{$column} == $id);
            })
            ->first();
    }

    /**
     * @param Collection $items
     * @param null $key
     * @param int $minutes
     */
    public function store($items, $key = null, $minutes = 2)
    {
        $cache_key = !is_null($key) ? $key : $this->key;
        Cache::remember(
            $cache_key,
            Utility::addMinutes($minutes),
            function() use($items){
                return $items;
            }
        );
    }

    /**
     * @param array $configs
     */
    public function initializeConfigs(array $configs)
    {
        $this->configs = $configs;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setConfigByKey($key, $value)
    {
        $this->configs[$key] = $value;
    }

    /**
     * @param $key
     * @param string $identifier
     * @param bool $use_session_key
     * @return string
     */
    public function getKey($key, $identifier='sessid', $use_session_key = true)
    {
        if(!$use_session_key) {
            return $key;
        }

        if ($identifier == 'sessid') {
            $identifier = '_'.$this->configs['sessid'];
        }

        $identifier = '_'.ltrim($identifier, '_');
        return $key.$identifier;
    }

    /**
     * @param $key
     * @param string $identifier
     * @param bool $use_session_key
     * @return string
     */
    protected function getCacheKey($key, $identifier='sessid', $use_session_key = true)
    {
        return $this->getKey($key, $identifier, $use_session_key);
    }




}
<?php

namespace App\Models;

use Cache;
use App\Helpers\Utility;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $timestamps = false;

    protected $table = 'clients';
    protected $configs = [];
    protected $guarded = [];

    /**
     * Get the meta tags for the client.
     */
    public function metaTags()
    {
        return $this->hasMany(MetaTag::class);
    }

    /**
     * @param null $key
     * @return array|mixed
     */
    public function configs($key = null)
    {
        if(func_num_args() == 0) {
            return $this->configs;
        }

        return $this->configs[$key];
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function getClient(Request $request)
    {
        $client = Cache::rememberForever('client', function() use($request) {
            return self::where([
                'base_url' => rtrim($request->root()).'/'
            ])
                ->with(['metaTags'])
                ->first();
        });

        // throw 404 exception if the client is not present
        if(!$client) {
            abort(404, 'Invalid request');
        }

        $client->setConfigs();

        return $client;
    }

    /**
     * @return mixed
     */
    public function ogMetaTags()
    {
        return $this->metaTags->filter(function ($tag) {
            return ($tag->type === MetaTag::META_OPEN_GRAPH);
        })->first();
    }

    /**
     * @return mixed
     */
    public function twitterMetaTags()
    {
        return $this->metaTags->filter(function ($tag) {
            return ($tag->type === MetaTag::META_TWITTER);
        })->first();
    }

    /**
     * @return mixed
     */
    public function siteMetaTags()
    {
        return $this->metaTags->filter(function ($tag) {
            return ($tag->type === MetaTag::META_SITE);
        })->first();
    }

    /**\
     * @param string $type
     * @return bool
     */
    public function metaTagByProvider($type = 'og')
    {
        if(!$this->socialMetaTags->isEmpty()) {
            return $this->socialMetaTags->get($type);
        }

        return false;
    }

    /**
     * @param $element
     * @param string $type
     * @return mixed
     */
    public function metaTagByElement($element, $type = 'og')
    {
        if ($meta = $this->metaTagByProvider($type)) {
            return $meta->{$element};
        }
        return $meta;
    }

    /**
     * @return array
     */
    public function getMetaTags()
    {
        return $this->socialMetaTags;
    }

    /**
     * Setter function for meta tags
     */
    public function setMetaTags()
    {
        $this->socialMetaTags = $this->metaTags->groupBy('type')
            ->map(function ($item){
                return $item->first();
            });
    }

    /**
     * @param $identifier
     * @param $prefix
     * @return string
     */
    public function getSignature($identifier=null, $prefix = null)
    {
        if(is_null($prefix)) {
            $prefix = 'sprooki_user';
        }

        if(is_null($identifier)) {
            $identifier = session()->get('sprooki_userid');
        }

        $fingerprint = Utility::fingerprint([
            $identifier,
            $this->segment
        ]);
        $fingerprint = '_'.ltrim($fingerprint, '_');
        return $prefix.$fingerprint;
    }

    /**
     * @param array $user
     */
    public function putClientUserInSession(array $user)
    {
        session($user);
    }

    /**
     * @return $this
     */
    protected function setConfigs()
    {
        $this->configs = [
            'endpoint' => $this->sprooki_endpoint,
            'publicKey' => $this->sprooki_publickey,
            'privateKey' => $this->sprooki_privatekey,
            'version' => $this->sprooki_api_version
        ];

        $this->setMetaTags();

        return $this;
    }
}
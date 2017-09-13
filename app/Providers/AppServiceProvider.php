<?php

namespace App\Providers;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (auth()->check()) {
            $user = auth()->user();
            session()->put('sprooki_sessid', $user->sessid);
            session()->put('sprooki_deviceid', $user->email);
            session()->put('sprooki_devicetype', 'WEB');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

//        $this->app->bind(
//            \App\Repositories\EntityRepositoryInterface::class, function ($app) {
//            $user_repository = new \App\Repositories\UserRepository(new \App\Adapters\Sprooki);
//            $user_repository->initializeConfigs($this->getClient()->configs());
//            return $user_repository;
//        });
//
//        $this->app->bind(
//            \App\Repositories\EntityRepositoryInterface::class, function ($app) {
//            $user_repository = new \App\Repositories\UserRepository(new \App\Adapters\Sprooki);
//            $user_repository->initializeConfigs($this->getClient()->configs());
//            return $user_repository;
//        });
//
//
//        $this->app->bind(\App\Adapters\RequestAdapterInterface::class, \App\Adapters\Sprooki::class);

        /*TODO this part is not working, hence running prepauth for each of the IcC*/
//        $this->app->bind(\App\Contracts\SprookiConnectorContract::class, function ($app) {
//            $client = $this->getClient();
//            $connector = $this->app->make(\App\Contracts\Repositories\StandardSprookiConnector::class);
//            $connector->prepAuth($client);
//            return $connector;
//        });

        $this->app->bind(\App\Contracts\Models\UserContract::class, \App\Repositories\Models\UserRepository::class);

        $this->app->bind(\App\Contracts\Repositories\UserContract::class, function ($app) {
            $client = $this->getClient();
            $connector = $this->app->make(\App\Repositories\SprookiConnectors\UserRepository::class);
            $connector->prepAuth($client);
            return $connector;
        });

        $this->app->bind(\App\Contracts\Repositories\CampaignContract::class, function(){
            $client = $this->getClient();
            $connector = $this->app->make(\App\Repositories\SprookiConnectors\CampaignRepository::class);
            $connector->prepAuth($client);
            return $connector;
        });
    }

    protected function getClient()
    {
        return (new \App\Models\Client)->getClient(Request::instance());
    }

    private function __initiateConnector($className)
    {
        $client = $this->getClient();
        $connector = $this->app->make($className);
        $connector->prepAuth($client);
        return $connector;
    }
}

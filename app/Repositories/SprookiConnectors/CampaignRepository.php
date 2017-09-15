<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 13/09/2017
 * Time: 2:46 PM
 */

namespace App\Repositories\SprookiConnectors;


use App\Contracts\Repositories\CampaignContract;

class CampaignRepository extends CampaignContract
{
    public function getActiveCampaigns(array $data = [])
    {
        /*init configuration*/
        $this->config();

        $data = $this->__prepUserInfo($data);

        /*set up parameters*/
        $this->params('GetActiveCampaigns', $data);

        $result = $this->call();

        return $result->data;
    }

    private function __prepUserInfo(array $data)
    {
        $user = null;
        if (!is_null(auth()->user())) {
            $user = auth()->user();
        }

        array_set($data, 'deviceid', !is_null($user) ? $user->email : array_get($data, 'useremail'));
        array_set($data, 'accounttype', 'EMAIL');
        return $data;
    }
}
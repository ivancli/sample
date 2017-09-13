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

    public function call()
    {
        $response = $this->curl->to($this->endpoint)
            ->withHeaders($this->headers)
            ->withData($this->params)
            ->returnResponseObject()
            ->asJson()
            ->post();
    }
}
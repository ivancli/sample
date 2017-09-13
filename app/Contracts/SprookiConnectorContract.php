<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 13/09/2017
 * Time: 2:21 PM
 */

namespace App\Contracts;


use App\Models\Client;

interface SprookiConnectorContract
{
    /**
     * set up configuration before sending request to Sprooki
     * @return mixed
     */
    public function config();

    /**
     * set up parameters before sending request to Sprooki
     * @param $request
     * @param $params
     * @return mixed
     */
    public function params($request, $params);

    public function prepAuth(Client $client);

    /**
     * sending post request to sprooki api
     * @return mixed
     */
    public function call();
}
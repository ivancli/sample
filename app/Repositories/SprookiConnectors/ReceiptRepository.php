<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 15/09/2017
 * Time: 12:32 PM
 */

namespace App\Repositories\SprookiConnectors;


use App\Contracts\Repositories\ReceiptContract;

class ReceiptRepository extends ReceiptContract
{

    public function uploadImage(array $data = [])
    {
        /*init configuration*/
        $this->config();

        $data = $this->__prepUserInfo($data);

        /*set up parameters*/
        $this->params('UploadImage', $data);
        $result = $this->call();
        dd($result);
        return $result->data;
    }

    public function getReceipts(array $data = [])
    {
        /*init configuration*/
        $this->config();

        $data = $this->__prepUserInfo($data);

        array_set($data, 'lastSyncTime', array_get($data, 'coupon_last_sync', null));

        /*set up parameters*/
        $this->params('GetReceipts', $data);

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
//        array_set($data, 'accounttype', 'EMAIL');
        return $data;
    }
}
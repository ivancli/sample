<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 15/09/2017
 * Time: 12:53 PM
 */

namespace App\Services\SprookiConnectors;


use App\Contracts\Repositories\ReceiptContract;

class ReceiptService
{
    protected $receiptRepo;

    public function __construct(ReceiptContract $receiptContract)
    {
        $this->receiptRepo = $receiptContract;
    }

    public function get(array $data = [])
    {
        $receipts = $this->receiptRepo->getReceipts();
        return $receipts;
    }

    public function getById($receipt_id)
    {
        return null;
    }

    public function upload(array $data = [])
    {
        $params = [
            "image" => array_get($data, 'content'),
            "type" => "RECEIPT",
        ];
        $receipt = $this->receiptRepo->uploadImage($params);
        return $receipt;
    }
}
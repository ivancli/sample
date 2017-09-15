<?php

namespace App\Http\Controllers;

use App\Services\SprookiConnectors\ReceiptService;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    protected $request;
    protected $receiptService;

    public function __construct(Request $request, ReceiptService $receiptService)
    {
        $this->request = $request;

        $this->receiptService = $receiptService;

    }

    public function index()
    {
        $receipts = $this->receiptService->get();
        return view('receipts.index')->with(compact(['receipts']));
    }

    public function create()
    {
        return view('receipts.create');
    }

    public function store()
    {
        /*TODO validation needed here*/

        $file = $this->request->file('receipt');
        $content = file_get_contents($file->getRealPath());
        $content = base64_encode($content);

        $receipt = $this->receiptService->upload(compact(['content']));
        return route('receipts.show');
    }

    public function show($receipt_id)
    {
        $receipt = $this->receiptService->getById($receipt_id);
        return view('receipts.show')->with(compact(['receipt']));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        return view('campaigns.index');
    }

    public function show()
    {
        return view('campaigns.details', []);
    }

    public function download()
    {
        return view('campaigns.download');
    }


    public function store()
    {
        return 'post download';
    }
}

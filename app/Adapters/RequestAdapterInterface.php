<?php

namespace App\Adapters;

interface RequestAdapterInterface
{
    public function call($request, $params);
}
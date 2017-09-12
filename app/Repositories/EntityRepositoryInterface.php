<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface EntityRepositoryInterface
{
    public function get($key = null);

    public function fetch(array $input);

    public function getById($id, Collection $items = null, $key = null, $column = 'id');

    public function store($items, $key, $minutes);

    public function update(array $items);

    public function initializeConfigs(array $configs);
}
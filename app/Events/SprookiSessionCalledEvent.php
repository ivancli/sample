<?php

namespace App\Events;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Event;

class SprookiSessionCalledEvent extends Event
{
    use SerializesModels;

    protected $client;

    protected $request;

    protected $repository;

    /**
     * Create a new event instance.
     *
     * @param $repository
     * @param $request
     * @param $client
     */
    public function __construct(RepositoryInterface $repository, Request $request, Client $client)
    {
        $this->client = $client;
        $this->request = $request;
        $this->repository = $repository;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }

    /**
     * @return \App\Repositories\RepositoryInterface
     */
    public function repository()
    {
        return $this->repository;
    }

    /**
     * @return \Illuminate\Http\Request
     */
    public function request()
    {
        return $this->request;
    }

    /**
     * @return \App\Models\Client
     */
    public function client()
    {
        return $this->client;
    }
}

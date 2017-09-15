<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 12/09/2017
 * Time: 4:20 PM
 */

namespace App\Listeners\Auth;


use App\Contracts\Models\UserContract;
use App\Services\MailingAgentService;
use Illuminate\Auth\Events\Registered;

class RegisterEventSubscriber
{

    protected $mailingAgentService;

    public function __construct(MailingAgentService $mailingAgentService)
    {
        $this->mailingAgentService = $mailingAgentService;
    }

    public function onRegistered($event)
    {
        $user = $event->user;
        $this->mailingAgentService->store($user);
    }

    public function subscribe($events)
    {
        $events->listen(Registered::class, 'App\Listeners\Auth\RegisterEventSubscriber@onRegistered');
    }
}
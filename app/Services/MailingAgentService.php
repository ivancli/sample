<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 14/09/2017
 * Time: 2:15 PM
 */

namespace App\Services;


use App\Contracts\Repositories\MailingAgentContract;
use App\Models\User;

class MailingAgentService
{
    protected $mailingAgentRepo;

    public function __construct(MailingAgentContract $mailingAgentContract)
    {
        $this->mailingAgentRepo = $mailingAgentContract;
    }

    public function store(User $user)
    {
        $this->mailingAgentRepo->storeSubscriber([
            'EmailAddress' => $user->email,
            'Name' => "{$user->given_name} {$user->family_name}",
            'CustomFields' => [
                $this->__custom_field('PhoneNumber', $user->phone_no),
                $this->__custom_field('Gender', $user->gender),
                $this->__custom_field('DateofBirth', $user->dob),
                $this->__custom_field('AgeRange', $user->age_range),
                $this->__custom_field('SessionID', $user->sessid),
            ],
            'Resubscribe' => true,
            'RestartSubscriptionBasedAutoresponders' => true,
        ]);
    }

    public function update(User $user)
    {
        $this->mailingAgentRepo->updateSubscriber($user->email, [
            'EmailAddress' => $user->email,
            'Name' => "{$user->given_name} {$user->family_name}",
            'CustomFields' => [
                $this->__custom_field('PhoneNumber', $user->phone_no),
                $this->__custom_field('Gender', $user->gender),
                $this->__custom_field('DateofBirth', $user->dob),
                $this->__custom_field('AgeRange', $user->age_range),
                $this->__custom_field('SessionID', $user->sessid),
            ],
            'Resubscribe' => true,
            'RestartSubscriptionBasedAutoresponders' => true,
        ]);
    }

    public function sendForgotPasswordEmail(array $data)
    {
        $result = $this->mailingAgentRepo->sendTransactionalEmail([
            "To" => [
                array_get($data, 'email')
            ],
            "CC" => null,
            "Data" => [
                "token" => array_get($data, 'token'),
                "email" => array_get($data, 'email'),
            ]
        ]);
        return $result;
    }

    private function __custom_field($key, $value)
    {
        $data = [
            'Key' => $key,
            'Value' => $value,
        ];
        if (is_null($value)) {
            array_set($data, 'Clear', true);
        }
        return $data;
    }
}
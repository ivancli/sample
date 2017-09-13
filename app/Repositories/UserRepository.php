<?php

namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Collection;
use App\Adapters\RequestAdapterInterface;
use App\Services\Auth\AuthDataProviderTrait;
use App\Exceptions\SprookiRequestException as RequestException;

class UserRepository implements EntityRepositoryInterface
{
    use AuthDataProviderTrait, CachableRepositoryTrait;

    protected $connection = null;
    protected $configs = [];

    public function __construct(RequestAdapterInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Fetches data through API
     *
     * @param array $input
     */
    public function fetch(array $input)
    {
    }

    /**
     * Fetches all data from the storage,
     * if key present, fetches data
     * based on the key
     *
     * @param null $key
     */
    public function get($key = null)
    {
    }

    public function getById($id, Collection $items = null, $key = null, $column = 'id')
    {
    }

    public function store($items, $key, $minutes)
    {
    }

    public function update(array $items)
    {
    }

    public function initializeConfigs(array $configs)
    {
        $this->configs = $configs;
    }

    /**
     * @param array $credentials
     * @return Collection
     * @throws RequestException
     */
    public function signIn(array $credentials)
    {
        try {
            $user = $this->connection
                ->signIn($this->validatedCredentials($credentials), $this->configs);
            return $this->getUser($user);

        } catch (RequestException $e) {
            throw $e;
        }
    }

    public function signOut(User $user)
    {
        try {
            $params = $this->__mergeSessionParam([], $user);
            $result = $this->connection->signOut($params, $this->configs);
            return $result;
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return Collection
     * @throws RequestException
     */
    public function register(array $data)
    {
        try {
//             $data['email'] = 'admin041@microsite.com';
            $user = $this->connection
                ->createUser(
                    $this->validatedCredentials($data),
                    $this->configs
                );
            return $this->getUser($user);
        } catch (RequestException $e) {
            throw $e;
        }
    }

    protected function validatedCredentials(array $credentials)
    {
        foreach ($credentials as $key => $value) {
            if ($key == 'email') {
                $credentials['useremail'] = $value;
                unset($credentials[$key]);
            }

            if (!array_key_exists('accounttype', $credentials)) {
                $credentials['accounttype'] = 'EMAIL';
            }

            if (!array_key_exists('deviceid', $credentials)) {
                $credentials['deviceid'] = isset($credentials['email']) ?
                    $credentials['email'] : $credentials['useremail'];
            }

            if (!array_key_exists('devicetype', $credentials)) {
                $credentials['devicetype'] = 'WEB';
            }
        }

        return $credentials;
    }

    private function __mergeSessionParam(array $params, User $user)
    {
        $newParams = [
            'sessid' => $user->sessid,
            'deviceid' => $user->email,
            'devicetype' => 'WEB',
            'accounttype' => 'EMAIL',
        ];
        $params = array_merge($params, $newParams);

        return $params;
    }

}
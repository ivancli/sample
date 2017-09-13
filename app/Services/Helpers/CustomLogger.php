<?php

namespace App\Services\Helpers;

use App\Helpers\Utility;
use DateTimeZone;
use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;

class CustomLogger extends MonologLogger
{
    protected $message;

    /**
     * The Log files.
     *
     * @var array
     */
    protected $log_files = [
        'debug'     => 'debug.log',
        'info'      => 'info.log',
        'warning'   => 'warning.log',
        'error'     => 'error.log',
        'alert'     => 'alert.log'
    ];

    const DEBUG_LEVEL = 'debug';
    const INFO_LEVEL = 'info';
    const WARNING_LEVEL = 'warning';
    const ERROR_LEVEL = 'error';
    const ALERT_LEVEL = 'alert';

    public function __construct($name, $level = 'DEBUG', $path = null, array $processors = [])
    {
        static::$timezone = new DateTimeZone(config('app.timezone'));
        parent::__construct($name, [], $processors);
    }

    /**
     * @param int $level
     * @param string $message
     * @param array $context
     */
    public function addRecord($level, $message, array $context = [])
    {
        if ( ! is_int($level)) {
            $level = static::getLevels()[strtoupper($level)];
        }
        parent::addRecord($level, $message, $context);
    }

    /**
     * @param Request $request
     * @param $scope
     * @param array $data
     * @param string $source
     */
    public function infoLog(Request $request, $scope, array $data = [], $source = 'sprooki')
    {
        $this->createLog($request, $scope, $data, $source, self::INFO_LEVEL);
    }

    /**
     * @param Request $request
     * @param $scope
     * @param array $data
     * @param string $source
     */
    public function debugLog(Request $request, $scope, array $data = [], $source = 'sprooki')
    {
        $this->createLog($request, $scope, $data, $source, self::DEBUG_LEVEL);
    }

    /**
     * @param Request $request
     * @param $scope
     * @param array $data
     * @param string $source
     */
    public function errorLog(Request $request, $scope, array $data = [], $source = 'sprooki')
    {
        $this->createLog($request, $scope, $data, $source, self::ERROR_LEVEL);
    }

    /**
     * @param Request $request
     * @param $scope
     * @param array $data
     * @param string $source
     */
    public function warningLog(Request $request, $scope, array $data = [], $source = 'sprooki')
    {
        $this->createLog($request, $scope, $data, $source, self::WARNING_LEVEL);
    }

    /**
     * @param Request $request
     * @param $scope
     * @param array $data
     * @param string $source
     */
    public function alertLog(Request $request, $scope, array $data = [], $source = 'sprooki')
    {
        $this->createLog($request, $scope, $data, $source, self::ALERT_LEVEL);
    }

    /**
     * @param Request $request
     * @param $scope
     * @param $data
     * @param $source
     * @param $level
     */
    public function createLog(Request $request, $scope, $data, $source, $level)
    {
        $this->create(
            $this->buildMessage($request, $scope, $data, $source),
            $this->getFilePath($level),
            $level
        );
    }

    /**
     * @param array $message
     * @param $path
     * @param $level
     * @param array $context
     */
    public function create(array $message, $path, $level, $context=[])
    {
        $this->pushHandler(new StreamHandler($path, $level));
        $this->addRecord($level, json_encode($message), $context);
    }

    /**
     * @param Request $request
     * @param $scope
     * @param array $data
     * @param string $source
     * @return array
     */
    public function buildMessage(Request $request, $scope, array $data = [], $source = 'sprooki')
    {
        if($user = $request->user()) {
            return [
                'user' => [
                    'id' => $user->getAuthIdentifier(),
                    'deviceid' => $user->sprooki_deviceid,
                    'email' => $user->email
                ],
                'data' => $data,
                'api' => [
                    'scope' => $scope,
                    'source' => $source
                ]
            ];
        }

        return [
            'data' => $data,
            'api' => [
                'scope' => $scope,
                'source' => $source
            ]
        ];

    }

    /**
     * @param $type
     * @return string
     */
    private function getFilePath($type)
    {
        $file_time_stamp = Utility::parseDateToString(Utility::now(), 'dmY');
        $prefix = config('customlogger.connections.file.prefix');
        $destination = rtrim(config('customlogger.connections.file.location'), '/');

        $file = $file_time_stamp.'.'.$prefix.'-'.$type.'.log';
        if(!is_dir($destination)) {
            // force create the path recursively.
            @mkdir($destination, 0775, true);
        }

        $path = rtrim($destination).'/'.$file;

        if (!file_exists ($path)) {
            @fopen($path, 'w+');
        }

        return $path;
    }

}
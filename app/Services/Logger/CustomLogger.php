<?php

namespace App\Services\Logger;

use App\Helpers\Utility;
use Illuminate\Log\Writer;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;
use Monolog\Handler\RotatingFileHandler;

class CustomLogger extends Writer
{
    protected $config;
    protected $logLevel;
    protected $logPath;
    protected $logPaths;
    protected $maxFiles = 0;
    protected $logger = null;
    protected $prefix = '';

    public function __construct()
    {
        $this->config = config('customlogger');
        $this->logPaths = $this->config['log_level'][$this->config['log_type']];

        parent::__construct(new MonologLogger(strtolower(config('app.name'))));
    }

    public function logForApplication($name)
    {
        $this->prefix = $name;
    }

    /**
     * Log a error message to the logs.
     * If syslog overrites is set,
     * logs the error message in syslog
     *
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function error($message, array $context = [])
    {
        $this->configureHandler($this->logType(__FUNCTION__));

        if(true === $this->config['syslog_overrides']) {
            $this->useSyslog(
                strtolower(config('app.name')),
                $this->logType(__FUNCTION__)
            );
        }

        $this->write($this->logType(__FUNCTION__), $message, $context);
    }

    /**
     * Log a debug message to the logs.
     *
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function debug($message, array $context = [])
    {
        $this->configureHandler($this->logType(__FUNCTION__));

        $this->write($this->logType(__FUNCTION__), $message, $context);
    }

    /**
     * Log a info message to the logs.
     *
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function info($message, array $context = [])
    {
        $this->configureHandler($this->logType(__FUNCTION__));

        $this->write($this->logType(__FUNCTION__), $message, $context);
    }

    /**
     * Log a warning message to the logs.
     *
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function warning($message, array $context = [])
    {
        $this->configureHandler($this->logType(__FUNCTION__));

        $this->write($this->logType(__FUNCTION__), $message, $context);
    }

    /**
     * Configure the Monolog handlers for the application.
     *
     * @param $type
     */
    protected function configureHandler($type)
    {
        $this->setLogLevel($type);

        $this->setLogPath($type);

        $this->{'configure'.ucfirst($this->config['log_type']).'Handler'}();
    }

    /**
     * Configure the Monolog handlers for the application.
     *
     * @return void
     */
    protected function configureSingleHandler()
    {
        $this->useFiles(
            $this->logPath() . '/'
            . (($this->prefix !='') ? $this->prefix. '/':'')
            . key($this->logPaths)
            . '.log', $this->logLevel()
        );
    }

    /**
     * Configure the Monolog handlers for the application.
     *
     */
    protected function configureDailyHandler()
    {
        $this->useDailyFiles(
            $this->logFileName(),
            $this->maxFiles(),
            strtolower($this->logLevel())
        );
    }

    /**
     * Overriding register a single file log handler.
     *
     * @param  string  $path
     * @param  string  $level
     * @return void
     */
    public function useFiles($path, $level = 'debug')
    {
        // just clear the existing handler from the stack
        if(!empty($this->monolog->getHandlers())){
            $this->monolog->popHandler();
        }

        $this->monolog->pushHandler(
            $handler = new StreamHandler(
                $path,
                $this->parseLevel($level)
            )
        );

        $handler->setFormatter($this->getDefaultFormatter());
    }

    /**
     * Overriding register a daily file log handler.
     *
     * @param  string  $path
     * @param  int     $days
     * @param  string  $level
     * @return void
     */
    public function useDailyFiles($path, $days = 0, $level = 'debug')
    {
        // just clear the existing handler from the stack
        if(!empty($this->monolog->getHandlers())){
            $this->monolog->popHandler();
        }

        $this->monolog->pushHandler(
            $handler = new RotatingFileHandler($this->logFileName(), $days, $this->parseLevel($level))
        );

        $handler->setFormatter($this->getDefaultFormatter());
    }

    /**
     * Get the name of the log file.
     *
     * @return string
     */
    protected function logFileName()
    {
        if(isset($this->logPaths[$this->logLevel()])) {
            return $this->logPath() . '/'
                . (($this->prefix !='') ? $this->prefix . '/' :'')
                . $this->logLevel()
                . '.log';
        }

        return $this->logPath(). '/' . strtolower(config('app.name')) . '.log';
    }

    /**
     * Configure the Monolog handlers for the application.
     *
     * @return void
     */
    protected function configureSyslogHandler()
    {
        $this->useSyslog(strtolower(config('app.name')), $this->logLevel());
    }

    /**
     * Get the log path for the application.
     *
     * @return mixed
     */
    protected function logPath()
    {
        return $this->logPath;
    }

    /**
     * Get the log level for the application.
     *
     * @return string
     */
    protected function logLevel()
    {
        if ($this->logLevel) {
            return $this->logLevel;
        }

        return 'debug';
    }

    /**
     * Get the maximum number of log files for the application.
     *
     * @return int
     */
    protected function maxFiles()
    {
        return isset($this->maxFiles) ? $this->maxFiles : 0;
    }

    /**
     * Get the log path for the application.
     *
     * @param $type
     */
    protected function setLogPath($type)
    {
        $this->logPath = isset($this->logPaths[$type]) ?
            $this->logPaths[$type]['path'] :
            Utility::multiArraySearch('path', $this->logPaths);
    }

    /**
     * Set the log level for the application.
     *
     * @param $type
     */
    protected function setLogLevel($type)
    {
        $this->logLevel = $type;
    }

    /**
     * Extracts the type of log message
     * specific to this implementation
     *
     * @param $method
     * @return string
     */
    private function logType($method)
    {
        return preg_replace('/Log/', '', $method);
    }

}
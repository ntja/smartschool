<?php

namespace App\Repositories\Util;

use Log;
use Monolog\Handler\StreamHandler;
use Illuminate\Log\Writer as WriteLog;
use Illuminate\Support\Facades\Auth;
use Exception;

class LogRepository extends WriteLog {

    /**
     * This method allows you to customize error handling with Laravel
     * 
     * @param string $level
     * @param string $message
     * @param array $context
     * 
     * @return void
     */
    public function log($level, $message, array $context = []) {
        
        if (!is_string($level)) {
            throw new Exception("Expected string as parameter , " . (is_object($level) ? get_class($level) : gettype($level)) . " found.");
        }

        if (!is_string($message)) {
            throw new Exception("Expected string as parameter , " . (is_object($message) ? get_class($message) : gettype($message)) . " found.");
        }

        if (!is_array($context)) {
            throw new Exception("Expected array as parameter , " . (is_object($context) ? get_class($context) : gettype($context)) . " found.");
        }
        
        //$path = __DIR__ . '/' . env('APP_ENV') . '-' . date('Y-m-d') . '.log';
		$path = __DIR__ . '/../../storage/logs' . env('APP_ENV') . '-' . date('Y-m-d H') . '.log';
        
        parent::useFiles($path, $level);
        
        $user = Auth::user();
        if ($user) {
            $context['user_id'] = $user->id;
        }

        parent::log($level, $message, $context);
    }

    /**
     * This static method is used to write to a log file 
     * 
     * @param string $level
     * @param string $message
     * @param array $context
     * 
     * @return void
     */
    public static function printLog($level, $message, array $context = []){
        
        $monolog = Log::getMonolog();
        $logger = new LogRepository($monolog);
        $logger->log($level, $message, $context);

    }

    /**
     * redefinition of mrthod useFiles 
     * 
     * @param string $path
     * @param string $level
     * 
     * @return void
     */
    public function useFiles($path, $level = 'debug') {
        $this->monolog->pushHandler($handler = new StreamHandler($path, $this->parseLevel($level)));

        $handler->setFormatter($this->getDefaultFormatter());
    }

}

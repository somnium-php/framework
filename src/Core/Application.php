<?php

namespace Somnium\Core;

use Exception;
use Somnium\Core\Concerns\ConfiguresPaths;
use Somnium\Exceptions\PathNotFoundException;

class Application
{
    use ConfiguresPaths;

    /**
     * The Somnium PHP Framework version
     */
    public const string VERSION = '1.0.0';

    /**
     * The current application instance
     */
    protected static Application $instance;

    /**
     * True if the application is running from the console
     */
    protected bool $isConsole;

    /**
     * The start time of the application request
     *
     * The stored value is a UNIX timestamp with microseconds.
     */
    protected string $startedAt;

    /**
     * Gets the server request start time
     *
     * The return value is a UNIX timestamp with microseconds.
     */
    protected function serverRequestStartedAt(): string
    {
        $precision = ini_set('precision', 16);

        $startedAt = (string) $_SERVER['REQUEST_TIME_FLOAT'];

        ini_set('precision', $precision);

        return $startedAt;
    }

    /**
     * Creates a new class instance
     *
     * @throws PathNotFoundException
     */
    public function __construct(string $rootPath)
    {
        static::$instance = $this;

        $this->isConsole = (PHP_SAPI === 'cli');

        $this->startedAt = $this->serverRequestStartedAt();

        $this->setRootPath($rootPath);
    }

    /**
     * Gets the current application instance
     *
     * @throws Exception
     */
    public static function instance(): static
    {
        if (!isset(static::$instance)) {
            throw new Exception('Application instance does not yet exist!');
        }

        return static::$instance;
    }

    /**
     * Returns true if the application is running from the console
     */
    public function isConsole(): bool
    {
        return $this->isConsole;
    }

    /**
     * Gets the start time of the application request
     *
     * The return value is a UNIX timestamp with microseconds.
     */
    public function startedAt(): string
    {
        return $this->startedAt;
    }

    /**
     * Gets the current application request runtime
     *
     * The return value is a UNIX timestamp with microseconds.
     */
    public function runtime(): string
    {
        return bcsub(
            timestamp_micro(),
            $this->startedAt,
            6
        );
    }
}

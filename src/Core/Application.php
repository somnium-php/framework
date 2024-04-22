<?php

namespace Somnium\Core;

use Exception;
use Somnium\Core\Concerns\HandlesPaths;

class Application
{
    use HandlesPaths;

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
     */
    protected string $startedAt;

    /**
     * Creates a new class instance
     */
    public function __construct(string $rootPath)
    {
        static::$instance = $this;

        $this->isConsole = (PHP_SAPI === 'cli');

        $this->startedAt = timestamp_micro(SOMNIUM_START);

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

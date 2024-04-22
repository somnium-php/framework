<?php

use Somnium\Core\Application;

if (!function_exists('app')) {
    /**
     * Gets the current application instance
     */
    function app(): Application
    {
        return Application::instance();
    }
}

if (!function_exists('public_path')) {
    /**
     * Gets the path of the application's public directory
     *
     * Each optional path string provided in ...$paths is merged with the public
     * path using OS-aware directory separators.
     */
    function public_path(string ...$paths): string
    {
        return Application::instance()
            ->publicPath(...$paths);
    }
}

if (!function_exists('root_path')) {
    /**
     * Gets the root path of the application
     *
     * Each optional path string provided in ...$paths is merged with the root
     * path using OS-aware directory separators.
     */
    function root_path(string ...$paths): string
    {
        return Application::instance()
            ->rootPath(...$paths);
    }
}

if (!function_exists('runtime')) {
    /**
     * Gets the current application request runtime
     *
     * The return value is a UNIX timestamp with microseconds.
     */
    function runtime(): string
    {
        return Application::instance()
            ->runtime();
    }
}

if (!function_exists('version')) {
    /**
     * Gets the Somnium PHP Framework version
     */
    function version(): string
    {
        return Application::VERSION;
    }
}

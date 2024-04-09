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

if (!function_exists('app_version')) {
    /**
     * Gets the Somnium PHP Framework version
     */
    function app_version(): string
    {
        return Application::VERSION;
    }
}

if (!function_exists('public_path')) {
    /**
     * Gets the path of the application's public directory
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
     */
    function runtime(): string
    {
        return Application::instance()
            ->runtime();
    }
}

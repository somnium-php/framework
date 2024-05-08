<?php

namespace Somnium\Core;

if (!function_exists('Somnium\Core\join_paths')) {
    /**
     * Joins path strings with OS-aware directory separators
     */
    function join_paths(string $parent, string ...$children): string
    {
        $path = rtrim($parent, DIRECTORY_SEPARATOR);

        foreach ($children as $child) {
            $child = trim($child, DIRECTORY_SEPARATOR);

            if (!empty($child)) {
                $path .= DIRECTORY_SEPARATOR . $child;
            }
        }

        return $path;
    }
}

if (!function_exists('Somnium\Core\timestamp_micro')) {
    /**
     * Gets the current UNIX timestamp with microseconds
     *
     * If $microtime is provided - from a call to microtime(false) - this
     * function formats and returns that value instead.
     */
    function timestamp_micro(string $microtime = null): string
    {
        if (is_null($microtime)) {
            $microtime = microtime();
        }

        $microtime = explode(' ', $microtime);

        return bcadd($microtime[1], $microtime[0], 6);
    }
}

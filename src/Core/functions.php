<?php

namespace Somnium\Core;

if (!function_exists('Somnium\Core\join_paths')) {
    /**
     * Joins path strings with OS-aware directory separators
     */
    function join_paths(string $parent, string ...$children): string
    {
        $path = rtrim($parent, '\/');

        foreach ($children as $child) {
            $child = trim($child, '\/');

            if ($child) {
                $path .= DIRECTORY_SEPARATOR . $child;
            }
        }

        return $path;
    }
}

if (!function_exists('Somnium\Core\timestamp_micro')) {
    /**
     * Calculates the current timestamp with microseconds
     */
    function timestamp_micro(string $microtime = null): string
    {
        if (!$microtime) {
            $microtime = microtime();
        }

        $microtime = explode(' ', $microtime);

        return bcadd($microtime[1], $microtime[0], 6);
    }
}

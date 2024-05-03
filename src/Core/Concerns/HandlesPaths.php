<?php

namespace Somnium\Core\Concerns;

use Somnium\Exceptions\PathNotFoundException;

use function Somnium\Core\join_paths;

trait HandlesPaths
{
    /**
     * The root path of the application
     */
    protected string $rootPath;

    /**
     * The path of the application's public directory
     */
    protected string $publicPath;

    /**
     * Sets the root path of the application
     *
     * This function also sets additional application-managed paths based on the
     * root path provided.
     *
     * @throws PathNotFoundException
     */
    protected function setRootPath(string $path): void
    {
        if (!is_dir($path)) {
            throw new PathNotFoundException($path, 'application root path');
        }

        $this->rootPath = rtrim(
            realpath($path),
            DIRECTORY_SEPARATOR
        );

        $this->setAdditionalPaths();
    }

    /**
     * Sets additional application-managed paths
     */
    protected function setAdditionalPaths(): void
    {
        $this->publicPath = join_paths($this->rootPath, 'public');
    }

    /**
     * Gets the root path of the application
     *
     * Each optional path string provided in ...$paths is merged with the root
     * path using OS-aware directory separators.
     */
    public function rootPath(string ...$paths): string
    {
        return join_paths($this->rootPath, ...$paths);
    }

    /**
     * Gets the path of the application's public directory
     *
     * Each optional path string provided in ...$paths is merged with the public
     * path using OS-aware directory separators.
     */
    public function publicPath(string ...$paths): string
    {
        return join_paths($this->publicPath, ...$paths);
    }
}

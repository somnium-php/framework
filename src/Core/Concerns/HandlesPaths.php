<?php

namespace Somnium\Core\Concerns;

use Exception;

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
     * @throws Exception
     */
    protected function setRootPath(string $path): void
    {
        if (!is_dir($path)) {
            throw new Exception(
                "Application root path \"$path\" does not exist!"
            );
        }

        $this->rootPath = rtrim(
            realpath($path),
            DIRECTORY_SEPARATOR
        );

        $this->setAdditionalPaths();
    }

    /**
     * Sets additional application paths automatically
     */
    protected function setAdditionalPaths(): void
    {
        $this->publicPath = join_paths($this->rootPath, 'public');
    }

    /**
     * Gets the root path of the application
     */
    public function rootPath(string ...$paths): string
    {
        return join_paths($this->rootPath, ...$paths);
    }

    /**
     * Gets the path of the application's public directory
     */
    public function publicPath(string ...$paths): string
    {
        return join_paths($this->publicPath, ...$paths);
    }
}

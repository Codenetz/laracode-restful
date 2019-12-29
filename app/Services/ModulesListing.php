<?php

namespace App\Services;

/**
 * Class ModulesListing
 * @package App\Services
 */
class ModulesListing
{
    /**
     * @param $moduleName
     * @param $dir
     * @param null $suffix
     * @return array
     */
    public function fetchFiles($moduleName, $dir, $suffix = null)
    {
        $dir = dirname(__DIR__) . '/Modules/' . $moduleName . '/' . $dir;

        return array_map(function ($file) use ($dir, $suffix) {
            return $dir . '/' . basename($file, $suffix);
        }, $this->listFiles($dir, true, false));

    }

    /**
     * @param $moduleName
     * @param $dir
     * @return array
     */
    public function fetchNamespaces($moduleName, $dir)
    {
        return array_map(function ($file) use ($moduleName, $dir) {
            return 'App\Modules\\' . $moduleName . '\\' . $dir . '\\' . basename($file, '.php');
        }, $this->listFiles(dirname(__DIR__) . '/Modules/' . $moduleName . '/' . $dir, true, false));
    }

    /**
     * @return array
     */
    public function fetchModules()
    {
        return $this->listFiles(dirname(__DIR__) . '/Modules', false, true);
    }

    /**
     * @param $directory
     * @return array
     */
    public function listFiles($directory, $includeFiles = true, $includeDirectories = true)
    {
        if (!is_dir($directory)) {
            return [];
        }

        return array_filter(scandir($directory), function ($item) use ($directory, $includeFiles, $includeDirectories) {
            return !in_array($item, ['.', '..']) && (
                    $includeFiles && is_file($directory . '/' . $item) ||
                    $includeDirectories && is_dir($directory . '/' . $item)
                );
        });
    }
}

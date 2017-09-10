<?php

namespace Mage2\Framework\Theme;

use Illuminate\Support\Collection;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\File;

class ThemeManager
{
    public $themeList;
    public $service;
    public $themeLoaded = false;

    public function __construct(ThemeService $service)
    {
        $this->service = $service;
        $this->themeList = Collection::make([]);
    }

    public function all()
    {
        if ($this->themeLoaded === false) {
            $this->loadThemes();
        }

        return $this->themeList;
    }

    protected function loadThemes()
    {
        $themePath = base_path('themes');


        $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($themePath, RecursiveDirectoryIterator::FOLLOW_SYMLINKS)
        );

        $iterator->setMaxDepth(2);
        $iterator->rewind();

        while ($iterator->valid()) {
            if (($iterator->getDepth() > 1) &&
                $iterator->isFile() &&
                ($iterator->getFilename() == 'register.yaml')) {

                $filePath = $iterator->getPathname();
                $themeRegisterContent = File::get($filePath);
                $assetFolderName = isset($data['asset_folder_name']) ? $data['asset_folder_name'] : "assets";

                $data = Yaml::parse($themeRegisterContent);
                $data['view_path'] = $iterator->getPath() . DIRECTORY_SEPARATOR ."views";
                $data['asset_path'] = $iterator->getPath() . DIRECTORY_SEPARATOR .$assetFolderName;
                $this->themeList->put($data['name'],$data);
            }
            $iterator->next();
        }

        $this->themeLoaded = true;

        return $this;
    }

    public function put($identifier, $themeInfo)
    {
        $this->themeList->put($identifier, $themeInfo);

        return $this;
    }

    public function get($identifier)
    {
        if ($this->themeLoaded === false) {
            $this->loadThemes();
        }

        return $this->themeList->pull($identifier);
    }

    public function getService() {
        return $this->service;
    }

    public function getByPath($path)
    {
        foreach ($this->themeList as $theme  =>  $themeInfo) {
            $path1 = $this->pathSlashFix($path);
            $path2 = $this->pathSlashFix($themeInfo['path']);

            if ($path1 == $path2) {
                $actualTheme = $this->themeList[$theme];
                break;
            }
        }

        return $actualTheme;
    }

    public function pathSlashFix($path)
    {
        return (DIRECTORY_SEPARATOR === '\\') ? str_replace('/', '\\', $path) : str_replace('\\', '/', $path);
    }
}

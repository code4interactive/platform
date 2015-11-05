<?php
/**
 * User: arturbartczak
 * Date: 12.03.15
 * Time: 13:51
 */
namespace Code4\Platform\Components\View;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\NamespacedItemResolver;

class AssetsHelper {

    /**
     * Przechowuje manifest
     *
     * @var JsonManifest
     */
    protected $manifest;

    /**
     * Filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;

        if (empty($this->manifest))
        {
            $manifest_path = $this->getPath('assets.json');
            $this->manifest = new JsonManifest(public_path() . $manifest_path);
        }
    }

    /**
     * Ustawia lokacje z której pobierany jest manifest
     */
    public function setLocation($location) {
        $manifest_path = $this->getPath($location.'/assets.json');
        $this->manifest = new JsonManifest(public_path() . $manifest_path);
    }

    /**
     * Zwraca do szablonu pliki mediów (js, css) odpowiednie dla aktualnego środowiska
     * dla 'local' zwraca wersje deweloperskie wraz a mapą. Dla 'production' pliki z linkiem wersjonowania.
     *
     * @param $url
     * @return string
     */
    public function getUrl($url)
    {
        $directory = dirname($url) . '/';
        $file = basename($url);

        if (env('APP_ENV') == 'production' && array_key_exists($file, $this->manifest->get()))
        {
            return $this->getPath($directory . $this->manifest->get()[$file]);
        } else
        {
            return $this->getPath($directory . $file);
        }
    }

    /**
     * Przeszukuje wszystkie ścieżki w public w poszukiwaniu plików
     */
    public function getPath($key)
    {
        list($section, $relativePath, $extension) = with(new NamespacedItemResolver)->parseKey($key);

        if (env('APP_ENV') == 'production') {
            $paths = [
                public_path() . '/prod' => '/prod',
                public_path() . '' => ''
            ];
        } else {
            $paths = [
                public_path() . '/build' => '/build',
                public_path() . '' => ''
            ];
        }

        foreach ($paths as $path => $url)
        {
            $file = rtrim($path, '/') . '/' . $relativePath . '.' . $extension;

            if ($this->getFilesystem()->exists($file))
            {

                return rtrim($url, '/') . '/' . $relativePath . '.' . $extension;

            }
        }
    }

    /**
     * Generuje prawidłowy URL do wskazanego zasobu w assetsach.
     *
     * @param $url
     * @return string
     */
    public function getFullUrl($url)
    {
        $directory = dirname($url) . '/';
        $file = basename($url);

        if (\App::environment() !== 'local' && array_key_exists($file, $this->manifest->get()))
        {
            return \URL::to('/') . '/' . $this->getPath($directory . $this->manifest->get()[$file]);
        } else
        {
            return \URL::to('/') . '/' . $this->getPath($directory . $file);
        }
    }

    /**
     * Get the filesystem associated
     *
     * @return \Illuminate\Filesystem\Filesystem
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

}
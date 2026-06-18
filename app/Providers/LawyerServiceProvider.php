<?php

namespace App\Modules\Lawyer\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\ModulerSvc\Traits\PathNamespace;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use File;

class LawyerServiceProvider extends ServiceProvider
{
    use PathNamespace;

    protected string $name = 'Lawyer';

    protected string $nameLower = 'lawyer';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerFileSystem();
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->app->register(EventServiceProvider::class);
        //// $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        // $this->commands([]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/'.$this->nameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->nameLower);
            $this->loadJsonTranslationsFrom($langPath);
            $this->app['translator']->addPath($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->name, 'resources/lang'), $this->nameLower);
            $this->loadJsonTranslationsFrom(module_path($this->name, 'resources/lang'));
            $this->app['translator']->addPath(module_path($this->name, 'resources/lang'));
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $relativeConfigPath = config('modules.paths.generator.config.path');
        $configPath = module_path($this->name, $relativeConfigPath);

        if (is_dir($configPath)) {
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($configPath));

            foreach ($iterator as $file) {
                if ($file->isFile() && $file->getExtension() === 'php') {
                    $relativePath = str_replace($configPath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                    $configKey = $this->nameLower . '.' . str_replace([DIRECTORY_SEPARATOR, '.php'], ['.', ''], $relativePath);
                    //$key = ($relativePath === 'config.php') ? $this->nameLower : $configKey;
                    $key = $configKey;

                    $this->publishes([$file->getPathname() => config_path($relativePath)], 'config');
                    $this->mergeConfigFrom($file->getPathname(), $key);
                }
            }
        }
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->nameLower);
        $sourcePath = module_path($this->name, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->nameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->nameLower);

        $this->getPublishableStoragePaths();

        $componentNamespace = $this->module_namespace($this->name, $this->app_path(config('modules.paths.generator.component-class.path')));
        Blade::componentNamespace($componentNamespace, $this->nameLower);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->nameLower)) {
                $paths[] = $path.'/modules/'.$this->nameLower;
            }
        }

        return $paths;
    }

    private function getPublishableStoragePaths()
    {
        $sourcePath = module_path($this->name, 'storage');
        $destinationPath = public_path('modules/' . $this->nameLower);

        // Check if the storage link exists
        $storageLinkPath = public_path('storage');

        if (File::exists($storageLinkPath) && File::isDirectory($storageLinkPath)) {
            // If storage link exists, publish to storage path
            $destinationPath = $storageLinkPath . '/modules/' . $this->nameLower;
        }

        // If the source path exists, proceed with publishing
        if (File::exists($sourcePath) || File::isDirectory($sourcePath)) {
            $this->publishes([
                $sourcePath => $destinationPath,
            ], 'public');
        }
    }

    protected function registerFileSystem(): void
    {
        $disks = config("{$this->nameLower}.config.disks");
        if(!$disks){
            $defaultCnf = config("filesystems.disks.local");
            if($defaultCnf && isset($defaultCnf['root']) && $defaultCnf['root']){
                $defaultCnf['root'] = base_path('app/Modules/'.$this->name.'/storage');
            }
            config([
                'filesystems.disks.'.$this->nameLower.'_local' => $defaultCnf
            ]);
        }
        if($disks && is_array($disks)){
            foreach ($disks as $disk => $config) {
                $modDisk = config('filesystems.disks.'.$this->nameLower.'_'.$disk);
                if(!$modDisk && is_array($config)){
                    config([
                        'filesystems.disks.'.$this->nameLower.'_'.$disk => $config
                    ]);
                }
            }
        }
    }
}

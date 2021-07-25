<?php

namespace TechnoBureau\Blog\Presets;

use Illuminate\Filesystem\Filesystem;
use Laravel\Ui\Presets\Preset;
use Illuminate\Console\Command;
use Symfony\Component\Finder\SplFileInfo;

class BlogPreset extends Preset
{

    protected $command;
    protected $option;

    public function __construct(Command $command)
    {
        $this->command = $command;
        $this->option = $this->command->options();
    }
    /**
     * Install the preset.
     *
     * @return void
     */
    public function install()
    {

        $this->ensureDirectoriesExist();
        static::updateSass();
        $this->exportViews();

        if ( ! isset($this->option['views']) ) {
            $this->exportBackend();
        }
        static::removeNodeModules();
    }
    /**
     * Update the Sass files for the application.
     *
     * @return void
     */
    protected static function updateSass()
    {
        (new Filesystem)->ensureDirectoryExists(resource_path('scss'));

        copy(__DIR__.'/../../bootstrap-stubs/technobureau.scss', resource_path('scss/technobureau.scss'));
        copy(__DIR__.'/../../bootstrap-stubs/blog.scss', resource_path('scss/blog.scss'));

    }
    /**
     * Export the authentication views.
     *
     * @return void
     */
    protected function exportViews()
    {
        $filesystem = new Filesystem();
        collect($filesystem->allFiles(__DIR__.'/../../Auth/bootstrap-stubs'))
            ->each(function (SplFileInfo $file) use ($filesystem) {
		(new Filesystem)->ensureDirectoryExists(base_path('resources/views/'.$file->getrelativePath()));	    
		    //if($file->getrelativePath()!='') //Avoid skipping welcome blade overwritten.
                    $filesystem->copy(
                        $file->getPathname(),
                        base_path('resources/views/'.$file->getrelativePathname())
                    );
            });

    }

    protected function exportBackend()
    {
        
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/../../Auth/stubs/routes.php'),
            FILE_APPEND
        );

        file_put_contents(
            base_path('routes/api.php'),
            file_get_contents(__DIR__.'/../../Auth/stubs/api.php'),
            FILE_APPEND
        );

        $filesystem = new Filesystem();

        collect($filesystem->allFiles(__DIR__.'/../../database'))
            ->each(function (SplFileInfo $file) use ($filesystem) {
                if($file->getrelativePath()!='')
                    $filesystem->copy(
                        $file->getPathname(),
                        base_path('database/'.$file->getrelativePathname())
                    );
            });
    }

    protected function getViewPath($path)
    {
        return implode(DIRECTORY_SEPARATOR, [
            config('view.paths')[0] ?? resource_path('views'), $path,
        ]);
    }

    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function ensureDirectoriesExist()
    {
        if (! is_dir($directory = $this->getViewPath('layouts'))) {
            mkdir($directory, 0755, true);
        }

        if (! is_dir($directory = $this->getViewPath('includes'))) {
            mkdir($directory, 0755, true);
        }
    }


    
}

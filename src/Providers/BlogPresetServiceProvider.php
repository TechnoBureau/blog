<?php

namespace TechnoBureau\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Ui\UiCommand;
use TechnoBureau\Blog\Presets\BlogPreset;

class BlogPresetServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        UiCommand::macro('tb-blog', function (UiCommand $command) {
            foreach ($command->option('option') as  $value)
                $command->addOption($value);
            
            $UiPreset = new BlogPreset($command);
            $UiPreset->install();

            $command->info('TechnoBureau Blog scaffolding installed successfully.');

            $command->comment('Please run "npm install && npm run prod" to compile your fresh scaffolding.');
        });
    }
}

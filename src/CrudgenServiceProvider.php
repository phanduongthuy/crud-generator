<?php

namespace Thuypd\Crudgen;

use Illuminate\Support\ServiceProvider;
use Thuypd\Crudgen\Console\MakeApiCrud;
use Thuypd\Crudgen\Console\MakeCommentable;
use Thuypd\Crudgen\Console\MakeCrud;
use Thuypd\Crudgen\Console\MakeService;
use Thuypd\Crudgen\Console\MakeViews;
use Thuypd\Crudgen\Console\RemoveApiCrud;
use Thuypd\Crudgen\Console\RemoveCommentable;
use Thuypd\Crudgen\Console\RemoveCrud;
use Thuypd\Crudgen\Console\RemoveService;

class CrudgenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //publish config file
        $this->publishes([__DIR__.'/../config/crudgen.php' => config_path('crudgen.php')]);

        //default-theme
        $this->publishes([__DIR__.'/stubs/default-theme/' => resource_path('crudgen/views/default-theme/')]);

        //default-layout
        $this->publishes([__DIR__.'/stubs/default-layout.stub' => resource_path('views/default.blade.php')]);

        //and commentable stub
        $this->publishes([
            __DIR__.'/stubs/commentable/views/comment-block.stub' => resource_path('crudgen/commentable/comment-block.stub')
        ], 'commentable-stub');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/crudgen.php', 'crudgen');

        $this->commands(
            MakeCrud::class,
            MakeViews::class,
            RemoveCrud::class,
            MakeApiCrud::class,
            RemoveApiCrud::class,
            MakeCommentable::class,
            RemoveCommentable::class,
            MakeService::class,
            RemoveService::class
        );
    }
}

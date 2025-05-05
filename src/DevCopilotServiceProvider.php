<?php
namespace Martink\DevCopilot;

use Illuminate\Support\ServiceProvider;
use Martink\DevCopilot\Commands\GptCommand;

class DevCopilotServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/devcopilot.php', 'devcopilot');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/devcopilot.php' => config_path('devcopilot.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                GptCommand::class,
            ]);
        }
    }
}

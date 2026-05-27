<?php

declare(strict_types=1);

namespace Versioon\HtmlCard;

use Versioon\HtmlCard\Console\CardCommand;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class CardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('versioon-html-card', __DIR__ . '/../dist/js/card.js');
            Nova::style('versioon-html-card', __DIR__ . '/../dist/css/card.css');
        });

        if ($this->app->runningInConsole()) {
            $this->commands([CardCommand::class]);
        }
    }
}

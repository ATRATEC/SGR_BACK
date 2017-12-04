<?php

namespace SGR\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'SGR\Events\Event' => [
            'SGR\Listeners\EventListener',
        ],
        'Laravel\Passport\Events\AccessTokenCreated' => [
            'SGR\Listeners\RevokeOldTokens',
        ],
        'Laravel\Passport\Events\RefreshTokenCreated' => [
            'SGR\Listeners\PruneOldTokens',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

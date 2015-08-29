<?php

namespace PS\Providers;

use Illuminate\Support\ServiceProvider;

class PSRepositoryProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(
            \PS\Repositories\Contract\ClientRepository::class, \PS\Repositories\ClientRepositoryEloquent::class
        );
        $this->app->bind(
            \PS\Repositories\Contract\ProjectRepository::class, \PS\Repositories\ProjectRepositoryEloquent::class
        );
        $this->app->bind(
            \PS\Repositories\Contract\ProjectNoteRepository::class, \PS\Repositories\ProjectNoteRepositoryEloquent::class
        );
    }

}

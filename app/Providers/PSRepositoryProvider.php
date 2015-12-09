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
        /*
        * Task
        */
        $this->app->bind(
            \PS\Repositories\Contract\ProjectTaskRepository::class, \PS\Repositories\ProjectTaskRepositoryEloquent::class
        );
        /*
         * Members
         */
        $this->app->bind(
            \PS\Repositories\Contract\ProjectMemberRepository::class, \PS\Repositories\ProjectMemberRepositoryEloquent::class
        );
        /*
         * ProjectFiles
         */
        $this->app->bind(
            \PS\Repositories\Contract\ProjectFileRepository::class, \PS\Repositories\ProjectFileRepositoryEloquent::class
        );
        /*
         * OAuthClient
         */
        $this->app->bind(
            \PS\Repositories\Contract\OAuthClientRepository::class, \PS\Repositories\OAuthClientRepositoryEloquent::class
        );
    }

}

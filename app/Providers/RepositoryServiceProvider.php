<?php

namespace FinancialSystem\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\FinancialSystem\Repositories\BankRepository::class, \FinancialSystem\Repositories\BankRepositoryEloquent::class);
        $this->app->bind(\FinancialSystem\Repositories\BankAccountRepository::class, \FinancialSystem\Repositories\BankAccountRepositoryEloquent::class);
        $this->app->bind(\FinancialSystem\Repositories\BillPayRepository::class, \FinancialSystem\Repositories\BillPayRepositoryEloquent::class);
        $this->app->bind(\FinancialSystem\Repositories\BillReceivedRepository::class, \FinancialSystem\Repositories\BillReceivedRepositoryEloquent::class);
        //:end-bindings:
    }
}

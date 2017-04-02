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
        $this->app->bind(\FinancialSystem\Repositories\ClientRepository::class, \FinancialSystem\Repositories\ClientRepositoryEloquent::class);
        $this->app->bind(\FinancialSystem\Repositories\CategoryRepository::class, \FinancialSystem\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\FinancialSystem\Repositories\CategoryRevenueRepository::class, \FinancialSystem\Repositories\CategoryRevenueRepositoryEloquent::class);
        $this->app->bind(\FinancialSystem\Repositories\CategoryExpenseRepository::class, \FinancialSystem\Repositories\CategoryExpenseRepositoryEloquent::class);
        //:end-bindings:
    }
}

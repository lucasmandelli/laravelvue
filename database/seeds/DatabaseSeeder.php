<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClientsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BankAccountsTableSeeder::class);
        $this->call(BillsPayTableSeeder::class);
        $this->call(BillsReceivedTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
    }
}

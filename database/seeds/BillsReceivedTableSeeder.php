<?php

use Illuminate\Database\Seeder;

class BillsReceivedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\FinancialSystem\Models\BillReceived::class, 10)->create();
    }
}

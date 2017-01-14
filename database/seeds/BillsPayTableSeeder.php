<?php

use Illuminate\Database\Seeder;

class BillsPayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\FinancialSystem\Models\BillPay::class, 10)->create();
    }
}

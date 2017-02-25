<?php

use Illuminate\Database\Seeder;

class BillsPayTableSeeder extends Seeder
{

    use \FinancialSystem\Repositories\GetClientsTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $clients = $this->getClients();

        factory(\FinancialSystem\Models\BillPay::class, 10)
            ->make()
            ->each(function($billPay) use($clients) {

                $client = $clients->random();

                $billPay->client_id = $client->id;
                $billPay->save();

            });
    }
}

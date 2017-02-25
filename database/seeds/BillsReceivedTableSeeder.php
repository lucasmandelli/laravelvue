<?php

use Illuminate\Database\Seeder;

class BillsReceivedTableSeeder extends Seeder
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

        factory(\FinancialSystem\Models\BillReceived::class, 10)
            ->make()
            ->each(function($billReceived) use($clients) {

                $client = $clients->random();

                $billReceived->client_id = $client->id;
                $billReceived->save();

            });
    }
}

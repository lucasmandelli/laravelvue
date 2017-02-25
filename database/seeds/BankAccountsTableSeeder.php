<?php

use Illuminate\Database\Seeder;

class BankAccountsTableSeeder extends Seeder
{

    use \FinancialSystem\Repositories\GetClientsTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $banks = $this->getBanks();
        $clients = $this->getClients();

        $max = 20;
        $bankAccountId = rand(1, $max);

        factory(\FinancialSystem\Models\BankAccount::class, $max)
            ->make()
            ->each(function($bankAccount) use($banks, $bankAccountId, $clients) {

                $bank = $banks->random();

                $client = $clients->random();

                $bankAccount->bank_id = $bank->id;
                $bankAccount->client_id = $client->id;

                $bankAccount->save();

                if($bankAccountId == $bankAccount->id) {
                    $bankAccount->default = true;
                    $bankAccount->save();
                }
            });
    }

    private function getBanks()
    {
        /** @var \FinancialSystem\Repositories\BankRepository $bankRepository */
        $bankRepository = app(\FinancialSystem\Repositories\BankRepository::class);
        $bankRepository->skipPresenter(true);

        return $bankRepository->all();
    }

}

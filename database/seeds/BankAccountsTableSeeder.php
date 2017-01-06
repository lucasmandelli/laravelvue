<?php

use Illuminate\Database\Seeder;

class BankAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \FinancialSystem\Repositories\BankRepository $bankRepository */
        $bankRepository = app(\FinancialSystem\Repositories\BankRepository::class);
        $bankRepository->skipPresenter(true);

        $banks = $bankRepository->all();

        $max = 15;
        $bankAccountId = rand(1, $max);

        factory(\FinancialSystem\Models\BankAccount::class, $max)
            ->make()
            ->each(function($bankAccount) use($banks, $bankAccountId) {

                $bank = $banks->random();

                $bankAccount->bank_id = $bank->id;

                $bankAccount->save();

                if($bankAccountId == $bankAccount->id) {
                    $bankAccount->default = true;
                    $bankAccount->save();
                }
            });
    }
}

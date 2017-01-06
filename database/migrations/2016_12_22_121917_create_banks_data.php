<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** @var \FinancialSystem\Repositories\BankRepository $repository */
        $bankRepository = app(\FinancialSystem\Repositories\BankRepository::class);

        foreach ($this->getData() as $arrBank) {
            $bankRepository->create($arrBank);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $bankRepository = app(\FinancialSystem\Repositories\BankRepository::class);

        $bankRepository->skipPresenter(true);

        $banks = $bankRepository->all();

        foreach ($banks as $bank) {
            $bankRepository->delete($bank->id);
        }
    }

    public function getData() {
        return [
            [
                'name' => 'Caixa Econômica Federal',
                'logo' => new \Illuminate\Http\UploadedFile(storage_path('app/files/banks/logos/caixa.png'), 'caixa.png')
            ],
            [
                'name' => 'Banco do Brasil',
                'logo' => new \Illuminate\Http\UploadedFile(storage_path('app/files/banks/logos/banco-brasil.png'), 'banco-brasil.png')
            ],
            [
                'name' => 'Itaú',
                'logo' => new \Illuminate\Http\UploadedFile(storage_path('app/files/banks/logos/itau.jpg'), 'itau.jpg')
            ],
            [
                'name' => 'Bradesco',
                'logo' => new \Illuminate\Http\UploadedFile(storage_path('app/files/banks/logos/bradesco.gif'), 'bradesco.gif')
            ],
            [
                'name' => 'Santander',
                'logo' => new \Illuminate\Http\UploadedFile(storage_path('app/files/banks/logos/santander.jpg'), 'santander.jpg')
            ],
        ];
    }
}

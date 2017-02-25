<?php

namespace FinancialSystem\Repositories;

trait GetClientsTrait
{

    private function getClients()
    {
        /** @var \FinancialSystem\Repositories\BankRepository $clientRepository */
        $clientRepository = app(\FinancialSystem\Repositories\ClientRepository::class);
        $clientRepository->skipPresenter(true);

        return $clientRepository->all();
    }

}
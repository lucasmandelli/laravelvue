<?php

namespace FinancialSystem\Listeners;

use FinancialSystem\Events\BankStoredEvent;
use FinancialSystem\Models\Bank;
use FinancialSystem\Repositories\BankRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BankLogoUploadListener
{
    /**
     * @var BankRepository
     */
    private $repository;

    /**
     * Create the event listener.
     *
     * @param BankRepository $repository
     */
    public function __construct(BankRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  BankStoredEvent  $event
     * @return void
     */
    public function handle(BankStoredEvent $event)
    {
        $bank = $event->getBank();
        $logo = $event->getLogo();

        if($logo) {
            $name = $bank->created_at != $bank->updated_at ? $bank->logo : md5($logo->getClientOriginalName()) . '.' . $logo->guessExtension();
            $destFile = Bank::logosDir();

            $result = \Storage::disk('public')->putFileAs($destFile, $logo, $name);

            if($result && $bank->created_at == $bank->updated_at) {
                $this->repository->update(['logo' => $name], $bank->id);
            }
        }
    }
}

<?php

namespace FinancialSystem\Presenters;

use FinancialSystem\Transformers\BankAccountTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BankAccountPresenter
 *
 * @package namespace FinancialSystem\Presenters;
 */
class BankAccountPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BankAccountTransformer();
    }
}

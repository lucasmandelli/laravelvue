<?php

namespace FinancialSystem\Presenters;

use FinancialSystem\Transformers\BankTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BankPresenter
 *
 * @package namespace FinancialSystem\Presenters;
 */
class BankPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BankTransformer();
    }
}

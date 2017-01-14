<?php

namespace FinancialSystem\Presenters;

use FinancialSystem\Transformers\BillReceivedTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BillReceivedPresenter
 *
 * @package namespace FinancialSystem\Presenters;
 */
class BillReceivedPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BillReceivedTransformer();
    }
}
